<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drive & Loc Admin</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.0/feather.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-white border-b border-gray-200 fixed w-full z-30">
        <div class="px-4 py-3 lg:px-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <button class="p-2 rounded-lg hover:bg-gray-100 lg:hidden">
                        <i data-feather="menu" class="h-6 w-6"></i>
                    </button>
                    <h1 class="text-xl font-bold ml-2">Drive & Loc Admin</h1>
                </div>
                <div class="flex items-center gap-4">
                    <div class="hidden md:flex items-center bg-gray-100 rounded-lg px-3 py-2">
                        <i data-feather="search" class="h-5 w-5 text-gray-500"></i>
                        <input type="text" placeholder="Rechercher..." class="bg-transparent border-none focus:outline-none ml-2">
                    </div>
                    <button class="p-2 rounded-lg hover:bg-gray-100 relative">
                        <i data-feather="bell" class="h-6 w-6"></i>
                        <span class="absolute top-1 right-1 h-2 w-2 bg-red-500 rounded-full"></span>
                    </button>
                    <img src="https://via.placeholder.com/32" alt="Admin" class="h-8 w-8 rounded-full">
                </div>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <aside class="fixed left-0 top-0 z-20 h-full w-64 pt-16 bg-white border-r border-gray-200 hidden lg:block">
        <div class="p-4">
            <nav class="space-y-1">
                <a href="#" class="flex items-center px-4 py-2 text-gray-900 bg-gray-100 rounded-lg">
                    <i data-feather="bar-chart-2" class="h-5 w-5 mr-3"></i>
                    Tableau de bord
                </a>
                <a href="#" class="flex items-center px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                    <i data-feather="calendar" class="h-5 w-5 mr-3"></i>
                    Réservations
                </a>
                <a href="#" class="flex items-center px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                    <i data-feather="truck" class="h-5 w-5 mr-3"></i>
                    Véhicules
                </a>
                <a href="#" class="flex items-center px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                    <i data-feather="users" class="h-5 w-5 mr-3"></i>
                    Clients
                </a>
                <a href="#" class="flex items-center px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                    <i data-feather="star" class="h-5 w-5 mr-3"></i>
                    Avis
                </a>
            </nav>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="lg:ml-64 pt-16">
        <div class="p-4 lg:p-8">
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
                <!-- Stat Card 1 -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">Réservations Totales</p>
                            <h3 class="text-2xl font-bold mt-1">1,234</h3>
                            <p class="text-sm text-green-600 mt-1">+12%</p>
                        </div>
                        <div class="p-3 bg-blue-50 rounded-lg">
                            <i data-feather="calendar" class="h-6 w-6 text-blue-600"></i>
                        </div>
                    </div>
                </div>
                <!-- Stat Card 2 -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">Véhicules Actifs</p>
                            <h3 class="text-2xl font-bold mt-1">45</h3>
                            <p class="text-sm text-green-600 mt-1">+3%</p>
                        </div>
                        <div class="p-3 bg-blue-50 rounded-lg">
                            <i data-feather="truck" class="h-6 w-6 text-blue-600"></i>
                        </div>
                    </div>
                </div>
                <!-- Stat Card 3 -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">Clients Actifs</p>
                            <h3 class="text-2xl font-bold mt-1">892</h3>
                            <p class="text-sm text-green-600 mt-1">+5%</p>
                        </div>
                        <div class="p-3 bg-blue-50 rounded-lg">
                            <i data-feather="users" class="h-6 w-6 text-blue-600"></i>
                        </div>
                    </div>
                </div>
                <!-- Stat Card 4 -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">Avis Reçus</p>
                            <h3 class="text-2xl font-bold mt-1">432</h3>
                            <p class="text-sm text-green-600 mt-1">+8%</p>
                        </div>
                        <div class="p-3 bg-blue-50 rounded-lg">
                            <i data-feather="star" class="h-6 w-6 text-blue-600"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Bookings -->
            <div class="mt-8">
                <div class="bg-white rounded-lg shadow">
                    <div class="p-6">
                        <h2 class="text-lg font-medium">Réservations Récentes</h2>
                        <div class="mt-4 overflow-x-auto">
                            <table class="w-full">
                                <thead class="text-left bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-sm text-gray-500">Client</th>
                                        <th class="px-6 py-3 text-sm text-gray-500">Véhicule</th>
                                        <th class="px-6 py-3 text-sm text-gray-500">Date</th>
                                        <th class="px-6 py-3 text-sm text-gray-500">Statut</th>
                                        <th class="px-6 py-3 text-sm text-gray-500">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-6 py-4">Jean Dupont</td>
                                        <td class="px-6 py-4">Renault Clio</td>
                                        <td class="px-6 py-4">2024-01-15</td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                En cours
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex space-x-2">
                                                <button class="text-blue-600 hover:text-blue-800">
                                                    <i data-feather="edit-2" class="h-4 w-4"></i>
                                                </button>
                                                <button class="text-red-600 hover:text-red-800">
                                                    <i data-feather="trash-2" class="h-4 w-4"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4">Marie Martin</td>
                                        <td class="px-6 py-4">Peugeot 208</td>
                                        <td class="px-6 py-4">2024-01-14</td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Terminée
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex space-x-2">
                                                <button class="text-blue-600 hover:text-blue-800">
                                                    <i data-feather="edit-2" class="h-4 w-4"></i>
                                                </button>
                                                <button class="text-red-600 hover:text-red-800">
                                                    <i data-feather="trash-2" class="h-4 w-4"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        feather.replace();
    </script>
</body>
</html>