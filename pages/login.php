<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Login Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="bg-gray-100 min-h-screen flex items-center justify-center relative">
        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <img src="https://source.unsplash.com/random/1920x1080" alt="Background"
                class="w-full h-full object-cover filter blur-lg brightness-50">
        </div>

        <!-- Login Form -->
        <div
            class="relative z-10 bg-white p-6 sm:p-8 lg:p-10 rounded-md shadow-lg w-full max-w-xs sm:max-w-md lg:max-w-lg">
            <h1 class="text-xl lg:text-2xl font-bold text-center mb-6 text-gray-800">Login</h1>
            <form action="#" method="POST">
                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2 text-sm sm:text-base" for="email">Email</label>
                    <input
                        class="appearance-none border border-gray-300 rounded-md py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 w-full"
                        id="email" type="email" placeholder="Enter your email" required>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2 text-sm sm:text-base" for="password">Password</label>
                    <input
                        class="appearance-none border border-gray-300 rounded-md py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 w-full"
                        id="password" type="password" placeholder="Enter your password" required>
                </div>
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <button
                        class="bg-cyan-500 hover:bg-cyan-700 text-white font-bold py-2 px-6 rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 w-full sm:w-auto"
                        type="submit">
                        Sign In
                    </button>
                    <a class="inline-block align-baseline font-bold text-sm sm:text-base text-cyan-500 hover:text-cyan-800"
                        href="#">
                        Forgot Password?
                    </a>
                </div>
            </form>

            <!-- Create Account Section -->
            <div class="mt-6 text-center">
                <p class="text-gray-600 text-sm sm:text-base">
                    Don't have an account?
                    <a href="signup.php" class="text-cyan-500 font-bold hover:text-cyan-800">
                        Create an Account
                    </a>
                </p>
            </div>
        </div>
    </div>
</body>

</html>
