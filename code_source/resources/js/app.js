import './bootstrap';
import '../css/app.css';
import 'trix';
import 'trix/dist/trix.css';

document.addEventListener('DOMContentLoaded', function() {
    const trixEditor = document.querySelector('trix-editor');
    if (trixEditor) {
        console.log('Trix Editor initialisé');
        document.addEventListener('trix-attachment-add', function(event) {
            if (event.attachment.file) {
                uploadFileAttachment(event.attachment);
            }
        });
    }
});

/**
 * Fonction pour uploader un fichier attaché à Trix
 * @param {object} attachment - L'objet attachment de Trix
 */
function uploadFileAttachment(attachment) {
    console.log('Début upload fichier:', attachment.file.name);

    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const formData = new FormData();
    formData.append('file', attachment.file);
    formData.append('_token', token);

    attachment.setUploadProgress(0);

    fetch('/admin/upload-trix-attachment', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
        .then(response => {
            console.log('Statut de la réponse:', response.status);
            if (!response.ok) {
                throw new Error('Erreur réseau: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            console.log('Données reçues:', data);
            if (data.url) {
                console.log('URL de l\'image:', data.url);
                attachment.setAttributes({
                    url: data.url,
                    href: data.url
                });
            } else {
                throw new Error('URL non trouvée dans la réponse');
            }
        })
        .catch(error => {
            console.error('Erreur lors de l\'upload:', error);
            attachment.remove();
        })
        .finally(() => {
            attachment.setUploadProgress(100);
        });
}
