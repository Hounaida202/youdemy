<?php
session_start();
require_once '../classes/database.php';
require_once '../classes/user.php';
// $user['user_name']=$_SESSION['user_name'];

$users=user::getEnattenteUsers();
// if($_SERVER['REQUEST_METHOD']==='POST'){
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['user_id']; // Utilisez l'ID de l'utilisateur spécifique
        $status = isset($_POST['valide']) ? 'valide' : 'invalide';
    
        user::updateStatus($status, $id);
        header("Location: ".$_SERVER['PHP_SELF']); // Redirige vers la même page
        exit;
    }
// }-----------------------------------------------------------------------------
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $id = $_POST['user_id'];
//     $status = isset($_POST['valide']) ? 'valide' : 'invalide';

//     if (user::updateStatus($status, $id)) {
//         $_SESSION['message'] = "Le statut a été mis à jour avec succès.";
//     } else {
//         $_SESSION['error'] = "Une erreur s'est produite lors de la mise à jour du statut.";
//     }
//     header("Location: ".$_SERVER['PHP_SELF']);
//     exit;
// }
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
                    <a href="#" class="hover:text-purple-200">Dashboard</a>
                    <a href="#" class="hover:text-purple-200">Cours</a>
                    <a href="#" class="hover:text-purple-200">Utilisateurs</a>
                    <a href="#" class="hover:text-purple-200">Paramètres</a>
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
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Gestion des demandes d'inscription</h1>
        
       
        <!-- Registration Requests -->
        <div class="space-y-6">
            <!-- Request 1 -->
             <?php foreach($users as $user):?>
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div>
                            <span class="text-lg font-semibold"><?= htmlspecialchars($user->getnom())?></span>
                            <span class="text-lg font-semibold"><?= htmlspecialchars($user->getprenom())?></span>
                            <p class="text-sm text-gray-500"><?= htmlspecialchars($user->getmail())?></p>
                        </div>
                    </div>
                    <form class="flex space-x-4" method="POST" action="">
    <input type="hidden" name="user_id" value="<?= $user->getUserId() ?>">
    <button type="submit" name="valide" value="valide" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition flex items-center">
        <i class="fas fa-check mr-2"></i>
        Valider
    </button>
    <button type="submit" name="invalide" value="invalide" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition flex items-center">
        <i class="fas fa-times mr-2"></i>
        Refuser
    </button>
</form>
                </div>
            </div>
<?php endforeach;?>
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