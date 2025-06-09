<!-- ========== Left Sidebar Start ========== -->
<style>
  .menu-arrow {
    transition: transform 0.3s ease;
    width: 18px;
    height: 18px;
    color: #6b7280;
    opacity: 0.7;
  }

  .menu-item:hover .menu-arrow {
    color: #8b5cf6;
    opacity: 1;
  }

  .submenu {
    transition: all 0.3s ease;
    background-color: rgba(0, 0, 0, 0.02);
    border-radius: 4px;
    margin: 2px 8px;
  }

  .menu-link {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 16px;
    border-radius: 6px;
    transition: all 0.2s ease;
  }

  .menu-link:hover {
    background-color: rgba(139, 92, 246, 0.05);
  }

  .menu-link i:not(.menu-arrow) {
    margin-left: 8px;
    color: #6b7280;
  }

  .menu-link:hover i:not(.menu-arrow) {
    color: #8b5cf6;
  }

  .menu-link span {
    flex: 1;
    margin: 0 8px;
    font-weight: 500;
  }

  .submenu a {
    padding: 8px 16px;
    border-radius: 4px;
    transition: all 0.2s ease;
  }

  .submenu a:hover {
    background-color: rgba(139, 92, 246, 0.05);
    color: #8b5cf6;
  }
</style>

<div
  class="vertical-menu rtl:right-0 fixed ltr:left-0 bottom-0 top-16 h-screen border-r bg-slate-50 border-gray-50 print:hidden dark:bg-zinc-800 dark:border-neutral-700 z-10">

  <div data-simplebar class="h-full">
    <!--- Sidemenu -->
    <div id="sidebar-menu">
      <!-- Left Menu Start -->
      <ul class="metismenu" id="side-menu">
        <li class="menu-heading px-4 py-3.5 text-xs font-medium text-gray-500 cursor-default" data-key="t-menu">منو</li>

        <li>
          <a href="<?php echo URLROOT . "/dashboard/admin" ?> "
            class="pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
            <i data-feather="home"></i>
            <span data-key="t-dashboard"> داشبورد</span>
          </a>
        </li>

        <li>
          <a href="<?php echo URLROOT . "/receptions/admin" ?>"
            class="pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
            <i data-feather="briefcase"></i>
            <span data-key="t-receptions"> پذیرش ها</span>
          </a>
        </li>

        <li>
          <a href="<?php echo URLROOT . "/customers/index" ?>"
            class="pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
            <i data-feather="gift"></i>
            <span data-key="t-extend"> مشتریان </span>
          </a>
        </li>

        <li>
          <a href="javascript: void(0);" aria-expanded="false"
            class="nav-menu pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
            <i data-feather="users"></i>
            <span data-key="t-users"> کاربران</span>
          </a>
          <ul>
            <li>
              <a href="<?php echo URLROOT . "/users/index" ?>"
                class="pr-14 pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">لیست
                کاربران</a>
            </li>
            <li>
              <a href="<?php echo URLROOT . "/users/create" ?>"
                class="pr-14 pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">افزودن
                کاربر جدید </a>
            </li>
          </ul>
        </li>

        <li>
          <a href="javascript: void(0);" aria-expanded="false"
            class="nav-menu pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
            <i data-feather="users"></i>
            <span data-key="t-"> نمایندگان</span>
          </a>
          <ul>
            <li>
              <a <a href="<?php echo URLROOT . "/users/indexAgents" ?> "
                class="pr-14 pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                لیست
                نمایندگان </a>
            </li>
            <li>
              <a href="<?php echo URLROOT . "/users/createAgent" ?> "
                class="pr-14 pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">افزودن
                نماینده جدید </a>
            </li>
          </ul>
        </li>



        <li>
          <a href="javascript: void(0);" aria-expanded="false"
            class="nav-menu pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
            <i data-feather="users"></i>
            <span data-key="t-"> کارت گارانتی</span>
          </a>
          <ul>
            <li>
              <a href="<?php echo URLROOT . "/cards/index" ?>"
                class="pr-14 pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                لیست
                کارت گارانتی ها </a>
            </li>
            <li>
              <a href="<?php echo URLROOT . "/cards/create" ?>"
                class="pr-14 pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">افزودن
                کارت گارانتی جدید </a>
            </li>

            <li>
              <a href="<?php echo URLROOT . "/cards/import" ?>"
                class="pr-14 pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">صدور
                کارت گارانتی جدید </a>
            </li>
          </ul>
        </li>



        <li>
          <a href="javascript: void(0);" aria-expanded="false"
            class="nav-menu pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
            <i data-feather="message-circle"></i>
            <span data-key="t-tickets"> تیکت </span>
          </a>
          <ul>
            <li>
              <a href="<?php echo URLROOT . "/tickets/admin" ?>"
                class="pr-14 pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                لیست
                تیکت ها </a>
            </li>
            <li>
              <a href="<?php echo URLROOT . "/tickets/create" ?>"
                class="pr-14 pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">افزودن
                تیکت جدید </a>
            </li>
          </ul>
        </li>


        <li>
          <a href="javascript: void(0);" aria-expanded="false"
            class="nav-menu pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
            <i data-feather="settings"></i>
            <span data-key="t-settings"> تنظیمات </span>
          </a>
          <ul>

            <li>
              <a href="<?php echo URLROOT; ?>/receptionstatuses"
                class="pr-14 pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                تعریف وضعیت پذیرش
              </a>
            </li>
            <li>
              <a href="<?php echo URLROOT; ?>/kaars"
                class="pr-14 pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
                گزارش کار انجام شده </a>
            </li>
          </ul>
        </li>

      </ul>
    </div>
    <!-- Sidebar -->
  </div>
</div>
<!-- Left Sidebar End -->