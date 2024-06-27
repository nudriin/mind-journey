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
        </div>
    </nav>