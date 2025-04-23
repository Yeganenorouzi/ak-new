<!DOCTYPE html>
<html lang="en" dir="rtl">

<!-- Mirrored from minia.cfarhad.ir/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 02 Oct 2024 16:01:11 GMT -->

<head>
  <meta charset="utf-8" />
  <title>داشبورد</title>
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta
    content="Tailwind Admin & Dashboard Template"
    name="description" />
  <meta content="" name="Themesbrand" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />

  <!-- App favicon -->
  <link rel="shortcut icon" href="<?php echo URLROOT . "/assets/images/favicon.ico" ?>" />

  <!-- alertifyjs Css -->
  <!-- <link href="assets/libs/alertifyjs/build/css/alertify.min.css" rel="stylesheet" type="text/css" /> -->

  <!-- alertifyjs default themes  Css -->
  <!-- <link href="assets/libs/alertifyjs/build/css/themes/default.min.css" rel="stylesheet" type="text/css" /> -->

  <!-- persian data css -->
  <link rel="stylesheet" href="<?php echo URLROOT . "/node_modules/persian-datepicker/dist/css/persian-datepicker.min.css" ?>" />

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>




  <link href="<?php echo URLROOT . "/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" ?>" rel="stylesheet" type="text/css">

  <link rel="stylesheet" href="<?php echo URLROOT . "/assets/libs/swiper/swiper-bundle.min.css" ?>">

  <link rel="stylesheet" href="<?php echo URLROOT . "/assets/css/icons.css" ?>" />
  <link rel="stylesheet" href="<?php echo URLROOT . "/assets/css/tailwind.css" ?>" />

  <!-- jQuery -->
  <script src="<?php echo URLROOT . "/node_modules/jquery/dist/jquery.js" ?>"></script>

  <script src="path/to/jquery.min.js"></script>
  <script src="path/to/persian-date.min.js"></script>
  <script src="path/to/persian-datepicker.min.js"></script>

</head>

<body data-mode="light" data-sidebar-size="lg">


  <!-- leftbar-tab-menu -->
  <nav class="border-b border-slate-100 dark:bg-zinc-800 print:hidden flex items-center fixed top-0 right-0 left-0 bg-white z-10 dark:border-zinc-700">

    <div class="flex items-center justify-between w-full">
      <div class="topbar-brand flex items-center">
        <div class="navbar-brand flex items-center justify-between shrink px-5 h-[70px] border-r bg-slate-50 border-r-gray-50 dark:border-zinc-700 dark:bg-zinc-800">
          <a href="#" class="flex items-center font-bold text-lg  dark:text-white">
            <img src="assets/images/logo-sm.svg" alt="" class="ltr:mr-2 rtl:ml-2 inline-block mt-1 h-6" />
            <span class="hidden xl:block align-middle">AK WARRANTY</span>
          </a>
        </div>
        <button type="button" class="text-gray-600 dark:text-white h-[70px] ltr:-ml-10 ltr:mr-6 rtl:-mr-10 rtl:ml-10 vertical-menu-btn" id="vertical-menu-btn">
          <i class="fa fa-fw fa-bars"></i>
        </button>

      </div>
      <div class="flex items-center">
        <div>
          <div class="dropdown relative sm:hidden block">
            <button type="button" class="text-xl px-4 h-[70px] text-gray-600 dark:text-gray-100 dropdown-toggle" data-dropdown-toggle="navNotifications">
              <i data-feather="search" class="h-5 w-5"></i>
            </button>

            <div class="dropdown-menu absolute px-4 -left-14 top-0 mx-4 w-72 z-50 hidden list-none border border-gray-50 rounded bg-white shadow dark:bg-zinc-800 dark:border-zinc-600 dark:text-gray-300" id="navNotifications">
              <form class="py-3 dropdown-item" aria-labelledby="navNotifications">
                <div class="form-group m-0">
                  <div class="flex w-full">
                    <input type="text" class="border-gray-100 dark:border-zinc-600 dark:text-zinc-100 w-fit" placeholder="جستجو ..." aria-label="Search Result">
                    <button class="btn btn-primary border-l-0 rounded-l-none rtl:rounded-r-none rtl:rounded-l bg-violet-500 border-transparent text-white" type="submit"><i class="mdi mdi-magnify"></i></button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

        <!--  Darkmode -->
        <div>
          <button type="button" class="light-dark-mode text-xl px-4 h-[70px] text-gray-600 dark:text-gray-100 hidden sm:block ">
            <i data-feather="moon" class="h-5 w-5 block dark:hidden"></i>
            <i data-feather="sun" class="h-5 w-5 hidden dark:block"></i>
        </div>

        <div>
          <div class="dropdown relative text-gray-600 hidden sm:block">
            <button type="button" class="btn border-0 h-[70px] text-xl px-4 dropdown-toggle dark:text-gray-100" data-bs-toggle="dropdown" id="dropdownMenuButton1">
              <i data-feather="grid" class="h-5 w-5"></i>
            </button>
            <div class="dropdown-menu absolute left-0 z-50 hidden w-72 list-none border border-gray-50 rounded bg-white shadow dark:bg-zinc-800 dark:border-zinc-600 dark:text-gray-300" aria-labelledby="dropdownMenuButton1">
              <div class="p-2">
                <div class="grid grid-cols-3">
                  <a class="dropdown-item hover:bg-gray-50/50 py-4 text-center dark:hover:bg-zinc-700/50 dark:hover:text-gray-50" href="https://www.google.com/" target="_blank">
                    <img src="<?php echo URLROOT . "/assets/images/brands/google.png" ?>" class="mb-2 mx-auto h-6" alt="Google">
                    <span>گوگل</span>
                  </a>
                  <a class="dropdown-item hover:bg-gray-50/50 py-4 text-center dark:hover:bg-zinc-700/50 dark:hover:text-gray-50" href="https://hamta.ntsw.ir/Account/Login?ReturnUrl=%2F" target="_blank">
                    <img src="<?php echo URLROOT . "/assets/images/brands/bitbucket.png" ?>" class="mb-2 mx-auto h-6" alt="Hamta">
                    <span>همتا</span>
                  </a>
                  <a class="dropdown-item hover:bg-gray-50/50 py-4 text-center dark:hover:bg-zinc-700/50 dark:hover:text-gray-50" href="https://www.gsmarena.com/" target="_blank">

                    <img src="<?php echo URLROOT . "/assets/images/brands/dribbble.png" ?>" class="mb-2 mx-auto h-6" alt="GsmArena">
                    <span>Gsm Arena</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>




        <div>
          <div class="dropdown relative ltr:mr-4 rtl:ml-4">
            <button type="button" class="flex items-center px-4 py-5 border-x border-gray-50 bg-gray-50/30 dropdown-toggle dark:bg-zinc-700 dark:border-zinc-600 dark:text-gray-100" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
              <img class="h-8 w-8 rounded-full ltr:xl:mr-2 rtl:xl:ml-2" src="<?php echo URLROOT . "/assets/images/users/38.jpg" ?>" alt="Header Avatar">
              <span class="fw-medium hidden xl:block"><?php echo $_SESSION['name']; ?></span>
              <i class="mdi mdi-chevron-down align-bottom hidden xl:block"></i>
            </button>
            <div class="dropdown-menu absolute top-0 ltr:-left-3 rtl:left-0 z-50 hidden w-40 list-none rounded bg-white shadow dark:bg-zinc-800" id="profile/log">
              <div class="border border-gray-50 dark:border-zinc-600" aria-labelledby="navNotifications">
                <div class="dropdown-item dark:text-gray-100">
                  <a class="px-3 py-2 hover:bg-gray-50/50 block dark:hover:bg-zinc-700/50" href="<?php echo URLROOT . "/users/profile" ?>">
                    <i class="mdi mdi-face-man text-16 align-middle mr-1"></i> پروفایل
                  </a>
                </div>
                <!-- <div class="dropdown-item dark:text-gray-100">
                  <a class="px-3 py-2 hover:bg-gray-50/50 block dark:hover:bg-zinc-700/50" href="lock-screen.html">
                    <i class="mdi mdi-lock text-16 align-middle mr-1"></i> قفل صفحه
                  </a>
                </div> -->
                <hr class="border-gray-50 dark:border-gray-700">
                <div class="dropdown-item dark:text-gray-100">
                  <a class="p-3 hover:bg-gray-50/50 block dark:hover:bg-zinc-700/50" href="<?php echo URLROOT . "/auth/logout" ?>">
                    <i class="mdi mdi-logout text-16 align-middle mr-1"></i> خروج
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </nav>

  <?php
  // Check user role and include appropriate sidebar
  if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) {
    // Admin sidebar
    require_once(APPROOT . "/views/public/sidebar.php");
  } else {
    // Agent sidebar
    require_once(APPROOT . "/views/public/sidebarAgent.php");
  }
  ?>