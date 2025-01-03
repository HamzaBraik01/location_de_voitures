<?php
require_once '../class/DatabaseConnection.php';
require_once '../class/Vehicule.Class.php';
require_once '../class/Categorie.Class.php';
$db = new Database();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_category') {
    $nom = $_POST['nom'];
    
    try {
        $db = new Database();
        $sql = "INSERT INTO categorie (nom) VALUES (?)";
        $stmt = $db->getConnection()->prepare($sql);
        $stmt->execute([$nom]);
        
        header('Location: ' . $_SERVER['PHP_SELF'] . '?success=category_added');
        exit();
    } catch (PDOException $e) {
        header('Location: ' . $_SERVER['PHP_SELF'] . '?error=category_error');
        exit();
    }
}

// Traitement de l'ajout de véhicule
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_vehicle') {
    $modele = $_POST['modele'];
    $prixParJour = $_POST['prixParJour'];
    $categorieId = $_POST['categorieId'];
    
    // Gestion de l'upload d'image
    $image = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../uploadsimage/';
        $imageFileName = uniqid() . '_' . basename($_FILES['image']['name']);
        $targetPath = $uploadDir . $imageFileName;
        
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            $image = $imageFileName;
        }
    }
    
    try {
        $sql = "INSERT INTO vehicule (modele, prixParJour, disponibilite, categorieId, image) VALUES (?, ?, 1, ?, ?)";
        $stmt = $db->getConnection()->prepare($sql);
        $stmt->execute([$modele, $prixParJour, $categorieId, $image]);
        
        header('Location: ' . $_SERVER['PHP_SELF'] . '?success=vehicle_added');
        exit();
    } catch (PDOException $e) {
        header('Location: ' . $_SERVER['PHP_SELF'] . '?error=vehicle_error');
        exit();
    }
}
$categories = Categorie::getAll();
/*---------------------------------------------------------------------------*/
$sql = "SELECT * FROM ListeVehicules";
$stmt = $db->getConnection()->prepare($sql);
$stmt->execute();
$vehicles2 = $stmt->fetchAll();
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
                <a href="AdminReservations.php" class="flex items-center px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                    <i data-feather="calendar" class="h-5 w-5 mr-3"></i>
                    Réservations
                </a>
                <a href="AdminVehicules.php" class="flex items-center px-4 py-2 text-gray-600 bg-gray-100 rounded-lg">
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
            <?php if (isset($_GET['success'])): ?>
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
                    <?php echo $_GET['success'] === 'category_added' ? 'Catégorie ajoutée avec succès!' : 'Véhicule ajouté avec succès!'; ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['error'])): ?>
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
                    Une erreur est survenue. Veuillez réessayer.
                </div>
            <?php endif; ?>

            <div class="mb-6">
                <button onclick="openCategoryModal()" class="bg-blue-500 text-white px-4 py-2 rounded-lg flex items-center">
                    <i data-feather="plus" class="h-5 w-5 mr-2"></i>
                    Ajouter une catégorie
                </button>
            </div>

            <!-- Liste des catégories -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <?php foreach ($categories as $categorie): ?>
                <div class="bg-white p-4 rounded-lg shadow">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold"><?= htmlspecialchars($categorie['nom']) ?></h3>
                        <button onclick="openVehicleModal(<?= $categorie['id'] ?>)" 
                                class="bg-green-500 text-white px-3 py-1 rounded flex items-center">
                            <i data-feather="plus" class="h-4 w-4 mr-1"></i>
                            Ajouter un véhicule
                        </button>
                    </div>
                    
                    <div class="space-y-4">
                        <?php 
                        $vehicles = Vehicule::getByCategory($categorie['id']);
                        foreach ($vehicles as $vehicle): 
                        ?>
                        <div class="flex items-center gap-4 border-b pb-4">
                            <?php if ($vehicle['image']): ?>
                                <img src="../uploadsimage/<?= htmlspecialchars($vehicle['image']) ?>" 
                                        alt="<?= htmlspecialchars($vehicle['modele']) ?>"
                                        class="w-24 h-24 object-cover rounded-lg">
                            <?php else: ?>
                                <div class="w-24 h-24 bg-gray-200 rounded-lg flex items-center justify-center">
                                    <i data-feather="image" class="h-8 w-8 text-gray-400"></i>
                                </div>
                            <?php endif; ?>
                            
                            <div>
                                <h4 class="font-medium"><?= htmlspecialchars($vehicle['modele']) ?></h4>
                                <p class="text-gray-600"><?= number_format($vehicle['prixParJour'], 2) ?>DH/jour</p>
                                <span class="inline-flex px-2 py-1 rounded-full text-xs <?= $vehicle['disponibilite'] ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                                    <?= $vehicle['disponibilite'] ? 'Disponible' : 'Indisponible' ?>
                                </span>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <!-- Liste des véhicules -->
            <div class="mt-8">
                <div class="bg-white rounded-lg shadow">
                    <div class="p-6">
                        <h2 class="text-lg font-medium">véhicules </h2>
                        <div class="mt-4 overflow-x-auto">
                            <table class="w-full">
                                <thead class="text-left bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-sm text-gray-500">Image</th>
                                        <th class="px-6 py-3 text-sm text-gray-500">Modèle</th>
                                        <th class="px-6 py-3 text-sm text-gray-500">Prix par jour</th>
                                        <th class="px-6 py-3 text-sm text-gray-500">Catégorie</th>
                                        <th class="px-6 py-3 text-sm text-gray-500">Disponibilité</th>
                                        <th class="px-6 py-3 text-sm text-gray-500">Note moyenne</th>
                                        <th class="px-6 py-3 text-sm text-gray-500">Nombre d'avis</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    <?php foreach ($vehicles2 as $vehicle): ?>
                                    <tr>
                                        <td class="px-6 py-4">
                                            <?php if ($vehicle['image']): ?>
                                                <img src="../uploadsimage/<?= htmlspecialchars($vehicle['image']) ?>" 
                                                    alt="<?= htmlspecialchars($vehicle['modele']) ?>"
                                                    class="w-16 h-16 object-cover rounded">
                                            <?php else: ?>
                                                <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center">
                                                    <i data-feather="image" class="h-8 w-8 text-gray-400"></i>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-6 py-4"><?= htmlspecialchars($vehicle['modele']) ?></td>
                                        <td class="px-6 py-4"><?= number_format($vehicle['prixParJour'], 2) ?> DH</td>
                                        <td class="px-6 py-4"><?= htmlspecialchars($vehicle['categorie']) ?></td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex px-2 py-1 rounded-full text-xs <?= $vehicle['estDisponible'] ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                                                <?= $vehicle['estDisponible'] ? 'Disponible' : 'Indisponible' ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4"><?= number_format($vehicle['moyenneNote'], 1) ?>/5</td>
                                        <td class="px-6 py-4"><?= $vehicle['nombreAvis'] ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <!-- Modal Catégorie -->
    <div id="categoryModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">
        <div class="bg-white rounded-lg p-6 w-96">
            <h2 class="text-xl font-bold mb-4">Ajouter une catégorie</h2>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <input type="hidden" name="action" value="add_category">
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Nom de la catégorie</label>
                    <input type="text" name="nom" required 
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeCategoryModal()" 
                            class="px-4 py-2 border rounded-lg">Annuler</button>
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-500 text-white rounded-lg">Ajouter</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Véhicule -->
    <div id="vehicleModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">
        <div class="bg-white rounded-lg p-6 w-96">
            <h2 class="text-xl font-bold mb-4">Ajouter un véhicule</h2>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" value="add_vehicle">
                <input type="hidden" name="categorieId" id="vehicleCategoryId">
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Modèle</label>
                    <input type="text" name="modele" required 
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Prix par jour</label>
                    <input type="number" name="prixParJour" step="0.01" required 
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Image</label>
                    <input type="file" name="image" accept="image/*" 
                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeVehicleModal()" 
                            class="px-4 py-2 border rounded-lg">Annuler</button>
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-500 text-white rounded-lg">Ajouter</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        feather.replace();

        function openCategoryModal() {
            document.getElementById('categoryModal').classList.remove('hidden');
        }

        function closeCategoryModal() {
            document.getElementById('categoryModal').classList.add('hidden');
        }

        function openVehicleModal(categorieId) {
            document.getElementById('vehicleCategoryId').value = categorieId;
            document.getElementById('vehicleModal').classList.remove('hidden');
        }

        function closeVehicleModal() {
            document.getElementById('vehicleModal').classList.add('hidden');
        }

        window.onclick = function(event) {
            let categoryModal = document.getElementById('categoryModal');
            let vehicleModal = document.getElementById('vehicleModal');
            
            if (event.target === categoryModal) {
                closeCategoryModal();
            }
            if (event.target === vehicleModal) {
                closeVehicleModal();
            }
        }
    </script>
</body>
</html>