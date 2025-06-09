<?php require_once(APPROOT . "/views/public/header.php"); ?>
<?php require_once(APPROOT . "/views/public/sidebar.php"); ?>

<div class="main-content">
    <div class="page-content dark:bg-zinc-700">
        <div class="container-fluid px-[0.625rem]">
            <div class="col-span-12 xl:col-span-6">
                <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                    <!-- فرم فیلتر هوشمند -->
                    <div class="card-header p-4 border-b border-gray-100 dark:border-zinc-600">
                        <h5 class="mb-0 text-lg font-semibold text-gray-900 dark:text-white">فیلتر هوشمند کارت‌های
                            گارانتی</h5>
                    </div>
                    <div class="card-body p-4">
                        <form action="<?php echo URLROOT; ?>/cards/applyFilters" method="POST" class="filter-form">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
                                <!-- فیلترهای متنی -->
                                <div class="form-group">
                                    <label for="serial"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">سریال
                                        اول دستگاه</label>
                                    <input type="text" id="serial" name="serial"
                                        value="<?php echo isset($data['filters']['serial']) ? $data['filters']['serial'] : ''; ?>"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-violet-500 focus:border-violet-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white">
                                </div>

                                <div class="form-group">
                                    <label for="serial2"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">سریال
                                        دوم دستگاه</label>
                                    <input type="text" id="serial2" name="serial2"
                                        value="<?php echo isset($data['filters']['serial2']) ? $data['filters']['serial2'] : ''; ?>"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-violet-500 focus:border-violet-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white">
                                </div>

                                <div class="form-group">
                                    <label for="model"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">مدل
                                        دستگاه</label>
                                    <input type="text" id="model" name="model"
                                        value="<?php echo isset($data['filters']['model']) ? $data['filters']['model'] : ''; ?>"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-violet-500 focus:border-violet-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white">
                                </div>

                                <div class="form-group">
                                    <label for="company"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">شرکت
                                        وارد کننده</label>
                                    <input type="text" id="company" name="company"
                                        value="<?php echo isset($data['filters']['company']) ? $data['filters']['company'] : ''; ?>"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-violet-500 focus:border-violet-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white">
                                </div>

                                <div class="form-group">
                                    <label for="sh_sanad"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">شماره
                                        سند</label>
                                    <input type="text" id="sh_sanad" name="sh_sanad"
                                        value="<?php echo isset($data['filters']['sh_sanad']) ? $data['filters']['sh_sanad'] : ''; ?>"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-violet-500 focus:border-violet-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white">
                                </div>


                                <!-- دکمه‌های عملیات -->
                                <div class="flex flex-wrap gap-3 items-center justify-between mt-4">
                                    <!-- دکمه‌های فیلتر -->
                                    <div class="flex flex-wrap gap-2">
                                        <button type="submit"
                                            class="inline-flex items-center px-4 py-2 bg-violet-600 text-white rounded-md hover:bg-violet-700 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:ring-offset-2">
                                            <i class="fas fa-filter ml-2"></i>
                                            اعمال فیلتر
                                        </button>
                                        <a href="<?php echo URLROOT; ?>/cards/index"
                                            class="inline-flex items-center px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                                            <i class="fas fa-times ml-2"></i>
                                            پاک کردن فیلترها
                                        </a>
                                    </div>

                                    <!-- دکمه خروجی اکسل -->
                                    <a href="<?php echo URLROOT; ?>/export/exportcards"
                                        class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                        <i class="fas fa-file-excel ml-2"></i>
                                        دانلود خروجی اکسل
                                    </a>
                                </div>
                        </form>
                    </div>

                    <div class="card-body">
                        <div class="relative overflow-x-auto rounded-lg">
                            <table class="w-full text-sm text-right text-gray-500">
                                <thead
                                    class="text-xs text-gray-700 dark:text-gray-100 uppercase bg-gray-50/50 dark:bg-zinc-700/50">
                                    <tr>
                                        <th scope="col" class="p-4">
                                            <div class="flex items-center">
                                                <input id="checkbox-all" type="checkbox"
                                                    class="w-4 h-4 focus:ring-0 focus:outline-0 border-gray-100 focus:ring-offset-0 rounded dark:bg-zinc-700 dark:border-zinc-500 dark:checked:bg-violet-500">
                                                <label for="checkbox-all" class="sr-only">چک باکس</label>
                                            </div>
                                        </th>
                                        <th scope="col" class="px-4 py-3">سریال اول دستگاه</th>
                                        <th scope="col" class="px-6 py-3">سریال دوم دستگاه</th>
                                        <th scope="col" class="px-6 py-3">مدل دستگاه</th>
                                        <th scope="col" class="px-6 py-3">شرکت وارد کننده</th>
                                        <th scope="col" class="px-6 py-3">شماره سند</th>
                                        <th scope="col" class="px-6 py-3">تاریخ صدور کارت گارانتی</th>
                                        <th scope="col" class="px-6 py-3">تاریخ انقضا کارت گارانتی</th>
                                        <th scope="col" class="px-6 py-3">عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($data['cards'])): ?>
                                        <tr class="bg-white border-b border-gray-100 dark:bg-zinc-700 dark:border-zinc-600">
                                            <td colspan="9" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                                هیچ نتیجه‌ای یافت نشد
                                            </td>
                                        </tr>
                                    <?php else: ?>
                                        <?php foreach ($data['cards'] as $item): ?>
                                            <tr
                                                class="bg-white border-b border-gray-100 hover:bg-gray-50/50 dark:bg-zinc-700 dark:hover:bg-zinc-700/50 dark:border-zinc-600">
                                                <td class="w-4 p-4">
                                                    <div class="flex items-center">
                                                        <input id="checkbox" type="checkbox"
                                                            class="w-4 h-4 focus:ring-0 focus:outline-0 border-gray-100 focus:ring-offset-0 rounded dark:bg-zinc-700 dark:border-zinc-500 dark:checked:bg-violet-500">
                                                        <label for="checkbox" class="sr-only">چک باکس</label>
                                                    </div>
                                                </td>
                                                <th scope="row"
                                                    class="px-4 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    <?php echo $item->serial; ?>
                                                </th>
                                                <td class="px-6 py-4"><?php echo $item->serial2; ?></td>
                                                <td class="px-6 py-4"><?php echo $item->model; ?></td>
                                                <td class="px-6 py-4"><?php echo $item->company; ?></td>
                                                <td class="px-6 py-4"><?php echo $item->sh_sanad; ?></td>
                                                <td class="px-6 py-4"><?php echo $item->start_guarantee; ?></td>
                                                <td class="px-6 py-4"><?php echo $item->expite_guarantee; ?></td>
                                                <td class="px-6 py-4">
                                                    <a href="<?php echo URLROOT; ?>/cards/update/<?php echo $item->id; ?>"
                                                        style="background-color: #24a0ed;"
                                                        class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-white rounded-md hover:brightness-110 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 transition-colors duration-200 ml-2">
                                                        <i class="fas fa-edit ml-1"></i>ویرایش
                                                    </a>
                                                    <a href="javascript:void(0);"
                                                        onclick="confirmDelete('<?php echo URLROOT; ?>/cards/delete/<?php echo $item->id; ?>', '<?php echo $item->serial; ?>', '<?php echo $item->model; ?>')"
                                                        class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-white bg-red-500 rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors duration-200">
                                                        <i class="fas fa-trash ml-1"></i>حذف
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="flex justify-center items-center pt-4">
                            <nav aria-label="مثال صفحه‌بندی">
                                <ul class="flex list-style-none">
                                    <li
                                        class="border ltr:rounded-l rtl:rounded-r ltr:border-r-0 rtl:border-l-0 dark:border-zinc-600 <?php echo ($data['currentPage'] <= 1) ? 'opacity-50 pointer-events-none' : ''; ?>">
                                        <a class="page-link relative block py-2 px-4 border-0 bg-transparent outline-none transition-all duration-300 text-gray-500 hover:text-violet-500 focus:shadow-none dark:text-zinc-100 dark:hover:bg-zinc-600 hover:bg-gray-50/50"
                                            href="<?php echo URLROOT; ?>/cards/index/<?php echo $data['currentPage'] - 1; ?><?php echo !empty($data['filters']) ? '?' . http_build_query($data['filters']) : ''; ?>">قبلی</a>
                                    </li>

                                    <!-- صفحه اول -->
                                    <li
                                        class="border <?php echo (1 == $data['currentPage']) ? 'border-violet-500 bg-violet-100' : 'dark:border-zinc-600'; ?>">
                                        <a class="page-link relative block py-2 px-4 border-0 bg-transparent outline-none transition-all duration-300 <?php echo (1 == $data['currentPage']) ? 'text-violet-500' : 'text-gray-500'; ?> hover:text-violet-500 hover:bg-gray-50/50 focus:shadow-none dark:text-zinc-100 dark:hover:bg-zinc-600"
                                            href="<?php echo URLROOT; ?>/cards/index/1<?php echo !empty($data['filters']) ? '?' . http_build_query($data['filters']) : ''; ?>">1</a>
                                    </li>

                                    <?php if ($data['currentPage'] > 3): ?>
                                        <li class="border dark:border-zinc-600">
                                            <span
                                                class="page-link relative block py-2 px-4 border-0 bg-transparent outline-none text-gray-500 dark:text-zinc-100">...</span>
                                        </li>
                                    <?php endif; ?>

                                    <?php
                                    $start = max(2, $data['currentPage'] - 1);
                                    $end = min($data['totalPages'] - 1, $data['currentPage'] + 1);

                                    for ($i = $start; $i <= $end; $i++):
                                        ?>
                                        <li
                                            class="border <?php echo ($i == $data['currentPage']) ? 'border-violet-500 bg-violet-100' : 'dark:border-zinc-600'; ?> border-l-0 rtl:border-l">
                                            <a class="page-link relative block py-2 px-4 border-0 bg-transparent outline-none transition-all duration-300 <?php echo ($i == $data['currentPage']) ? 'text-violet-500' : 'text-gray-500'; ?> hover:text-violet-500 hover:bg-gray-50/50 focus:shadow-none dark:text-zinc-100 dark:hover:bg-zinc-600"
                                                href="<?php echo URLROOT; ?>/cards/index/<?php echo $i; ?><?php echo !empty($data['filters']) ? '?' . http_build_query($data['filters']) : ''; ?>"><?php echo $i; ?></a>
                                        </li>
                                    <?php endfor; ?>

                                    <?php if ($data['currentPage'] < $data['totalPages'] - 2): ?>
                                        <li class="border dark:border-zinc-600 border-l-0 rtl:border-l">
                                            <span
                                                class="page-link relative block py-2 px-4 border-0 bg-transparent outline-none text-gray-500 dark:text-zinc-100">...</span>
                                        </li>
                                    <?php endif; ?>

                                    <!-- صفحه آخر -->
                                    <?php if ($data['totalPages'] > 1): ?>
                                        <li
                                            class="border <?php echo ($data['totalPages'] == $data['currentPage']) ? 'border-violet-500 bg-violet-100' : 'dark:border-zinc-600'; ?> border-l-0 rtl:border-l">
                                            <a class="page-link relative block py-2 px-4 border-0 bg-transparent outline-none transition-all duration-300 <?php echo ($data['totalPages'] == $data['currentPage']) ? 'text-violet-500' : 'text-gray-500'; ?> hover:text-violet-500 hover:bg-gray-50/50 focus:shadow-none dark:text-zinc-100 dark:hover:bg-zinc-600"
                                                href="<?php echo URLROOT; ?>/cards/index/<?php echo $data['totalPages']; ?><?php echo !empty($data['filters']) ? '?' . http_build_query($data['filters']) : ''; ?>"><?php echo $data['totalPages']; ?></a>
                                        </li>
                                    <?php endif; ?>

                                    <li
                                        class="border ltr:rounded-r rtl:rounded-l dark:border-zinc-600 border-l-0 rtl:border-l <?php echo ($data['currentPage'] >= $data['totalPages']) ? 'opacity-50 pointer-events-none' : ''; ?>">
                                        <a class="page-link relative block py-2 px-4 border-0 bg-transparent outline-none transition-all duration-300 text-gray-500 hover:text-violet-500 hover:bg-gray-50/50 focus:shadow-none dark:text-zinc-100 dark:hover:bg-zinc-600"
                                            href="<?php echo URLROOT; ?>/cards/index/<?php echo $data['currentPage'] + 1; ?><?php echo !empty($data['filters']) ? '?' . http_build_query($data['filters']) : ''; ?>">بعدی</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete(deleteUrl, serial, model) {
        Swal.fire({
            title: 'آیا مطمئن هستید؟',
            text: 'آیا می‌خواهید کارت گارانتی با مشخصات زیر را حذف کنید؟\nسریال: \n ' + serial + '\nمدل دستگاه:  ' + model,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'بله، حذف شود',
            cancelButtonText: 'انصراف',
            showCloseButton: true,
            width: '500px', // افزایش عرض مودال
            customClass: {
                title: 'text-sm', // کاهش سایز فونت عنوان
                content: 'text-xs', // کاهش سایز فونت محتوا
                confirmButton: 'text-xs', // کاهش سایز فونت دکمه تایید
                cancelButton: 'text-xs' // کاهش سایز فونت دکمه انصراف
            }
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = deleteUrl;
            }
        });
    }

    // اضافه کردن اسکریپت برای انتخاب همه چک‌باکس‌ها
    document.addEventListener('DOMContentLoaded', function () {
        const checkboxAll = document.getElementById('checkbox-all');
        const checkboxes = document.querySelectorAll('tbody input[type="checkbox"]');

        if (checkboxAll) {
            checkboxAll.addEventListener('change', function () {
                checkboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
            });
        }
    });
</script>

<?php require_once(APPROOT . "/views/public/footer.php"); ?>