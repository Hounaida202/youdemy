<?php
require_once '../classes/database.php';
require_once '../classes/categories.php';

$categories=categories::getAllCategories();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduLearn - Catégories de cours</title>
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
                    <span class="text-2xl font-bold">EduLearn</span>
                </div>
                <div class="hidden md:flex space-x-8">
                    <a href="#" class="hover:text-purple-200">Mes cours</a>
                    <a href="#" class="hover:text-purple-200">Catalogue</a>
                    <a href="#" class="hover:text-purple-200">Profil</a>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm"> <?php if (isset($_SESSION['user_nom'])): ?>
        <p>Etudiant.<?php echo htmlspecialchars($_SESSION["user_nom"]); ?></p>
      <?php endif; ?></span>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-6 py-12">
        <h1 class="text-4xl font-bold text-gray-800 mb-12 text-center">Catégories de Cours</h1>
        
        <div class="grid md:grid-cols-3 gap-8">
        <!-- ---------------------------------------------------------------------------- --> 
<?php foreach($categories as $categorie):?>
            <!-- Frontend Category -->
            <a href="../Apps/cours_etudiant.php?categorie_id=<?=htmlspecialchars($categorie->getcategorieId())?>" class="group">
                <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition duration-300 hover:scale-105">
                    <div class="h-48 bg-gradient-to-r from-blue-400 to-blue-600 flex items-center justify-center">
                        <img src="<?=htmlspecialchars($categorie->getimage())?>" alt="">
                    </div>
                    <div class="p-6">
                        <h2 class="text-2xl font-bold text-gray-800 mb-2"><?=htmlspecialchars($categorie->getnom())?></h2>
                        <p class="text-gray-600"><?=htmlspecialchars($categorie->getdescription())?></p>
                        <div class="mt-4 flex items-center text-blue-500">
                            <span>Explorer les cours</span>
                            <i class="fas fa-arrow-right ml-2 group-hover:translate-x-2 transition-transform"></i>
                        </div>
                    </div>
                </div>
            </a>
            <?php endforeach;?>

<!-- ---------------------------------------------------------------------------- -->
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-auto">
        <div class="container mx-auto px-6 py-8">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <h4 class="text-xl font-bold mb-4">Youdemy</h4>
                    <p class="text-gray-400">Plateforme d'apprentissage en ligne pour tous</p>
                </div>
                <div>
                    <h4 class="text-xl font-bold mb-4">Liens rapides</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="../Apps/user_accueil.php" class="hover:text-white">Accueil</a></li>
                        <li><a href="./cours.php" class="hover:text-white">Cours</a></li>
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
                <p>&copy; 2024 Youdemy. Tous droits réservés.</p>
            </div>
        </div>
    </footer>
</body>
</html>