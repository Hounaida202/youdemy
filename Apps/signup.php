<?php
require_once '../classes/database.php';
require_once '../classes/user.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   

    $nom = $_POST["firstname"];
    $prenom = $_POST["lastname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirm-password"];
    $user_type = $_POST["role"];

    $errors = [];

    if (user::verifieremail($email)===true) {
        $errors[] = "L'email existe déjà.";
        echo "<script>alert('ixiste !');</script>";
    }

    if ($password !== $confirmpassword) {
        $errors[] = "Les mots de passe ne sont pas identiques.";
    }

    if (empty($errors)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $hashedconfirmPassword = password_hash($confirmpassword, PASSWORD_DEFAULT);
        $inscription = user::inscrireStudent($nom, $prenom, $email, $hashedPassword, $hashedconfirmPassword, $user_type);

        if (!$inscription) {
            echo "<script>alert('Merci , veuillez attendre 24 h jusqu'à ce que l'admin vous accepte!');</script>";
        } else {
            echo "<script>alert('Une erreur est survenue lors de l\'inscription.');</script>";
        }
    } else {
        foreach ($errors as $error) {
            echo "<script>alert('$error');</script>";
        }
    }
}


?>


<!DOCTYPE html>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Inscription</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-slate-50">
    <nav class="bg-purple-800 text-white shadow-lg">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center">
                <a href="index.html" class="flex items-center">
                    <i class="fas fa-graduation-cap text-2xl mr-2"></i>
                    <span class="text-2xl font-bold">EduLearn</span>
                </a>
            </div>
        </div>
    </nav>

    <div class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8 bg-gradient-to-b from-purple-50 to-slate-50">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="text-center text-3xl font-extrabold text-gray-900 mb-8">
                Créer un compte
            </h2>
        </div>

        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow-xl rounded-lg sm:px-10">
                <form class="space-y-6" method="POST" action="">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="firstname" class="block text-sm font-medium text-gray-700">Prénom</label>
                            <input type="text" id="firstname" name="firstname" required 
                                class="mt-1 block w-full px-3 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        </div>
                        <div>
                            <label for="lastname" class="block text-sm font-medium text-gray-700">Nom</label>
                            <input type="text" id="lastname" name="lastname" required 
                                class="mt-1 block w-full px-3 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        </div>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Adresse email</label>
                        <input type="email" id="email" name="email" required 
                            class="mt-1 block w-full px-3 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                        <input type="password" id="password" name="password" required 
                            class="mt-1 block w-full px-3 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                    </div>

                    <div>
                        <label for="confirm-password" class="block text-sm font-medium text-gray-700">Confirmer le mot de passe</label>
                        <input type="password" id="confirm-password" name="confirm-password" required 
                            class="mt-1 block w-full px-3 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                    </div>

                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700">Je suis</label>
                        <select id="role" name="role" required 
                            class="mt-1 block w-full px-3 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                            <option value="">Sélectionnez votre rôle</option>
                            <option value="etudiant">Étudiant</option>
                            <option value="enseignant">Enseignant</option>
                        </select>
                    </div>

                    <div class="flex items-center">
                        <input id="terms" name="terms" type="checkbox" required
                            class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                        <label for="terms" class="ml-2 block text-sm text-gray-900">
                            J'accepte les conditions d'utilisation et la politique de confidentialité
                        </label>
                    </div>

                    <div>
                        <button type="submit" 
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-purple-800 hover:bg-purple-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                            Créer mon compte
                        </button>
                    </div>
                </form>

                <div class="mt-6">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-gray-500">
                                Déjà inscrit ?
                            </span>
                        </div>
                    </div>

                    <div class="mt-6">
                        <a href="login.php" 
                            class="w-full flex justify-center py-3 px-4 border border-purple-300 rounded-lg shadow-sm text-sm font-medium text-purple-800 bg-white hover:bg-purple-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                            Se connecter
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
