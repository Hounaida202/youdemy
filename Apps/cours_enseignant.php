<?php
session_start();
require_once '../classes/database.php';
require_once '../classes/categories.php';
require_once '../classes/cours.php';

$categorie_id=$_GET['categorie_id'];
$user_id=$_GET['user_id'];

if (isset($_POST['supprimer']) && isset($_POST['cours_id'])) {
    $cours_id = $_POST['cours_id'];
    $resultat = cours::deleteByIdcour($cours_id);
}
$mescours=Cours::afficherMescours($categorie_id,$user_id);

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
    <main class="flex-grow container mx-auto px-6 py-8">
    <div class="mb-8 flex justify-between items-center">
                <h1 class="text-2xl font-bold text-gray-800">Mes cours</h1>
                 <a href="../Apps/formulaire_enseignant.php?user_id=<?= $user_id ?>&categorie_id=<?= $categorie_id ?>" 
                 class="bg-purple-800 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition flex items-center">
                    <i class="fas fa-plus mr-2"></i>
                    Ajouter un cours
                   </a>
            </div>
        <div class="grid gap-8">
            <!-- Cours 1 -->

            <!-- <?php if($mescours):?> -->
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
                
                <div class="flex gap-2">
                    <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm">CSS</span>
                    <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm">Tailwind</span>
                </div>
                <form method="POST" action="" style="margin-top: 20px;" class="flex space-x-2 ">
                    <input type="hidden" name="cours_id" value="<?php echo htmlspecialchars($cour->getId()) ?>">
                <a href="../Apps/update_cours.php?cours_id=<?=  htmlspecialchars($cour->getId()) ?>" name="modifier" value="modifier" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition flex items-center">
                    <i class="fas fa-edit mr-2"></i>
                    Modifier
                </a>
                <button name="supprimer" value="supprimer" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition flex items-center">
                    <i class="fas fa-trash-alt mr-2"></i>
                    Supprimer
                </button>
                </form>
                
            </div>
        </div>
    </div>

<?php endforeach;?>

<?php else:?>
<p>Vous n'avez posé aucun cours</p>
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