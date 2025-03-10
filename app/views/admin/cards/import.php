<?php require_once(APPROOT . "/views/public/header.php"); ?>
<?php require_once(APPROOT . "/views/public/sidebar.php"); ?>

<div class="main-content">
    <div class="page-content dark:bg-zinc-700">
        <div class="grid grid-cols-1 mb-5">
            <div class="flex items-center justify-between">
                <h4 class="mb-sm-0 text-lg font-semibold grow text-gray-800 dark:text-gray-100">تعریف کاربر جدید</h4>
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 ltr:md:space-x-3 rtl:md:space-x-0">
                        <li class="inline-flex items-center">
                            <a href="#" class="inline-flex items-center text-sm font-medium text-gray-800 hover:text-gray-900 dark:text-zinc-100 dark:hover:text-white">
                                کارت گارانتی ها
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 text-gray-400 -rotate-180" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <a href="#" class="ltr:ml-1 rtl:mr-1 text-sm font-medium text-gray-500 hover:text-gray-900 ltr:md:ml-2 rtl:md:mr-2 dark:text-gray-100 dark:hover:text-white">تعریف کارت گارانتی جدید</a>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>


        <div class="grid grid-cols-1">
            <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                <div class="card-body">

                    <form action="<?php echo URLROOT; ?>/cards/import" method="POST" enctype="multipart/form-data">
                        <input type="file" name="excel_file" accept=".xlsx,.xls" />
                        <button type="submit">Upload</button>
                    </form>


                </div>

            </div>












            <?php require_once(APPROOT . "/views/public/footer.php"); ?>