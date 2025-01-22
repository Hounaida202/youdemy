<?php
session_start();

require_once '../classes/database.php';
require_once '../classes/cours.php';
require_once '../classes/inscriptions.php';
// $user_id = $_GET['user_id'];
// $cours_id=$_GET['cours_id'];
// $nom=$_POST['nom'];
// $prenom=$_POST['prenom'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cours_id = $_GET['cours_id'] ?? null;
    $user_id = $_GET['user_id'] ?? null;
    $nom = $_POST['nom'] ?? null;
    $prenom = $_POST['prenom'] ?? null;

    if ($nom && $prenom && $cours_id && $user_id) {
        $inscrire = inscriptions::insertInscription($nom, $prenom, $cours_id, $user_id);

        if ($inscrire) {
            echo "Réussi";
        } else {
            echo "Réussi";
        }
    } else {
        echo "Veuillez remplir tous les champs.";
    }
}



?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduLearn - Inscription au cours</title>
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
    <main class="flex-grow container mx-auto px-6 py-8">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-lg shadow-md p-8">
                <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">Inscription au cours</h1>
                
                <form class="space-y-6" method="POST" action="">
                    <!-- Informations personnelles -->
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2" for="firstname">
                                Prénom
                            </label>
                            <input type="text" name="prenom" id="firstname" 
                                class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500" 
                                required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2" for="lastname">
                                Nom
                            </label>
                            <input type="text" name="nom" value="nom" id="lastname" 
                                class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500" 
                                required>
                        </div>
                    </div>

                    <!-- Niveau d'études -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2" for="education-level">
                            Niveau d'études
                        </label>
                        <select id="education-level" 
                            class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500" 
                            required>
                            <option value="">Sélectionnez votre niveau</option>
                            <option value="bac">Baccalauréat</option>
                            <option value="licence">Licence</option>
                            <option value="master">Master</option>
                            <option value="doctorat">Doctorat</option>
                            <option value="professionnel">Professionnel</option>
                        </select>
                    </div>

                    <!-- Période souhaitée -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2" for="period">
                            Période souhaitée
                        </label>
                        <select id="period" 
                            class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500" 
                            required>
                            <option value="">Choisissez une période</option>
                            <option value="matin">Matin (8h-12h)</option>
                            <option value="apres-midi">Après-midi (14h-18h)</option>
                            <option value="soir">Soir (19h-22h)</option>
                            <option value="weekend">Weekend</option>
                        </select>
                    </div>

                    <!-- Niveau dans la matière -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Niveau dans la matière
                        </label>
                        <div class="grid grid-cols-3 gap-4">
                            <label class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-purple-50">
                                <input type="radio" name="level" value="debutant" class="text-purple-600">
                                <span class="ml-2">Débutant</span>
                            </label>
                            <label class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-purple-50">
                                <input type="radio" name="level" value="intermediaire" class="text-purple-600">
                                <span class="ml-2">Intermédiaire</span>
                            </label>
                            <label class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-purple-50">
                                <input type="radio" name="level" value="avance" class="text-purple-600">
                                <span class="ml-2">Avancé</span>
                            </label>
                        </div>
                    </div>

                    <!-- Commentaires supplémentaires -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2" for="comments">
                            Commentaires supplémentaires (optionnel)
                        </label>
                        <textarea id="comments" rows="4" 
                            class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500"></textarea>
                    </div>

                    <!-- Bouton d'inscription -->
                    <div>
                        <button type="submit" 
                            class="w-full py-3 px-4 bg-purple-800 text-white rounded-lg hover:bg-purple-900 transition-colors duration-300 flex items-center justify-center space-x-2">
                            <i class="fas fa-check-circle"></i>
                            <span>S'inscrire au cours</span>
                        </button>
                    </div>
                </form>
            </div>
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