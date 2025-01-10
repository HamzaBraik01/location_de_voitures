<?php
require_once '../class/DatabaseConnection.php';
require_once '../class/Theme.Class.php';
require_once '../class/Article.Class.php';
require_once '../class/Tag.Class.php';
$db = new Database();
$pdo = $db->getConnection();

// Dossier pour stocker les images uploadées
$uploadDir = '../uploads/';

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
        1,
        'pending',
        $imagePath
    );
    $article->save($pdo);

    // Récupérer les tags
    if (isset($_POST['tags'])) {
        $tags = json_decode($_POST['tags'], true);
        foreach ($tags as $tagName) {
            // Vérifier si le tag existe déjà
            $tag = Tag::getByName($pdo, $tagName);
            if (!$tag) {
                // Créer un nouveau tag
                $tagId = Tag::create($pdo, $tagName);
            } else {
                $tagId = $tag['id_tag'];
            }
            // Associer le tag à l'article
            $article->addTag($pdo, $tagId);
        }
    }

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
        1,
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
    <style>
        .fade-in {
            animation: fadeIn 0.3s ease-in-out;
        }
        
        .fade-out {
            animation: fadeOut 0.3s ease-in-out;
        }
        
        .scale-in {
            animation: scaleIn 0.3s ease-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        @keyframes fadeOut {
            from { opacity: 1; }
            to { opacity: 0; }
        }
        
        @keyframes scaleIn {
            from { transform: translate(-50%, -50%) scale(0.95); }
            to { transform: translate(-50%, -50%) scale(1); }
        }
        .tag {
            display: inline-flex;
            align-items: center;
            background-color: #e3f2fd;
            color: #1976d2;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
            margin-right: 4px;
            margin-bottom: 4px;
        }

        .tag:hover {
            background-color: #bbdefb;
        }

        .delete-tag {
            cursor: pointer;
        }
        
    </style>
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
                <form method="POST" class="mb-8 bg-white p-6 rounded-xl shadow-lg">
                    <div class="flex gap-4 items-center">
                        <input type="text" name="name" placeholder="Nom du thème" 
                                class="p-2 border rounded-lg flex-grow focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <button type="submit" name="add_theme" 
                                class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg flex items-center transition-colors duration-200">
                            <i data-feather="plus" class="h-5 w-5 mr-2"></i>
                            Ajouter
                        </button>
                    </div>
                </form>

                <!-- Liste des thèmes -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach ($themes as $theme): ?>
                        <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden">
                            <div class="p-6">
                                <!-- En-tête du thème -->
                                <div class="flex justify-between items-center mb-4">
                                    <div class="flex items-center space-x-3">
                                        <i data-feather="folder" class="h-6 w-6 text-blue-500"></i>
                                        <h3 class="text-xl font-semibold text-gray-800"><?= $theme['name'] ?></h3>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <button onclick="openEditModal(<?= $theme['id_theme'] ?>, '<?= $theme['name'] ?>')" 
                                                class="p-2 hover:bg-gray-100 rounded-full transition-colors duration-200">
                                            <i data-feather="edit" class="h-5 w-5 text-blue-500"></i>
                                        </button>
                                        <form method="POST" class="inline">
                                            <input type="hidden" name="id_theme" value="<?= $theme['id_theme'] ?>">
                                            <button type="submit" name="delete_theme" 
                                                    class="p-2 hover:bg-gray-100 rounded-full transition-colors duration-200">
                                                <i data-feather="trash" class="h-5 w-5 text-red-500"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <!-- Bouton Ajouter un article -->
                                <button onclick="openAddArticleModal(<?= $theme['id_theme'] ?>)"
                                        class="w-full mb-4 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white py-3 px-4 rounded-lg shadow-md hover:shadow-lg transition-all duration-200 flex items-center justify-center space-x-2 group">
                                    <i data-feather="plus-circle" class="h-5 w-5 transform group-hover:rotate-90 transition-transform duration-300"></i>
                                    <span>Ajouter un article</span>
                                </button>

                                <!-- Bouton pour afficher/masquer les articles -->
                                <button onclick="toggleArticles(this)" 
                                        class="toggle-articles w-full flex items-center justify-between p-3 bg-gray-50 hover:bg-gray-100 rounded-lg transition-colors duration-200">
                                    <span class="font-medium text-gray-700">
                                        <?php 
                                        $articles = Article::getAllByTheme($pdo, $theme['id_theme']);
                                        $count = count($articles);
                                        echo $count . ' Article' . ($count > 1 ? 's' : '');
                                        ?>
                                    </span>
                                    <i data-feather="chevron-down" class="h-5 w-5 text-gray-500 transform transition-transform duration-300"></i>
                                </button>

                                <!-- Liste des articles -->
                                <div class="articles-list mt-4 space-y-3 hidden">
                                    <?php foreach ($articles as $article): ?>
                                        <div class="group flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-all duration-200">
                                            <div class="flex items-center space-x-3">
                                                <?php if ($article['image']): ?>
                                                    <img src="<?= $article['image'] ?>" alt="" class="h-10 w-10 rounded-lg object-cover">
                                                <?php endif; ?>
                                                <span class="text-gray-700 font-medium"><?= $article['name'] ?></span>
                                            </div>
                                            <div class="flex items-center space-x-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                                <button onclick="openEditArticleModal(<?= $article['id_article'] ?>, '<?= htmlspecialchars($article['name'], ENT_QUOTES) ?>', '<?= htmlspecialchars($article['content'], ENT_QUOTES) ?>', <?= $article['id_theme'] ?>)"
                                                        class="p-1.5 hover:bg-white rounded-full transition-colors duration-200">
                                                    <i data-feather="edit" class="h-4 w-4 text-blue-500"></i>
                                                </button>
                                                <form method="POST" class="inline">
                                                    <input type="hidden" name="id_article" value="<?= $article['id_article'] ?>">
                                                    <button type="submit" name="delete_article"
                                                            class="p-1.5 hover:bg-white rounded-full transition-colors duration-200">
                                                        <i data-feather="trash" class="h-4 w-4 text-red-500"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Modal pour modifier un thème -->
        <div id="editModal" class="fixed inset-0 z-30 bg-black bg-opacity-50 hidden fade-in">
            <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium">Modifier le Thème</h3>
                    <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600">
                        <i data-feather="x" class="h-6 w-6"></i>
                    </button>
                </div>
                <form method="POST">
                    <input type="hidden" id="edit_id" name="id_theme">
                    <input type="text" id="edit_name" name="name" 
                            class="p-2 border rounded-lg w-full mb-4 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                            placeholder="Nouveau nom du thème">
                    <div class="flex justify-end gap-2">
                        <button type="button" onclick="closeEditModal()" 
                                class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-colors duration-200">
                            Annuler
                        </button>
                        <button type="submit" name="update_theme" 
                                class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors duration-200">
                            Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal pour ajouter un article -->
        <div id="addArticleModal" class="fixed inset-0 z-30 bg-black bg-opacity-50 hidden fade-in">
            <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium">Ajouter un article</h3>
                    <button onclick="closeAddArticleModal()" class="text-gray-400 hover:text-gray-600">
                        <i data-feather="x" class="h-6 w-6"></i>
                    </button>
                </div>
                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" id="add_article_id_theme" name="id_theme">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nom de l'article</label>
                            <input type="text" name="name" placeholder="Nom de l'article" 
                                class="p-2 border rounded-lg w-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Contenu</label>
                            <textarea name="content" placeholder="Contenu de l'article" 
                                class="p-2 border rounded-lg w-full h-32 resize-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Image</label>
                            <input type="file" name="image" accept="image/*" 
                                class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tags</label>
                            <div class="tags-input-container">
                                <input type="text" id="tags-input" placeholder="Ajouter un tag" 
                                    class="p-2 border rounded-lg w-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <div id="tags-list" class="flex flex-wrap gap-2 mt-2"></div>
                                <input type="hidden" name="tags" id="hidden-tags">
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end gap-2 mt-6">
                        <button type="button" onclick="closeAddArticleModal()" 
                                class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-colors duration-200">
                            Annuler
                        </button>
                        <button type="submit" name="add_article" 
                                class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors duration-200">
                            Ajouter
                        </button>
                    </div>
                </form>
            </div>
        </div>


        <!-- Modal pour modifier un article -->
        <div id="editArticleModal" class="fixed inset-0 z-30 bg-black bg-opacity-50 hidden fade-in">
            <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium">Modifier l'article</h3>
                    <button onclick="closeEditArticleModal()" class="text-gray-400 hover:text-gray-600">
                        <i data-feather="x" class="h-6 w-6"></i>
                    </button>
                </div>
                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" id="edit_article_id" name="id_article">
                    <input type="hidden" id="edit_article_id_theme" name="id_theme">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nom de l'article</label>
                            <input type="text" id="edit_article_name" name="name" 
                                class="p-2 border rounded-lg w-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Contenu</label>
                            <textarea id="edit_article_content" name="content" 
                                    class="p-2 border rounded-lg w-full h-32 resize-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nouvelle image (optionnel)</label>
                            <input type="file" name="image" accept="image/*" 
                                class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>
                    </div>
                    <div class="flex justify-end gap-2 mt-6">
                        <button type="button" onclick="closeEditArticleModal()" 
                                class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-colors duration-200">
                            Annuler
                        </button>
                        <button type="submit" name="update_article" 
                                class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors duration-200">
                            Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        // Initialisation des icônes
        feather.replace();

        // Fonction pour basculer l'affichage des articles
        function toggleArticles(button) {
            const articlesList = button.nextElementSibling;
            const icon = button.querySelector('[data-feather]');
            
            articlesList.classList.toggle('hidden');
            if (articlesList.classList.contains('hidden')) {
                icon.style.transform = 'rotate(0deg)';
            } else {
                icon.style.transform = 'rotate(180deg)';
            }
            feather.replace();
        }

        // Fonction pour fermer un modal et réinitialiser son formulaire
        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                // Réinitialiser le formulaire
                const form = modal.querySelector('form');
                if (form) {
                    form.reset(); // Réinitialise tous les champs du formulaire
                }

                // Réinitialiser les tags (si applicable)
                if (modalId === 'addArticleModal') {
                    document.getElementById('tags-list').innerHTML = ''; // Réinitialiser les tags visibles
                    document.getElementById('hidden-tags').value = ''; // Réinitialiser les tags cachés
                }

                // Fermer le modal avec une animation
                modal.classList.add('fade-out');
                setTimeout(() => {
                    modal.classList.add('hidden');
                    modal.classList.remove('fade-out');
                }, 300);
            }
        }

        // Fonctions spécifiques pour chaque modal
        function closeEditModal() {
            closeModal('editModal');
        }

        function closeAddArticleModal() {
            closeModal('addArticleModal');
        }

        function closeEditArticleModal() {
            closeModal('editArticleModal');
        }

        // Fonctions pour les modals
        function openEditModal(id, name) {
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_name').value = name;
            document.getElementById('editModal').classList.remove('hidden');
        }

        

        function openAddArticleModal(id_theme) {
            document.getElementById('add_article_id_theme').value = id_theme;
            document.getElementById('addArticleModal').classList.remove('hidden');
        }

        

        function openEditArticleModal(id, name, content, id_theme) {
            document.getElementById('edit_article_id').value = id;
            document.getElementById('edit_article_name').value = name;
            document.getElementById('edit_article_content').value = content;
            document.getElementById('edit_article_id_theme').value = id_theme;
            document.getElementById('editArticleModal').classList.remove('hidden');
        }

        
        document.addEventListener('DOMContentLoaded', function () {
            const tagsInput = document.getElementById('tags-input');
            const tagsList = document.getElementById('tags-list');
            const hiddenTags = document.getElementById('hidden-tags');

            // Ajouter un tag
            tagsInput.addEventListener('keydown', function (e) {
                if (e.key === 'Enter' || e.key === ',') {
                    e.preventDefault();
                    const tagText = tagsInput.value.trim();
                    if (tagText !== '') {
                        addTag(tagText);
                        tagsInput.value = '';
                    }
                }
            });

            // Délégation d'événements pour la suppression des tags
            tagsList.addEventListener('click', function (e) {
                // Vérifier si l'élément cliqué est un bouton de suppression
                if (e.target.closest('.delete-tag')) {
                    // Supprimer le tag parent
                    const tag = e.target.closest('.tag'); // Assurez-vous que chaque tag a la classe "tag"
                    if (tag) {
                        tag.remove();
                        updateHiddenTags();
                    }
                }
            });

            // Fonction pour ajouter un tag
            function addTag(tagText) {
                const tag = document.createElement('div');
                tag.className = 'tag bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full flex items-center gap-2';
                tag.innerHTML = `
                    ${tagText}
                    <button type="button" class="delete-tag text-blue-800 hover:text-blue-900">
                        <i data-feather="x" class="h-4 w-4"></i>
                    </button>
                `;
                tagsList.appendChild(tag);
                updateHiddenTags();
                feather.replace();
            }

            // Mettre à jour le champ caché avec les tags
            function updateHiddenTags() {
                const tags = Array.from(tagsList.children).map(tag => tag.textContent.trim());
                hiddenTags.value = JSON.stringify(tags);
            }
        });
    </script>
</body>
</html>