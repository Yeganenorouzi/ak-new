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
          <a href="<?php echo URLROOT . "/dashboard/agent" ?> "
            class="pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
            <i data-feather="home"></i>
            <span data-key="t-dashboard"> داشبورد</span>
          </a>
        </li>

        <li>
          <a href="javascript: void(0);" aria-expanded="false"
            class="nav-menu pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
            <i data-feather="briefcase"></i>
            <span data-key="t-pages">پذیرش ها</span>
          </a>
          <ul>
            <li>
              <a href="<?php echo URLROOT . "/receptions/agent" ?>"
                class="pr-14 pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">لیست
                پذیرش ها </a>
            </li>
            <li>
              <a href="<?php echo URLROOT . "/receptions/create" ?>"
                class="pr-14 pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">افزودن
                پذیرش جدید</a>
            </li>
          </ul>
        </li>

        <li>
          <a href="javascript: void(0);" aria-expanded="false"
            class="nav-menu pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
            <i data-feather="gift"></i>
            <span data-key="t-extend">مشتریان </span>
          </a>
          <ul>
            <li>
              <a href="<?php echo URLROOT . "/customers/agent" ?>"
                class="pr-14 pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">لیست
                مشتریان </a>
            </li>
          </ul>
        </li>

        <li>
          <a href="javascript: void(0);" aria-expanded="false"
            class="nav-menu pl-6 pr-4 py-3 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">
            <i data-feather="sliders"></i>
            <span data-key="t-charts">تیکت ها</span>
          </a>
          <ul>
            <li>
              <a href="<?php echo URLROOT . "/tickets/agent" ?>"
                class="pr-14 pl-4 py-2 block text-[13.5px] font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">لیست
                تیکت ها </a>
            </li>
            <li>
              <a href="<?php echo URLROOT . "/tickets/create" ?>"
                class="pr-14 pl-4  py-2 block text-sm font-medium text-gray-700 transition-all duration-150 ease-linear hover:text-violet-500 dark:text-gray-300 dark:active:text-white dark:hover:text-white">ارسال
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
    // Override the default MetisMenu behavior to add session storage
    if (typeof MetisMenu !== 'undefined') {
      // Initialize MetisMenu with custom options
      const metisMenu = new MetisMenu('#side-menu', {
        toggle: true,
        parentTrigger: 'li',
        subMenu: 'ul'
      });

      // Save menu state to session storage
      function saveMenuState() {
        const openMenus = [];
        const activeMenus = document.querySelectorAll('#side-menu .mm-active');
        activeMenus.forEach(function (menu, index) {
          const menuLink = menu.querySelector('.nav-menu');
          if (menuLink) {
            const menuText = menuLink.querySelector('span').textContent.trim();
            openMenus.push(menuText);
          }
        });
        sessionStorage.setItem('openMenusAgent', JSON.stringify(openMenus));
      }

      // Restore menu state from session storage
      function restoreMenuState() {
        const savedMenus = sessionStorage.getItem('openMenusAgent');
        if (savedMenus) {
          try {
            const openMenus = JSON.parse(savedMenus);

            // Only keep the active page menu open, close others
            const currentUrl = window.location.href;
            let shouldKeepOpen = false;

            openMenus.forEach(function (menuText) {
              const menuItems = document.querySelectorAll('#side-menu .nav-menu');
              menuItems.forEach(function (menuItem) {
                const spanText = menuItem.querySelector('span').textContent.trim();
                if (spanText === menuText) {
                  const parentLi = menuItem.closest('li');
                  const submenu = parentLi.querySelector('ul');

                  if (submenu) {
                    // Check if any submenu item matches current URL
                    const submenuLinks = submenu.querySelectorAll('a');
                    submenuLinks.forEach(function (link) {
                      if (currentUrl.includes(link.href) || link.href.includes(currentUrl.split('?')[0])) {
                        shouldKeepOpen = true;
                      }
                    });

                    // Only keep open if it contains the active page
                    if (shouldKeepOpen) {
                      parentLi.classList.add('mm-active');
                      submenu.classList.add('mm-show');
                      menuItem.setAttribute('aria-expanded', 'true');
                    }
                  }
                }
              });
            });
          } catch (e) {
            console.error('Error restoring menu state:', e);
          }
        }
      }

      // Listen for menu toggle events
      document.addEventListener('click', function (e) {
        if (e.target.closest('.nav-menu')) {
          setTimeout(saveMenuState, 100);
        }
      });

      // Override the existing initActiveMenu function behavior
      setTimeout(function () {
        // First run the original active menu logic
        const menuItems = document.querySelectorAll("#sidebar-menu a");
        menuItems.forEach(function (item) {
          const pageUrl = window.location.href.split(/[?#]/)[0];

          if (item.href === pageUrl) {
            item.classList.add("active");
            let parentLi = item.closest('li');
            while (parentLi) {
              parentLi.classList.add("mm-active");
              const parentUl = parentLi.querySelector('ul');
              if (parentUl) {
                parentUl.classList.add("mm-show");
              }
              parentLi = parentLi.parentElement.closest('li');
            }
          }
        });

        // Then close other menus that shouldn't be open
        const currentUrl = window.location.href.split(/[?#]/)[0];
        const allMenuItems = document.querySelectorAll('#side-menu li.mm-active');

        allMenuItems.forEach(function (menuItem) {
          const submenu = menuItem.querySelector('ul');
          if (submenu) {
            let hasActiveChild = false;
            const submenuLinks = submenu.querySelectorAll('a');

            submenuLinks.forEach(function (link) {
              if (link.href === currentUrl) {
                hasActiveChild = true;
              }
            });

            // If this menu doesn't contain the active page, close it
            if (!hasActiveChild) {
              menuItem.classList.remove('mm-active');
              submenu.classList.remove('mm-show');
              const navMenu = menuItem.querySelector('.nav-menu');
              if (navMenu) {
                navMenu.setAttribute('aria-expanded', 'false');
              }
            }
          }
        });

        // Save the current state
        saveMenuState();
      }, 200);
    }
  });
</script>

<!-- Left Sidebar End -->