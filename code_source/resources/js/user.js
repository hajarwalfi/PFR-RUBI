import './bootstrap';
import '../css/app.css';
document.addEventListener('DOMContentLoaded', function() {
    var userMenuButton = document.getElementById('userMenuButton');
    var userMenu = document.getElementById('userMenu');

    if (userMenuButton && userMenu) {
        userMenuButton.onclick = function() {
            userMenu.classList.toggle('hidden');
        };
    }

    var mobileMenuButton = document.getElementById('mobileMenuButton');
    var mobileMenu = document.getElementById('mobileMenu');
    var closeMenuButton = document.getElementById('closeMobileMenu');

    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.onclick = function() {
            mobileMenu.classList.toggle('hidden');
        };
    }

    if (closeMenuButton && mobileMenu) {
        closeMenuButton.onclick = function() {
            mobileMenu.classList.add('hidden');
        };
    }
});
