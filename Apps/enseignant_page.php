<?php
session_start();
require_once '../classes/database.php';
require_once '../classes/categories.php';

$categories=categories::getAllCategories();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduLearn - Dashboard Enseignant</title>
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
                    <a href="#" class="hover:text-purple-200">Dashboard</a>
                    <a href="#" class="hover:text-purple-200">Mes Cours</a>
                    <a href="#" class="hover:text-purple-200">Étudiants</a>
                    <a href="#" class="hover:text-purple-200">Messages</a>
                </div>
                <div class="flex items-center space-x-4">
                <span class="text-sm"> <?php if (isset($_SESSION['user_nom'])): ?>
        <p>Prof.<?php echo htmlspecialchars($_SESSION["user_nom"]); ?></p>
      <?php endif; ?>
                    </span>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="flex-grow flex">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-lg">
            <div class="p-6 space-y-4">
                <a href="#" class="flex items-center space-x-3 text-purple-800 font-medium">
                    <i class="fas fa-th-large"></i>
                    <span>Vue d'ensemble</span>
                </a>
                <a href="#" class="flex items-center space-x-3 text-gray-600 hover:text-purple-800">
                    <i class="fas fa-book"></i>
                    <span>Gestion des cours</span>
                </a>
                <a href="#" class="flex items-center space-x-3 text-gray-600 hover:text-purple-800">
                    <i class="fas fa-chart-bar"></i>
                    <span>Statistiques</span>
                </a>
            </div>
        </div>

        <!-- Content -->
        <div class="flex-grow p-8">
            <div class="mb-8 flex justify-between items-center">
                <h1 class="text-2xl font-bold text-gray-800">Mes Catégories de Cours</h1>
               
            </div>

            <!-- Categories Grid -->
            <div class="grid md:grid-cols-3 gap-6">
                <!-- Backend Category -->
                 <?php foreach($categories as $categorie): ?>
                <a href="../Apps/cours_enseignant.php?categorie_id=<?=htmlspecialchars($categorie->getcategorieId())?>&user_id=<?=htmlspecialchars($_SESSION['user_id'])?>" class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
                    <div class="flex items-center space-x-4 mb-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-server text-blue-600 text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold"><?=htmlspecialchars($categorie->getnom())?></h3>
                    </div>
                    <p class="text-gray-600 mb-4"><?=htmlspecialchars($categorie->getdescription())?></p>
                    
                 </a>
                <?php endforeach; ?>

            </div>
        </div>
    </div>
     <!-- Footer -->
     <footer class="bg-gray-900 text-white mt-12">
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