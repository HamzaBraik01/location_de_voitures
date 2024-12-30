# Drive & Loc - Système de Gestion de Location de Voitures

## Description du Projet

L'agence **Drive & Loc** souhaite enrichir son site web en proposant une plateforme moderne et fonctionnelle permettant à ses clients de parcourir et de réserver des véhicules selon leurs besoins. Ce projet utilise les technologies **PHP** avec une approche **POO** (Programmation Orientée Objet) et **SQL** pour la gestion des données.

## Fonctionnalités Principales

### Pour les Clients :
- **Connexion utilisateur** : Accès à la plateforme uniquement pour les utilisateurs authentifiés.
- **Exploration des véhicules** : Parcourir les différentes catégories de véhicules disponibles.
- **Détails des véhicules** : Consulter les informations d'un véhicule (modèle, prix, disponibilité, etc.).
- **Réservation** : Réserver un véhicule en précisant les dates et lieux de prise en charge.
- **Recherche avancée** : Trouver un véhicule par son modèle ou ses caractéristiques.
- **Filtrage dynamique** : Filtrer les véhicules disponibles par catégorie sans rechargement de page.
- **Ajout d'avis** : Publier des avis et évaluations sur les véhicules loués.
- **Pagination** : Naviguer entre les pages pour explorer les véhicules disponibles (avec **PHP** ou **DataTable** pour une version dynamique).
- **Gestion des avis** : Modifier ou supprimer ses propres avis (Soft Delete).

### Pour les Administrateurs :
- **Ajout en masse** : Ajouter plusieurs véhicules ou catégories en une seule fois.
- **Gestion avancée** : Administrer les réservations, véhicules, avis et catégories avec des statistiques via un tableau de bord.

### Extra :
- **Vue SQL** : Création d'une vue "ListeVehicules" combinant catégories, évaluations et disponibilité.
- **Procédure stockée** : Procédure "AjouterReservation" pour l'ajout d'une réservation.

### Bonus :
- **Validation des réservations** : Approuver ou refuser les réservations avec envoi d'email.
- **Options supplémentaires** : Ajouter des options (GPS, siège enfant, etc.) lors de la réservation.
- **Interaction sociale** : Liker/disliker des avis, marquer des véhicules comme favoris.
- **Statistiques utilisateur** : Consulter les véhicules les plus réservés et les mieux évalués.
- **Validation au niveau SQL** : Utilisation de triggers pour valider les champs.
- **Gestion des clients** : Accès à une page dédiée à la gestion des utilisateurs.

## Technologies Utilisées
- **Langages** : PHP 8.2.12 (POO), SQL
- **Base de données** : MySQL
- **Frontend** : HTML, CSS, JavaScript
- **Frameworks/Bibliothèques** : DataTable (version avancée de la pagination)
- **Outils** : XAMPP, phpMyAdmin, Postman (pour les tests d'API si applicable)

## Installation et Configuration

1. Clonez le dépôt :
   ```bash
   git clone https://github.com/HamzaBraik01/location_de_voitures
   ```

2. Configurez la base de données :
   - Importez le fichier `database.sql` dans votre gestionnaire de base de données (phpMyAdmin).
   - Assurez-vous de mettre à jour les informations de connexion dans le fichier `config/database.php`.

3. Démarrez le serveur local :
   - Utilisez **XAMPP** ou tout autre serveur compatible pour exécuter le projet.

4. Accédez au projet :
   - Ouvrez votre navigateur et accédez à `http://localhost/drive-loc/`.



## Fonctionnalités Futures
- Intégration d'une API externe pour les options supplémentaires.
- Ajout d'une section d'aide et de FAQ pour les utilisateurs.

## Auteur
Projet réalisé par [Hamza Braik](https://github.com/HamzaBraik01).

---
Merci d'utiliser **Drive & Loc** ! Si vous avez des suggestions ou des questions, n'hésitez pas à me contacter via GitHub.
