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

  /* Ensure MetisMenu works properly */
  .metismenu .mm-collapse {
    display: none;
  }

  .metismenu .mm-collapse.mm-show {
    display: block !important;
  }

  .metismenu .mm-collapsing {
    position: relative;
    height: 0;
    overflow: hidden;
    transition: height 0.35s ease;
  }
</style>

<div
  class="vertical-menu rtl:right-0 fixed ltr:left-0 bottom-0 top-16 h-screen border-r bg-slate-50 border-gray-50 print:hidden dark:bg-zinc-800 dark:border-neutral-700 z-10">

  <div data-simplebar class="h-full">
    <!--- Sidemenu -->
    <div id="sidebar-menu">
      <!-- Left Menu Start -->
      <ul class="metismenu" id="side-menu">
        <li class="menu-heading px-4 py-3.5 text-xs font-medium text-gray-500 cursor-default" data-key="t-menu"> منو
        </li>

        <li>
          <a href="<?php echo URLROOT . "/dashboard/agent" ?> "
            class="pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
            <i data-feather="home"></i>
            <span data-key="t-dashboard"> داشبورد</span>
          </a>
        </li>

        <li>
          <a href="<?php echo URLROOT . "/customers/agent" ?>"
            class="pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
            <i data-feather="users"></i>
            <span data-key="t-users"> مشتریان </span>
          </a>
        </li>

        <li>
          <a href="javascript: void(0);" aria-expanded="false"
            class="nav-menu pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
            <i data-feather="briefcase"></i>
            <span data-key="t-pages"> پذیرش ها</span>
          </a>
          <ul>
            <li>
              <a href="<?php echo URLROOT . "/receptions/agent" ?>"
                class="pr-14 pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">لیست
                پذیرش ها</a>
            </li>
            <li>
              <a href="<?php echo URLROOT . "/receptions/create" ?>"
                class="pr-14 pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">افزودن
                پذیرش جدید </a>
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
              <a href="<?php echo URLROOT . "/tickets/agent" ?>"
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


      </ul>
    </div>
    <!-- Sidebar -->
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    // همه آیتم‌های منو که زیرمنو دارند
    const navMenus = document.querySelectorAll('.nav-menu');

    navMenus.forEach(function (menu) {
      menu.addEventListener('click', function (e) {
        e.preventDefault();

        // همه زیرمنوها را ببند
        document.querySelectorAll('.nav-menu + ul').forEach(function (submenu) {
          submenu.style.display = 'none';
        });

        // اگر زیرمنوی فعلی باز نبود، بازش کن
        const submenu = this.nextElementSibling;
        if (submenu && submenu.style.display !== 'block') {
          submenu.style.display = 'block';
        }
      });
    });

    // در ابتدا همه زیرمنوها بسته باشند
    document.querySelectorAll('.nav-menu + ul').forEach(function (submenu) {
      submenu.style.display = 'none';
    });
  });
</script>

<!-- Left Sidebar End -->