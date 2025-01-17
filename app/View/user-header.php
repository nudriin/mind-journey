<?php
require_once __DIR__ . "/../Helper/ImageHelper.php";
require_once __DIR__ . "/../../vendor/autoload.php";
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.2/css/font-awesome.min.css'>
</head>

<body class="text-abu font-poppins">
    <!-- Navigation -->
    <nav class="" x-data="{navOpen : true}">
        <div class="fixed top-0 left-0 right-0 mx-auto bg-biru items-center py-4 px-4 z-50 sm:hidden">
            <div class="flex justify-between">
                <div class="flex items-center gap-3">
                    <img src="<?= getImage("LogoSmall.svg") ?>">
                    <a href="/" class="font-rubik text-white">MindJourney</a>
                </div>
                <img src="<?= getImage("toggle.svg") ?>" @click="navOpen = !navOpen" class="sm:hidden">
            </div>
        </div>
        <div x-show="navOpen" x-transition:enter="transition duration-1000" x-transition:enter-end="transform translate-x-0" x-transition:leave="transition duration-1000" x-transition:leave-start="transform -translate-x-0" x-transition:leave-end="transform -translate-x-full" class="fixed top-0 left-0 h-screen w-64 z-50">
            <div class="bg-dark-white h-full px-4 py-4">
                <div class="flex items-center space-x-2 px-3 w-full text-center rounded-xl py-2 font-rubik font-medium sm:hidden">
                    <span class="flex-1 text-left font-rubik font-medium text-xl">MindJourney</span>
                    <button type="button" class="p-2 focus:outline-none focus:bg-biru hover:bg-biru hover:text-dark-white rounded-md" @click="navOpen = false">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path fill-rule="evenodd" d="M7.72 12.53a.75.75 0 010-1.06l7.5-7.5a.75.75 0 111.06 1.06L9.31 12l6.97 6.97a.75.75 0 11-1.06 1.06l-7.5-7.5z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
                <ul class="py-4 space-y-3">
                    <li>
                        <a href="/" class="flex items-center space-x-2 px-3 group w-full text-center rounded-xl py-2 font-rubik font-medium hover:bg-biru hover:text-dark-white">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                <path fill-rule="evenodd" d="M9.293 2.293a1 1 0 011.414 0l7 7A1 1 0 0117 11h-1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-3a1 1 0 00-1-1H9a1 1 0 00-1 1v3a1 1 0 01-1 1H5a1 1 0 01-1-1v-6H3a1 1 0 01-.707-1.707l7-7z" clip-rule="evenodd" />
                            </svg>
                            <span>Beranda</span>
                        </a>
                    </li>
                    <li>
                        <a href="/user/profile" class="flex items-center space-x-2 px-3 group w-full text-center rounded-xl py-2 font-rubik font-medium hover:bg-biru hover:text-dark-white">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-5.5-2.5a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0zM10 12a5.99 5.99 0 00-4.793 2.39A6.483 6.483 0 0010 16.5a6.483 6.483 0 004.793-2.11A5.99 5.99 0 0010 12z" clip-rule="evenodd" />
                            </svg>
                            <span>Profil</span>
                        </a>
                    </li>
                    <li>
                        <a href="/user/chat" class="flex items-center space-x-2 px-3 group w-full text-center rounded-xl py-2 font-rubik font-medium hover:bg-biru hover:text-dark-white">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                <path fill-rule="evenodd" d="M2 10c0-3.967 3.69-7 8-7 4.31 0 8 3.033 8 7s-3.69 7-8 7a9.165 9.165 0 01-1.504-.123 5.976 5.976 0 01-3.935 1.107.75.75 0 01-.584-1.143 3.478 3.478 0 00.522-1.756C2.979 13.825 2 12.025 2 10z" clip-rule="evenodd" />
                            </svg>
                            <span>Chat</span>
                        </a>
                    </li>
                    <li>
                        <a href="/user/diary" class="flex items-center space-x-2 px-3 group w-full text-center rounded-xl py-2 font-rubik font-medium hover:bg-biru hover:text-dark-white">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                <path fill-rule="evenodd" d="M4.5 2A1.5 1.5 0 003 3.5v13A1.5 1.5 0 004.5 18h11a1.5 1.5 0 001.5-1.5V7.621a1.5 1.5 0 00-.44-1.06l-4.12-4.122A1.5 1.5 0 0011.378 2H4.5zm2.25 8.5a.75.75 0 000 1.5h6.5a.75.75 0 000-1.5h-6.5zm0 3a.75.75 0 000 1.5h6.5a.75.75 0 000-1.5h-6.5z" clip-rule="evenodd" />
                            </svg>
                            <span>Diary</span>
                        </a>
                    </li>
                    <li>
                        <a href="/user/post-diary" class="flex items-center space-x-2 px-3 group w-full text-center rounded-xl py-2 font-rubik font-medium hover:bg-biru hover:text-dark-white">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-11.25a.75.75 0 00-1.5 0v2.5h-2.5a.75.75 0 000 1.5h2.5v2.5a.75.75 0 001.5 0v-2.5h2.5a.75.75 0 000-1.5h-2.5v-2.5z" clip-rule="evenodd" />
                            </svg>
                            <span>Tulis Diary</span>
                        </a>
                    </li>
                    <li>
                        <a href="/user/password" class="flex items-center space-x-2 px-3 group w-full text-center rounded-xl py-2 font-rubik font-medium hover:bg-biru hover:text-dark-white">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                <path fill-rule="evenodd" d="M8 7a5 5 0 113.61 4.804l-1.903 1.903A1 1 0 019 14H8v1a1 1 0 01-1 1H6v1a1 1 0 01-1 1H3a1 1 0 01-1-1v-2a1 1 0 01.293-.707L8.196 8.39A5.002 5.002 0 018 7zm5-3a.75.75 0 000 1.5A1.5 1.5 0 0114.5 7 .75.75 0 0016 7a3 3 0 00-3-3z" clip-rule="evenodd" />
                            </svg>
                            <span>Ganti password</span>
                        </a>
                    </li>
                    <li>
                        <a href="/user/logout" class="flex items-center space-x-2 px-3 group w-full text-center rounded-xl py-2 font-rubik font-medium bg-biru text-dark-white hover:bg-red-600 hover:text-dark-white">
                            <span>Logout</span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>