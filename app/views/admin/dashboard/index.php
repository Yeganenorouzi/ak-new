<?php require_once(APPROOT . "/views/public/header.php"); ?>
<?php require_once(APPROOT . "/views/public/sidebar.php"); ?>


<div class="main-content ">
  <div class="page-content dark:bg-zinc-700">
    <div class="container-fluid px-[0.625rem]">

      <div class="grid grid-cols-1 mb-5">
        <div class="flex items-center justify-between">
          <h4 class="mb-sm-0 text-lg font-semibold grow text-gray-800 dark:text-gray-100">داشبورد</h4>
          <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 ltr:md:space-x-3 rtl:md:space-x-0">
              <li class="inline-flex items-center">
                <a href="<?php echo URLROOT; ?>/admin/dashboard/index.php" class="inline-flex items-center text-sm font-medium text-gray-800 hover:text-gray-900 dark:text-zinc-100 dark:hover:text-white">
                  داشبورد
                </a>
              </li>
              <li>
                <div class="flex items-center">
                  <svg class="w-4 h-4 text-gray-400 -rotate-180" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                  </svg>
                  <a href="#" class="ltr:ml-1 rtl:mr-1 text-sm font-medium text-gray-500 hover:text-gray-900 ltr:md:ml-2 rtl:md:mr-2 dark:text-gray-100 dark:hover:text-white">داشبورد</a>
                </div>
              </li>
            </ol>
          </nav>
        </div>
      </div>

      <main class="w-3/4 p-8">

        <!-- cards  -->
        <div class="grid grid-cols-4 gap-6 mb-8">
          <div class="bg-white rounded-lg shadow p-6 text-center">
            <h3 class="text-lg font-semibold">تعداد کل پذیرش ها</h3>
            <p class="text-2xl font-bold text-blue-600 mt-2">۱۵۰</p>
          </div>
          <div class="bg-white rounded-lg shadow p-6 text-center">
            <h3 class="text-lg font-semibold">گوشی‌های در انتظار بررسی</h3>
            <p class="text-2xl font-bold text-yellow-600 mt-2">۴۵</p>
          </div>
          <div class="bg-white rounded-lg shadow p-6 text-center">
            <h3 class="text-lg font-semibold">گوشی‌های تعمیر شده</h3>
            <p class="text-2xl font-bold text-green-600 mt-2">۱۰۵</p>
          </div>
          <div class="bg-white rounded-lg shadow p-6 text-center">
            <h3 class="text-lg font-semibold">گوشی‌های آماده تحویل </h3>
            <p class="text-2xl font-bold text-green-600 mt-2">50</p>
          </div>

        </div>

        <!-- end cards -->

      

      </main>



<?php require_once(APPROOT . "/views/public/footer.php"); ?>