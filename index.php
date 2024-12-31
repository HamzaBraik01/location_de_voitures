<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drive & Loc - Location de voitures</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.13.5/cdn.js"></script>
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
                <a href="#" class="block px-4 py-2 text-gray-600 hover:bg-gray-100">Accueil</a>
                <a href="#" class="block px-4 py-2 text-gray-600 hover:bg-gray-100">Véhicules</a>
                <a href="#" class="block px-4 py-2 text-gray-600 hover:bg-gray-100">Catégories</a>
                <a href="#" class="block px-4 py-2 text-gray-600 hover:bg-gray-100">Contact</a>
                <div class="px-4 py-2">
                    <a href="./pages/login.php" class="w-full bg-cyan-400 text-white px-4 py-2 rounded-full hover:bg-cyan-500">Connexion</a>
                </div>
            </div>
        </nav>
    </div>

    <!-- Hero Section avec image de fond -->
    <div class="relative  min-h-screen flex items-center pt-16">
        <div class="absolute inset-0 z-0">
            <img src="./img/cover.jpg" alt="Luxury car" class="w-full h-full object-cover opacity-80">
        </div>
        <div class="max-w-7xl mx-auto px-4 py-16 relative z-10">
            <div class="text-center text-white">
                <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
                    Votre Voyage, Notre Passion
                </h1>
                <p class="text-xl md:text-2xl mb-12 max-w-3xl mx-auto">
                    Découvrez notre sélection premium de véhicules pour tous vos besoins de déplacement
                </p>
                
            </div>
        </div>
    </div>

    <!-- Categories Section -->
    <div class="max-w-7xl mx-auto px-4 py-16">
        <h2 class="text-3xl md:text-4xl font-bold text-center mb-12">Nos Catégories de Véhicules</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Citadines -->
            <div class="relative group overflow-hidden rounded-xl shadow-lg transform hover:scale-105 transition-transform">
                <img src="./img/Citadines.png" alt="Citadine" class="w-full h-64 object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-75"></div>
                <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                    <h3 class="text-2xl font-semibold mb-2">Citadines</h3>
                    <p class="mb-4 opacity-90">Parfaites pour la ville</p>
                    <a href="#" class="inline-block bg-white text-blue-600 px-4 py-2 rounded-full hover:bg-cyan-400 hover:text-white transition-colors">
                        Découvrir →
                    </a>
                </div>
            </div>

            <!-- SUV -->
            <div class="relative group overflow-hidden rounded-xl shadow-lg transform hover:scale-105 transition-transform">
                <img src="./img/suv.jpg" alt="SUV" class="w-full h-64 object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-75"></div>
                <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                    <h3 class="text-2xl font-semibold mb-2">SUV</h3>
                    <p class="mb-4 opacity-90">Pour plus d'espace et de confort</p>
                    <a href="#" class="inline-block bg-white text-blue-600 px-4 py-2 rounded-full hover:bg-cyan-400 hover:text-white transition-colors">
                        Découvrir →
                    </a>
                </div>
            </div>

            <!-- Utilitaires -->
            <div class="relative group overflow-hidden rounded-xl shadow-lg transform hover:scale-105 transition-transform">
                <img src="./img/Utilitaires.jpg" alt="Utilitaire" class="w-full h-64 object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-75"></div>
                <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                    <h3 class="text-2xl font-semibold mb-2">Utilitaires</h3>
                    <p class="mb-4 opacity-90">Pour vos besoins professionnels</p>
                    <a href="#" class="inline-block bg-white text-blue-600 px-4 py-2 rounded-full hover:bg-cyan-400 hover:text-white transition-colors">
                        Découvrir →
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Vehicles with improved cards -->
    <div class="bg-gray-100 py-16">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-12">Véhicules Populaires</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Vehicle Card 1 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:scale-105 transition-transform">
                    <div class="relative">
                        <img src="./img/Clio4.jpg" alt="Renault Clio" class="w-full h-48 object-cover">
                        <div class="absolute top-4 right-4 bg-blue-600 text-white px-3 py-1 rounded-full">
                            Disponible
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-3">
                            <h3 class="text-xl font-semibold">Renault Clio</h3>
                            <div class="flex text-yellow-400">★★★★☆</div>
                        </div>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="bg-gray-100 px-3 py-1 rounded-full text-sm">5 places</span>
                            <span class="bg-gray-100 px-3 py-1 rounded-full text-sm">Diesel</span>
                            <span class="bg-gray-100 px-3 py-1 rounded-full text-sm">Manuelle</span>
                        </div>
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-2xl font-bold text-cyan-400">45€/jour</span>
                            <button class="bg-cyan-400 text-white px-6 py-2 rounded-full hover:bg-cyan-300 transition-colors">
                                Réserver
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Vehicle Card 2 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:scale-105 transition-transform">
                    <div class="relative">
                        <img src="./img/eugeot3008.jpg" alt="Peugeot 3008" class="w-full h-48 object-cover">
                        <div class="absolute top-4 right-4 bg-green-600 text-white px-3 py-1 rounded-full">
                            Nouveau
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-3">
                            <h3 class="text-xl font-semibold">Peugeot 3008</h3>
                            <div class="flex text-yellow-400">★★★★★</div>
                        </div>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="bg-gray-100 px-3 py-1 rounded-full text-sm">7 places</span>
                            <span class="bg-gray-100 px-3 py-1 rounded-full text-sm">Essence</span>
                            <span class="bg-gray-100 px-3 py-1 rounded-full text-sm">Automatique</span>
                        </div>
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-2xl font-bold text-cyan-400">75€/jour</span>
                            <button class="bg-cyan-400 text-white px-6 py-2 rounded-full hover:bg-cyan-300 transition-colors">
                                Réserver
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Vehicle Card 3 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:scale-105 transition-transform">
                    <div class="relative">
                        <img src="./img/CitroenC3.png" alt="Citroën C3" class="w-full h-48 object-cover">
                        <div class="absolute top-4 right-4 bg-red-600 text-white px-3 py-1 rounded-full">
                            Promotion
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-3">
                            <h3 class="text-xl font-semibold">Citroën C3</h3>
                            <div class="flex text-yellow-400">★★★★☆</div>
                        </div>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="bg-gray-100 px-3 py-1 rounded-full text-sm">5 places</span>
                            <span class="bg-gray-100 px-3 py-1 rounded-full text-sm">Essence</span>
                            <span class="bg-gray-100 px-3 py-1 rounded-full text-sm">Manuelle</span>
                        </div>
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-2xl font-bold text-cyan-400">50€/jour</span>
                            <button class="bg-cyan-400 text-white px-6 py-2 rounded-full hover:bg-cyan-300 transition-colors">
                                Réserver</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section avec animation -->
    <div class="max-w-7xl mx-auto px-4 py-16">
        <h2 class="text-3xl md:text-4xl font-bold text-center mb-12">Pourquoi nous choisir ?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="bg-white p-8 rounded-xl shadow-lg transform hover:-translate-y-2 transition-transform">
                <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-center mb-4">Réservation Express</h3>
                <p class="text-gray-600 text-center">Réservez votre véhicule en moins de 3 minutes. Service disponible 24/7.</p>
            </div>

            <!-- Feature 2 -->
            <div class="bg-white p-8 rounded-xl shadow-lg transform hover:-translate-y-2 transition-transform">
                <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-center mb-4">Qualité Garantie</h3>
                <p class="text-gray-600 text-center">Tous nos véhicules sont contrôlés et nettoyés après chaque location.</p>
            </div>

            <!-- Feature 3 -->
            <div class="bg-white p-8 rounded-xl shadow-lg transform hover:-translate-y-2 transition-transform">
                <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-center mb-4">Support Premium</h3>
                <p class="text-gray-600 text-center">Une équipe dédiée à votre service 24/7 pour vous accompagner.</p>
            </div>
        </div>
    </div>

    <!-- Testimonials Section -->
    <div class="bg-gray-100 py-16">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-12">Ce que disent nos clients</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-white p-6 rounded-xl shadow-lg">
                    <div class="flex items-center mb-4">
                        <img src="./img/Marie.jpg" alt="Client" class="w-14 h-14 object-cover rounded-full">
                        <div class="ml-4">
                            <h4 class="font-semibold">Marie L.</h4>
                            <div class="flex text-yellow-400">★★★★★</div>
                        </div>
                    </div>
                    <p class="text-gray-600">"Service impeccable ! La voiture était propre et en parfait état. Je recommande vivement."</p>
                </div>

                <!-- Testimonial 2 -->
                <div class="bg-white p-6 rounded-xl shadow-lg">
                    <div class="flex items-center mb-4">
                        <img src="./img/ThomasR.jpg" alt="Client" class="w-14 h-14 object-cover rounded-full">
                        <div class="ml-4">
                            <h4 class="font-semibold">Thomas R.</h4>
                            <div class="flex text-yellow-400">★★★★★</div>
                        </div>
                    </div>
                    <p class="text-gray-600">"Réservation rapide et simple. Le personnel est très professionnel. Je reviendrai !"</p>
                </div>

                <!-- Testimonial 3 -->
                <div class="bg-white p-6 rounded-xl shadow-lg">
                    <div class="flex items-center mb-4">
                        <img src="./img/Sophie.jpg" alt="Client" class="w-14 h-14 object-cover rounded-full">
                        <div class="ml-4">
                            <h4 class="font-semibold">Sophie M.</h4>
                            <div class="flex text-yellow-400">★★★★★</div>
                        </div>
                    </div>
                    <p class="text-gray-600">"Des prix compétitifs et un service client au top. Merci Drive & Loc !"</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Newsletter Section -->
    <div class="bg-slate-900 py-16">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">Restez informé</h2>
            <p class="text-xl text-white/90 mb-8">Recevez nos meilleures offres et nos nouveautés</p>
            <form class="max-w-lg mx-auto flex flex-col sm:flex-row gap-4">
                <input type="email" placeholder="Votre adresse email" class="flex-1 px-6 py-3 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-300">
                <button class="bg-white text-blue-600 px-8 py-3 rounded-full hover:bg-cyan-400 transition-colors">
                    S'inscrire
                </button>
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

    <!-- Back to Top Button -->
    <button id="backToTop" class="fixed bottom-8 right-8 bg-blue-600 text-white p-3 rounded-full shadow-lg hover:bg-blue-700 transition-colors hidden">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
        </svg>
    </button>

    <!-- Scripts -->
    <script>
        // Back to Top Button
        const backToTopButton = document.getElementById('backToTop');
        
        window.addEventListener('scroll', () => {
            if (window.scrollY > 500) {
                backToTopButton.classList.remove('hidden');
            } else {
                backToTopButton.classList.add('hidden');
            }
        });

        backToTopButton.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Mobile Menu Toggle Animation
        const menuButton = document.querySelector('[x-data]');
        menuButton?.addEventListener('click', () => {
            document.body.style.overflow = 
                document.body.style.overflow === 'hidden' ? 'auto' : 'hidden';
        });

        // Smooth Scroll for Navigation Links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href'))?.scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>