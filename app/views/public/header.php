<!DOCTYPE html>
<html lang="en" dir="rtl">

<!-- Mirrored from minia.cfarhad.ir/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 02 Oct 2024 16:01:11 GMT -->

<head>
  <meta charset="utf-8" />
  <title>داشبورد</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta content="Tailwind Admin & Dashboard Template" name="description" />
  <meta content="" name="Themesbrand" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />

  <!-- App favicon -->
  <link rel="shortcut icon" href="<?php echo URLROOT . "/assets/images/favicon.ico" ?>" />

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- jQuery Loader - This will ensure jQuery is loaded before any other scripts -->
  <script src="<?php echo URLROOT . "/assets/js/jquery-loader.js" ?>"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <link href="<?php echo URLROOT . "/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" ?>"
    rel="stylesheet" type="text/css">

  <link rel="stylesheet" href="<?php echo URLROOT . "/assets/libs/swiper/swiper-bundle.min.css" ?>">

  <link rel="stylesheet" href="<?php echo URLROOT . "/assets/css/icons.css" ?>" />
  <link rel="stylesheet" href="<?php echo URLROOT . "/assets/css/tailwind.css" ?>" />

  <!-- jQuery from CDN -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Jalali Date Picker -->
  <link rel="stylesheet" href="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>

<body data-mode="light" data-sidebar-size="lg">


  <!-- leftbar-tab-menu -->
  <nav
    class="border-b border-slate-100 dark:bg-zinc-800 print:hidden flex items-center fixed top-0 right-0 left-0 bg-white z-10 dark:border-zinc-700">

    <div class="flex items-center justify-between w-full">
      <div class="topbar-brand flex items-center">
        <div
          class="navbar-brand flex items-center justify-between shrink px-5 h-[70px] border-r bg-slate-50 border-r-gray-50 dark:border-zinc-700 dark:bg-zinc-800">
          <a href="#" class="flex items-center font-bold text-lg  dark:text-white">
            <img src="assets/images/logo-sm.svg" alt="" class="ltr:mr-2 rtl:ml-2 inline-block mt-1 h-6" />
            <span class="hidden xl:block align-middle">AK WARRANTY</span>
          </a>
        </div>
        <button type="button"
          class="text-gray-600 dark:text-white h-[70px] ltr:-ml-10 ltr:mr-6 rtl:-mr-10 rtl:ml-10 vertical-menu-btn"
          id="vertical-menu-btn">
          <i class="fa fa-fw fa-bars"></i>
        </button>

      </div>
      <div class="flex items-center">
        <div>
          <div class="dropdown relative sm:hidden block">
            <button type="button"
              class="text-xl px-4 h-[70px] text-gray-600 dark:text-gray-100 flex items-center justify-center"
              data-dropdown-toggle="navNotifications">
              <i data-feather="search" class="h-5 w-5"></i>
            </button>

            <div
              class="dropdown-menu absolute px-4 -left-14 top-0 mx-4 w-72 z-50 hidden list-none border border-gray-50 rounded bg-white shadow dark:bg-zinc-800 dark:border-zinc-600 dark:text-gray-300"
              id="navNotifications">
              <form class="py-3 dropdown-item" aria-labelledby="navNotifications">
                <div class="form-group m-0">
                  <div class="flex w-full">
                    <input type="text" class="border-gray-100 dark:border-zinc-600 dark:text-zinc-100 w-fit"
                      placeholder="جستجو ..." aria-label="Search Result">
                    <button
                      class="btn btn-primary border-l-0 rounded-l-none rtl:rounded-r-none rtl:rounded-l bg-violet-500 border-transparent text-white"
                      type="submit"><i class="mdi mdi-magnify"></i></button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

        <!-- Quick Links -->
        <div class="flex items-center">
          <a href="https://www.google.com/" target="_blank"
            class="text-xl px-3 h-[70px] flex items-center justify-center hover:bg-gray-50 dark:hover:bg-zinc-700"
            title="گوگل">
            <i class="fab fa-google" style="color: #4285F4;"></i>
          </a>
          <a href="https://hamta.ntsw.ir/Account/Login?ReturnUrl=%2F" target="_blank"
            class="text-xl px-3 h-[70px] flex items-center justify-center hover:bg-gray-50 dark:hover:bg-zinc-700"
            title="همتا">
            <i class="fas fa-mobile-alt" style="color: #1abc9c;"></i>
          </a>
          <a href="https://www.gsmarena.com/" target="_blank"
            class="text-xl px-3 h-[70px] flex items-center justify-center hover:bg-gray-50 dark:hover:bg-zinc-700"
            title="Gsm Arena">
            <i class="fas fa-mobile-screen" style="color: #e74c3c;"></i>
          </a>
        </div>



        <div>
          <div class="dropdown relative ltr:mr-4 rtl:ml-4">
            <button type="button"
              class="flex items-center gap-2 px-4 py-3 border-x border-gray-50 bg-gray-50/30 dark:bg-zinc-700 dark:border-zinc-600 dark:text-gray-100 dropdown-toggle hover:bg-gray-100 dark:hover:bg-zinc-600 transition-colors duration-200"
              id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
              <div class="relative">
                <?php if (!empty($_SESSION['avatar'])): ?>
                  <img class="h-9 w-9 rounded-full ring-2 ring-violet-500/20 dark:ring-violet-400/20 object-cover"
                    src="<?php echo URLROOT . "/uploads/users/" . $_SESSION['avatar']; ?>" alt="Header Avatar">
                <?php else: ?>
                  <div
                    class="h-9 w-9 rounded-full bg-violet-500 flex items-center justify-center ring-2 ring-violet-500/20">
                    <i class="fas fa-user text-white text-lg"></i>
                  </div>
                <?php endif; ?>
                <span
                  class="absolute bottom-0 right-0 h-3 w-3 bg-green-500 border-2 border-white dark:border-zinc-800 rounded-full"></span>
              </div>
              <div class="flex flex-col items-start">
                <span class="fw-medium text-sm"><?php echo $_SESSION['name']; ?></span>
                <span
                  class="text-xs text-gray-500 dark:text-gray-400"><?php echo (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) ? 'ادمین' : 'نماینده'; ?></span>
              </div>
            </button>
            <div
              class="dropdown-menu absolute top-full mt-2 ltr:-left-3 rtl:left-0 z-50 hidden w-56 list-none rounded-lg bg-white shadow-lg dark:bg-zinc-800 border border-gray-100 dark:border-zinc-700"
              id="profile/log">
              <div class="p-2" aria-labelledby="navNotifications">
                <div class="dropdown-item dark:text-gray-100">
                  <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-gray-50 dark:hover:bg-zinc-700/50 transition-colors duration-200"
                    href="<?php echo URLROOT . "/users/profile" ?>">
                    <i class="fas fa-user text-violet-500"></i>
                    <span>پروفایل</span>
                  </a>
                </div>



                <hr class="my-2 border-gray-100 dark:border-zinc-700">

                <div class="dropdown-item dark:text-gray-100">
                  <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-red-50 dark:hover:bg-red-500/10 text-red-500 transition-colors duration-200"
                    href="<?php echo URLROOT . "/auth/logout" ?>">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>خروج</span>
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

</body>

<!-- Mirrored from minia.cfarhad.ir/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 02 Oct 2024 16:01:11 GMT -->

</html>