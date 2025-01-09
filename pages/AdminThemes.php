<?php
require_once '../class/DatabaseConnection.php';
require_once '../class/Theme.Class.php';
require_once '../class/Article.Class.php';
$db = new Database();
$pdo = $db->getConnection();

// Dossier pour stocker les images uploadées
$uploadDir = '../uploads/';

// Créer le dossier s'il n'existe pas
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

// Ajouter un thème
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_theme'])) {
    $theme = new Theme($_POST['name']);
    $theme->save($pdo);
    header("Location: AdminThemes.php");
    exit();
}

// Supprimer un thème
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_theme'])) {
    Theme::delete($pdo, $_POST['id_theme']);
    header("Location: AdminThemes.php");
    exit();
}

// Modifier un thème
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_theme'])) {
    Theme::update($pdo, $_POST['id_theme'], $_POST['name']);
    header("Location: AdminThemes.php");
    exit();
}

// Ajouter un article
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_article'])) {
    $imagePath = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageName = basename($_FILES['image']['name']);
        $imagePath = $uploadDir . $imageName;
        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
    }

    $article = new Article(
        $_POST['name'],
        $_POST['content'],
        $_POST['id_theme'],
        1, // Remplacez par l'ID de l'utilisateur connecté
        'pending',
        $imagePath
    );
    $article->save($pdo);
    header("Location: AdminThemes.php");
    exit();
}

// Supprimer un article
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_article'])) {
    Article::delete($pdo, $_POST['id_article']);
    header("Location: AdminThemes.php");
    exit();
}

// Modifier un article
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_article'])) {
    $imagePath = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageName = basename($_FILES['image']['name']);
        $imagePath = $uploadDir . $imageName;
        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
    }

    Article::update(
        $pdo,
        $_POST['id_article'],
        $_POST['name'],
        $_POST['content'],
        $_POST['id_theme'],
        1, // Remplacez par l'ID de l'utilisateur connecté
        'pending',
        $imagePath
    );
    header("Location: AdminThemes.php");
    exit();
}

$themes = Theme::getAll($pdo);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Thèmes</title>
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
                <a href="AdminVehicules.php" class="flex items-center px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                    <i data-feather="truck" class="h-5 w-5 mr-3"></i>
                    Véhicules
                </a>
                <a href="AdminAvis.php" class="flex items-center px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                    <i data-feather="star" class="h-5 w-5 mr-3"></i>
                    Avis
                </a>
                <a href="AdminThemes.php" class="flex items-center px-4 py-2 text-gray-600 bg-gray-100 rounded-lg">
                    <i data-feather="folder" class="h-5 w-5 mr-3"></i>
                    Thèmes
                </a>
            </nav>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="lg:ml-64 pt-16">
        <div class="p-4 lg:p-8">
            <div class="mt-8">
                <h2 class="text-2xl font-bold mb-6">Gestion des Thèmes</h2>

                <!-- Formulaire pour ajouter un thème -->
                <form method="POST" class="mb-8 bg-white p-6 rounded-lg shadow">
                    <div class="flex gap-4 items-center">
                        <input type="text" name="name" placeholder="Nom du thème" class="p-2 border rounded-lg flex-grow">
                        <button type="submit" name="add_theme" class="bg-blue-500 text-white p-2 rounded-lg flex items-center">
                            <i data-feather="plus" class="h-5 w-5 mr-2"></i>
                            Ajouter
                        </button>
                    </div>
                </form>

                <!-- Liste des thèmes -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach ($themes as $theme): ?>
                        <div class="bg-white p-6 rounded-lg shadow">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-xl font-semibold flex items-center">
                                    <i data-feather="folder" class="h-6 w-6 mr-2 text-blue-500"></i>
                                    <?= $theme['name'] ?>
                                </h3>
                                <div class="flex gap-2">
                                    <!-- Bouton Modifier -->
                                    <button onclick="openEditModal(<?= $theme['id_theme'] ?>, '<?= $theme['name'] ?>')" class="text-blue-500 hover:text-blue-700">
                                        <i data-feather="edit" class="h-5 w-5"></i>
                                    </button>
                                    <!-- Bouton Supprimer -->
                                    <form method="POST" class="inline">
                                        <input type="hidden" name="id_theme" value="<?= $theme['id_theme'] ?>">
                                        <button type="submit" name="delete_theme" class="text-red-500 hover:text-red-700">
                                            <i data-feather="trash" class="h-5 w-5"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Bouton pour ajouter un article -->
                            <button onclick="openAddArticleModal(<?= $theme['id_theme'] ?>)" class="bg-green-500 text-white p-2 rounded-lg flex items-center mb-4">
                                <i data-feather="plus" class="h-4 w-4 mr-2"></i>
                                Ajouter un article
                            </button>

                            <!-- Liste des articles pour ce thème -->
                            <div class="space-y-2">
                                <?php
                                $articles = Article::getAllByTheme($pdo, $theme['id_theme']);
                                foreach ($articles as $article): ?>
                                    <div class="flex items-center justify-between p-2 bg-gray-50 rounded-lg">
                                        <span class="text-gray-700"><?= $article['name'] ?></span>
                                        <div class="flex gap-2">
                                            <!-- Bouton Modifier -->
                                            <button onclick="openEditArticleModal(<?= $article['id_article'] ?>, '<?= $article['name'] ?>', '<?= $article['content'] ?>', <?= $article['id_theme'] ?>, '<?= $article['status'] ?>', '<?= $article['image'] ?>')" class="text-blue-500 hover:text-blue-700">
                                                <i data-feather="edit" class="h-4 w-4"></i>
                                            </button>
                                            <!-- Bouton Supprimer -->
                                            <form method="POST" class="inline">
                                                <input type="hidden" name="id_article" value="<?= $article['id_article'] ?>">
                                                <button type="submit" name="delete_article" class="text-red-500 hover:text-red-700">
                                                    <i data-feather="trash" class="h-4 w-4"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Modal pour ajouter un article -->
        <div id="addArticleModal" class="fixed inset-0 z-30 bg-black bg-opacity-50 hidden">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium">Ajouter un article</h3>
                    <button onclick="closeAddArticleModal()" class="text-gray-400 hover:text-gray-600">
                        <i data-feather="x" class="h-6 w-6"></i>
                    </button>
                </div>
                <form method="POST">
                    <input type="hidden" id="add_article_id_theme" name="id_theme">
                    <input type="text" name="name" placeholder="Nom de l'article" class="p-2 border rounded-lg w-full mb-4">
                    <textarea name="content" placeholder="Contenu de l'article" class="p-2 border rounded-lg w-full mb-4"></textarea>
                    <input type="text" name="image" placeholder="URL de l'image" class="p-2 border rounded-lg w-full mb-4">
                    <div class="flex justify-end">
                        <button type="button" onclick="closeAddArticleModal()" class="bg-gray-500 text-white p-2 rounded-lg mr-2">Annuler</button>
                        <button type="submit" name="add_article" class="bg-green-500 text-white p-2 rounded-lg">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal pour modifier un article -->
        <div id="editArticleModal" class="fixed inset-0 z-30 bg-black bg-opacity-50 hidden">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium">Modifier l'article</h3>
                    <button onclick="closeEditArticleModal()" class="text-gray-400 hover:text-gray-600">
                        <i data-feather="x" class="h-6 w-6"></i>
                    </button>
                </div>
                <form method="POST">
                    <input type="hidden" id="edit_article_id" name="id_article">
                    <input type="text" id="edit_article_name" name="name" placeholder="Nom de l'article" class="p-2 border rounded-lg w-full mb-4">
                    <textarea id="edit_article_content" name="content" placeholder="Contenu de l'article" class="p-2 border rounded-lg w-full mb-4"></textarea>
                    <input type="text" id="edit_article_image" name="image" placeholder="URL de l'image" class="p-2 border rounded-lg w-full mb-4">
                    <div class="flex justify-end">
                        <button type="button" onclick="closeEditArticleModal()" class="bg-gray-500 text-white p-2 rounded-lg mr-2">Annuler</button>
                        <button type="submit" name="update_article" class="bg-blue-500 text-white p-2 rounded-lg">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        feather.replace();

        // Fonctions pour le modal d'ajout d'article
        function openAddArticleModal(id_theme) {
            document.getElementById('add_article_id_theme').value = id_theme;
            document.getElementById('addArticleModal').classList.remove('hidden');
        }

        function closeAddArticleModal() {
            document.getElementById('addArticleModal').classList.add('hidden');
        }

        // Fonctions pour le modal de modification d'article
        function openEditArticleModal(id, name, content, id_theme, status, image) {
            document.getElementById('edit_article_id').value = id;
            document.getElementById('edit_article_name').value = name;
            document.getElementById('edit_article_content').value = content;
            document.getElementById('edit_article_image').value = image;
            document.getElementById('editArticleModal').classList.remove('hidden');
        }

        function closeEditArticleModal() {
            document.getElementById('editArticleModal').classList.add('hidden');
        }
    </script>
</body>
</html>