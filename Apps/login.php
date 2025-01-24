
<?php
require_once '../classes/database.php';
require_once '../classes/user.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $emailresult=user::GetUserinfos($email);

    $result = user::verfierData($email, $password);

    if ($result === true) {
      if($emailresult['status']==='en attente'){
        echo "<script>alert('votre demande est en cours de traitement');</script>";
      }
      if($emailresult['status']==='valide'){
        if($emailresult["user_type"]==="etudiant"){
            header("Location: ./etudiant_page.php");
            exit;
        }
        if($emailresult["user_type"]==="administrateur"){
            header("Location: ./admin_page.php");
            exit;
        }
        else{
            header("Location: ./enseignant_page.php");
            exit;
        }
      }
      else{
        echo "<script>alert('ce compte n'existe pas');</script>";

      }
       
    } else {
        $error_message = $result; 
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduLearn - Connexion</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-slate-50">
    <!-- Navbar (simplifié) -->
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

    <!-- Login Form -->
    <div class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8 bg-gradient-to-b from-purple-50 to-slate-50">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="text-center text-3xl font-extrabold text-gray-900 mb-8">
                Connexion à votre compte
            </h2>
        </div>
        <?php if (isset($error_message)): ?>
            <div class="text-red-500 text-center mb-4">
                <?php echo htmlspecialchars($error_message); ?>
            </div>
        <?php endif; ?>
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow-xl rounded-lg sm:px-10">
                <form class="space-y-6" method="POST"  action="" >
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">
                            Adresse email
                        </label>
                        <div class="mt-1">
                            <input id="email" name="email" type="email" required 
                                class="appearance-none block w-full px-3 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">
                            Mot de passe
                        </label>
                        <div class="mt-1">
                            <input id="password" name="password" type="password" required 
                                class="appearance-none block w-full px-3 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember-me" name="remember-me" type="checkbox" 
                                class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                            <label for="remember-me" class="ml-2 block text-sm text-gray-900">
                                Se souvenir de moi
                            </label>
                        </div>

                        <div class="text-sm">
                            <a href="#" class="font-medium text-purple-600 hover:text-purple-500">
                                Mot de passe oublié ?
                            </a>
                        </div>
                    </div>

                    <div>
                        <button type="submit" 
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-purple-800 hover:bg-purple-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                            Se connecter
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
                                Pas encore de compte ?
                            </span>
                        </div>
                    </div>

                    <div class="mt-6">
                        <a href="./signup.php" 
                            class="w-full flex justify-center py-3 px-4 border border-purple-300 rounded-lg shadow-sm text-sm font-medium text-purple-800 bg-white hover:bg-purple-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                            Créer un compte
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>