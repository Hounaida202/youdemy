<?php
session_start();
require_once '../classes/database.php';
require_once '../classes/categories.php';
require_once '../classes/cours.php';

$user_id=$_SESSION['user_id'];
if (isset($_POST['supprimer']) && isset($_POST['cours_id'])) {
    $cours_id = $_POST['cours_id'];
    $resultat = cours::deleteByIdcour($cours_id);
}
$mescours=Cours::afficherMescoursStudent($user_id);


$mescours = array_filter($mescours, fn($obj) => $obj); 

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
                    <a href="../Apps/etudiant_page.php" class="hover:text-purple-200">Catalogue</a>
                    <a href="#" class="hover:text-purple-200">Mes Cours</a>
                </div>
                <div class="flex items-center space-x-4">
                <span class="text-sm"> <?php if (isset($_SESSION['user_nom'])): ?>
        <p>Etudiant.<?php echo htmlspecialchars($_SESSION["user_nom"]); ?></p>
      <?php endif; ?>
                    </span>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-6 py-8">
    <div class="mb-8 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800">Mes cours</h1>
    </div>
        <div class="grid gap-8">
            <!-- Cours 1 -->

            <?php if($mescours):?>
<?php foreach($mescours as $cour):?>

    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="grid md:grid-cols-3 gap-6">
            <div class="md:col-span-1">
                <img src="<?php echo htmlspecialchars($cour->getImage()) ?>" alt="Tailwind" class="w-full h-full object-cover">
            </div>
            <div class="p-6 md:col-span-2">
                <h2 class="text-2xl font-bold text-gray-800 mb-3"><?php echo htmlspecialchars($cour->getNom())?></h2>
                <p class="text-gray-600 mb-4">
                    <?php echo htmlspecialchars($cour->getDescription())?>
                </p>
                <div class="mb-4">
                    <span class="text-purple-800 font-semibold">Type de contenu:</span>
                    <span class="ml-2"><?php echo htmlspecialchars($cour->gettype())?></span>
                </div>
                <div class="mb-4">
                    <span class="text-purple-800 font-semibold">Contenu:</span>
                    <a href="<?php echo htmlspecialchars($cour->getContenu())?>" class="ml-2"><?php echo htmlspecialchars($cour->getContenu())?></a>
                </div>
               
                <?php $tags = explode(",", $cour->getTags()); ?>

                <div class="flex gap-2">
                    <?php foreach($tags as $tag): ?>
                    <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm"><?php echo htmlspecialchars($tag)?></span>
                    <?php endforeach; ?>
                </div>



               
                
            </div>
        </div>
    </div>

<?php endforeach;?>

<?php else:?>
    <?php echo "Vous n'avez inscré dans aucun cours"?>
<!-- <p>Vous n'avez posé aucun cours</p> -->
<?php endif;?>


        </div>
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