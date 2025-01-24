<?php 
session_start();
require_once '../classes/database.php';
require_once '../classes/cours.php';
require_once '../classes/inscriptions.php';


$user_id=$_SESSION['user_id'];

$cours=cours::CountCoursEnseignant($user_id);
$inscriptions=inscriptions::CountinscriptionsEnseignant($user_id);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduLearn - Cours Frontend</title>
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
                    <a href="../Apps/enseignant_page.php" class="hover:text-purple-200">Dashboard</a>
                    <a href="#" class="hover:text-purple-200">Mes Cours</a>
                    
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
    <main class="flex-grow container mx-auto px-6 py-8">

                <h2 class="text-2xl font-bold text-gray-800 mb-3"> le nombre des inscriptions dans mes cours sont : <?= htmlspecialchars($inscriptions);?></h2>
                <h2 class="text-2xl font-bold text-gray-800 mb-3"> le nombre totale de mes cours sont : <?= htmlspecialchars($cours);?></h2>

    </main>

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