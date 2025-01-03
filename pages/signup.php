<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
</head>

<body>
    <div class="bg-gray-100 min-h-screen flex items-center justify-center relative">
        <div class="absolute inset-0 z-0">
            <img src="https://source.unsplash.com/random/1920x1080" alt="Background"
                class="w-full h-full object-cover filter blur-lg brightness-50">
        </div>

        <div class="relative z-10 bg-white p-6 sm:p-8 md:p-10 lg:p-12 rounded-md shadow-lg w-full max-w-xs sm:max-w-sm md:max-w-md lg:max-w-lg">
            <h1 class="text-2xl font-bold text-center mb-6 text-gray-800">Create an Account</h1>
            <form id="signupForm" method="POST">
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-bold mb-2">Full Name</label>
                    <input
                        class="appearance-none border border-gray-300 rounded-md py-2 px-4 w-full text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500"
                        id="name" name="name" type="text" placeholder="Your Full Name" required>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                    <input
                        class="appearance-none border border-gray-300 rounded-md py-2 px-4 w-full text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500"
                        id="email" name="email" type="email" placeholder="Your Email" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 font-bold mb-2">Password</label>
                    <input
                        class="appearance-none border border-gray-300 rounded-md py-2 px-4 w-full text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500"
                        id="password" name="password" type="password" placeholder="Create a Password" required>
                </div>
                <div class="mb-6">
                    <label for="confirm-password" class="block text-gray-700 font-bold mb-2">Confirm Password</label>
                    <input
                        class="appearance-none border border-gray-300 rounded-md py-2 px-4 w-full text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500"
                        id="confirm-password" name="confirm_password" type="password" placeholder="Confirm Your Password" required>
                </div>
                <div class="flex items-center justify-between flex-col sm:flex-row">
                    <button
                        class="bg-cyan-500 hover:bg-cyan-700 text-white font-bold py-2 px-6 rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 w-full sm:w-auto"
                        type="submit">
                        Sign Up
                    </button>
                    <a href="login.php"
                        class="inline-block mt-4 sm:mt-0 sm:ml-4 font-bold text-sm text-cyan-500 hover:text-cyan-800">
                        Already have an account?
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
    
    </script>
</body>

</html>
<?php
require_once '../class/Auth.Class.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $auth = new Auth();
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    if (!$email) {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: 'Email invalide.',
                confirmButtonColor: '#d33'
            }).then(() => {
                window.history.back();
            });
        </script>";
        exit();
    }

    if ($motDePasse !== $confirmMotDePasse) {
        
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: 'Les mots de passe ne correspondent pas.',
                confirmButtonColor: '#d33'
            }).then(() => {
                window.history.back();
            });
        </script>";
        exit();
    }
    
    $result = $auth->register($name, $email, $password);
    
    if ($result) {
        echo "<script>
            Swal.fire({
                title: 'Succès!',
                text: 'Votre compte a été créé avec succès',
                icon: 'success',
                confirmButtonColor: '#06b6d4'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'login.php';
                }
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                title: 'Erreur!',
                text: 'Cette adresse email est déjà utilisée',
                icon: 'error',
                confirmButtonColor: '#06b6d4'
            });
        </script>";
    }
}
?>