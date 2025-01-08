<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drive & Loc - Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media (max-width: 640px) {
            .hero-search {
                padding: 1rem;
            }
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-black shadow-lg fixed w-full top-0 z-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="#" class="text-2xl font-bold text-cyan-400">AutoMove</a>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#" class="text-white hover:text-cyan-400 transition-colors">Accueil</a>
                    <a href="#" class="text-white hover:text-cyan-400 transition-colors">Véhicules</a>
                    <a href="#" class="text-white hover:text-cyan-400 transition-colors">Catégories</a>
                    <a href="./ClientBlog.php" class="text-cyan-400 transition-colors">Blog</a>
                    <a href="#" class="text-white hover:text-cyan-400 transition-colors">Contact</a>
                    <a href="./pages/login.php" class="bg-cyan-400 text-white px-6 py-2 rounded-full hover:bg-cyan-500 transition-colors">Connexion</a>
                </div>
                <button class="md:hidden">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </nav>

    <!-- Blog Section -->
    <div class="max-w-7xl mx-auto px-4 py-16 mt-16">
        <h2 class="text-3xl md:text-4xl font-bold text-center mb-12">Blog</h2>
        
        <!-- Blog Themes -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            <div class="bg-white p-6 rounded-xl shadow-lg transform hover:scale-105 transition-transform">
                <h3 class="text-xl font-semibold mb-4">Thème 1</h3>
                <p class="text-gray-600 mb-4">Description du thème 1.</p>
                <button onclick="loadTheme('theme1')" class="bg-cyan-400 text-white px-6 py-2 rounded-full hover:bg-cyan-300 transition-colors">Voir les articles</button>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-lg transform hover:scale-105 transition-transform">
                <h3 class="text-xl font-semibold mb-4">Thème 2</h3>
                <p class="text-gray-600 mb-4">Description du thème 2.</p>
                <button onclick="loadTheme('theme2')" class="bg-cyan-400 text-white px-6 py-2 rounded-full hover:bg-cyan-300 transition-colors">Voir les articles</button>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-lg transform hover:scale-105 transition-transform">
                <h3 class="text-xl font-semibold mb-4">Thème 3</h3>
                <p class="text-gray-600 mb-4">Description du thème 3.</p>
                <button onclick="loadTheme('theme3')" class="bg-cyan-400 text-white px-6 py-2 rounded-full hover:bg-cyan-300 transition-colors">Voir les articles</button>
            </div>
        </div>

        <!-- Articles Section -->
        <div id="articles" class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Articles will be loaded here -->
        </div>

        <!-- Pagination -->
        <div class="flex justify-center mt-12">
            <button onclick="changePage(-1)" class="bg-cyan-400 text-white px-6 py-2 rounded-full hover:bg-cyan-300 transition-colors mr-4">Précédent</button>
            <button onclick="changePage(1)" class="bg-cyan-400 text-white px-6 py-2 rounded-full hover:bg-cyan-300 transition-colors">Suivant</button>
        </div>
    </div>

    <!-- Footer -->
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
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        let currentTheme = '';
        let currentPage = 1;
        const articlesPerPage = 5;

        const articlesData = {
            theme1: [
                { title: 'Article 1', content: 'Contenu de l\'article 1', tags: ['tag1', 'tag2'] },
                { title: 'Article 2', content: 'Contenu de l\'article 2', tags: ['tag2', 'tag3'] },
                // Add more articles
            ],
            theme2: [
                { title: 'Article 3', content: 'Contenu de l\'article 3', tags: ['tag1', 'tag3'] },
                { title: 'Article 4', content: 'Contenu de l\'article 4', tags: ['tag2', 'tag4'] },
                // Add more articles
            ],
            theme3: [
                { title: 'Article 5', content: 'Contenu de l\'article 5', tags: ['tag1', 'tag4'] },
                { title: 'Article 6', content: 'Contenu de l\'article 6', tags: ['tag3', 'tag4'] },
                // Add more articles
            ]
        };

        function loadTheme(theme) {
            currentTheme = theme;
            currentPage = 1;
            displayArticles();
        }

        function displayArticles() {
            const articles = articlesData[currentTheme] || [];
            const start = (currentPage - 1) * articlesPerPage;
            const end = start + articlesPerPage;
            const paginatedArticles = articles.slice(start, end);

            const articlesContainer = document.getElementById('articles');
            articlesContainer.innerHTML = paginatedArticles.map(article => `
                <div class="bg-white p-6 rounded-xl shadow-lg">
                    <h3 class="text-xl font-semibold mb-4">${article.title}</h3>
                    <p class="text-gray-600 mb-4">${article.content}</p>
                    <div class="flex flex-wrap gap-2 mb-4">
                        ${article.tags.map(tag => `<span class="bg-gray-100 px-3 py-1 rounded-full text-sm">${tag}</span>`).join('')}
                    </div>
                    <button class="bg-cyan-400 text-white px-6 py-2 rounded-full hover:bg-cyan-300 transition-colors">Voir plus</button>
                </div>
            `).join('');
        }

        function changePage(direction) {
            currentPage += direction;
            displayArticles();
        }

        // Initial load
        loadTheme('theme1');
    </script>
</body>
</html>