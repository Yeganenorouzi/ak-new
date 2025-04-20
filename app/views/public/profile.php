<!DOCTYPE html>
<html lang="en" dir="rtl">


<head>
    <meta charset="utf-8" />
    <title>پروفایل - قالب مدیریت و داشبورد مدیریت</title>
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta
      content="Tailwind Admin & Dashboard Template"
      name="description"
    />
    <meta content="" name="Themesbrand" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo URLROOT . "/assets/images/favicon.ico" ?>" />


     <link href="<?php echo URLROOT . "/assets/libs/flatpickr/flatpickr.min.css" ?>" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="<?php echo URLROOT . "/assets/css/icons.css" ?>" />
    <link rel="stylesheet" href="<?php echo URLROOT . "/assets/css/tailwind.css" ?>" />




</head>
    <body data-mode="light" data-sidebar-size="lg">

    <!-- leftbar-tab-menu -->
    <nav class="border-b border-slate-100 dark:bg-zinc-800 print:hidden flex items-center fixed top-0 right-0 left-0 bg-white z-10 dark:border-zinc-700">

        <div class="flex items-center justify-between w-full">
            <div class="topbar-brand flex items-center">
                <div class="navbar-brand flex items-center justify-between shrink px-5 h-[70px] border-r bg-slate-50 border-r-gray-50 dark:border-zinc-700 dark:bg-zinc-800">
                    <a href="#" class="flex items-center font-bold text-lg  dark:text-white">
                        <img src="assets/images/logo-sm.svg" alt="" class="ltr:mr-2 rtl:ml-2 inline-block mt-1 h-6" />
                        <span class="hidden xl:block align-middle">مینیا</span>
                    </a>
                </div>
                <button type="button" class="text-gray-600 dark:text-white h-[70px] ltr:-ml-10 ltr:mr-6 rtl:-mr-10 rtl:ml-10 vertical-menu-btn" id="vertical-menu-btn">
                    <i class="fa fa-fw fa-bars"></i>
                </button>
                <form class="app-search hidden xl:block px-5">
                    <div class="relative inline-block">
                        <input type="text" class="bg-gray-50/30 dark:bg-zinc-700/50 border-0 rounded focus:ring-0 placeholder:text-sm px-4 dark:placeholder:text-gray-200 dark:text-gray-100 dark:border-zinc-700 " placeholder="جستجو...">
                        <button class="py-1.5 px-2.5 text-white bg-violet-500 inline-block absolute ltr:right-1 top-1 rounded shadow shadow-violet-100 dark:shadow-gray-900 rtl:left-1 rtl:right-auto" type="button"><i class="bx bx-search-alt align-middle"></i></button>
                    </div>
                </form>
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
        
                <div class="dropdown relative language hidden sm:block">
                    <button class="btn border-0 py-0 dropdown-toggle px-4 h-[70px]" type="button" aria-expanded="false" data-dropdown-toggle="navNotifications">
                        <img src="assets/images/flags/us.jpg" alt="" class="h-4" id="header-lang-img">
                    </button>
                    <div class="dropdown-menu absolute left-0 z-50 hidden w-40 list-none rounded bg-white shadow dark:bg-zinc-800" id="navNotifications">
                        <ul class="border border-gray-50 dark:border-gray-700" aria-labelledby="navNotifications">
                            <li>
                                <a href="#" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-50/50 dark:text-gray-200 dark:hover:bg-zinc-600/50 dark:hover:text-white"><img src="assets/images/flags/us.jpg" alt="user-image" class="mr-1 inline-block h-3"> <span class="align-middle">انگلیسی</span></a>
                            </li>
                            <li>
                                <a href="#" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-50/50 dark:text-gray-200 dark:hover:bg-zinc-600/50 dark:hover:text-white"><img src="assets/images/flags/spain.jpg" alt="user-image" class="mr-1 inline-block h-3"> <span class="align-middle">اسپانیایی</span></a>
                            </li>
                            <li>
                                <a href="#" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-50/50 dark:text-gray-200 dark:hover:bg-zinc-600/50 dark:hover:text-white"><img src="assets/images/flags/germany.jpg" alt="user-image" class="mr-1 inline-block h-3"> <span class="align-middle">آلمانی</span></a>
                            </li>
                            <li>
                                <a href="#" class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-50/50 dark:text-gray-200 dark:hover:bg-zinc-600/50 dark:hover:text-white"><img src="assets/images/flags/italy.jpg" alt="user-image" class="mr-1 inline-block h-3"> <span class="align-middle">ایتالیایی</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
        
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
                                    <a class="dropdown-item hover:bg-gray-50/50 py-4 text-center dark:hover:bg-zinc-700/50 dark:hover:text-gray-50" href="#">
                                        <img src="assets/images/brands/github.png" class="mb-2 mx-auto h-6" alt="Github">
                                        <span>گیت‌هاب</span>
                                    </a>
                                        <a class="dropdown-item hover:bg-gray-50/50 py-4 text-center dark:hover:bg-zinc-700/50 dark:hover:text-gray-50" href="#">
                                        <img src="assets/images/brands/bitbucket.png" class="mb-2 mx-auto h-6" alt="Github">
                                        <span>بیت‌باکت</span>
                                    </a>
                                        <a class="dropdown-item hover:bg-gray-50/50 py-4 text-center dark:hover:bg-zinc-700/50 dark:hover:text-gray-50" href="#">
                                        <img src="assets/images/brands/dribbble.png" class="mb-2 mx-auto h-6" alt="Github">
                                        <span>دریببل</span>
                                    </a>
                                </div>
                                    <div class="grid grid-cols-3">
                                    <a class="dropdown-item hover:bg-gray-50/50 py-4 text-center dark:hover:bg-zinc-700/50 dark:hover:text-gray-50" href="#">
                                        <img src="assets/images/brands/dropbox.png" class="mb-2 mx-auto h-6" alt="Github">
                                        <span>دراپ‌باکس</span>
                                    </a>
                                        <a class="dropdown-item hover:bg-gray-50/50 py-4 text-center dark:hover:bg-zinc-700/50 dark:hover:text-gray-50" href="#">
                                        <img src="assets/images/brands/mail_chimp.png" class="mb-2 mx-auto h-6" alt="Github">
                                        <span>میل‌چیمپ</span>
                                    </a>
                                        <a class="dropdown-item hover:bg-gray-50/50 py-4 text-center dark:hover:bg-zinc-700/50 dark:hover:text-gray-50" href="#">
                                        <img src="assets/images/brands/slack.png" class="mb-2 mx-auto h-6" alt="Github">
                                        <span>اسلک</span>
                                    </a>
                                </div>
        
                            </div>
                        </div>
                    </div>
                </div>
        
                <div>
                    <div class="dropdown relative ">
                        <div class="relative">
                            <button type="button" class="btn border-0 h-[70px] dropdown-toggle px-4 text-gray-500 dark:text-gray-100" aria-expanded="false" data-dropdown-toggle="notification">
                                <i data-feather="bell" class="h-5 w-5"></i>
                            </button>
                                <span class="absolute text-xs px-1.5 bg-red-500 text-white font-medium rounded-full left-6 top-2.5">5</span>
                        </div>
                        <div class="dropdown-menu absolute z-50 hidden w-80 list-none rounded bg-white shadow dark:bg-zinc-800 " id="notification">
                            <div class="border border-gray-50 dark:border-gray-700 rounded" aria-labelledby="notification">
                                <div class="grid grid-cols-12 p-4">
                                    <div class="col-span-6">
                                        <h6 class="m-0 text-gray-700 dark:text-gray-100"> اطلاعیه‌ها </h6>
                                    </div>
                                    <div class="col-span-6 justify-self-end">
                                        <a href="#!" class="text-xs underline dark:text-gray-400"> خوانده نشده (3)</a>
                                    </div>
                                </div>
                                <div class="max-h-56" data-simplebar>
                                    <div>
                                        <a href="#!" class="text-reset notification-item">
                                            <div class="flex px-4 py-2 hover:bg-gray-50/50 dark:hover:bg-zinc-700/50">
                                                <div class="flex-shrink-0 ltr:mr-3 rtl:ml-3">
                                                    <img src="assets/images/users/avatar-3.jpg" class="rounded-full h-8 w-8" alt="user-pic">
                                                </div>
                                                <div class="flex-grow">
                                                    <h6 class="mb-1 text-gray-700 dark:text-gray-100">جیمز لمایر</h6>
                                                    <div class="text-13 text-gray-600">
                                                        <p class="mb-1 dark:text-gray-400"> به نظر می‌رسد زبان ساده شده انگلیسی باشد.</p>
                                                        <p class="mb-0"><i class="mdi mdi-clock-outline dark:text-gray-400"></i> <span>1 ساعت پیش</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#!" class="text-reset notification-item">
                                            <div class="flex px-4 py-2 hover:bg-gray-50/50 dark:hover:bg-zinc-700/50">
                                                <div class="flex-shrink-0 ltr:mr-3 rtl:ml-3">
                                                    <div class="h-8 w-8 bg-violet-500 rounded-full text-center">
                                                        <i class="bx bx-cart text-xl leading-relaxed text-white"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow">
                                                    <h6 class="mb-1 text-gray-700 dark:text-gray-100">سفارش شما ثبت شده است</h6>
                                                    <div class="text-13 text-gray-600">
                                                        <p class="mb-1 dark:text-gray-400"> اگر چندین زبان با هم آمیخته شوند، دستور زبان را کاهش می‌دهند</p>
                                                        <p class="mb-0"><i class="mdi mdi-clock-outline dark:text-gray-400"></i> <span>3 دقیقه پیش</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#!" class="text-reset notification-item">
                                            <div class="flex px-4 py-2 hover:bg-gray-50/50 dark:hover:bg-zinc-700/50">
                                                <div class="flex-shrink-0 ltr:mr-3 rtl:ml-3">
                                                    <div class="h-8 w-8 bg-green-500 rounded-full text-center">
                                                        <i class="bx bx-badge-check text-xl leading-relaxed text-white"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow">
                                                    <h6 class="mb-1 text-gray-700 dark:text-gray-100">محصول شما ارسال شده است</h6>
                                                    <div class="text-13 text-gray-600">
                                                        <p class="mb-1 dark:text-gray-400"> اگر چندین زبان با هم آمیخته شوند، دستور زبان را کاهش می‌دهند</p>
                                                        <p class="mb-0"><i class="mdi mdi-clock-outline dark:text-gray-400"></i> <span>3 دقیقه پیش</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#!" class="text-reset notification-item">
                                            <div class="flex px-4 py-2 hover:bg-gray-50/50 dark:hover:bg-zinc-700/50">
                                                <div class="flex-shrink-0 ltr:mr-3 rtl:ml-3">
                                                    <img src="assets/images/users/avatar-6.jpg" class="rounded-full h-8 w-8" alt="user-pic">
                                                </div>
                                                <div class="flex-grow">
                                                    <h6 class="mb-1 text-gray-700 dark:text-gray-100">سالنا لیفیلد</h6>
                                                    <div class="text-13 text-gray-600">
                                                        <p class="mb-1 dark:text-gray-400"> به عنوان یک دوست متشکک کمبریجی از غربی</p>
                                                        <p class="mb-0"><i class="mdi mdi-clock-outline dark:text-gray-400"></i> <span>1 ساعت پیش</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="p-1 border-t grid border-gray-50 dark:border-zinc-600 justify-items-center">
                                    <a class="btn border-0 text-violet-500" href="javascript:void(0)">
                                        <i class="mdi mdi-arrow-left-circle mr-1"></i> <span>مشاهده بیشتر..</span> 
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        
        
                <div>
                    <div class="dropdown relative ltr:mr-4 rtl:ml-4">
                        <button type="button" class="flex items-center px-4 py-5 border-x border-gray-50 bg-gray-50/30 dropdown-toggle dark:bg-zinc-700 dark:border-zinc-600 dark:text-gray-100" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <img class="h-8 w-8 rounded-full ltr:xl:mr-2 rtl:xl:ml-2" src="assets/images/users/avatar-1.jpg" alt="Header Avatar">
                            <span class="fw-medium hidden xl:block">فرهاد باقری</span>
                            <i class="mdi mdi-chevron-down align-bottom hidden xl:block"></i>
                        </button>
                        <div class="dropdown-menu absolute top-0 ltr:-left-3 rtl:left-0 z-50 hidden w-40 list-none rounded bg-white shadow dark:bg-zinc-800" id="profile/log">
                            <div class="border border-gray-50 dark:border-zinc-600" aria-labelledby="navNotifications">
                                <div class="dropdown-item dark:text-gray-100">
                                    <a class="px-3 py-2 hover:bg-gray-50/50 block dark:hover:bg-zinc-700/50" href="<?php echo URLROOT; ?>/users/profile">
                                        <i class="mdi mdi-face-man text-16 align-middle mr-1"></i> پروفایل
                                    </a>
                                </div>
                                <div class="dropdown-item dark:text-gray-100">
                                    <a class="px-3 py-2 hover:bg-gray-50/50 block dark:hover:bg-zinc-700/50" href="lock-screen.html">
                                        <i class="mdi mdi-lock text-16 align-middle mr-1"></i> قفل صفحه
                                    </a>
                                </div>
                                <hr class="border-gray-50 dark:border-gray-700">
                                <div class="dropdown-item dark:text-gray-100">
                                    <a class="p-3 hover:bg-gray-50/50 block dark:hover:bg-zinc-700/50" href="#">
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

            <div class="hidden">
                <div class="fixed inset-0 bg-black/40 transition-opacity z-40"></div>
                <div class="h-screen z-50 bg-white fixed w-80 right-0" data-simplebar>
                    <div class="flex items-center p-4 border-b border-gray-100">
                        <h5 class="m-0 mr-2">سفارشی‌سازی قالب</h5>
                        <a href="javascript:void(0);" class="h-6 w-6 text-center bg-gray-700 ml-auto rounded-full">
                            <i class="mdi mdi-close text-15 align-middle text-white leading-relaxed"></i>
                        </a>
                    </div>
                    <div class="p-4">
                        <h6 class="mt-4 mb-3 pt-2">حالت طرح</h6>
                        <div class="flex gap-4">
                            <div>
                                <input class="focus:ring-0" checked type="radio" name="layout-mode" id="layout-mode-light" value="light">
                                <label class="form-check-label" for="layout-mode-light">روشن</label>
                            </div>
                            <div>
                                <input class="focus:ring-0" type="radio" name="layout-mode" id="layout-mode-dark" value="dark">
                                <label class="form-check-label" for="layout-mode-dark">تاریک</label>
                            </div>
                        </div>
                    
                        <h6 class="mt-4 mb-3 pt-2">عرض طرح</h6>
                    
                        <div class="flex gap-4">
                            <div>
                                <input class="focus:ring-0" checked type="radio" name="layout-width" id="layout-width-fuild" value="fuild" onchange="document.body.setAttribute('data-layout-size', 'fluid')">
                                <label class="form-check-label" for="layout-width-fuild">مایع</label>
                            </div>
                            <div>
                                <input class="focus:ring-0" type="radio" name="layout-width" id="layout-width-boxed" value="boxed" onchange="document.body.setAttribute('data-layout-size', 'boxed')">
                                <label class="form-check-label" for="layout-width-boxed">بسته</label>
                            </div>
                        </div>
                    
                        <h6 class="mt-4 mb-3 pt-2">موقعیت طرح</h6>
                        <div class="flex gap-4">
                            <div>
                                <input class="focus:ring-0" checked type="radio" name="layout-position" id="layout-position-fixed" value="fixed" onchange="document.body.setAttribute('data-layout-scrollable', 'false')">
                                <label class="form-check-label" for="layout-position-fixed">ثابت</label>
                            </div>
                            <div>
                                <input class="focus:ring-0" checked type="radio" name="layout-position" id="layout-position-scrollable" value="scrollable" onchange="document.body.setAttribute('data-layout-scrollable', 'true')">
                                <label class="form-check-label" for="layout-position-scrollable">قابل پیمایش</label>
                            </div>
                        </div>
                    
                        <h6 class="mt-4 mb-3 pt-2">رنگ بالاستر</h6>
                        <div class="flex gap-4">
                            <div>
                                <input class="focus:ring-0" checked type="radio" name="topbar-color" id="topbar-color-light" value="light" onchange="document.body.setAttribute('data-topbar', 'light')">
                                <label class="form-check-label" for="topbar-color-light">روشن</label>
                            </div>
                            <div>
                                <input class="focus:ring-0" type="radio" name="topbar-color" id="topbar-color-dark" value="dark" onchange="document.body.setAttribute('data-topbar', 'dark')">
                                <label class="form-check-label" for="topbar-color-dark">تاریک</label>
                            </div>
                        </div>
                    
                        <h6 class="mt-4 mb-3 pt-2 sidebar-setting">اندازه نوار کناری</h6>
                    
                        <div class="space-y-1">
                            <div class="form-check sidebar-setting">
                                <input class="focus:ring-0" checked type="radio" name="sidebar-size" id="sidebar-size-default" value="default" onchange="document.body.setAttribute('data-sidebar-size', 'lg')">
                                <label class="form-check-label" for="sidebar-size-default">پیش‌فرض</label>
                            </div>
                            <div class="form-check sidebar-setting">
                                <input class="focus:ring-0" type="radio" name="sidebar-size" id="sidebar-size-compact" value="compact" onchange="document.body.setAttribute('data-sidebar-size', 'md')">
                                <label class="form-check-label" for="sidebar-size-compact">فشرده</label>
                            </div>
                            <div class="form-check sidebar-setting">
                                <input class="focus:ring-0" type="radio" name="sidebar-size" id="sidebar-size-small" value="small" onchange="document.body.setAttribute('data-sidebar-size', 'sm')">
                                <label class="form-check-label" for="sidebar-size-small">کوچک (نمایش آیکون)</label>
                            </div>
                        </div>
                    
                        <h6 class="mt-4 mb-3 pt-2 sidebar-setting">رنگ نوار کناری</h6>
                        <div class="space-y-1">
                            <div class="form-check sidebar-setting">
                                <input class="focus:ring-0" checked type="radio" name="sidebar-color" id="sidebar-color-light" value="light" onchange="document.body.setAttribute('data-sidebar', 'light')">
                                <label class="form-check-label" for="sidebar-color-light">روشن</label>
                            </div>
                            <div class="form-check sidebar-setting">
                                <input class="focus:ring-0" type="radio" name="sidebar-color" id="sidebar-color-dark" value="dark" onchange="document.body.setAttribute('data-sidebar', 'dark')">
                                <label class="form-check-label" for="sidebar-color-dark">تاریک</label>
                            </div>
                            <div class="form-check sidebar-setting">
                                <input class="focus:ring-0" type="radio" name="sidebar-color" id="sidebar-color-brand" value="brand" onchange="document.body.setAttribute('data-sidebar', 'brand')">
                                <label class="form-check-label" for="sidebar-color-brand">برند</label>
                            </div>
                        </div>
                    
                        <h6 class="mt-4 mb-3 pt-2">جهت</h6>
                        <div class="space-y-1">
                            <div>
                                <input class="focus:ring-0" checked type="radio" name="layout-direction" id="layout-direction-ltr" value="ltr">
                                <label class="form-check-label" for="layout-direction-ltr">LTR</label>
                            </div>
                            <div>
                                <input class="focus:ring-0" type="radio" name="layout-direction" id="layout-direction-rtl" value="rtl">
                                <label class="form-check-label" for="layout-direction-rtl">RTL</label>
                            </div>
                        </div>
                    
                    </div>
                </div>
            </div>

    <!-- ========== Left Sidebar Start ========== -->
    <div class="vertical-menu rtl:right-0 fixed ltr:left-0 bottom-0 top-16 h-screen border-r bg-slate-50 border-gray-50 print:hidden dark:bg-zinc-800 dark:border-neutral-700 z-10">
    
        <div data-simplebar class="h-full">
            <!--- Sidemenu -->
            <div id="sidebar-menu">
                <!-- Left Menu Start -->
                <ul class="metismenu" id="side-menu">
                    <li class="menu-heading px-4 py-3.5 text-xs font-medium text-gray-500 cursor-default" data-key="t-menu">منو</li>

                    <li>
                        <a href="index-2.html" class="pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                            <i data-feather="home"></i>
                            <span data-key="t-dashboard"> داشبورد</span>
                        </a>
                    </li>
                
                    <li>
                        <a href="javascript: void(0);" aria-expanded="false" class="nav-menu pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                            <i data-feather="grid"></i>
                            <span data-key="t-apps"> برنامه‌ها</span>
                        </a>
                        <ul>
                            <li>
                                <a href="app-calendar.html" class="pr-14 pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">تقویم</a>
                            </li>
                            <li>
                                <a href="app-chat.html" class="pr-14 pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">چت</a>
                            </li>
                
                            <li>
                                <a href="javascript: void(0);" aria-expanded="false" class="nav-menu pr-14 pl-4 py-2 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                                    <span data-key="t-apps">ایمیل</span>
                                </a>
                                <ul>
                                    <li>
                                        <a href="apps-email-inbox.html" class="pr-[4.5rem] pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">صندوق ورودی</a>
                                    </li>
                                    <li>
                                        <a href="apps-email-read.html" class="pr-[4.5rem] pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">خواندن ایمیل</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);" aria-expanded="false" class="nav-menu pr-14 pl-4 py-2 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                                    <span data-key="t-apps">فاکتورها</span>
                                </a>
                                <ul>
                                    <li>
                                        <a href="apps-invoices-list.html" class="pr-[4.5rem] pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">لیست فاکتور</a>
                                    </li>
                                    <li>
                                        <a href="apps-invoices-detail.html" class="pr-[4.5rem] pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">جزئیات فاکتور</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);" aria-expanded="false" class="nav-menu pr-14 pl-4 py-2 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                                    <span data-key="t-apps">مخاطبین</span>
                                </a>
                                <ul>
                                    <li>
                                        <a href="apps-contacts-grid.html" class="pr-[4.5rem] pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">شبکه کاربری</a>
                                    </li>
                                    <li>
                                        <a href="apps-contacts-list.html" class="pr-[4.5rem] pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">لیست کاربران</a>
                                    </li>
                                    <li>
                                        <a href="apps-contacts-profile.html" class="pr-[4.5rem] pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">پروفایل</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript: void(0);" aria-expanded="false" class="flex items-center justify-between pr-14 pl-4 py-2  text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                                    <span data-key="t-apps">وبلاگ</span>
                                    <span class="badge px-2 py-0.5 bg-red-100 text-xs rounded-full font-medium text-red-400 text-end">جدید</span>
                                </a>
                                <ul>
                                    <li>
                                        <a href="apps-blog-grid.html" class="pr-[4.5rem] pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">گرید وبلاگ</a>
                                    </li>
                                    <li>
                                        <a href="apps-blog-list.html" class="pr-[4.5rem] pl-4  py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">لیست وبلاگ</a>
                                    </li>
                                    <li>
                                        <a href="apps-blog-detail.html" class="pr-[4.5rem] pl-4  py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">جزئیات وبلاگ</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                
                
                    <li>
                        <a href="javascript: void(0);" aria-expanded="false" class="nav-menu pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                            <i data-feather="users"></i>
                            <span data-key="t-auth">احراز هویت</span>
                        </a>
                        <ul>
                            <li>
                                <a href="login.html" class="pr-14 pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">ورود</a>
                            </li>
                            <li>
                                <a href="register.html" class="pr-14 pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">ثبت نام</a>
                            </li>
                             <li>
                                <a href="recoverpw.html" class="pr-14 pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">بازیابی رمزعبور</a>
                            </li>
                            <li>
                                <a href="lock-screen.html" class="pr-14 pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">قفل صفحه</a>
                            </li>
                            <li>
                                <a href="logout.html" class="pr-14 pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">خروج</a>
                            </li>
                            <li>
                                <a href="confirm-mail.html" class="pr-14 pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">تأیید ایمیل</a>
                            </li>
                            <li>
                                <a href="email-verification.html" class="pr-14 pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">تأیید ایمیل</a>
                            </li>
                            <li>
                                <a href="two-step-verification.html" class="pr-14 pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">تأیید دو مرحله‌ای</a>
                            </li>
                        </ul>
                    </li>
                
                     <li>
                        <a href="javascript: void(0);" aria-expanded="false" class="nav-menu pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                            <i data-feather="briefcase"></i><span data-key="t-pages">صفحات</span>
                        </a>
                        <ul>
                            <li>
                                <a href="starter.html" class="pr-14 pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">صفحه شروع</a>
                            </li>
                            <li>
                                <a href="maintenance.html" class="pr-14 pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">تعمیرات</a>
                            </li>
                             <li>
                                <a href="coming-soon.html" class="pr-14 pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">به زودی</a>
                            </li>
                            <li>
                                <a href="timeline.html" class="pr-14 pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">جدول زمانی</a>
                            </li>
                            <li>
                                <a href="faqs.html" class="pr-14 pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">سوالات متداول</a>
                            </li>
                            <li>
                                <a href="pricing.html" class="pr-14 pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">قیمت‌گذاری</a>
                            </li>
                            <li>
                                <a href="404.html" class="pr-14 pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">خطای 404</a>
                            </li>
                            <li>
                                <a href="500.html" class="pr-14 pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">خطای 500</a>
                            </li>
                        </ul>
                    </li>
                
                    <li class="menu-heading px-4 py-3 text-xs font-medium text-gray-500 cursor-default" data-key="t-elements">عناصر</li>
                
                    <li>
                        <a href="javascript: void(0);" aria-expanded="false"  class="nav-menu pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                            <i data-feather="briefcase"></i>
                            <span data-key="t-compo">کامپوننت ها</span>
                        </a>
                        <ul>
                            <li>
                                <a href="alerts.html" class="pr-14 pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">هشدارها</a>
                            </li>
                            <li>
                                <a href="buttons.html" class="pr-14 pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">دکمه‌ها</a>
                            </li>
                            <li>
                                <a href="cards.html" class="pr-14 pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">کارت‌ها</a>
                            </li>
                            <li>
                                <a href="dropdown.html" class="pr-14 pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">منو کشویی</a>
                            </li>
                            <li>
                                <a href="flexbox%26grid.html" class="pr-14 pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">جعبه انعطاف پذیر و شبکه</a>
                            </li>
                            <li>
                                <a href="sizing.html" class="pr-14 pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">سایز ها</a>
                            </li>
                            <li>
                                <a href="avatars.html" class="pr-14 pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">آواتار</a>
                            </li>
                            <li>
                                <a href="modals.html" class="pr-14 pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">مودال‌ها</a>
                            </li>
                            <li>
                                <a href="progress.html" class="pr-14 pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">پیشرفت</a>
                            </li>
                            <li>
                                <a href="tabs%26accordions.html" class="pr-14 pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">تب‌ها و آکاردئون‌ها</a>
                            </li>
                            <li>
                                <a href="typography.html" class="pr-14 pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">تایپوگرافی</a>
                            </li>
                            <li>
                                <a href="toasts.html" class="pr-14 pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">توست‌ها</a>
                            </li>
                            <li>
                                <a href="general.html" class="pr-14 pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">عمومی</a>
                            </li>
                            <li>
                                <a href="colors.html" class="pr-14 pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">رنگ‌ها</a>
                            </li>
                            <li>
                                <a href="utilities.html" class="pr-14 pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">ابزارها</a>
                            </li>
                        </ul>
                    </li>
                

                    <li>
                        <a href="javascript: void(0);" aria-expanded="false" class="nav-menu pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                            <i data-feather="gift"></i>
                            <span data-key="t-extend">توسعه یافته</span>
                        </a>
                        <ul>
                            <li>
                                <a href="extended-lightbox.html" class="pr-14 pl-4 py-2 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">لایت باکس</a>
                            </li>
                            <li>
                                <a href="extended-rangeslider.html" class="pr-14 pl-4  py-2 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">انتخابگر محدوده</a>
                            </li>
                            <li>
                                <a href="extended-sweet-alert.html" class="pr-14 pl-4  py-2 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">SweetAlert 2</a>
                            </li>
                            <li>
                                <a href="extended-rating.html" class="pr-14 pl-4  py-2 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">رتبه بندی</a>
                            </li>
                            <li>
                                <a href="extended-notifications.html" class="pr-14 pl-4  py-2 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">اطلاعیه‌ها</a>
                            </li>
                        </ul>
                    </li>
                
                    <li>
                        <a href="javascript: void(0);" aria-expanded="false" class="pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                            <span class="badge bg-red-50 text-danger ltr:float-right rtl:float-left z-50 px-1.5 rounded-full text-11 text-red-500" data-toggle="collapse">7</span>
                            <i data-feather="box"></i>
                            <span data-key="t-forms">فرم‌ها</span>
                        </a>
                        <ul>
                            <li>
                                <a href="form-elements.html" class="pr-14 pl-4 py-2 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">عناصر اساسی</a>
                            </li>
                            <li>
                                <a href="form-validation.html" class="pr-14 pl-4  py-2 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">انتخابگر محدوده</a>
                            </li>
                            <li>
                                <a href="form-advanced.html" class="pr-14 pl-4  py-2 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">SweetAlert 2</a>
                            </li>
                            <li>
                                <a href="form-editors.html" class="pr-14 pl-4  py-2 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">ویرایشگرها</a>
                            </li>
                            <li>
                                <a href="file-uploads.html" class="pr-14 pl-4  py-2 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">آپلود فایل</a>
                            </li>
                            <li>
                                <a href="form-wizard.html" class="pr-14 pl-4  py-2 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">جادوگر</a>
                            </li>
                            <li>
                                <a href="form-mask.html" class="pr-14 pl-4  py-2 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">ماسک</a>
                            </li>
                        </ul>
                    </li>
                
                    <li>
                        <a href="javascript: void(0);" aria-expanded="false" class="nav-menu pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                            <i data-feather="sliders"></i>
                            <span data-key="t-charts">جداول</span>
                        </a>
                        <ul>
                            <li>
                                <a href="tables-basic.html" class="pr-14 pl-4 py-2 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">عناصر اساسی</a>
                            </li>
                            <li>
                                <a href="tables-datatable.html" class="pr-14 pl-4  py-2 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">جداول داده</a>
                            </li>
                            <li>
                                <a href="tables-responsive.html" class="pr-14 pl-4  py-2 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">واکنش‌پذیر</a>
                            </li>
                            <li>
                                <a href="tables-editable.html" class="pr-14 pl-4  py-2 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">ویرایش‌پذیر </a>
                            </li>
                        </ul>
                    </li>
                
                    <li>
                        <a href="javascript: void(0);" aria-expanded="false" class="nav-menu pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                            <i data-feather="pie-chart"></i>
                            <span data-key="t-charts">نمودارها</span>
                        </a>
                        <ul>
                            <li>
                                <a href="charts-apex.html" class="pr-14 pl-4 py-2 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Apexcharts</a>
                            </li>
                            <li>
                                <a href="charts-echart.html" class="pr-14 pl-4 py-2 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Echarts</a>
                            </li>
                            <li>
                                <a href="charts-chartjs.html" class="pr-14 pl-4  py-2 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Chartjs</a>
                            </li>
                            <li>
                                <a href="charts-knob.html" class="pr-14 pl-4  py-2 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Jquery Knob</a>
                            </li>
                            <li>
                                <a href="charts-sparkline.html" class="pr-14 pl-4  py-2 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">نمودار Sparkline</a>
                            </li>
                        </ul>
                    </li>
                

                    <li>
                        <a href="javascript: void(0);" aria-expanded="false" class="nav-menu pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                            <i data-feather="cpu"></i>
                            <span data-key="t-icons">آیکون‌ها</span>
                        </a>
                        <ul>
                            <li>
                                <a href="icons-boxicons.html" class="pr-14 pl-4 py-2 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Boxicons</a>
                            </li>
                            <li>
                                <a href="icons-materialdesign.html" class="pr-14 pl-4  py-2 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">طراحی متریال</a>
                            </li>
                            <li>
                                <a href="icons-dripicons.html" class="pr-14 pl-4  py-2 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">آیکون‌های Dripicons</a>
                            </li>
                        </ul>
                    </li>
                
                    <li>
                        <a href="javascript: void(0);" aria-expanded="false" class="nav-menu pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                            <i data-feather="map"></i>
                            <span data-key="t-maps">نقشه‌ها</span>
                        </a>
                        <ul>
                            <li>
                                <a href="maps-google.html" class="pr-14 pl-4 py-2 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Google</a>
                            </li>
                            <li>
                                <a href="maps-vector.html" class="pr-14 pl-4  py-2 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Vector map</a>
                            </li>
                            <li>
                                <a href="maps-leaflet.html" class="pr-14 pl-4  py-2 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">Leaflet</a>
                            </li>
                        </ul>
                    </li>
                
                    <li class="menu__item w-full ">
                        <a href="javascript: void(0);" aria-expanded="false" class="nav-menu pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                            <i data-feather="share-2"></i>
                            <span data-key="t-level">چند سطحی</span>
                        </a>
                        <div>
                            <ul>
                                <li>
                                    <a href="index-2.html" class="pr-14 pl-4 py-2 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">سطح 1.1</a>
                                </li>
                                <li>
                                    <a href="#!" data-toggle="collapse" data-target=".Level1.2-menu" class="nav-menu pr-14 pl-4 py-2 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                                        <span data-key="t-level">سطح 1.2</span>
                                    </a>
                                    <ul class="collapse Level1.2-menu">
                                        <li>
                                            <a href="#" class="pr-14 pl-4 py-2 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">سطح 2.1</a>
                                        </li>
                                        <li>
                                            <a href="#" class="pr-14 pl-4  py-2 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">سطح 2.2</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </li>
                            <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                                <div class="card-body border-b border-gray-50 dark:border-zinc-600">
                                    <div class="flex">
                                        <div class="grow">
                                            <h5 class="text-15 text-gray-700 dark:text-gray-100">پست</h5>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <a href="#post" class="text-violet-500 font-medium">مشاهده همه</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                   <div>
                                        <div class="grid grid-cols-12 gap-4">
                                            <div class="col-span-12 lg:col-span-4">
                                                <div class="card p-1 dark:border-zinc-600">
                                                    <div class="p-4">
                                                        <div class="flex items-start">
                                                            <div class="flex-grow">
                                                                <h5 class="text-15 text-truncate"><a href="#" class="text-gray-700 dark:text-gray-100">روز زیبا با دوستان</a></h5>
                                                                <p class="text-13 text-gray-500 dark:text-zinc-100 mt-2 mb-0">20 آبان 1403</p>
                                                            </div>
                                                            <div class="flex-shrink-0 ms-2">
                                                                <div class="dropend text-end relative">
                                                                    <button class="btn border-transparent py-1 text-16 text-gray-500 dark:text-zinc-100 shadow-none dropdown-toggle " href="#" role="button" data-bs-toggle="dropdown" id="dropdownMenu1" aria-expanded="false">
                                                                        <i class="bx bx-dots-horizontal-rounded"></i>
                                                                    </button>
                                                                    <ul class="dropdown-menu min-w-max absolute bg-white z-50 float-left py-2 list-none text-left -left-7 top-6 w-40
                                                                    rounded-lg shadow-lg hidden bg-clip-padding border-none dark:bg-zinc-800" aria-labelledby="dropdownMenu1">
                                                                        <li><a
                                                                            class="dropdown-item text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 dark:text-gray-100 hover:bg-gray-50/50 dark:hover:bg-zinc-500/50"
                                                                            href="#">عملیات</a>
                                                                        </li>
                                                                        <li><a class="dropdown-item text-sm py-2 px-4 font-normal block w-full whitespace-nowrap
                                                                            bg-transparent text-gray-700 dark:text-gray-100 hover:bg-gray-50/50 dark:hover:bg-zinc-500/50" href="#">عملیات دیگر</a >
                                                                        </li>
                                                                        <li><a class="dropdown-item text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent
                                                                            text-gray-700 dark:text-gray-100 hover:bg-gray-50/50 dark:hover:bg-zinc-500/50" href="#">چیز دیگری اینجا</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <img src="assets/images/small/img-3.jpg" alt="" class="border p-1 border-gray-50 rounded dark:border-zinc-600">
                                                    </div>
                                                    <div class="p-4">
                                                        <ul class="inline-flex mb-4">
                                                            <li class="ltr:mr-3 rtl:ml-3">
                                                                <a href="javascript: void(0);" class="text-gray-500 dark:text-zinc-100">
                                                                    <i class="bx bx-purchase-tag-alt align-middle text-gray-500 dark:text-zinc-100 ltr:mr-1 rtl:ml-1"></i> پروژه
                                                                </a>
                                                            </li>
                                                            <li class="ltr:mr-3 rtl:ml-3">
                                                                <a href="javascript: void(0);" class="text-gray-500 dark:text-zinc-100">
                                                                    <i class="bx bx-comment-dots align-middle text-gray-500 dark:text-zinc-100 ltr:mr-1 rtl:ml-1"></i> 12 نظر
                                                                </a>
                                                            </li>
                                                        </ul>
                                                        <p class="text-gray-500 dark:text-zinc-100 mb-4">نهایتاً هیچ کس نیست که از این روند لذت ببرد چون درد این برنامه بزرگتر است</p>
                                                        <div>
                                                            <a href="#" class="text-violet-500">ادامه مطلب <i class="mdi mdi-arrow-left align-middle"></i></a>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-4">
                                                <div class="card p-1 dark:border-zinc-600">
                                                    <div class="p-4">
                                                        <div class="flex items-start">
                                                            <div class="flex-grow">
                                                                <h5 class="text-15 text-truncate"><a href="#" class="text-gray-700 dark:text-gray-100">نقاشی یک طرح</a></h5>
                                                                <p class="text-13 text-gray-500 dark:text-zinc-100 mt-2 mb-0">24 بهمن 1403</p>
                                                            </div>
                                                            <div class="flex-shrink-0 ms-2">
                                                                <div class="dropend text-end relative">
                                                                    <button class="btn border-transparent py-1 text-16 text-gray-500 dark:text-zinc-100 shadow-none dropdown-toggle " href="#" role="button" data-bs-toggle="dropdown" id="dropdownMenu1" aria-expanded="false">
                                                                        <i class="bx bx-dots-horizontal-rounded"></i>
                                                                    </button>
                                                                    <ul class="dropdown-menu min-w-max absolute bg-white z-50 float-left py-2 list-none text-left -left-7 top-6 w-40
                                                                        rounded-lg shadow-lg hidden bg-clip-padding border-none dark:bg-zinc-600 dark:border-transparent dark:text-white " aria-labelledby="dropdownMenu1">
                                                                        <li><a
                                                                            class="dropdown-item text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 dark:text-gray-100 hover:bg-gray-50/50 dark:hover:bg-zinc-500/50"
                                                                            href="#">عملیات</a>
                                                                        </li>
                                                                        <li><a class="dropdown-item text-sm py-2 px-4 font-normal block w-full whitespace-nowrap
                                                                            bg-transparent text-gray-700 dark:text-gray-100 hover:bg-gray-50/50 dark:hover:bg-zinc-500/50" href="#">عملیات دیگر</a >
                                                                        </li>
                                                                        <li><a class="dropdown-item text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent
                                                                            text-gray-700 dark:text-gray-100 hover:bg-gray-50/50 dark:hover:bg-zinc-500/50" href="#">چیز دیگری اینجا</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <img src="assets/images/small/img-1.jpg" alt="" class="border p-1 border-gray-50 rounded dark:border-zinc-600">
                                                    </div>
                                                    <div class="p-4">
                                                        <ul class="inline-flex mb-4">
                                                            <li class="ltr:mr-3 rtl:ml-3">
                                                                <a href="javascript: void(0);" class="text-gray-500 dark:text-zinc-100">
                                                                    <i class="bx bx-purchase-tag-alt align-middle text-gray-500 dark:text-zinc-100 ltr:mr-1 rtl:ml-1"></i> توسعه
                                                                </a>
                                                            </li>
                                                            <li class="ltr:mr-3 rtl:ml-3">
                                                                <a href="javascript: void(0);" class="text-gray-500 dark:text-zinc-100">
                                                                    <i class="bx bx-comment-dots align-middle text-gray-500 dark:text-zinc-100 ltr:mr-1 rtl:ml-1"></i> 08 نظر
                                                                </a>
                                                            </li>
                                                        </ul>
                                                        <p class="text-gray-500 dark:text-zinc-100 mb-4">اصولاً انسانها از محبت و نشاط زندگی بهره می برند و از کردارهای آزار دهنده و ناراحت کننده اجتناب می کنند</p>
                                                        <div>
                                                            <a href="#" class="text-violet-500">ادامه مطلب <i class="mdi mdi-arrow-left align-middle"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-4">
                                                <div class="card p-1 dark:border-zinc-600">
                                                    <div class="p-4">
                                                        <div class="flex items-start">
                                                            <div class="flex-grow">
                                                                <h5 class="text-15 text-truncate"><a href="#" class="text-gray-700 dark:text-gray-100">بحث پروژه با تیم</a></h5>
                                                                <p class="text-13 text-gray-500 dark:text-zinc-100 mt-2 mb-0">20 تیر 1403</p>
                                                            </div>
                                                            <div class="flex-shrink-0 ms-2">
                                                                <div class="dropend text-end relative">
                                                                    <button class="btn border-transparent py-1 text-16 text-gray-500 dark:text-zinc-100 shadow-none dropdown-toggle " href="#" role="button" data-bs-toggle="dropdown" id="dropdownMenu1" aria-expanded="false">
                                                                        <i class="bx bx-dots-horizontal-rounded"></i>
                                                                    </button>
                                                                    <ul class=" dropdown-menu min-w-max absolute bg-white z-50 float-left py-2 list-none text-left -left-7 top-6 w-40
                                                                        rounded-lg shadow-lg hidden bg-clip-padding border-none dark:bg-zinc-600 dark:border-transparent dark:text-white" aria-labelledby="dropdownMenu1">
                                                                        <li><a
                                                                            class="dropdown-item text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-gray-700 dark:text-gray-100 hover:bg-gray-50/50 dark:hover:bg-zinc-500/50"
                                                                            href="#">عملیات</a>
                                                                        </li>
                                                                        <li><a class="dropdown-item text-sm py-2 px-4 font-normal block w-full whitespace-nowrap
                                                                            bg-transparent text-gray-700 dark:text-gray-100 hover:bg-gray-50/50 dark:hover:bg-zinc-500/50" href="#">عملیات دیگر</a >
                                                                        </li>
                                                                        <li><a class="dropdown-item text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent
                                                                            text-gray-700 dark:text-gray-100 hover:bg-gray-50/50 dark:hover:bg-zinc-500/50" href="#">چیز دیگری اینجا</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <img src="assets/images/small/img-5.jpg" alt="" class="border p-1 border-gray-50 rounded dark:border-zinc-600">
                                                    </div>
                                                    <div class="p-4">
                                                        <ul class="inline-flex mb-4">
                                                            <li class="ltr:mr-3 rtl:ml-3">
                                                                <a href="javascript: void(0);" class="text-gray-500 dark:text-zinc-100">
                                                                    <i class="bx bx-purchase-tag-alt align-middle text-gray-500 dark:text-zinc-100 ltr:mr-1 rtl:ml-1"></i> پروژه
                                                                </a>
                                                            </li>
                                                            <li class="ltr:mr-3 rtl:ml-3">
                                                                <a href="javascript: void(0);" class="text-gray-500 dark:text-zinc-100">
                                                                    <i class="bx bx-comment-dots align-middle text-gray-500 dark:text-zinc-100 ltr:mr-1 rtl:ml-1"></i> 08 نظر
                                                                </a>
                                                            </li>
                                                        </ul>
                                                        <p class="text-gray-500 dark:text-zinc-100 mb-4">اما در حقیقت هم آنها را متهم می کنیم و هم با نفرت عادلانه کسانی را که شایسته آن هستند می آوریم</p>
                                                        <div>
                                                            <a href="#" class="text-violet-500">ادامه مطلب <i class="mdi mdi-arrow-left align-middle"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                   </div>
                                </div>
                            </div>
                       </div>
                       <div class="col-span-12 lg:col-span-3">
                            <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                                <div class="card-body">
                                    <h5 class="text-15 text-gray-700 dark:text-gray-100 mb-3">مهارت‌ها</h5>
                                    <div class="flex flex-wrap gap-2">
                                        <a href="#" class="text-xs px-2 py-0.5 rounded text-violet-500 bg-violet-50/50 hover:bg-violet-50 duration-300 dark:bg-violet-500/20">فتوشاپ</a>
                                        <a href="#" class="text-xs px-2 py-0.5 rounded text-violet-500 bg-violet-50/50 hover:bg-violet-50 duration-300 dark:bg-violet-500/20">ایلاستریتور</a>
                                        <a href="#" class="text-xs px-2 py-0.5 rounded text-violet-500 bg-violet-50/50 hover:bg-violet-50 duration-300 dark:bg-violet-500/20">HTML</a>
                                        <a href="#" class="text-xs px-2 py-0.5 rounded text-violet-500 bg-violet-50/50 hover:bg-violet-50 duration-300 dark:bg-violet-500/20">جاوااسکریپت</a>
                                        <a href="#" class="text-xs px-2 py-0.5 rounded text-violet-500 bg-violet-50/50 hover:bg-violet-50 duration-300 dark:bg-violet-500/20">PHP</a>
                                        <a href="#" class="text-xs px-2 py-0.5 rounded text-violet-500 bg-violet-50/50 hover:bg-violet-50 duration-300 dark:bg-violet-500/20">پایتون</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                                <div class="card-body">
                                    <h5 class="text-15 text-gray-700 dark:text-gray-100 mb-4">نمونه کارها</h5>
                                    <ul class="list-unstyled mb-0">
                                        <li>
                                            <a href="#" class="py-2 d-block text-gray-500 dark:text-zinc-100 "><i class="mdi mdi-web text-violet-500 ltr:mr-1 rtl:ml-1"></i> وب‌سایت</a>
                                        </li>
                                        <li class="mt-4">
                                            <a href="#" class="py-2 d-block text-gray-500 dark:text-zinc-100"><i class="mdi mdi-note-text-outline text-violet-500 ltr:mr-1 rtl:ml-1"></i> وبلاگ</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                                <div class="card-body">
                                    <h5 class="text-15 text-gray-700 dark:text-gray-100 mb-4">پروفایل‌های مشابه</h5>
                                    <div class="list-group">
                                            <a href="#">
                                                <div class="flex items-center p-4 border-b border-gray-50 dark:border-zinc-600">
                                                    <div class="avatar-sm flex-shrink-0 ltr:mr-3 rtl:ml-3">
                                                        <img src="assets/images/users/avatar-1.jpg" alt="" class="h-8 w-8 rounded-full border p-1 border-gray-100 dark:border-zinc-600">
                                                    </div>
                                                    <div class="flex-grow">
                                                        <div>
                                                            <h5 class="text-sm mb-1 text-gray-700 dark:text-gray-100">جیمز نیکس</h5>
                                                            <p class="text-13 text-gray-500 dark:text-zinc-100 mb-0">توسعه‌دهنده فول استک</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="#">
                                                <div class="flex items-center p-4 border-b border-gray-50 dark:border-zinc-600">
                                                    <div class="avatar-sm flex-shrink-0 ltr:mr-3 rtl:ml-3">
                                                        <img src="assets/images/users/avatar-3.jpg" alt="" class="h-8 w-8 rounded-full border p-1 border-gray-100 dark:border-zinc-600">
                                                    </div>
                                                    <div class="flex-grow">
                                                        <div>
                                                            <h5 class="text-sm mb-1 text-gray-700 dark:text-gray-100">دارلین اسمیت</h5>
                                                            <p class="text-13 text-gray-500 dark:text-zinc-100 mb-0">طراح رابط کاربری/کاربری</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="#">
                                                <div class="flex items-center p-4">
                                                    <div class="avatar-sm flex-shrink-0 ltr:mr-3 rtl:ml-3">
                                                        <div class="bg-gray-50/50 h-8 w-8 text-22 rounded-full text-center text-gray-100">
                                                            <i class="bx bxs-user-circle"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow">
                                                        <div>
                                                            <h5 class="text-sm mb-1 text-gray-700 dark:text-gray-100">ویلیام اسویفت</h5>
                                                            <p class="text-13 text-gray-500 dark:text-zinc-100 mb-0">توسعه‌دهنده بکند</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Footer Start -->
                    <footer class="footer absolute bottom-0 right-0 left-0 border-t border-gray-50 py-5 px-5 bg-white dark:bg-zinc-700 dark:border-zinc-600 dark:text-gray-200">
                        <div class="grid grid-cols-2">

                            <div class="hidden md:inline-block text-start">دیزاین و توسعه توسط <a href="#" class="text-violet-500 underline">Themesbrand</a></div>
                            <div class="grow lg:text-left">
                                &copy;
                                <script>
                                    document.write(new Date().getFullYear());
                                </script> Minia
                            </div>
                        </div>
                    </footer>
                    <!-- end Footer -->
                </div>
            </div>
        </div>

            
    
            <div class="fixed ltr:right-5 rtl:left-5 bottom-10 flex flex-col gap-3 z-40 animate-bounce">
                <!-- light-dark mode button -->
                <a href="javascript: void(0);" id="ltr-rtl" class="px-3.5 py-4 z-40 text-14 transition-all duration-300 ease-linear text-white bg-violet-500 hover:bg-violet-600 rounded-full font-medium" onclick="changeMode(event)">
                    <span class="ltr:hidden">LTR</span>
                    <span  class="rtl:hidden">RTL</span>
                </a>  
            </div> 
        
    <script src="assets/libs/%40popperjs/core/umd/popper.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/libs/metismenujs/metismenujs.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>

    <script src="assets/libs/flatpickr/flatpickr.min.js"></script>

    <script src="assets/js/app.js"></script>

</body>


<!-- Mirrored from minia.cfarhad.ir/apps-contacts-profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 02 Oct 2024 16:01:11 GMT -->
</html>