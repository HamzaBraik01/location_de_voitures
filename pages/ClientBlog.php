<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoMove - Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .article-enter {
            animation: fadeIn 0.3s ease-in;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Navbar reste identique au fichier principal -->
     <!-- Mobile Menu (Using Alpine.js) -->
    <div x-data="{ isOpen: false }" class="relative">
        <!-- Navbar -->
        <nav class="bg-black shadow-lg fixed w-full top-0 z-50">
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center">
                        <a href="#" class="text-2xl font-bold text-cyan-400">AutoMove</a>
                    </div>
                    
                    <!-- Desktop Menu -->
                    <div class="hidden md:flex items-center space-x-8">
                        <a href="#" class="text-white hover:text-cyan-400 transition-colors">Accueil</a>
                        <a href="#" class="text-white hover:text-cyan-400 transition-colors">Véhicules</a>
                        <a href="#" class="text-white hover:text-cyan-400 transition-colors">Catégories</a>
                        <a href="./pages/ClientBlog.php" class="text-cyan-400 transition-colors">Blog</a>
                        <a href="#" class="text-white hover:text-cyan-400 transition-colors">Contact</a>
                        <a href="./pages/login.php" class="bg-cyan-400 text-white px-6 py-2 rounded-full hover:bg-cyan-500 transition-colors">Connexion</a>
                    </div>

                    <!-- Mobile Menu Button -->
                    <button @click="isOpen = !isOpen" class="md:hidden">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="!isOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            <path x-show="isOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu Items -->
            <div x-show="isOpen" class="md:hidden bg-white border-t" x-transition>
                <a href="#" class="block px-4 py-2 text-cyan-600 hover:bg-cyan-500">Accueil</a>
                <a href="#" class="block px-4 py-2 text-cyan-600 hover:bg-cyan-500">Véhicules</a>
                <a href="#" class="block px-4 py-2 text-cyan-600 hover:bg-cyan-500">Catégories</a>
                <a href="./pages/ClientBlog.php" class="block px-4 py-2 text-gray-600 ">Blog</a>
                <a href="#" class="block px-4 py-2 text-cyan-600 hover:bg-cyan-500">Contact</a>
                <div class="px-4 py-2">
                    <a href="./pages/login.php" class="w-full bg-cyan-400 text-white px-4 py-2 rounded-full hover:bg-cyan-500">Connexion</a>
                </div>
            </div>
        </nav>
    </div>

    <!-- Blog Content -->
    <div class="max-w-7xl mx-auto px-4 py-8 mt-16">
        <!-- Blog Header -->
        <div class="mb-8">
            <h1 class="text-4xl font-bold mb-4">Blog AutoMove</h1>
            <p class="text-gray-600">Découvrez nos derniers articles et partagez vos expériences</p>
        </div>

        <!-- Toolbar -->
        <div class="flex flex-wrap gap-4 mb-8">
            <!-- Search Bar -->
            <div class="flex-1 min-w-[300px]">
                <div class="relative">
                    <input
                        type="text"
                        id="searchInput"
                        placeholder="Rechercher un article..."
                        class="w-full pl-10 pr-4 py-2 border rounded-lg"
                    >
                    <svg class="w-5 h-5 absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </div>

            <!-- Items per page selector -->
            <select 
                id="itemsPerPage"
                class="border rounded-lg px-4 py-2"
            >
                <option value="5">5 par page</option>
                <option value="10">10 par page</option>
                <option value="15">15 par page</option>
            </select>

            <!-- Add Article Button -->
            <button
                id="addArticleBtn"
                class="bg-cyan-400 text-white px-4 py-2 rounded-lg flex items-center gap-2"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Nouvel Article
            </button>
        </div>

        <!-- Tags -->
        <div id="tagsContainer" class="flex flex-wrap gap-2 mb-8">
            <!-- Tags will be inserted here by JavaScript -->
        </div>

        <!-- Articles Container -->
        <div id="articlesContainer" class="space-y-8">
            <!-- Articles will be inserted here by JavaScript -->
        </div>

        <!-- Pagination -->
        <div id="pagination" class="flex justify-center gap-2 mt-8">
            <!-- Pagination buttons will be inserted here by JavaScript -->
        </div>
    </div>

    <!-- Add Article Modal -->
    <div id="addArticleModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">
        <div class="bg-white rounded-lg p-6 max-w-lg w-full">
            <h3 class="text-2xl font-bold mb-4">Nouvel Article</h3>
            <form id="newArticleForm" class="space-y-4">
                <input
                    type="text"
                    name="title"
                    placeholder="Titre"
                    class="w-full px-4 py-2 border rounded"
                    required
                >
                <textarea
                    name="content"
                    placeholder="Contenu"
                    class="w-full px-4 py-2 border rounded h-32"
                    required
                ></textarea>
                <input
                    type="text"
                    name="tags"
                    placeholder="Tags (séparés par des virgules)"
                    class="w-full px-4 py-2 border rounded"
                    required
                >
                <div class="flex justify-end gap-4">
                    <button type="button" id="cancelArticle" class="px-4 py-2 border rounded">
                        Annuler
                    </button>
                    <button type="submit" class="px-4 py-2 bg-cyan-400 text-white rounded">
                        Publier
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- Footer avec design amélioré -->
    <footer class="bg-black text-white py-16">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                <!-- Company Info -->
                <div>
                    <h3 class="text-2xl font-bold text-cyan-400 mb-6">AutoMove</h3>
                    <p class="text-gray-400 mb-6">Location de voitures premium depuis 2024. Votre satisfaction est notre priorité.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="bg-blue-600 p-2 rounded-full hover:bg-blue-700 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/>
                            </svg>
                        </a>
                        <a href="#" class="bg-blue-400 p-2 rounded-full hover:bg-blue-500 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"/>
                            </svg>
                        </a>
                        <a href="#" class="bg-pink-600 p-2 rounded-full hover:bg-pink-700 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-semibold mb-6">Liens Rapides</h4>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-gray-400 hover:text-cyan-400 transition-colors">Accueil</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-cyan-400 transition-colors">Nos véhicules</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-cyan-400 transition-colors">Réservation</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-cyan-400 transition-colors">À propos</a></li>
                    </ul>
                </div>

                <!-- Services -->
                <div>
                    <h4 class="text-lg font-semibold mb-6">Nos Services</h4>
                    <ul class="space-y-4">
                        <li><a href="#" class="text-gray-400 hover:text-cyan-400 transition-colors">Location courte durée</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-cyan-400 transition-colors">Location longue durée</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-cyan-400 transition-colors">Assurances</a></li>
                        <li><a href="#" class="text-gray-400 hover:ttext-cyan-400 transition-colors">Services VIP</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h4 class="text-lg font-semibold mb-6">Contact</h4>
                    <ul class="space-y-4">
                        <li class="flex items-center text-gray-400">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.242-4.243a2 2 0 010-2.827l.1-.1a1.998 1.998 0 012.827 0l4.243 4.243a1.998 1.998 0 01-.001 2.827z"/>
                            </svg>
                            123 Avenue des Champs-Élysées, Paris
                        </li>
                        <li class="flex items-center text-gray-400">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            contact@driveloc.fr
                        </li>
                        <li class="flex items-center text-gray-400">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            01 23 45 67 89
                        </li>
                        <li class="flex items-center text-gray-400">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Lun-Sam: 8h-20h
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Footer -->
            <div class="border-t border-gray-800 mt-12 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-400 text-sm mb-4 md:mb-0">
                        © 2024 AutoMove. Tous droits réservés.
                    </p>
                    <div class="flex space-x-6">
                        <a href="#" class="text-gray-400 hover:text-white text-sm">Mentions légales</a>
                        <a href="#" class="text-gray-400 hover:text-white text-sm">Politique de confidentialité</a>
                        <a href="#" class="text-gray-400 hover:text-white text-sm">CGV</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>


    <script>
        // Data
        let articles = [
            {
                id: 1,
                title: "Les meilleurs SUV de 2024",
                content: "Découvrez notre sélection des SUV les plus performants...",
                author: "Jean Dupont",
                date: "2024-01-15",
                tags: ["SUV", "Comparatif", "2024"],
                likes: 15,
                comments: [
                    { id: 1, author: "Marie L.", content: "Excellent article !", date: "2024-01-16" }
                ],
                isFavorite: false
            }
            // Autres articles...
        ];

        let currentPage = 1;
        let itemsPerPage = 5;
        let selectedTags = [];

        // DOM Elements
        const searchInput = document.getElementById('searchInput');
        const itemsPerPageSelect = document.getElementById('itemsPerPage');
        const addArticleBtn = document.getElementById('addArticleBtn');
        const modal = document.getElementById('addArticleModal');
        const articleForm = document.getElementById('newArticleForm');
        const cancelBtn = document.getElementById('cancelArticle');
        const tagsContainer = document.getElementById('tagsContainer');
        const articlesContainer = document.getElementById('articlesContainer');
        const paginationContainer = document.getElementById('pagination');

        // Available tags
        const availableTags = ["SUV", "Citadine", "Électrique", "Comparatif", "Entretien"];

        // Initialize Tags
        function initializeTags() {
            tagsContainer.innerHTML = availableTags.map(tag => `
                <button
                    data-tag="${tag}"
                    class="tag-btn flex items-center gap-1 px-3 py-1 rounded-full ${
                        selectedTags.includes(tag) ? 'bg-cyan-400 text-white' : 'bg-gray-100'
                    }"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                    ${tag}
                </button>
            `).join('');
        }

        // Render Articles
        function renderArticles() {
            const filteredArticles = articles.filter(article => {
                const matchesSearch = article.title.toLowerCase().includes(searchInput.value.toLowerCase());
                const matchesTags = selectedTags.length === 0 || 
                    selectedTags.every(tag => article.tags.includes(tag));
                return matchesSearch && matchesTags;
            });

            const startIndex = (currentPage - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            const paginatedArticles = filteredArticles.slice(startIndex, endIndex);

            articlesContainer.innerHTML = paginatedArticles.map(article => `
                <div class="article-enter bg-white rounded-lg shadow-md p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h2 class="text-2xl font-bold mb-2">${article.title}</h2>
                            <div class="flex items-center gap-4 text-sm text-gray-500">
                                <span>${article.author}</span>
                                <span>${article.date}</span>
                            </div>
                        </div>
                        <button 
                            class="favorite-btn p-2 rounded-full ${article.isFavorite ? 'text-red-500' : 'text-gray-400'}"
                            data-id="${article.id}"
                        >
                            <svg class="w-6 h-6" fill="${article.isFavorite ? 'currentColor' : 'none'}" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </button>
                    </div>
                    <p class="mb-4">${article.content}</p>
                    <div class="flex flex-wrap gap-2 mb-4">
                        ${article.tags.map(tag => `
                            <span class="bg-gray-100 px-3 py-1 rounded-full text-sm">${tag}</span>
                        `).join('')}
                    </div>
                    <div class="flex items-center gap-4 text-gray-500">
                        <button class="flex items-center gap-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                            ${article.comments.length} commentaires
                        </button>
                        <button class="flex items-center gap-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                            ${article.likes} likes
                        </button>
                    </div>
                </div>
            `).join('');

            // Update pagination
            const pageCount = Math.ceil(filteredArticles.length / itemsPerPage);
            paginationContainer.innerHTML = Array.from({ length: pageCount }).map((_, idx) => `
                <button 
                    class="page-btn px-4 py-2 rounded ${
                        currentPage === idx + 1 ? 'bg-cyan-400 text-white' : 'bg-gray-100'
                    }"
                    data-page="${idx + 1}"
                >
                    ${idx + 1}
                </button>
            `).join('');
        }

        // Event Listeners
        searchInput.addEventListener('input', () => {
            currentPage = 1;
            renderArticles();
        });

        itemsPerPageSelect.addEventListener('change', (e) => {
            itemsPerPage = parseInt(e.target.value);
            currentPage = 1;
            renderArticles();
        });

        addArticleBtn.addEventListener('click', () => {
            modal.classList.remove('hidden');
        });

        cancelBtn.addEventListener('click', () => {
            modal.classList.add('hidden');
            articleForm.reset();
        });

        articleForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const formData = new FormData(articleForm);
            const newArticle = {
                id: articles.length + 1,
                title: formData.get('title'),
                content: formData.get('content'),
                tags: formData.get('tags').split(',').map(tag => tag.trim()),
                author: "User",
                date: new Date().toISOString().split('T')[0],
                likes: 0,
                comments: [],
                isFavorite: false
            };
            articles.unshift(newArticle);
            modal.classList.add('hidden');
            articleForm.reset();
            renderArticles();
        });

        tagsContainer.addEventListener('click', (e) => {
            const tagBtn = e.target.closest('.tag-btn');
            if (tagBtn) {
                const tag = tagBtn.dataset.tag;
                if (selectedTags.includes(tag)) {
                    selectedTags = selectedTags.filter(t => t !== tag);
                } else {
                    selectedTags.push(tag);
                }
                initializeTags();
                renderArticles();
            }
        });

        paginationContainer.addEventListener('click', (e) => {
            const pageBtn = e.target.closest('.page-btn');
            if (pageBtn) {
                currentPage = parseInt(pageBtn.dataset.page);
                renderArticles();
            }
        });

        articlesContainer.addEventListener('click', (e) => {
            const favoriteBtn = e.target.closest('.favorite-btn');
            if (favoriteBtn) {
                const id = parseInt(favoriteBtn.dataset.id);
                const article = articles.find(a => a.id === id);
                if (article) {
                    article.isFavorite = !article.isFavorite;
                    renderArticles();
                }
            }
        });

        // Initialize
        initializeTags();
        renderArticles();
    </script>
</body>
</html>