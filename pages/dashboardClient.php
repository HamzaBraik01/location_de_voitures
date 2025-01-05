<?php
require_once '../class/DatabaseConnection.php';
require_once '../class/Categorie.Class.php';

$categories = Categorie::getAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoMove- Espace Client</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/jquery.dataTables.min.css">
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white border-b border-gray-200 fixed w-full z-30">
        <div class="px-4 py-3 lg:px-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <h1 class="text-xl font-bold">AutoMove</h1>
                </div>
                <div class="flex items-center gap-4">
                    <div class="hidden md:flex items-center bg-gray-100 rounded-lg px-3 py-2">
                        <i data-feather="search" class="h-5 w-5 text-gray-500"></i>
                        <input type="text" placeholder="Rechercher un véhicule..." class="bg-transparent border-none focus:outline-none ml-2">
                    </div>
                    <div class="flex items-center gap-2">
                        <button class="p-2 rounded-lg hover:bg-gray-100 relative">
                            <i data-feather="shopping-cart" class="h-6 w-6"></i>
                            <span class="absolute top-1 right-1 h-2 w-2 bg-blue-500 rounded-full"></span>
                        </button>
                        <div class="flex items-center gap-2 border-l pl-4">
                            <img src="/api/placeholder/32/32" alt="Profile" class="h-8 w-8 rounded-full">
                            <span class="text-sm font-medium">Jean Dupont</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-16">
        <div class="p-4 lg:p-8">
            <!-- Category Filter -->
            <div class="flex gap-4 overflow-x-auto pb-4">
                <button class="px-4 py-2 bg-blue-500 text-white rounded-lg flex items-center gap-2 whitespace-nowrap">
                    <i data-feather="grid" class="h-4 w-4"></i>
                    Toutes les catégories
                </button>
                <?php foreach ($categories as $categorie): ?>
                    <button class="px-4 py-2 bg-white hover:bg-gray-50 text-gray-700 rounded-lg flex items-center gap-2 whitespace-nowrap">
                        <i data-feather="truck" class="h-4 w-4"></i>
                        <?php echo htmlspecialchars($categorie['nom']); ?>
                    </button>
                <?php endforeach; ?>
            </div>

            <!-- Vehicle Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mt-6">
                <!-- Vehicle Card -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <img src="/api/placeholder/400/200" alt="Véhicule" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="font-semibold text-lg">Renault Clio</h3>
                                <p class="text-gray-600 text-sm">Essence - 5 portes</p>
                            </div>
                            <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Disponible</span>
                        </div>
                        <div class="mt-4 flex justify-between items-center">
                            <div>
                                <p class="text-gray-500 text-sm">À partir de</p>
                                <p class="text-lg font-bold">45€ /jour</p>
                            </div>
                            <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                                Réserver
                            </button>
                        </div>
                    </div>
                </div>

                <!-- More Vehicle Cards -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <img src="/api/placeholder/400/200" alt="Véhicule" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="font-semibold text-lg">Peugeot e-208</h3>
                                <p class="text-gray-600 text-sm">Électrique - 5 portes</p>
                            </div>
                            <span class="bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full">Réservé</span>
                        </div>
                        <div class="mt-4 flex justify-between items-center">
                            <div>
                                <p class="text-gray-500 text-sm">À partir de</p>
                                <p class="text-lg font-bold">55€ /jour</p>
                            </div>
                            <button class="bg-gray-100 text-gray-400 px-4 py-2 rounded-lg cursor-not-allowed">
                                Réserver
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div class="mt-8 flex justify-center">
                <nav class="flex items-center gap-2">
                    <button class="p-2 rounded-lg hover:bg-gray-100">
                        <i data-feather="chevron-left" class="h-5 w-5"></i>
                    </button>
                    <button class="px-4 py-2 bg-blue-500 text-white rounded-lg">1</button>
                    <button class="px-4 py-2 hover:bg-gray-100 rounded-lg">2</button>
                    <button class="px-4 py-2 hover:bg-gray-100 rounded-lg">3</button>
                    <button class="p-2 rounded-lg hover:bg-gray-100">
                        <i data-feather="chevron-right" class="h-5 w-5"></i>
                    </button>
                </nav>
            </div>
        </div>
    </main>

    <!-- Vehicle Detail Modal -->
    

    <script>
        feather.replace();
    </script>
</body>
</html>