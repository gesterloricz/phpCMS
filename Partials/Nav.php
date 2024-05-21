<?php

session_start();

if (!isset($_SESSION['userDetails'])) {
    $_SESSION['userDetails'] = array(
        'user_id' => 0,
        'username' => 'guest',
        'name' => 'Guest User',
    );
}

if (isset($_POST['logout'])) {
    session_destroy(); // Destroy the session
    header("Location: index.php"); // Redirect to a page after logout
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <title>Document</title>
</head>

<body>
    <nav x-cloak x-data="{ isOpen: false }" class="relative bg-white dark:bg-gray-800">
        <div class="container px-4 py-6 mx-auto">
            <div class="lg:flex lg:items-center lg:justify-between">
                <div class="flex items-center justify-between">
                    <div class="text-xl font-semibold text-gray-700">
                        <a href="/" class="text-2xl font-medium text-sky-500 transition-colors flex items-center duration-300 transform dark:text-sky-400 hover:text-sky-400 dark:hover:text-sky-300" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" class="w-8 h-8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 01-1.125-1.125v-3.75zM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-8.25zM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-2.25z" />
                            </svg>

                            <h3 class="mx-2">BEKU</h3>
                        </a>
                    </div>

                    <!-- Mobile menu button -->
                    <div class="flex lg:hidden">
                        <button x-cloak @click="isOpen = !isOpen" type="button" class="text-gray-500 dark:text-gray-200 hover:text-gray-600 dark:hover:text-gray-400 focus:outline-none focus:text-gray-600 dark:focus:text-gray-400" aria-label="toggle menu">
                            <svg x-show="!isOpen" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 8h16M4 16h16" />
                            </svg>

                            <svg x-show="isOpen" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Mobile Menu open: "block", Menu closed: "hidden" -->
                <div x-cloak :class="[isOpen ? 'translate-x-0 opacity-100 ' : 'opacity-0 -translate-x-full']" class="absolute inset-x-0 z-20 w-full px-6 py-4 transition-all duration-300 ease-in-out bg-white dark:bg-gray-800 lg:mt-0 lg:p-0 lg:top-0 lg:relative lg:bg-transparent lg:w-auto lg:opacity-100 lg:translate-x-0 lg:flex lg:items-center">
                    <div class="flex flex-col -mx-6 lg:flex-row lg:items-center">
                        <a href="/" class="px-4 py-1.5 mx-3 mt-2 text-gray-700 transition-colors duration-300 transform rounded-lg lg:mt-0 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                            Home</a>
                        <a href="Blogs.php" class="px-4 py-1.5 mx-3 mt-2 text-gray-700 transition-colors duration-300 transform rounded-lg lg:mt-0 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                            Blogs</a>
                        <?php if ($_SESSION['userDetails']['username'] === "guest" || $_SESSION['userDetails']['username'] === null) : ?>
                            <a href="user/login.php" class=" px-4 py-1.5 mx-3  text-white duration-300 bg-sky-500 rounded-lg hover:bg-sky-600 focus:ring focus:ring-sky-300 focus:ring-opacity-80">
                                <span>Login</span>
                            </a>
                            <a href="user/register.php" class="inline-flex items-center justify-center px-4 py-1.5 mx-3 text-white duration-300 bg-sky-500 rounded-lg hover:bg-sky-600 focus:ring focus:ring-sky-300 focus:ring-opacity-80">
                                <span>Sign Up</span>
                            </a>
                        <?php else : ?>
                            <a href="user/index.php" class="px-4 py-1.5 mx-3 text-white duration-300 bg-sky-500 rounded-lg hover:bg-sky-600 focus:ring focus:ring-sky-300 focus:ring-opacity-80">
                                <span>Dashboard</span>
                            </a>
                            <form method="post" action="index.php" action="">
                                <button type="submit" name="logout" class="px-4 py-1.5 mx-3 text-white duration-300 bg-red-500 rounded-lg hover:bg-red-600 focus:ring focus:ring-red-300 focus:ring-opacity-80">
                                    <span>Logout</span>
                                </button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </nav>