<?php
require_once "../core/Init.php";
include '../functions/Sanitize.php';
spl_autoload_register(fn ($class) => require_once '../classes/' . $class . '.php');
$user = new User();
$user->route('Subscriber', '../index');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Coffee Code | Admin </title>
  <link rel="icon" type="image/x-icon" href="img/favicon.ico">

  <!-- Tiny MCE -->
  <script src="https://cdn.tiny.cloud/1/hsxii5x54ovgvmkj3ydni2lq4hb8huatigr1ae8itv8hma50/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

  <!-- Animate.css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

  <!-- Datatables -->
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />

  <link href="css/styles.css" rel="stylesheet" />
  <link href="css/main.css" rel="stylesheet" />

  <link rel="stylesheet" href="css/toastr.css">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>

  <!-- Tiny MCE -->
  <script src="https://cdn.tiny.cloud/1/g635d5m61bd8t5je2s5uybo3qkcrxeynq8ptwocauwgvvedz/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>




  <style>
    body {
      overflow: hidden;

    }

    body::-webkit-scrollbar-thumb {
      border: 5px solid transparent;
      border-radius: 100px;
      background-color: #8070d4;
      background-clip: content-box;
    }

    .button-comment:hover {
      background: #bf2130 !important;
    }

    .button-category:hover {
      background: #1b7a31 !important;
    }

    .button-user:hover {
      background: #ebb000 !important;
    }

    #logout .text-gray-300 {
      color: rgb(209 213 219);
    }

    #logout .text-white:hover {
      color: rgb(255 255 255);
    }

    #logout .bg-gray-700:hover {
      background-color: rgb(55 65 81);
    }

    #btn {
      text-decoration: none;
    }

    #btn:hover {
      background-color: rgb(55 65 81);
      color: white;
    }

    #btn-reset {
      all: unset !important;
      color: rgb(0, 0, 238) !important;
      text-decoration: underline !important;
      cursor: pointer !important;
    }

    #btn-reset:hover {
      color: rgb(85, 26, 139) !important;
    }

    .rounded-md {
      border-radius: 0.375rem;
    }

    .block {
      display: block;
    }

    .py-2 {
      padding-top: 0.5rem !important;
      padding-bottom: 0.5rem !important;
    }

    .px-3 {
      padding-right: 1rem !important;
      padding-left: 1rem !important;
    }

    .text-gray-300 {
      --tw-text-opacity: 1;
      color: rgb(209 213 219 / var(--tw-text-opacity));
    }

    .font-medium {
      font-weight: 500;
    }

    .text-base {
      font-size: 1rem;
      line-height: 1.5rem;
    }

    .border-md {
      border-radius: 0.375rem;
    }

    .current {

      background-color: rgb(17 24 39);
      color: white !important;

    }

    /* Preloader bar */


    #loading {
      position: fixed;
      width: 100%;
      height: 100vh;
      background: #fff url('./img/loader.gif') no-repeat center center;
      z-index: 9999;

    }

    /* Fixed Modal */

    .modal-backdrop {
      display: none;
    }

    .modal {
      background-color: rgba(10, 10, 10, .45);
    }
  </style>
</head>

<body class="sb-nav-fixed" onload="myLoader()">
  <div id="loading" class="animate__animated animate__fadeOut animate__delay-2s"></div>


  <nav id="sidenav" class=" sb-topnav navbar navbar-expand navbar-dark" style="background: #1f2937; height: 64px;">

    <!-- Navbar Brand-->
    <button class="btn btn-link btn-sm order-lg-0 ms-3 me-2 me-lg-2" id="sidebarToggle" href="#!">
      <i class="fas fa-bars"></i>
    </button>

    <a class="navbar-brand ps-3 " style="background: #1f2937;" href="index">
      <span style="font-weight: normal;"> ☕</span>
      <span style="font-weight: bold;"><span style="color: #d0b49f">Coffee</span>Code</span>
    </a>

    <div class="d-flex justify-content-between mx-3 w-100">
      <a id="btn" class="text-gray-300 hover:bg-gray-700 ms-3 hover:text-white px-3 py-2 rounded-md text-base font-medium" href="../index">
        <i class="fas fa-home me-1"></i> Home
      </a>
      <a id="btn" class="text-gray-300 hover:bg-gray-700 ms-3 hover:text-white px-3 py-2 rounded-md text-base font-medium" href="../logout">
        <i class="fas fa-power-off me-1"></i>
        Logout
      </a>
    </div>
    <!-- Sidebar Toggle-->

  </nav>

  <div id="layoutSidenav">
    <div id="layoutSidenav_nav">
      <nav id="sidenav1" class="sb-sidenav accordion sb-sidenav-dark" style="background: #1f2937;" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
          <div class="nav px-2">
            <div class="mt-5 mb-4 text-center"> Hello, <?= $user->data()->user_firstname ?>!</div>
            <a id="btn" class="home nav-link mt-3 py-2 rounded-md text-base font-medium" href="index">
              <div class="sb-nav-link-icon">
                <i class="fas fa-tachometer-alt"></i>
              </div>
              Dashboard
            </a>

            <a id="btn" class="nav-link mt-3 text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-base font-medium collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts1" aria-expanded="false" aria-controls="collapseLayouts">
              <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
              Users
              <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>

            <div class="collapse" id="collapseLayouts1" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
              <nav class="sb-sidenav-menu-nested nav">
                <a id="btn" class="nav-link mt-3 text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-base font-medium" href="users"><i class="fas fa-address-book me-1" style="color: rgba(255, 255, 255, 0.25)"></i> View List User</a>
                <a id="btn" class="nav-link mt-3 text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-base font-medium" href="author"><i class="fas fa-user-clock me-1" style="color: rgba(255, 255, 255, 0.25)"></i> Pending Request </a>
              </nav>
            </div>

            <a id="btn" class="nav-link mt-3 text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-base font-medium collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
              <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
              Posts
              <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
              <nav class="sb-sidenav-menu-nested nav">
                <a id="btn" class="nav-link mt-3 text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-base font-medium" href="viewpost"><i class="fas fa-eye me-1" style="color: rgba(255, 255, 255, 0.25)"></i> View Post</a>
                <a id="btn" class="nav-link mt-3 text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-base font-medium" href="createpost"><i class="fas fa-plus-square me-1" style="color: rgba(255, 255, 255, 0.25)"></i> Add Post</a>
              </nav>
            </div>

            <a id="btn" class=" nav-link mt-3 text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-base font-medium" href="categories">
              <div class="sb-nav-link-icon">
                <i class="fas fa-sitemap"></i>
              </div>
              Categories
            </a>

            <a id="btn" class="nav-link mt-3 text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-base font-medium" href="comments">
              <div class="sb-nav-link-icon">
                <i class="fas fa-comments"></i>
              </div>
              Comments
            </a>

            <a id="btn" class="nav-link mt-3 text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-base font-medium" href="profile">
              <div class="sb-nav-link-icon">
                <i class="fas fa-user-cog"></i>
              </div>
              Profile
            </a>

          </div>
        </div>
      </nav>
    </div>