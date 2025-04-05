
    <!-- Main Content -->
    <main class="flex-1 overflow-auto">
        <div class="p-4 bg-gray-100 border-b border-gray-200">
            <h1 class="text-lg font-medium text-gray-500">Ajouter un article</h1>
        </div>

        <div class="p-6">
            <!-- Fil d'Ariane -->
            <div class="flex items-center gap-2 mb-6">
                <a href="#" class="inline-flex items-center justify-center rounded-md border border-gray-200 bg-white h-8 w-8 p-0">
                    <i class="fas fa-arrow-left text-gray-600"></i>
                </a>
                <div class="text-sm">
                    <a href="#" class="text-gray-600 hover:underline">Article</a>
                    <span class="text-gray-400 mx-1">></span>
                    <span class="text-gray-800">Nouvelle publication</span>
                </div>
            </div>

            <!-- Titre et sous-titre -->
            <div class="mb-6">
                <h1 class="text-2xl font-bold mb-1">Créer un nouvel article</h1>
                <p class="text-sm text-gray-500">Créez une nouvelle publication pour informer les utilisateurs de l'application RUBI</p>
            </div>

            <!-- Formulaire d'article -->
            <div class="bg-white border border-gray-200 rounded-md p-6 mb-6">
                <h2 class="text-lg font-medium mb-6">Informations de l'article</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Titre de l'article -->
                    <div>
                        <label for="titre" class="block text-sm font-medium text-gray-700 mb-1">Titre de l'article</label>
                        <input
                            type="text"
                            id="titre"
                            placeholder="écrivez le titre de l'article"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm"
                        >
                    </div>

                    <!-- Image -->
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Image</label>
                        <input
                            type="text"
                            id="image"
                            placeholder="parcourir"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm"
                        >
                    </div>
                </div>

                <!-- Contenu -->
                <div class="mb-6">
                    <label for="contenu" class="block text-sm font-medium text-gray-700 mb-1">Contenu</label>
                    <textarea
                        id="contenu"
                        rows="12"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm"
                    ></textarea>
                </div>

                <!-- Boutons d'action -->
                <div class="flex justify-between">
                    <button class="px-4 py-2 bg-white border border-gray-300 rounded-md text-sm">
                        Annuler
                    </button>
                    <button class="px-4 py-2 bg-black text-white rounded-md text-sm flex items-center">
                        <i class="fas fa-save mr-2"></i>
                        Sauvegarder
                    </button>
                </div>
            </div>
        </div>
    </main>
</div>
</body>
</html>
