<?php
session_start();
require_once '../class/DatabaseConnection.php';
require_once '../class/Categorie.Class.php';
require_once '../class/Vehicule.Class.php';
require_once '../class/Reservation.Class.php';

$categories = Categorie::getAll();

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = 3;

$vehicules = Vehicule::getPaginatedVehicles($page, $perPage);
$totalVehicles = Vehicule::getTotalVehicles();
$totalPages = ceil($totalVehicles / $perPage);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vehicleId = $_POST['vehicleId'];
    $pickupDate = $_POST['pickupDate'];
    $returnDate = $_POST['returnDate'];
    $pickupLocation = $_POST['pickupLocation'];
    $clientId = $_SESSION['user_id']; 

    $success = Reservation::createReservation($pickupDate, $returnDate, $pickupLocation, $clientId, $vehicleId);

    if ($success) {
        Vehicule::updateDisponibilite($vehicleId, false);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}
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
                <?php foreach ($vehicules as $vehicule): ?>
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-lg hover:scale-105 transition-all duration-300">
                        <img src="../uploadsimage/<?php echo htmlspecialchars($vehicule['image']); ?>" alt="Véhicule" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-semibold text-lg"><?php echo htmlspecialchars($vehicule['modele']); ?></h3>
                                </div>
                                <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full"><?php echo $vehicule['disponibilite'] ? 'Disponible' : 'Indisponible'; ?></span>
                            </div>
                            <div class="mt-4 flex justify-between items-center">
                                <div>
                                    <p class="text-gray-500 text-sm">À partir de</p>
                                    <p class="text-lg font-bold"><?php echo htmlspecialchars($vehicule['prixParJour']); ?>DH /jour</p>
                                </div>
                                <button onclick="openModal(<?php echo $vehicule['id']; ?>)" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                                    Réserver
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Pagination -->
            <div class="mt-8 flex justify-center">
                <nav class="flex items-center gap-2">
                    <?php if ($page > 1): ?>
                        <a href="?page=<?php echo $page - 1; ?>" class="p-2 rounded-lg hover:bg-gray-100">
                            <i data-feather="chevron-left" class="h-5 w-5"></i>
                        </a>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <a href="?page=<?php echo $i; ?>" class="px-4 py-2 <?php echo $i === $page ? 'bg-blue-500 text-white' : 'hover:bg-gray-100'; ?> rounded-lg">
                            <?php echo $i; ?>
                        </a>
                    <?php endfor; ?>

                    <?php if ($page < $totalPages): ?>
                        <a href="?page=<?php echo $page + 1; ?>" class="p-2 rounded-lg hover:bg-gray-100">
                            <i data-feather="chevron-right" class="h-5 w-5"></i>
                        </a>
                    <?php endif; ?>
                </nav>
            </div>
            <!-- Modal -->
            <div id="reservationModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
                <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                    <div class="mt-3 text-center">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Réserver un véhicule</h3>
                        <form id="reservationForm" action="" method="POST" class="mt-2">
                            <input type="hidden" id="vehicleId" name="vehicleId" value="">
                            <div class="mb-4">
                                <label for="pickupDate" class="block text-sm font-medium text-gray-700">Date de prise en charge</label>
                                <input type="date" id="pickupDate" name="pickupDate" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            </div>
                            <div class="mb-4">
                                <label for="returnDate" class="block text-sm font-medium text-gray-700">Date de retour</label>
                                <input type="date" id="returnDate" name="returnDate" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            </div>
                            <div class="mb-4">
                                <label for="pickupLocation" class="block text-sm font-medium text-gray-700">Lieu de prise en charge</label>
                                <input type="text" id="pickupLocation" name="pickupLocation" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            </div>
                            <div class="items-center px-4 py-3">
                                <button type="submit" class="px-4 py-2 bg-blue-500 text-white text-base font-medium rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    Confirmer la réservation
                                </button>
                                <button type="button" onclick="closeModal()" class="ml-3 px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500">
                                    Annuler
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        feather.replace();
        function openModal(vehicleId) {
        document.getElementById('reservationModal').classList.remove('hidden');
        document.getElementById('vehicleId').value = vehicleId;
        }

        function closeModal() {
            document.getElementById('reservationModal').classList.add('hidden');
        }
    </script>
</body>
</html>