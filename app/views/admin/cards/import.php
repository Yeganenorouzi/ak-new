<?php require_once(APPROOT . "/views/public/header.php"); ?>
<?php require_once(APPROOT . "/views/public/sidebar.php"); ?>

<div class="main-content">
    <div class="page-content dark:bg-zinc-700">
        <div class="grid grid-cols-1 mb-5">
            <div class="flex items-center justify-between">
                <h4 class="mb-sm-0 text-lg font-semibold grow text-gray-800 dark:text-gray-100">وارد کردن کارت‌های گارانتی از فایل اکسل</h4>
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 ltr:md:space-x-3 rtl:md:space-x-0">
                        <li class="inline-flex items-center">
                            <a href="<?php echo URLROOT; ?>/cards" class="inline-flex items-center text-sm font-medium text-gray-800 hover:text-gray-900 dark:text-zinc-100 dark:hover:text-white">
                                کارت گارانتی ها
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 text-gray-400 -rotate-180" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <a href="#" class="ltr:ml-1 rtl:mr-1 text-sm font-medium text-gray-500 hover:text-gray-900 ltr:md:ml-2 rtl:md:mr-2 dark:text-gray-100 dark:hover:text-white">وارد کردن از اکسل</a>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <?php if (isset($data['success']) && $data['success']): ?>
            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                <p><?php echo $data['message']; ?></p>
            </div>
        <?php endif; ?>

        <?php if (!empty($data['errors'])): ?>
            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                <?php foreach ($data['errors'] as $error): ?>
                    <p><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1">
            <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                <div class="card-body">
                    <div class="mb-4">
                        <h5 class="text-lg font-medium text-gray-700 dark:text-gray-100 mb-2">راهنمای وارد کردن کارت‌های گارانتی از فایل اکسل</h5>
                        <p class="text-gray-600 dark:text-gray-300 mb-4">
                            برای وارد کردن کارت‌های گارانتی از فایل اکسل، لطفاً مراحل زیر را دنبال کنید:
                        </p>
                        <ol class="list-decimal list-inside text-gray-600 dark:text-gray-300 mb-4">
                            <li class="mb-2">قالب نمونه را دانلود کنید.</li>
                            <li class="mb-2">اطلاعات کارت‌های گارانتی را در قالب وارد کنید.</li>
                            <li class="mb-2">فایل اکسل را در فرم زیر آپلود کنید.</li>
                            <li class="mb-2">دکمه "وارد کردن" را کلیک کنید.</li>
                        </ol>
                        <div class="mb-4">
                            <a href="<?php echo URLROOT; ?>/cards/downloadTemplate" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none">
                                دانلود قالب نمونه
                            </a>
                        </div>
                    </div>

                    <form action="<?php echo URLROOT; ?>/cards/import" method="POST" enctype="multipart/form-data" class="max-w-2xl">
                        <div class="mb-4">
                            <label for="excel_file" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">انتخاب فایل اکسل</label>
                            <input 
                                type="file" 
                                name="excel_file" 
                                id="excel_file"
                                accept=".xlsx,.xls" 
                                class="w-full text-gray-700 dark:text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100 dark:file:bg-zinc-700 dark:file:text-zinc-100"
                                required
                            />
                        </div>
                        
                        <div class="mt-6 flex gap-4">
                            <button type="submit" class="px-5 py-2.5 bg-violet-500 text-white rounded hover:bg-violet-600 focus:outline-none">
                                وارد کردن
                            </button>
                            <a href="<?php echo URLROOT; ?>/cards" class="px-5 py-2.5 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 focus:outline-none">
                                انصراف
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once(APPROOT . "/views/public/footer.php"); ?>