<?php
require_once __DIR__ . "/../Helper/ImageHelper.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $model['title'] ?></title>
    <link rel="stylesheet" href="http://localhost/css/styles.css">
    <link rel="icon" type="image/x-icon" href="http://localhost/images/LogoSmall.svg">
    <!-- <link rel="stylesheet" href="http://1291-114-10-143-235.ngrok-free.app/css/styles.css"> -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@500&family=Lilita+One&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Bree+Serif&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Secular+One&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,700;1,900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Rubik:wght@500&display=swap');
    </style>
    <!-- Alpine js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="text-abu font-poppins">
    <!-- Navigation -->
    <nav x-data="{navOpen : false}" class="py-5 px-4">
        <div class="fixed top-0 left-0 right-0 z-50 bg-biru items-center py-4 px-4">
            <div class="container mx-auto lg:px-20">
                <div class="flex justify-between">
                    <div class="flex items-center gap-3">
                        <img src="<?= getImage("LogoSmall.svg") ?>">
                        <a href="/" class="font-rubik text-white">MindJourney</a>
                    </div>
                    <div class="hidden lg:block">
                        <ul class="flex flex-row gap-3 mt-2 text-white">
                            <li><a href="/">Beranda</a></li>
                            <li><a href="/article">Artikel</a></li>
                            <li><a href="/article/Tidur">Tidur</a></li>
                            <li><a href="/article/Olahraga">Olahraga</a></li>
                            <li><a href="/article/Stres">Stres</a></li>
                            <li><a href="/article/Lainnya">Lainnya</a></li>
                        </ul>
                    </div>
                    <img src="<?= getImage('toggle.svg') ?>" @click="navOpen = !navOpen" class="lg:hidden sm:order-3">
                    <div class="hidden lg:block">
                        <div class="flex flex-row gap-2">
                            <a href="/user/login" class="grow hidden lg:block py-2 px-3 rounded-full text-white font-semibold">Login</a>
                            <a href="/user/register" class="grow bg-dark-white hidden lg:block py-2 px-3 rounded-full text-biru font-semibold">Daftar</a>
                        </div>
                    </div>
                </div>

            </div>
            <!-- mobile navigation -->
            <!-- z index buat fixed bottom -->
            <div class="fixed top-0 left-0 h-screen w-64 duration-200 z-50 transform -translate-x-full lg:hidden" :class="{'translate-x-0' : navOpen === true, '-translate-x-full' : navOpen === false}">
                <div class="bg-dark-white h-full px-4 py-4">
                    <div class="flex items-center space-x-2 px-3 w-full text-center rounded-xl py-2 font-rubik font-medium">
                        <span class="flex-1 text-left font-rubik font-medium text-xl text-biru">MindJourney</span>
                        <button type="button" class="p-2 focus:outline-none focus:bg-biru hover:bg-biru hover:text-dark-white rounded-md" @click="navOpen = false">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path fill-rule="evenodd" d="M7.72 12.53a.75.75 0 010-1.06l7.5-7.5a.75.75 0 111.06 1.06L9.31 12l6.97 6.97a.75.75 0 11-1.06 1.06l-7.5-7.5z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                    <hr class="outline-2">
                    <ul class="py-4 space-y-3">
                        <li>
                            <a href="/" class="flex items-center space-x-2 px-3 group w-full text-center rounded-xl py-2 font-rubik font-medium hover:bg-biru hover:text-dark-white">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                    <path fill-rule="evenodd" d="M9.293 2.293a1 1 0 011.414 0l7 7A1 1 0 0117 11h-1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-3a1 1 0 00-1-1H9a1 1 0 00-1 1v3a1 1 0 01-1 1H5a1 1 0 01-1-1v-6H3a1 1 0 01-.707-1.707l7-7z" clip-rule="evenodd" />
                                </svg>
                                <span>Beranda</span>
                            </a>
                        </li>
                        <li x-data="{open:false}" @click="open = !open">
                            <button type="button" class="flex items-center space-x-2 px-3 w-full text-center rounded-xl py-2 font-rubik font-medium hover:bg-biru hover:text-dark-white">
                                <svg class="flex-shrink-0 w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                    <path d="M12 9a1 1 0 01-1-1V3c0-.553.45-1.008.997-.93a7.004 7.004 0 015.933 5.933c.078.547-.378.997-.93.997h-5z" />
                                    <path d="M8.003 4.07C8.55 3.992 9 4.447 9 5v5a1 1 0 001 1h5c.552 0 1.008.45.93.997A7.001 7.001 0 012 11a7.002 7.002 0 016.003-6.93z" />
                                </svg>
                                <span class="flex-1 text-left">Artikel</span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <!-- <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                            <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 21">
                                <path d="M15 12a1 1 0 0 0 .962-.726l2-7A1 1 0 0 0 17 3H3.77L3.175.745A1 1 0 0 0 2.208 0H1a1 1 0 0 0 0 2h.438l.6 2.255v.019l2 7 .746 2.986A3 3 0 1 0 9 17a2.966 2.966 0 0 0-.184-1h2.368c-.118.32-.18.659-.184 1a3 3 0 1 0 3-3H6.78l-.5-2H15Z" />
                            </svg>
                            <span class="flex-1 ml-3 text-left whitespace-nowrap">E-commerce</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button> -->
                            <ul x-show="open">
                                <li>
                                    <a href="/article" class="flex items-center space-x-2 px-3 group w-full text-center rounded-xl py-2 font-rubik font-medium hover:bg-biru hover:text-dark-white">
                                        <span class="ml-7">Semua</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/article/Tidur" class="flex items-center space-x-2 px-3 group w-full text-center rounded-xl py-2 font-rubik font-medium hover:bg-biru hover:text-dark-white">
                                        <span class="ml-7">Tidur</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/article/Olahraga" class="flex items-center space-x-2 px-3 group w-full text-center rounded-xl py-2 font-rubik font-medium hover:bg-biru hover:text-dark-white">
                                        <span class="ml-7">Olahraga</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/article/Stres" class="flex items-center space-x-2 px-3 group w-full text-center rounded-xl py-2 font-rubik font-medium hover:bg-biru hover:text-dark-white">
                                        <span class="ml-7">Stres</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="/article/Lainnya" class="flex items-center space-x-2 px-3 group w-full text-center rounded-xl py-2 font-rubik font-medium hover:bg-biru hover:text-dark-white">
                                        <span class="ml-7">Lainnya</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="/user/login" class="flex items-center space-x-2 px-3 group w-full text-center rounded-xl py-2 font-rubik font-medium bg-biru text-dark-white hover:bg-red-600 hover:text-dark-white">
                                <span>Login</span>
                            </a>
                        </li>
                        <li>
                            <a href="/user/register" class="flex items-center space-x-2 px-3 group w-full text-center rounded-xl py-2 font-rubik font-medium bg-biru text-dark-white hover:bg-red-600 hover:text-dark-white">
                                <span>Register</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

    </nav>