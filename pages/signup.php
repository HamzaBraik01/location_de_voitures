<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Sign Up Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="bg-gray-100 min-h-screen flex items-center justify-center relative">
        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <img src="https://source.unsplash.com/random/1920x1080" alt="Background"
                class="w-full h-full object-cover filter blur-lg brightness-50">
        </div>

        <!-- Sign-Up Form -->
        <div
            class="relative z-10 bg-white p-6 sm:p-8 md:p-10 lg:p-12 rounded-md shadow-lg w-full max-w-xs sm:max-w-sm md:max-w-md lg:max-w-lg">
            <h1 class="text-2xl font-bold text-center mb-6 text-gray-800">Create an Account</h1>
            <form action="#" method="POST">
                <!-- Full Name -->
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-bold mb-2">Full Name</label>
                    <input
                        class="appearance-none border border-gray-300 rounded-md py-2 px-4 w-full text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500"
                        id="name" type="text" placeholder="Your Full Name" required>
                </div>
                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                    <input
                        class="appearance-none border border-gray-300 rounded-md py-2 px-4 w-full text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500"
                        id="email" type="email" placeholder="Your Email" required>
                </div>
                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 font-bold mb-2">Password</label>
                    <input
                        class="appearance-none border border-gray-300 rounded-md py-2 px-4 w-full text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500"
                        id="password" type="password" placeholder="Create a Password" required>
                </div>
                <!-- Confirm Password -->
                <div class="mb-6">
                    <label for="confirm-password" class="block text-gray-700 font-bold mb-2">Confirm Password</label>
                    <input
                        class="appearance-none border border-gray-300 rounded-md py-2 px-4 w-full text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500"
                        id="confirm-password" type="password" placeholder="Confirm Your Password" required>
                </div>
                <!-- Sign-Up Button -->
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
</body>

</html>
