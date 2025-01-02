<?php
require_once '../class/DatabaseConnection.php';
$db = new Database();
$pdo = $db->getConnection();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Suppression
    if (isset($_POST['delete']) && isset($_POST['reservation_id'])) {
        $stmt = $pdo->prepare("DELETE FROM reservation WHERE id = ?");
        $stmt->execute([$_POST['reservation_id']]);
        header('Location: AdminReservations.php');
        exit;
    }
    
    if (isset($_POST['update_status']) && isset($_POST['reservation_id']) && isset($_POST['statut'])) {
        $stmt = $pdo->prepare("UPDATE reservation SET statut = ? WHERE id = ?");
        $stmt->execute([$_POST['statut'], $_POST['reservation_id']]);
        header('Location: AdminReservations.php');
        exit;
    }
}
function getRecentReservations($pdo) {
    $query = "SELECT 
                r.id,
                p.nom as client_nom,
                v.modele as vehicule_modele,
                r.dateDebut,
                r.dateFin,
                r.statut
                FROM reservation r
                JOIN personne p ON r.clientId = p.id
                JOIN vehicule v ON r.vehiculeId = v.id
                ORDER BY r.dateDebut DESC";
    
    $result = $pdo->query($query);
    return $result->fetchAll();
}

function getStatusStyle($statut) {
    switch($statut) {
        case 'confirmée':
            return [
                'bg' => 'bg-green-100',
                'text' => 'text-green-800'
            ];
        case 'en attente':
            return [
                'bg' => 'bg-yellow-100',
                'text' => 'text-yellow-800'
            ];
        case 'annulée':
            return [
                'bg' => 'bg-red-100',
                'text' => 'text-red-800'
            ];
        default:
            return [
                'bg' => 'bg-gray-100',
                'text' => 'text-gray-800'
            ];
    }
}
$recentReservations = getRecentReservations($pdo);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoMove</title>
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
                    <h1 class="text-xl font-bold ml-2">AutoMove</h1>
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
                <a href="dashboardAdmin.php" class="flex items-center px-4 py-2 text-gray-900 hover:bg-gray-100 rounded-lg">
                    <i data-feather="bar-chart-2" class="h-5 w-5 mr-3"></i>
                    Tableau de bord
                </a>
                <a href="AdminReservations.php" class="flex items-center px-4 py-2 text-gray-600 bg-gray-100 rounded-lg">
                    <i data-feather="calendar" class="h-5 w-5 mr-3"></i>
                    Réservations
                </a>
                <a href="AdminVehicules.php" class="flex items-center px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                    <i data-feather="truck" class="h-5 w-5 mr-3"></i>
                    Véhicules
                </a>
                <a href="AdminAvis.php" class="flex items-center px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                    <i data-feather="star" class="h-5 w-5 mr-3"></i>
                    Avis
                </a>
            </nav>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="lg:ml-64 pt-16">
        <div class="p-4 lg:p-8">
            <div class="mt-8">
                <div class="bg-white rounded-lg shadow">
                    <div class="p-6">
                        <h2 class="text-lg font-medium">Réservations </h2>
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
                                <?php foreach($recentReservations as $reservation): 
                                    $statusStyle = getStatusStyle($reservation['statut']);
                                ?>
                                    <tr>
                                        <td class="px-6 py-4"><?php echo htmlspecialchars($reservation['client_nom']); ?></td>
                                        <td class="px-6 py-4"><?php echo htmlspecialchars($reservation['vehicule_modele']); ?></td>
                                        <td class="px-6 py-4"><?php echo htmlspecialchars($reservation['dateDebut']); ?></td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?php echo $statusStyle['bg'] . ' ' . $statusStyle['text']; ?>">
                                                <?php echo htmlspecialchars($reservation['statut']); ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex space-x-2">
                                                <button onclick="openEditModal(<?php echo htmlspecialchars($reservation['id']); ?>)" 
                                                        class="text-blue-600 hover:text-blue-800 edit">
                                                    <i data-feather="edit-2" class="h-4 w-4"></i>
                                                </button>
                                                <form method="POST" class="inline" >
                                                    <input type="hidden" name="reservation_id" value="<?php echo htmlspecialchars($reservation['id']); ?>">
                                                    <input type="hidden" name="delete" value="1">
                                                    <button type="submit" class="text-red-600 hover:text-red-800">
                                                        <i data-feather="trash-2" class="h-4 w-4"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium">Modifier le Statut</h3>
                    <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600">
                        <i data-feather="x" class="h-6 w-6"></i>
                    </button>
                </div>
                <form method="POST">
                    <input type="hidden" name="reservation_id" id="editReservationId">
                    <input type="hidden" name="update_status" value="1">
                    <div class="mb-4">
                        <label for="statut" class="block text-sm font-medium text-gray-700">Statut</label>
                        <select id="statut" name="statut" class="mt-1 block w-full rounded-lg border-gray-300">
                            <option value="confirmée">Confirmée</option>
                            <option value="en attente">En attente</option>
                            <option value="annulée">Annulée</option>
                        </select>
                    </div>
                    <div class="flex justify-end space-x-2">
                        <button type="button" onclick="closeEditModal()" 
                                class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">Annuler</button>
                        <button type="submit" 
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        feather.replace();
        function openEditModal(reservationId) {
            document.getElementById('editReservationId').value = reservationId;
            document.getElementById('editModal').classList.remove('hidden');
        }
        
        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }
    </script>
</body>
</html>