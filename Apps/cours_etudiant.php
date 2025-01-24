<?php
session_start();
require_once '../classes/database.php';
require_once '../classes/categories.php';
require_once '../classes/cours.php';
require_once '../classes/lescours.php';

require_once '../classes/inscriptions.php';

$user_id=$_SESSION['user_id'];
$limit = 3;
$pageActuelle = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($pageActuelle - 1) * $limit;
$categorie_id=$_GET['categorie_id'];
$totalCours=cours::CountCours($categorie_id);
$cours = lescours::getAllElementsPaginé($limit,$offset,$categorie_id);
$totalPages = ceil($totalCours / $limit);


// $dejaInscré=inscriptions::dejaInscré($cours_id);
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
                    <span class="text-2xl font-bold">EduLearn</span>
                </div>
                <div class="hidden md:flex space-x-8">
                    <a href="../Apps/mesCours.php" class="hover:text-purple-200">Mes cours</a>
                    <a href="../Apps/etudiant_page.php" class="hover:text-purple-200">Catalogue</a>
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
        <div class="flex items-center mb-12">
            <a href="./categorie.php" class="text-blue-500 hover:text-blue-600 flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>
                Retour aux catégories
            </a>
        </div>

        <h1 class="text-4xl font-bold text-gray-800 mb-12">Cours Frontend</h1>
        
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Course 1: HTML/CSS -->
            <?php foreach ($cours as $cour): ?>
    <?php $dejaInscre = inscriptions::dejaInscré($cour->getId(),$_SESSION['user_id']); ?>
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="h-48 bg-gradient-to-r from-pink-400 to-pink-600 relative">
            <img src="/api/placeholder/400/200" alt="HTML CSS" class="w-full h-full object-cover opacity-20">
            <div class="absolute inset-0 flex items-center justify-center">
                <i class="fab fa-html5 text-6xl text-white mr-4"></i>
                <i class="fab fa-css3-alt text-6xl text-white"></i>
            </div>
        </div>
        <div class="p-6">
            <div class="flex justify-between items-start mb-4">
                <h2 class="text-2xl font-bold text-gray-800"><?php echo htmlspecialchars($cour->getNom()) ?></h2>
                <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">Débutant</span>
            </div>
            <p class="text-gray-600 mb-4"><?php echo htmlspecialchars($cour->getDescription()) ?></p>
            <h6 class="text-xl text-gray-800" style="margin-bottom: 10px;">Enseignant :  <?php echo htmlspecialchars($cour->getUsernom()) ?></h6>
            
            <!-- Afficher le bouton ou le message en fonction de l'inscription -->
            <?php if ($dejaInscre): ?>
                <div class="text-green-500 font-bold">Inscrit</div>
            <?php else: ?>
                <a href="../Apps/inscription_cours.php?cours_id=<?php echo htmlspecialchars($cour->getid()) ?>&user_id=<?= $user_id ?>" 
                   class="block text-center bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition">
                    S'inscrire au cours
                </a>
            <?php endif; ?>
        </div>
    </div>
<?php endforeach; ?>

            <div class="pagination">
        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
            <a href="?categorie_id=<?= $categorie_id ?>&page=<?= $i ?>" class="">
                <?= $i ?>
            </a>
        <?php endfor; ?>
    </div>

            <!-- Course 2: JavaScript -->
            
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