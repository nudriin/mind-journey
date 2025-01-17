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
    <nav x-data="{navOpen : true}">
        <div class="fixed top-0 left-0 right-0 mx-auto bg-biru items-center py-4 px-4 sm:hidden">
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
                        <a href="/admin" class="flex items-center space-x-2 px-3 group w-full text-center rounded-xl py-2 font-rubik font-medium hover:bg-biru hover:text-dark-white">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                <path d="M12 9a1 1 0 01-1-1V3c0-.553.45-1.008.997-.93a7.004 7.004 0 015.933 5.933c.078.547-.378.997-.93.997h-5z" />
                                <path d="M8.003 4.07C8.55 3.992 9 4.447 9 5v5a1 1 0 001 1h5c.552 0 1.008.45.93.997A7.001 7.001 0 012 11a7.002 7.002 0 016.003-6.93z" />
                            </svg>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/profile" class="flex items-center space-x-2 px-3 group w-full text-center rounded-xl py-2 font-rubik font-medium hover:bg-biru hover:text-dark-white">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-5.5-2.5a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0zM10 12a5.99 5.99 0 00-4.793 2.39A6.483 6.483 0 0010 16.5a6.483 6.483 0 004.793-2.11A5.99 5.99 0 0010 12z" clip-rule="evenodd" />
                            </svg>
                            <span>Ubah profil</span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/chat" class="flex items-center space-x-2 px-3 group w-full text-center rounded-xl py-2 font-rubik font-medium hover:bg-biru hover:text-dark-white">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                <path fill-rule="evenodd" d="M2 10c0-3.967 3.69-7 8-7 4.31 0 8 3.033 8 7s-3.69 7-8 7a9.165 9.165 0 01-1.504-.123 5.976 5.976 0 01-3.935 1.107.75.75 0 01-.584-1.143 3.478 3.478 0 00.522-1.756C2.979 13.825 2 12.025 2 10z" clip-rule="evenodd" />
                            </svg>
                            <span>Chat</span>
                        </a>
                    </li>
                    <li>
                        <a href="/post-article" class="flex items-center space-x-2 px-3 group w-full text-center rounded-xl py-2 font-rubik font-medium hover:bg-biru hover:text-dark-white">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                <path fill-rule="evenodd" d="M2 3.5A1.5 1.5 0 013.5 2h9A1.5 1.5 0 0114 3.5v11.75A2.75 2.75 0 0016.75 18h-12A2.75 2.75 0 012 15.25V3.5zm3.75 7a.75.75 0 000 1.5h4.5a.75.75 0 000-1.5h-4.5zm0 3a.75.75 0 000 1.5h4.5a.75.75 0 000-1.5h-4.5zM5 5.75A.75.75 0 015.75 5h4.5a.75.75 0 01.75.75v2.5a.75.75 0 01-.75.75h-4.5A.75.75 0 015 8.25v-2.5z" clip-rule="evenodd" />
                                <path d="M16.5 6.5h-1v8.75a1.25 1.25 0 102.5 0V8a1.5 1.5 0 00-1.5-1.5z" />
                            </svg>
                            <span>Tambah artikel</span>
                        </a>
                    </li>
                    <li>
                        <a href="/active-article" class="flex items-center space-x-2 px-3 group w-full text-center rounded-xl py-2 font-rubik font-medium hover:bg-biru hover:text-dark-white">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                <path d="M10 12.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5z" />
                                <path fill-rule="evenodd" d="M.664 10.59a1.651 1.651 0 010-1.186A10.004 10.004 0 0110 3c4.257 0 7.893 2.66 9.336 6.41.147.381.146.804 0 1.186A10.004 10.004 0 0110 17c-4.257 0-7.893-2.66-9.336-6.41zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                            </svg>
                            <span>Artikel aktif</span>
                        </a>
                    </li>
                    <li>
                        <a href="/deactive-article" class="flex items-center space-x-2 px-3 group w-full text-center rounded-xl py-2 font-rubik font-medium hover:bg-biru hover:text-dark-white">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                <path fill-rule="evenodd" d="M3.28 2.22a.75.75 0 00-1.06 1.06l14.5 14.5a.75.75 0 101.06-1.06l-1.745-1.745a10.029 10.029 0 003.3-4.38 1.651 1.651 0 000-1.185A10.004 10.004 0 009.999 3a9.956 9.956 0 00-4.744 1.194L3.28 2.22zM7.752 6.69l1.092 1.092a2.5 2.5 0 013.374 3.373l1.091 1.092a4 4 0 00-5.557-5.557z" clip-rule="evenodd" />
                                <path d="M10.748 13.93l2.523 2.523a9.987 9.987 0 01-3.27.547c-4.258 0-7.894-2.66-9.337-6.41a1.651 1.651 0 010-1.186A10.007 10.007 0 012.839 6.02L6.07 9.252a4 4 0 004.678 4.678z" />
                            </svg>
                            <span>Artikel non-aktif</span>
                        </a>
                    </li>
                    <li>
                        <a href="/suggestions" class="flex items-center space-x-2 px-3 group w-full text-center rounded-xl py-2 font-rubik font-medium hover:bg-biru hover:text-dark-white">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                <path fill-rule="evenodd" d="M2 10c0-3.967 3.69-7 8-7 4.31 0 8 3.033 8 7s-3.69 7-8 7a9.165 9.165 0 01-1.504-.123 5.976 5.976 0 01-3.935 1.107.75.75 0 01-.584-1.143 3.478 3.478 0 00.522-1.756C2.979 13.825 2 12.025 2 10z" clip-rule="evenodd" />
                            </svg>
                            <span>Kritik & saran</span>
                        </a>
                    </li>
                    <li>
                    <li>
                        <a href="/admin/register" class="flex items-center space-x-2 px-3 group w-full text-center rounded-xl py-2 font-rubik font-medium hover:bg-biru hover:text-dark-white">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-11.25a.75.75 0 00-1.5 0v2.5h-2.5a.75.75 0 000 1.5h2.5v2.5a.75.75 0 001.5 0v-2.5h2.5a.75.75 0 000-1.5h-2.5v-2.5z" clip-rule="evenodd" />
                            </svg>
                            <span>Tambah admin</span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/password" class="flex items-center space-x-2 px-3 group w-full text-center rounded-xl py-2 font-rubik font-medium hover:bg-biru hover:text-dark-white">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                <path fill-rule="evenodd" d="M8 7a5 5 0 113.61 4.804l-1.903 1.903A1 1 0 019 14H8v1a1 1 0 01-1 1H6v1a1 1 0 01-1 1H3a1 1 0 01-1-1v-2a1 1 0 01.293-.707L8.196 8.39A5.002 5.002 0 018 7zm5-3a.75.75 0 000 1.5A1.5 1.5 0 0114.5 7 .75.75 0 0016 7a3 3 0 00-3-3z" clip-rule="evenodd" />
                            </svg>
                            <span>Ganti password</span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/logout" class="flex items-center space-x-2 px-3 group w-full text-center rounded-xl py-2 font-rubik font-medium bg-biru text-dark-white hover:bg-red-600 hover:text-dark-white">
                            <span>Logout</span>
                        </a>
                    </li>

                </ul>
            </div>
    </nav>