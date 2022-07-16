<?php

require_once "./core/Init.php";
include './functions/Sanitize.php';

spl_autoload_register(fn ($class) => require_once './classes/' . $class . '.php');

$user = new User();
$notif = new Notification();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />


    <title>Coffee Code | Home Page</title>
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">

    <!-- Tiny MCE -->
    <script src="https://cdn.tiny.cloud/1/hsxii5x54ovgvmkj3ydni2lq4hb8huatigr1ae8itv8hma50/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- Tail Wind Css -->
    <script src="https://cdn.tailwindcss.com/"></script>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>


    <link rel="stylesheet" href="../css/bootstrap.css">

    <link rel="stylesheet" href="css/toastr.css">

    <link rel="stylesheet" href="css/shareBtn.css">

    <link rel="stylesheet" href="css/notification.css">




    <style>
        @import url("https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap");

        * {
            font-family: "Quicksand", system-ui, -apple-system, BlinkMacSystemFont,
                "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif,
                "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol",
                "Noto Color Emoji";

            box-sizing: border-box;
            scroll-behavior: smooth;
        }

        body {
            background: #d0b49f;
            overflow: hidden;

        }

        .min-height {
            min-height: calc(100vh - 255px) !important;
        }

        .rte-modern.rte-desktop.rte-toolbar-default {
            width: 100%;
            min-width: unset;
        }

        .container {
            background: white;
            border-radius: 20px !important;
        }

        .scrollToTop {
            position: fixed;
            right: 40px;
            bottom: 40px;
            font-size: 18px;
            border-radius: 50%;
            background: #0D6EFD;
            cursor: pointer;
            visibility: hidden;
            opacity: 0;
            transition: 0.5s ease-in;
            z-index: 99;
        }

        .tox-statusbar__branding {
            display: none;
        }

        .scrollToTop:hover {
            background: #0966ed;
        }

        .active {
            visibility: visible;
            opacity: 1;
        }

        .editIconContainer #editIcon {
            transition: transform 1s;
        }

        .editIconContainer:hover #editIcon {
            transform: rotate(160deg);
        }

        /* Datatable */
        .dataTable-dropdown .dataTable-selector {
            border: 1px solid #ccc;
            flex-shrink: 70px;
            border-radius: 3px;
        }

        .dataTable-selector,
        .dataTable-input {
            border-radius: 3px;
        }

        .dataTable-selector {
            padding: 6px !important;
        }

        .dataTable-input {
            border: 1px solid #CCCCCC;
        }

        .dataTable-info,
        .dataTable-dropdown,
        th,
        td {
            font-size: 14px;
        }

        .dataTable-wrapper.no-footer .dataTable-container {
            border: 2px solid transparent !important;
        }


        .dataTable-dropdown label,
        .dataTable-bottom,
        th,
        td {
            font-weight: 700;
        }


        .btn {
            display: inline-block;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: center;
            text-decoration: none;
            vertical-align: middle;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
            background-color: transparent;
            border: 1px solid transparent;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            border-radius: 0.25rem;
            transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        .btn-sm {
            padding: .25rem .5rem !important;
            font-size: .875rem !important;
        }

        .btn-primary {
            color: #fff !important;
            background-color: #0d6efd !important;
            border-color: #0d6efd !important;
        }

        .btn-primary:hover {
            color: #fff;
            background-color: #0b5ed7 !important;
            border-color: #0a58ca !important;
        }

        .btn-check:focus+.btn-primary,
        .btn-primary:focus {
            color: #fff !important;
            background-color: #0b5ed7 !important;
            border-color: #0a58ca !important;
            box-shadow: 0 0 0 .25rem rgba(49, 132, 253, .5) !important;
        }

        .btn-check:active+.btn-primary,
        .btn-check:checked+.btn-primary,
        .btn-primary.active,
        .btn-primary:active,
        .show>.btn-primary.dropdown-toggle {
            color: #fff !important;
            background-color: #0a58ca !important;
            border-color: #0a53be !important;
        }

        .btn-check:active+.btn-primary:focus,
        .btn-check:checked+.btn-primary:focus,
        .btn-primary.active:focus,
        .btn-primary:active:focus,
        .show>.btn-primary.dropdown-toggle:focus {
            box-shadow: 0 0 0 .25rem rgba(49, 132, 253, .5) !important;
        }

        .btn-outline-primary {
            color: #0d6efd;
            border-color: #0d6efd;
        }

        .btn-outline-primary:hover {
            color: #fff;
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        .btn-check:focus+.btn-outline-primary,
        .btn-outline-primary:focus {
            box-shadow: 0 0 0 .25rem rgba(13, 110, 253, .5);
        }

        .btn-check:active+.btn-outline-primary,
        .btn-check:checked+.btn-outline-primary,
        .btn-outline-primary.active,
        .btn-outline-primary.dropdown-toggle.show,
        .btn-outline-primary:active {
            color: #fff;
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        .btn-check:active+.btn-outline-primary:focus,
        .btn-check:checked+.btn-outline-primary:focus,
        .btn-outline-primary.active:focus,
        .btn-outline-primary.dropdown-toggle.show:focus,
        .btn-outline-primary:active:focus {
            box-shadow: 0 0 0 .25rem rgba(13, 110, 253, .5);
        }

        .btn-outline-danger,
        .btn-outline-danger:focus {
            box-shadow: 0 0 0 .25rem rgba(220, 53, 69, .5) !important;
        }

        .btn-danger {
            color: #fff !important;
            background-color: #dc3545 !important;
            border-color: #dc3545 !important;
        }

        .btn-danger:hover {
            color: #fff !important;
            background-color: #bb2d3b !important;
            border-color: #b02a37 !important;
        }

        .btn-check:focus+.btn-danger,
        .btn-danger:focus {
            color: #fff !important;
            background-color: #bb2d3b !important;
            border-color: #b02a37 !important;
            box-shadow: 0 0 0 .25rem rgba(225, 83, 97, .5) !important;
        }

        .btn-check:active+.btn-danger,
        .btn-check:checked+.btn-danger,
        .btn-danger.active,
        .btn-danger:active,
        .show>.btn-danger.dropdown-toggle {
            color: #fff !important;
            background-color: #b02a37 !important;
            border-color: #a52834 !important;
        }

        .btn-check:active+.btn-danger:focus,
        .btn-check:checked+.btn-danger:focus,
        .btn-danger.active:focus,
        .btn-danger:active:focus,
        .show>.btn-danger.dropdown-toggle:focus {
            box-shadow: 0 0 0 .25rem rgba(225, 83, 97, .5) !important;
        }

        .btn-check:active+.btn-outline-danger,
        .btn-check:checked+.btn-outline-danger,
        .btn-outline-danger.active,
        .btn-outline-danger.dropdown-toggle.show,
        .btn-outline-danger:active {
            color: #fff !important;
            background-color: #dc3545 !important;
            border-color: #dc3545 !important;
        }

        .btn-check:active+.btn-outline-danger:focus,
        .btn-check:checked+.btn-outline-danger:focus,
        .btn-outline-danger.active:focus,
        .btn-outline-danger.dropdown-toggle.show:focus,
        .btn-outline-danger:active:focus {
            box-shadow: 0 0 0 .25rem rgba(220, 53, 69, .5) !important;
        }

        .btn-secondary {
            color: #fff;
            background-color: #6c757d;
            border-color: #6c757d
        }

        .btn-secondary:hover {
            color: #fff;
            background-color: #5c636a;
            border-color: #565e64
        }

        .btn-check:focus+.btn-secondary,
        .btn-secondary:focus {
            color: #fff;
            background-color: #5c636a;
            border-color: #565e64;
            box-shadow: 0 0 0 .25rem rgba(130, 138, 145, .5)
        }

        .btn-check:active+.btn-secondary,
        .btn-check:checked+.btn-secondary,
        .btn-secondary.active,
        .btn-secondary:active,
        .show>.btn-secondary.dropdown-toggle {
            color: #fff;
            background-color: #565e64;
            border-color: #51585e
        }

        .btn-check:active+.btn-secondary:focus,
        .btn-check:checked+.btn-secondary:focus,
        .btn-secondary.active:focus,
        .btn-secondary:active:focus,
        .show>.btn-secondary.dropdown-toggle:focus {
            box-shadow: 0 0 0 .25rem rgba(130, 138, 145, .5)
        }

        .btn-success {
            color: #fff !important;
            background-color: #198754 !important;
            border-color: #198754 !important;
        }

        .btn-success:hover {
            color: #fff !important;
            background-color: #157347 !important;
            border-color: #146c43 !important;
        }

        .btn-check:focus+.btn-success,
        .btn-success:focus {
            color: #fff !important;
            background-color: #157347 !important;
            border-color: #146c43 !important;
            box-shadow: 0 0 0 .25rem rgba(60, 153, 110, .5) !important;
        }

        .btn-check:active+.btn-success,
        .btn-check:checked+.btn-success,
        .btn-success.active,
        .btn-success:active,
        .show>.btn-success.dropdown-toggle {
            color: #fff !important;
            background-color: #146c43 !important;
            border-color: #13653f !important;
        }

        .btn-check:active+.btn-success:focus,
        .btn-check:checked+.btn-success:focus,
        .btn-success.active:focus,
        .btn-success:active:focus,
        .show>.btn-success.dropdown-toggle:focus {
            box-shadow: 0 0 0 .25rem rgba(60, 153, 110, .5) !important;
        }

        .btn-outline-success {
            color: #198754;
            border: 2px solid #198754
        }

        .btn-outline-success:hover {
            color: #fff;
            background-color: #198754;
            border-color: #198754
        }

        .btn-check:focus+.btn-outline-success,
        .btn-outline-success:focus {
            box-shadow: 0 0 0 .25rem rgba(25, 135, 84, .5)
        }

        .btn-check:active+.btn-outline-success,
        .btn-check:checked+.btn-outline-success,
        .btn-outline-success.active,
        .btn-outline-success.dropdown-toggle.show,
        .btn-outline-success:active {
            color: #fff;
            background-color: #198754;
            border-color: #198754
        }

        .btn-check:active+.btn-outline-success:focus,
        .btn-check:checked+.btn-outline-success:focus,
        .btn-outline-success.active:focus,
        .btn-outline-success.dropdown-toggle.show:focus,
        .btn-outline-success:active:focus {
            box-shadow: 0 0 0 .25rem rgba(25, 135, 84, .5)
        }

        .link-info {
            color: #0dcaf0
        }

        .link-info:focus,
        .link-info:hover {
            color: #3dd5f3
        }

        .current {
            background-color: rgb(17 24 39);
            color: white !important;
        }

        .drop-shadow {
            filter: drop-shadow(0 1px 2px rgb(0 0 0 / 0.1)) drop-shadow(0 1px 1px rgb(0 0 0 / 0.06));
        }

        /* Preloader bar */


        #loading {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background: #fff url('./img/loader.gif') no-repeat center center;
            z-index: 999999;

        }

        /* Fixed Modal */
        .modal-backdrop {
            display: none;
        }

        .modal {
            background-color: rgba(10, 10, 10, .45);
        }

        .btn-secondary {
            background-color: rgb(108, 117, 125) !important;

        }

        /* dropdowns */

        #menuNav:hover #menuNavItems,
        #menuNav1:hover #menuNavItems1,
        #menuNav2:hover #menuNavItems2 {
            display: block;
        }

        .dropshadow-sm {
            box-shadow: 0 .125rem .25rem rgba(black, .075);
        }

        hr {
            width: 100%;
        }
    </style>
</head>

<body id="body" onload="myLoader()">
    <?php
    $user->send_request_to_be_author(Input::get('author_permission'));
    ?>
    <div id="loading" class="animate__animated animate__fadeOut animate__delay-1s"></div>

    <div onclick="scrollToTop()" class="scrollToTop py-2 px-3 text-light"><i class="fas fa-arrow-up"></i></div>

    <!-- This example requires Tailwind CSS v2.0+ -->
    <nav class="bg-gray-800 mb-5 drop-shadow-md" style="position: fixed; top: 0; right: 0; left: 0;z-index: 99;">
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <div class="relative flex items-center justify-between h-16">
                <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                    <!-- Mobile menu button-->
                    <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false" id="user-menu-button">
                        <span class="sr-only">Open main menu</span>

                        <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>

                        <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                    <a href="index" class="flex-shrink-0 flex items-center" style="font-size: 20px;">

                        ☕

                        <h1 class="text-white px-3 py-2 rounded-md text-sm text-lg font-sans font-bold" style="font-size: 20px;">
                            <span style="color: #d0b49f">Coffee</span>Code
                        </h1>

                    </a>
                    <div id="sidenav1" class="hidden sm:block sm:ml-10 flex items-center">
                        <div class="flex items-center space-x-4 h-full">
                            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                            <a href="index" class="home text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium"> <i class="fas fa-home me-1"></i> Home</a>

                            <?php if ($user->isLoggedIn()) { ?>
                                <?php if ($user->data()->user_role == 'Admin') { ?>
                                    <a href="admin" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-base font-medium"> <i class="fas fa-user-cog me-1"></i> Admin </a>
                                <?php } elseif ($user->data()->user_role == 'Author') { ?>

                                    <!-- This example requires Tailwind CSS v2.0+ -->
                                    <div class="relative inline-block text-left">
                                        <div id="menuNav">
                                            <button type="button" class="currentBtn inline-flex justify-center items-center text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-base font-medium" aria-expanded="true" aria-haspopup="true">
                                                <i class="fas fa-columns me-2"></i> Post
                                                <!-- Heroicon name: solid/chevron-down -->
                                                <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </button>

                                            <div class="currentBtn origin-top-right absolute right-0 w-56 rounded-md shadow-lg bg-gray-800 ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" id="menuNavItems" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                                                <div class="py-1" role="none">
                                                    <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
                                                    <a href="mypost" class="text-gray-300 block px-4 py-2 text-sm hover:bg-gray-700 hover:text-white" role="menuitem" tabindex="-1" id="menu-item-0"> <i class="fas fa-eye me-2"></i> My Post </a>
                                                    <a href="createpost" class="text-gray-300 block px-4 py-2 text-sm hover:bg-gray-700 hover:text-white" role="menuitem" tabindex="-1" id="menu-item-1"> <i class="fas fa-plus-square me-2"></i> Create Post </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="relative inline-block text-left">
                                        <div id="menuNav1">
                                            <button type="button" class="inline-flex justify-center items-center text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-base font-medium" aria-expanded="true" aria-haspopup="true">
                                                <i class="fas fa-comment me-2"></i> Comments
                                                <!-- Heroicon name: solid/chevron-down -->
                                                <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </button>

                                            <div class="origin-top-right absolute right-0 w-56 rounded-md shadow-lg bg-gray-800 ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" id="menuNavItems1" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                                                <div class="py-1" role="none">
                                                    <a href="mycomments" class="text-gray-300 block px-4 py-2 text-sm hover:bg-gray-700 hover:text-white"><i class="fas fa-comment me-2"></i> My Comments </a>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                    

                                <?php } ?>
                                
                            <?php if($user->data()->user_role !== 'Admin'): ?>
                                <a href="favorites" class="home text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium"> <i class="fas fa-star me-1"></i> Favorites</a>
                            <?php endif; ?>


                            <?php } else { ?>
                                <div class="absolute right-0 d-flex align-content-center">
                                    <?php if (isset($_GET['post_id'])) { ?>
                                        <a href="login?post_id=<?= Input::get('post_id') ?>" class="btn btn-primary sign-in-bg mr-4 font-extrabold w-28" id="btn"> Log In</a>
                                    <?php } else { ?>
                                        <a href="login" class="btn btn-primary mr-4 w-28" id=""> Log In</a>
                                    <?php } ?>
                                    <a href="signup" class="btn btn-outline-success font-extrabold w-24"> Sign Up </a>
                                <?php } ?>
                                </div>
                        </div>
                    </div>

                    <?php if ($user->isLoggedIn()) : ?>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                            <div class="relative inline-block text-left">
                                <div class="navbar">
                                    <div class="notifications d-flex align-items-center">

                                        <?php if ($user->data()->user_role == 'Author') : ?>
                                            <div class="icon_wrap"><i class="fas fa-bell text-gray-300 text-lg me-3" style="position:relative; z-index:-1;"></i> <span class="circle" style="position: absolute;top: 8px;right: 169px;"></span></div>
                                            <div class="notification_dd">
                                                <ul class="notification_ul">

                                                </ul>
                                            </div>
                                        <?php elseif ($user->data()->user_role == 'Subscriber') : ?>
                                            <div class="icon_wrap"><i class="fas fa-bell text-gray-300 text-lg me-3" style="position:relative; z-index:-1;"></i> <span class="circle" style="position: absolute;top: 6px;right: 113px;"></span></div>
                                            <div class="notification_dd" style="right: 110px;">
                                                <ul class="notification_ul">

                                                </ul>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <?php if ($user->data()->user_role == 'Admin' || $user->data()->user_role == 'Subscriber') : ?>

                                        <a href="logout" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-base font-medium" id="menu-item-1"><i class="fas fa-power-off me-1"></i> Logout </a>

                                        <!-- Notification -->
                                    <?php else : ?>
                                        <!-- Notification -->

                                        <div id="menuNav2">
                                            <button type="button" class="currentBtn inline-flex justify-center items-center text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-base font-medium" aria-expanded="true" aria-haspopup="true">
                                                Hello, <?= $user->data()->user_firstname ?>!
                                                <!-- Heroicon name: solid/chevron-down -->
                                                <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </button>

                                            <div class="currentBtn origin-top-right absolute right-0 w-56 rounded-md shadow-lg bg-gray-800 ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" id="menuNavItems2" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                                                <div class="py-1" role="none">
                                                    <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
                                                    <a href="profile" class="text-gray-300 block px-4 py-2 text-sm hover:bg-gray-700 hover:text-white" role="menuitem" tabindex="-1" id="menu-item-0"> <i class="fas fa-user me-2"></i> Profile </a>
                                                    <a href="logout" class="text-gray-300 block px-4 py-2 text-sm hover:bg-gray-700 hover:text-white" role="menuitem" tabindex="-2" id="menu-item-1"><i class="fas fa-power-off me-1"></i> Logout </a>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                            </div>
                        </div>
                </div>

                <!-- Mobile menu, show/hide based on menu state. -->
                <div class="sm:hidden" id="menu">
                    <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 text-center">

                        <a href="index" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium" aria-current="page"> Home </a>

                        <?php if ($user->isLoggedIn()) : ?>
                            <?php if ($user->data()->user_role == 'Admin') : ?>
                                <a href="admin" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium" aria-current="page"> Admin </a>
                            <?php elseif ($user->data()->user_role == 'Author') : ?>
                                <a href="mypost" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium" aria-current="page"> My Post </a>
                                <a href="createpost" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium" aria-current="page"> Create Post </a>
                                <a href="mycomments" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium" aria-current="page"> My Comments </a>
                            <?php endif; ?>

                            <a href="logout" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium" aria-current="page"> Logout </a>

                        <?php else : ?>
                            <?php if (isset($_GET['post_id'])) { ?>
                                <a href="login?post_id=<?= Input::get('post_id') ?>" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium" aria-current="page"> Log In</a>
                            <?php } else { ?>
                                <a href="login" class="btn btn-primary block px-3 py-2 rounded-md text-base font-medium" aria-current="page"> Log In</a>
                            <?php } ?>
                            <a href="signup" class="btn btn-outline-success block px-3 py-2 rounded-md text-base font-medium" aria-current="page"> Sign Up </a>
                        <?php endif; ?>
                    </div>
    </nav>
    <div class="py-5"></div>

    <!-- <i class="fas fa-sync-alt"></i> -->