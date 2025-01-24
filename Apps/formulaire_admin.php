<?php
session_start();
require_once '../classes/database.php';
require_once '../classes/user.php';
require_once '../classes/categories.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $categorie_image = $_POST['categorie_image'];
    $categorie_nom = $_POST['categorie_nom'];
    $categorie_description = $_POST['categorie_description'];
   
    $categorie_id = categories::inserCtegorie($categorie_image, $categorie_nom, $categorie_description);

 
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduLearn Admin - Gestion des inscriptions</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-slate-50 min-h-screen flex flex-col">
    <!-- Navbar -->
    <nav class="bg-purple-800 text-white shadow-lg">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fas fa-graduation-cap text-2xl mr-2"></i>
                    <span class="text-2xl font-bold">Youdemy</span>
                </div>
                <div class="hidden md:flex space-x-8">
                    <a href="../Apps/adminCategorie.php" class="hover:text-purple-200">Dashboard</a>
                    <a href="../Apps/admin_page.php" class="hover:text-purple-200">Gestion des Comptes</a>
                    <a href="" class="hover:text-purple-200">Statistiques</a>
                   
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm"> <?php if (isset($_SESSION['user_nom'])): ?>
        <p><?php echo htmlspecialchars($_SESSION["user_nom"]); ?></p>
      <?php endif; ?>
                    </span>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    
    <main class="flex-grow container mx-auto px-6 py-8">
        <div class="mb-8 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800">Ajouter une Catégorie</h1>
        </div>
        
        <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-lg p-8">
            <form class="space-y-6" method="POST" action="">
                <div>
                    <label for="titre" class="block text-sm font-medium text-gray-700 mb-2">Titre de la Catégorie</label>
                    <input type="text" id="titre" name="categorie_nom" required 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea id="description" name="categorie_description" rows="4" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500"></textarea>
                </div>

                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Image de la Catégorie</label>
                    <div class="flex items-center">
                        <input type="text" id="image" name="categorie_image" accept="image/*" required 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                    </div>
                </div>

                <div class="pt-6">
                    <button type="submit" 
                        class="w-full bg-purple-800 text-white py-3 rounded-lg hover:bg-purple-900 transition duration-300">
                        Ajouter Catégorie
                    </button>
                </div>
            </form>
        </div>
    </main>
    <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-auto">
        <div class="container mx-auto px-6 py-8">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <h4 class="text-xl font-bold mb-4">EduLearn</h4>
                    <p class="text-gray-400">Plateforme d'apprentissage en ligne pour tous</p>
                </div>
                <div>
                    <h4 class="text-xl font-bold mb-4">Liens rapides</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white">Accueil</a></li>
                        <li><a href="#" class="hover:text-white">Cours</a></li>
                        <li><a href="#" class="hover:text-white">À propos</a></li>
                        <li><a href="#" class="hover:text-white">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-xl font-bold mb-4">Contact</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><i class="fas fa-envelope mr-2"></i>contact@edulearn.com</li>
                        <li><i class="fas fa-phone mr-2"></i>+33 1 23 45 67 89</li>
                        <li><i class="fas fa-map-marker-alt mr-2"></i>Paris, France</li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-xl font-bold mb-4">Suivez-nous</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="hover:text-purple-400"><i class="fab fa-facebook text-2xl"></i></a>
                        <a href="#" class="hover:text-purple-400"><i class="fab fa-twitter text-2xl"></i></a>
                        <a href="#" class="hover:text-purple-400"><i class="fab fa-linkedin text-2xl"></i></a>
                        <a href="#" class="hover:text-purple-400"><i class="fab fa-instagram text-2xl"></i></a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2024 EduLearn. Tous droits réservés.</p>
            </div>
        </div>
    </footer>
</body>
</html>