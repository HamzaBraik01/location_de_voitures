<?php
require_once '../class/DatabaseConnection.php';
require_once '../class/Theme.Class.php';
require_once '../class/Article.Class.php';
$db = new Database();
$pdo = $db->getConnection();

// Traitement du formulaire pour ajouter un thème
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_theme'])) {
    $themeName = $_POST['theme_name'];
    $stmt = $pdo->prepare("INSERT INTO Theme (name) VALUES (:name)");
    $stmt->execute(['name' => $themeName]);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Traitement du formulaire pour ajouter un article
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_article'])) {
    $articleName = $_POST['article_name'];
    $articleContent = $_POST['article_content'];
    $idTheme = $_POST['id_theme'];
    $idUser = 1; // Remplacez par l'ID de l'utilisateur connecté
    $stmt = $pdo->prepare("INSERT INTO Article (name, content, id_theme, id_user) VALUES (:name, :content, :id_theme, :id_user)");
    $stmt->execute([
        'name' => $articleName,
        'content' => $articleContent,
        'id_theme' => $idTheme,
        'id_user' => $idUser
    ]);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Supprimer un thème
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_theme'])) {
    $idTheme = $_POST['id_theme'];
    $stmt = $pdo->prepare("DELETE FROM Theme WHERE id_theme = :id_theme");
    $stmt->execute(['id_theme' => $idTheme]);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Supprimer un article
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_article'])) {
    $idArticle = $_POST['id_article'];
    $stmt = $pdo->prepare("DELETE FROM Article WHERE id_article = :id_article");
    $stmt->execute(['id_article' => $idArticle]);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Récupérer tous les thèmes avec leurs articles
$stmt = $pdo->query("SELECT * FROM Theme");
$themes = $stmt->fetchAll();

foreach ($themes as &$theme) {
    $stmt = $pdo->prepare("SELECT * FROM Article WHERE id_theme = :id_theme");
    $stmt->execute(['id_theme' => $theme['id_theme']]);
    $theme['articles'] = $stmt->fetchAll();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Themes AutoMove</title>
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
                <a href="AdminAvis.php" class="flex items-center px-4 py-2 text-gray-600 bg-gray-100 rounded-lg">
                    <i data-feather="star" class="h-5 w-5 mr-3"></i>
                    Themes
                </a>
            </nav>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="lg:ml-64 pt-16">
        <div class="p-4 lg:p-8">
            <!-- Formulaire pour ajouter un thème -->
            <form method="POST" class="mb-8">
                <div class="flex gap-4">
                    <input type="text" name="theme_name" placeholder="Nom du thème" class="flex-1 p-2 border border-gray-300 rounded-lg">
                    <button type="submit" name="add_theme" class="bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-600">Ajouter un thème</button>
                </div>
            </form>

            <!-- ... (le reste du code PHP et HTML reste inchangé) ... -->

            <!-- Liste des thèmes avec leurs articles -->
            <div class="space-y-4">
                <?php foreach ($themes as $theme): ?>
                    <div class="bg-white p-4 rounded-lg shadow">
                        <div class="flex justify-between items-center">
                            <h2 class="text-lg font-semibold"><?= htmlspecialchars($theme['name']) ?></h2>
                            <div class="flex gap-2">
                                <!-- Bouton pour afficher/cacher le formulaire d'ajout d'article -->
                                <button onclick="toggleArticleForm(<?= $theme['id_theme'] ?>)" class="bg-green-500 text-white p-2 rounded-lg hover:bg-green-600 flex items-center gap-2">
                                    <span>Ajouter un article</span>
                                    <i id="icon<?= $theme['id_theme'] ?>" data-feather="chevron-down" class="h-4 w-4"></i>
                                </button>
                                <!-- Bouton pour supprimer le thème -->
                                <form method="POST" >
                                    <input type="hidden" name="id_theme" value="<?= $theme['id_theme'] ?>">
                                    <button type="submit" name="delete_theme" class="bg-red-500 text-white p-2 rounded-lg hover:bg-red-600">
                                        <i data-feather="trash-2" class="h-4 w-4"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Formulaire pour ajouter un article (caché par défaut) -->
                        <form method="POST" id="articleForm<?= $theme['id_theme'] ?>" class="mt-4 hidden">
                            <input type="hidden" name="id_theme" value="<?= $theme['id_theme'] ?>">
                            <div class="space-y-4">
                                <input type="text" name="article_name" placeholder="Nom de l'article" class="w-full p-2 border border-gray-300 rounded-lg">
                                <textarea name="article_content" placeholder="Contenu de l'article" class="w-full p-2 border border-gray-300 rounded-lg"></textarea>
                                <button type="submit" name="add_article" class="bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-600">Ajouter l'article</button>
                            </div>
                        </form>

                        <!-- Liste des articles -->
                        <div class="mt-4 space-y-2">
                            <?php foreach ($theme['articles'] as $article): ?>
                                <div class="flex justify-between items-center p-2 bg-gray-50 rounded-lg">
                                    <div>
                                        <h3 class="font-medium"><?= htmlspecialchars($article['name']) ?></h3>
                                        <p class="text-sm text-gray-600"><?= htmlspecialchars($article['content']) ?></p>
                                    </div>
                                    <div class="flex gap-2">
                                        <button class="text-blue-500 hover:text-blue-700">
                                            <i data-feather="edit" class="h-4 w-4"></i>
                                        </button>
                                        <form method="POST" >
                                            <input type="hidden" name="id_article" value="<?= $article['id_article'] ?>">
                                            <button type="submit" name="delete_article" class="text-red-500 hover:text-red-700">
                                                <i data-feather="trash-2" class="h-4 w-4"></i>
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

    <script>
        feather.replace();

        function toggleArticleForm(themeId) {
            const form = document.getElementById(`articleForm${themeId}`);
            const icon = document.getElementById(`icon${themeId}`);

            // Basculer la visibilité du formulaire
            form.classList.toggle('hidden');

            // Changer l'icône en fonction de l'état du formulaire
            if (form.classList.contains('hidden')) {
                icon.setAttribute('data-feather', 'chevron-down');
            } else {
                icon.setAttribute('data-feather', 'chevron-up');
            }

            feather.replace();
        }
    </script>
</body>
</html>