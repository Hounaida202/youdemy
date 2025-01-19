<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduLearn - Plateforme d'apprentissage en ligne</title>
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
                    <a href="#" class="hover:text-purple-200">Accueil</a>
                    <a href="../Apps/categorie.php" class="hover:text-purple-200">Cours</a>
                    <a href="#" class="hover:text-purple-200">À propos</a>
                    <a href="#" class="hover:text-purple-200">Contact</a>
                </div>
                <div class="flex space-x-4">
                    <a href="login.php" class="px-4 py-2 bg-purple-600 rounded-lg hover:bg-purple-700 transition">Connexion</a>
                    <a href="signup.php" class="px-4 py-2 bg-white text-purple-800 rounded-lg hover:bg-purple-100 transition">Inscription</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-purple-800 to-purple-900 text-white py-20">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">Apprenez à votre rythme</h1>
            <p class="text-xl mb-8">Découvrez des milliers de cours en ligne avec les meilleurs instructeurs</p>
            <a href="signup.php" class="bg-white text-purple-800 px-8 py-3 rounded-full font-bold hover:bg-purple-100 transition">
                Commencer gratuitement
            </a>
        </div>
    </section>

    <!-- Features -->
    <section class="py-16">
        <div class="container mx-auto px-6 grid md:grid-cols-3 gap-8">
            <div class="text-center p-6 bg-white rounded-xl shadow-md">
                <i class="fas fa-laptop-code text-4xl text-purple-600 mb-4"></i>
                <h3 class="text-xl font-bold mb-2">Cours en ligne</h3>
                <p class="text-gray-600">Accédez à vos cours n'importe où, n'importe quand</p>
            </div>
            <div class="text-center p-6 bg-white rounded-xl shadow-md">
                <i class="fas fa-users text-4xl text-purple-600 mb-4"></i>
                <h3 class="text-xl font-bold mb-2">Communauté active</h3>
                <p class="text-gray-600">Échangez avec d'autres étudiants et experts</p>
            </div>
            <div class="text-center p-6 bg-white rounded-xl shadow-md">
                <i class="fas fa-certificate text-4xl text-purple-600 mb-4"></i>
                <h3 class="text-xl font-bold mb-2">Certificats reconnus</h3>
                <p class="text-gray-600">Obtenez des certificats validés par des professionnels</p>
            </div>
        </div>
    </section>

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