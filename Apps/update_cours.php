<?php
session_start();
require_once '../classes/database.php';
require_once '../classes/cours.php';
require_once '../classes/user.php';

$cours_id=$_GET['cours_id'];
$cours=cours::afficherPourUpdate($cours_id);

if($_SERVER['REQUEST_METHOD']==='POST'){
    $cours_image = $_POST['cours_image'];
    $cours_nom = $_POST['cours_nom'];
    $cours_description = $_POST['cours_description'];
    
    $cours_type = $_POST['cours_type'];
    $cours_lien = $_POST['cours_lien'];

    $cours=cours::UpdateCours($cours_id, $cours_image, $cours_nom, $cours_description, $cours_type, $cours_lien);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduLearn - Ajouter un cours</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-slate-50 min-h-screen flex flex-col">
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
                    <a href="#" class="hover:text-purple-200">Statistiques</a>
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

    <main class="flex-grow container mx-auto px-6 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Ajouter un nouveau cours</h1>

        <form method="POST" action="" class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-8">
            <div class="space-y-6">
<!-- Image URL -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Lien de l'image</label>
                    <input name="cours_image" type="url" value="<?php echo htmlspecialchars($cours['cours_image']); ?>" placeholder="https://example.com/image.jpg" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                </div>

                <!-- Titre -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Titre du cours</label>
                    <input name="cours_nom" type="text" placeholder="Entrez le titre du cours" value="<?php echo htmlspecialchars($cours['cours_nom']); ?>"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea name="cours_description"  rows="4" placeholder="Décrivez votre cours" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"><?php echo htmlspecialchars($cours['cours_description']); ?></textarea>
                </div>

                <!-- Type de contenu -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Type de contenu</label>
                    <select name="cours_type" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        <option value="">Sélectionnez le type</option>
                        <option value="video">Vidéo</option>
                        <option value="pdf">Document</option>
                    </select>
                </div>

                <!-- Lien du contenu -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Lien du contenu</label>
                    <input name="cours_lien" type="url" value="<?php echo htmlspecialchars($cours['cours_contenu']); ?>" placeholder="https://example.com/content" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                </div>
                <button name="sauvegarder" type="submit" class="w-full bg-purple-800 text-white py-3 px-4 rounded-lg hover:bg-purple-900 transition duration-200 flex items-center justify-center">
                     Sauvegarder La modification
                </button>
            </div>
        </form>
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
