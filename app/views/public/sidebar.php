<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu rtl:right-0 fixed ltr:left-0 bottom-0 top-16 h-screen border-r bg-slate-50 border-gray-50 print:hidden dark:bg-zinc-800 dark:border-neutral-700 z-10">

  <div data-simplebar class="h-full">
    <!--- Sidemenu -->
    <div id="sidebar-menu">
      <!-- Left Menu Start -->
      <ul class="metismenu" id="side-menu">
        <li class="menu-heading px-4 py-3.5 text-xs font-medium text-gray-500 cursor-default" data-key="t-menu">منو</li>

        <li>
          <a href="<?php echo URLROOT . "/dashboard/admin" ?> " class="pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
            <i data-feather="home"></i>
            <span data-key="t-dashboard"> داشبورد</span>
          </a>
        </li>

        <li>
          <a href="<?php echo URLROOT . "/receptions/admin" ?>" class="nav-menu pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
            <i data-feather="home"></i>
            <span data-key="t-dashboard"> پذیرش ها</span>
          </a>
        </li>
        <li>
          <a href="javascript: void(0);" aria-expanded="false" class="nav-menu pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
            <i data-feather="users"></i>
            <span data-key="t-auth">کاربران</span>
          </a>
          <ul>
            <li>
              <a href="<?php echo URLROOT . "/users/index" ?>" class="pr-14 pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">لیست کاربران</a>
            </li>
            <li>
              <a href="<?php echo URLROOT . "/users/create" ?>" class="pr-14 pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">افزودن کاربر جدید </a>
            </li>

          </ul>
        </li>

        <li>
          <a href="javascript: void(0);" aria-expanded="false" class="nav-menu pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
            <i data-feather="briefcase"></i><span data-key="t-pages">نمایندگان</span>
          </a>
          <ul>
            <li>
              <a href="<?php echo URLROOT . "/users/indexAgents" ?> " class="pr-14 pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">لیست نمایندگان </a>
            </li>
            <li>
              <a href="<?php echo URLROOT . "/users/createAgent" ?> " class="pr-14 pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">افزودن نماینده جدید</a>
            </li>
            
          </ul>
        </li>

        <li>
          <a href="javascript: void(0);" aria-expanded="false" class="nav-menu pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
            <i data-feather="briefcase"></i>
            <span data-key="t-compo">کارت گارانتی </span>
          </a>
          <ul>
            <li>
              <a href="<?php echo URLROOT . "/cards/index" ?>" class="pr-14 pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">لیست کارت گارانتی ها</a>
            </li>
            <li>
              <a href="<?php echo URLROOT . "/cards/create" ?>" class="pr-14 pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">افزودن کارت گارانتی جدید</a>
            </li>
            <li>
              <a href="cards.html" class="pr-14 pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">صدور کارت گارانتی</a>
            </li>
            <li>
              <a href="dropdown.html" class="pr-14 pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">تایید کارت گارانتی</a>
            </li>
            
          </ul>
        </li>


        <li>
          <a href="javascript: void(0);" aria-expanded="false" class="nav-menu pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
            <i data-feather="gift"></i>
            <span data-key="t-extend">مشتریان </span>
          </a>
          <ul>
            <li>
              <a href="<?php echo URLROOT . "/customers/index" ?>" class="pr-14 pl-4 py-2 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">لیست مشتریان </a>
            </li>
            
          </ul>
        </li>

        

        <li>
          <a href="javascript: void(0);" aria-expanded="false" class="nav-menu pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
            <i data-feather="sliders"></i>
            <span data-key="t-charts">تیکت ها</span>
          </a>
          <ul>
            <li>
              <a href="tables-basic.html" class="pr-14 pl-4 py-2 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">لیست تیکت ها </a>
            </li>
            <li>
              <a href="tables-datatable.html" class="pr-14 pl-4  py-2 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">ارسال تیکت جدید </a>
            </li>
            
          </ul>
        </li>

        <li>
          <a href="javascript: void(0);" aria-expanded="false" class="nav-menu pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
            <i data-feather="pie-chart"></i>
            <span data-key="t-charts">تنظیمات</span>
          </a>
          <ul>
            <li>
              <a href="charts-apex.html" class="pr-14 pl-4 py-2 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">تعریف لوازم جانبی</a>
            </li>
            <li>
              <a href="charts-echart.html" class="pr-14 pl-4 py-2 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">تعریف وضعیت پذیرش</a>
            </li>
            <li>
              <a href="charts-chartjs.html" class="pr-14 pl-4  py-2 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">تعریف وضعیت گارانتی</a>
            </li>
            <li>
              <a href="charts-knob.html" class="pr-14 pl-4  py-2 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white"> گزارش کار انجام شده</a>
            </li>
            <li>
              <a href="charts-sparkline.html" class="pr-14 pl-4  py-2 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white"> ویرایش پرینت </a>
            </li>
          </ul>
        </li>


        <li>
          <a href="javascript: void(0);" aria-expanded="false" class="nav-menu pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
            <i data-feather="cpu"></i>
            <span data-key="t-icons">گزارشات مدیریتی</span>
          </a>
          <ul>
            <li>
              <a href="icons-boxicons.html" class="pr-14 pl-4 py-2 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">گزارش پذیرش ها</a>
            </li>
            <li>
              <a href="icons-materialdesign.html" class="pr-14 pl-4  py-2 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">گزارش کارت های گارانتی </a>
            </li>
            <li>
              <a href="icons-dripicons.html" class="pr-14 pl-4  py-2 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white"> گزارش تغییر وضعیت ها</a>
            </li>
          </ul>
        </li>

        

      </ul>


    </div>
    <!-- Sidebar -->
  </div>
</div>
<!-- Left Sidebar End -->