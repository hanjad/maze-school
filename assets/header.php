<?php $signedIn = false; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.css" rel="stylesheet" />
    <title><?= $pagetitle ?></title>
</head>

<body class="bg-gray-50 dark:bg-gray-900">

    <nav class="bg-gray-50 dark:bg-gray-900 sticky w-full z-20 top-0 start-0 border-b border-default dark:text-white">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="https://flowbite.com/docs/images/logo.svg" class="h-7" alt="Maze Schools Logo" />
                <span class="self-center text-xl text-heading font-semibold whitespace-nowrap">Maze Schools</span>
            </a>
            <?php if ($signedIn === true): ?>
            <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse ">
                <button type="button" class="flex text-sm bg-neutral-primary rounded-full md:me-0 focus:ring-4 focus:ring-neutral-tertiary cursor-pointer" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                    <span class="sr-only">Open user menu</span>
                    <img class="w-8 h-8 rounded-full" src="data:image/jpeg;base64,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" alt="user photo">
                </button>
                <!-- Dropdown menu -->
                <div class="z-50 hidden bg-gray-400 text-black shadow border-gray rounded rounded-base shadow-lg w-44" id="user-dropdown">
                    <div class="px-4 py-3 text-sm border-b border-default">
                        <span class="block text-heading font-medium">Jane Doe</span>
                        <span class="block text-body truncate">janedoe@mazeschool.com</span>
                    </div>
                    <ul class="p-2 text-sm text-body font-medium" aria-labelledby="user-menu-button">
                        <li>
                            <a href="#" class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded">Profile</a>
                        </li>
                        <li>
                            <a href="#" class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded">My schools</a>
                        </li>
                        <li>
                            <a href="#" class="inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded">Log out</a>
                        </li>
                    </ul>
                </div>
                <button data-collapse-toggle="navbar-user" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-body rounded-base md:hidden hover:bg-neutral-secondary-soft hover:text-heading focus:outline-none focus:ring-2 focus:ring-neutral-tertiary" aria-controls="navbar-user" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h14" />
                    </svg>
                </button>
            </div> 
             
            <?php endif; ?>
            <?php if ($signedIn === false): ?>
            <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse ">
                <button onclick="window.location.href='./register.php'" class="bg-[#2111ff] px-[20px] py-[5px] rounded-md cursor-pointer font-medium text-heading hover:text-fg-brand">Register</button>
            </div>
            <?php endif; ?>
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-user">
                <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-default rounded-base bg-neutral-secondary-soft md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-neutral-primary">
                    <li>
                        <a href="./index.php" class="block py-2 px-3 bg-brand rounded md:bg-transparent md:text-fg-brand md:p-0" aria-current="page">Home</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-3 text-heading rounded hover:bg-neutral-tertiary md:hover:bg-transparent md:border-0 md:hover:text-fg-brand md:p-0 md:dark:hover:bg-transparent">Applications</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-3 text-heading rounded hover:bg-neutral-tertiary md:hover:bg-transparent md:border-0 md:hover:text-fg-brand md:p-0 md:dark:hover:bg-transparent">News</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-3 text-heading rounded hover:bg-neutral-tertiary md:hover:bg-transparent md:border-0 md:hover:text-fg-brand md:p-0 md:dark:hover:bg-transparent">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>