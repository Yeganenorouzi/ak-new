<?php require_once(APPROOT . "/views/public/header.php"); ?>
<?php require_once(APPROOT . "/views/public/sidebar.php"); ?>

<div class="min-h-screen flex flex-col">
    <div class="flex-1 main-content mr-[240px]">
        <div class="page-content dark:bg-zinc-700">
            <div class="container-fluid px-[0.625rem]">
                <div class="col-span-12 xl:col-span-6">
                    <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                        <div class="card-header p-4">
                            <h3 class="card-title mb-sm-0 text-lg font-semibold grow text-gray-800 dark:text-gray-100">
                                لیست کارت‌های گارانتی</h3>
                        </div>
                        <div class="card-body">
                            <div class="card-body p-0 mb-4">
                                <div
                                    class="bg-white dark:bg-zinc-800 border border-gray-200 dark:border-zinc-700 rounded-lg shadow-sm p-3 flex flex-col items-center">
                                    <form action="<?php echo URLROOT; ?>/cards/applyFilters" method="POST"
                                        class="filter-form w-full max-w-4xl grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 items-end">
                                        <div class="form-group flex flex-col">
                                            <label for="serial"
                                                class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">سریال
                                                اول دستگاه</label>
                                            <input type="text" id="serial" name="serial"
                                                value="<?php echo isset($data['filters']['serial']) ? $data['filters']['serial'] : ''; ?>"
                                                class="w-full h-8 text-xs rounded-md border-gray-300 shadow-sm focus:border-violet-500 focus:ring-violet-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white px-2">
                                        </div>
                                        <div class="form-group flex flex-col">
                                            <label for="sh_sanad"
                                                class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">شماره
                                                سند</label>
                                            <input type="text" id="sh_sanad" name="sh_sanad"
                                                value="<?php echo isset($data['filters']['sh_sanad']) ? $data['filters']['sh_sanad'] : ''; ?>"
                                                class="w-full h-8 text-xs rounded-md border-gray-300 shadow-sm focus:border-violet-500 focus:ring-violet-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white px-2">
                                        </div>
                                        <div class="form-group flex flex-col">
                                            <label for="model"
                                                class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">مدل
                                                دستگاه</label>
                                            <input type="text" id="model" name="model"
                                                value="<?php echo isset($data['filters']['model']) ? $data['filters']['model'] : ''; ?>"
                                                class="w-full h-8 text-xs rounded-md border-gray-300 shadow-sm focus:border-violet-500 focus:ring-violet-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white px-2">
                                        </div>
                                        <div></div>
                                        <div class="form-group flex flex-col">
                                            <label for="serial2"
                                                class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">سریال
                                                دوم دستگاه</label>
                                            <input type="text" id="serial2" name="serial2"
                                                value="<?php echo isset($data['filters']['serial2']) ? $data['filters']['serial2'] : ''; ?>"
                                                class="w-full h-8 text-xs rounded-md border-gray-300 shadow-sm focus:border-violet-500 focus:ring-violet-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white px-2">
                                        </div>
                                        <div class="form-group flex flex-col">
                                            <label for="company"
                                                class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">شرکت
                                                وارد کننده</label>
                                            <input type="text" id="company" name="company"
                                                value="<?php echo isset($data['filters']['company']) ? $data['filters']['company'] : ''; ?>"
                                                class="w-full h-8 text-xs rounded-md border-gray-300 shadow-sm focus:border-violet-500 focus:ring-violet-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white px-2">
                                        </div>
                                        <div
                                            class="col-span-1 sm:col-span-2 lg:col-span-4 flex flex-wrap gap-2 justify-end mt-2">
                                            <button type="submit"
                                                class="inline-flex items-center px-3 py-1 bg-violet-600 text-white rounded-md hover:bg-violet-700 text-xs">
                                                <i class="fas fa-filter ml-2"></i>
                                                اعمال فیلتر
                                            </button>
                                            <a href="<?php echo URLROOT; ?>/cards/index"
                                                class="inline-flex items-center px-3 py-1 bg-gray-500 text-white rounded-md hover:bg-gray-600 text-xs">
                                                <i class="fas fa-times ml-2"></i>
                                                پاک کردن فیلترها
                                            </a>
                                            <a href="<?php echo URLROOT; ?>/export/exportcards"
                                                class="inline-flex items-center px-3 py-1 bg-green-600 text-white rounded-md hover:bg-green-700 text-xs">
                                                <i class="fas fa-file-excel ml-2"></i>
                                                دانلود خروجی اکسل
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="relative overflow-x-auto rounded-lg">
                                    <table class="w-full text-sm text-right text-gray-500">
                                        <thead
                                            class="text-xs text-gray-700 dark:text-gray-100 uppercase bg-gray-50/50 dark:bg-zinc-700/50">
                                            <tr>
                                                <th scope="col" class="px-4 py-3">سریال اول دستگاه</th>
                                                <th scope="col" class="px-6 py-3">سریال دوم دستگاه</th>
                                                <th scope="col" class="px-6 py-3">مدل دستگاه</th>
                                                <th scope="col" class="px-6 py-3">شرکت وارد کننده</th>
                                                <th scope="col" class="px-6 py-3">شماره سند</th>
                                                <th scope="col" class="px-6 py-3">تاریخ صدور </th>
                                                <th scope="col" class="px-6 py-3">تاریخ انقضا </th>
                                                <th scope="col" class="px-6 py-3">وضعیت تایید</th>
                                                <th scope="col" class="px-6 py-3">عملیات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (empty($data['cards'])): ?>
                                                <tr
                                                    class="bg-white border-b border-gray-100 dark:bg-zinc-700 dark:border-zinc-600">
                                                    <td colspan="10"
                                                        class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                                        هیچ نتیجه‌ای یافت نشد
                                                    </td>
                                                </tr>
                                            <?php else: ?>
                                                <?php foreach ($data['cards'] as $item): ?>
                                                    <tr
                                                        class="bg-white border-b border-gray-100 hover:bg-gray-50/50 dark:bg-zinc-700 dark:hover:bg-zinc-700/50 dark:border-zinc-600">
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
                                                            <?php if ($item->approved == 1): ?>
                                                                <span
                                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                                    <i class="fas fa-check-circle ml-1"></i>
                                                                    تایید شده
                                                                </span>
                                                            <?php else: ?>
                                                                <span
                                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                                                    <i class="fas fa-clock ml-1"></i>
                                                                    در انتظار تایید
                                                                </span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            <div class="flex flex-row gap-2">
                                                                <?php if ($item->approved == 0): ?>
                                                                    <button onclick="approveCard(<?php echo $item->id; ?>)"
                                                                        class="font-medium text-green-600 dark:text-green-500 hover:underline cursor-pointer">
                                                                        <i class="fas fa-check ml-1"></i>تایید
                                                                    </button>
                                                                <?php else: ?>
                                                                    <button onclick="rejectCard(<?php echo $item->id; ?>)"
                                                                        class="font-medium text-orange-600 dark:text-orange-500 hover:underline cursor-pointer">
                                                                        <i class="fas fa-times ml-1"></i>لغو تایید
                                                                    </button>
                                                                <?php endif; ?>
                                                                <a href="<?php echo URLROOT; ?>/cards/update/<?php echo $item->id; ?>"
                                                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">ویرایش</a>
                                                                <a href="javascript:void(0);"
                                                                    onclick="confirmDelete('<?php echo URLROOT; ?>/cards/delete/<?php echo $item->id; ?>', '<?php echo $item->serial; ?>', '<?php echo $item->model; ?>')"
                                                                    class="font-medium text-red-600 dark:text-red-500 hover:underline">حذف</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php if (isset($data['totalPages']) && $data['totalPages'] > 1): ?>
                <div
                    class="flex items-center justify-between mt-4 px-4 py-3 bg-white dark:bg-zinc-800 border-t border-gray-200 dark:border-zinc-700 sm:px-6">
                    <div class="flex-1 flex justify-between sm:hidden">
                        <?php if ($data['currentPage'] > 1): ?>
                            <a href="<?php echo URLROOT; ?>/cards/index/<?php echo $data['currentPage'] - 1; ?><?php echo !empty($data['filters']) ? '?' . http_build_query($data['filters']) : ''; ?>"
                                class="relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-zinc-600 text-sm font-medium rounded-md text-gray-700 dark:text-gray-200 bg-white dark:bg-zinc-700 hover:bg-gray-50 dark:hover:bg-zinc-600">
                                قبلی
                            </a>
                        <?php endif; ?>
                        <?php if ($data['currentPage'] < $data['totalPages']): ?>
                            <a href="<?php echo URLROOT; ?>/cards/index/<?php echo $data['currentPage'] + 1; ?><?php echo !empty($data['filters']) ? '?' . http_build_query($data['filters']) : ''; ?>"
                                class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-zinc-600 text-sm font-medium rounded-md text-gray-700 dark:text-gray-200 bg-white dark:bg-zinc-700 hover:bg-gray-50 dark:hover:bg-zinc-600">
                                بعدی
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <!-- اگر نمی‌خواهی متن نمایش بازه را نشان بدهی، این div را خالی بگذار یا حذف کن -->
                        </div>
                        <div>
                            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                <?php if ($data['currentPage'] > 1): ?>
                                    <a href="<?php echo URLROOT; ?>/cards/index/<?php echo $data['currentPage'] - 1; ?><?php echo !empty($data['filters']) ? '?' . http_build_query($data['filters']) : ''; ?>"
                                        class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-sm font-medium text-gray-500 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-zinc-600">
                                        <span class="sr-only">قبلی</span>
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                <?php endif; ?>
                                <?php
                                $range = 2;
                                $start = max(1, $data['currentPage'] - $range);
                                $end = min($data['totalPages'], $data['currentPage'] + $range);
                                if ($start > 1) {
                                    echo '<a href="' . URLROOT . '/cards/index/1' . (!empty($data['filters']) ? '?' . http_build_query($data['filters']) : '') . '" 
                                        class="relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-zinc-600 text-sm font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-zinc-700 hover:bg-gray-50 dark:hover:bg-zinc-600">
                                        1
                                      </a>';
                                    if ($start > 2) {
                                        echo '<span class="relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-sm font-medium text-gray-700 dark:text-gray-200">
                                            ...
                                          </span>';
                                    }
                                }
                                for ($i = $start; $i <= $end; $i++) {
                                    if ($i == $data['currentPage']) {
                                        echo '<span class="relative inline-flex items-center px-4 py-2 border border-violet-500 bg-violet-50 dark:bg-violet-900/20 text-sm font-medium text-violet-600 dark:text-violet-400">
                                            ' . $i . '
                                          </span>';
                                    } else {
                                        echo '<a href="' . URLROOT . '/cards/index/' . $i . (!empty($data['filters']) ? '?' . http_build_query($data['filters']) : '') . '" 
                                            class="relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-zinc-600 text-sm font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-zinc-700 hover:bg-gray-50 dark:hover:bg-zinc-600">
                                            ' . $i . '
                                          </a>';
                                    }
                                }
                                if ($end < $data['totalPages']) {
                                    if ($end < $data['totalPages'] - 1) {
                                        echo '<span class="relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-sm font-medium text-gray-700 dark:text-gray-200">
                                            ...
                                          </span>';
                                    }
                                    echo '<a href="' . URLROOT . '/cards/index/' . $data['totalPages'] . (!empty($data['filters']) ? '?' . http_build_query($data['filters']) : '') . '" 
                                        class="relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-zinc-600 text-sm font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-zinc-700 hover:bg-gray-50 dark:hover:bg-zinc-600">
                                        ' . $data['totalPages'] . '
                                      </a>';
                                }
                                ?>
                                <?php if ($data['currentPage'] < $data['totalPages']): ?>
                                    <a href="<?php echo URLROOT; ?>/cards/index/<?php echo $data['currentPage'] + 1; ?><?php echo !empty($data['filters']) ? '?' . http_build_query($data['filters']) : ''; ?>"
                                        class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-sm font-medium text-gray-500 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-zinc-600">
                                        <span class="sr-only">بعدی</span>
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                <?php endif; ?>
                            </nav>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
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
                width: '500px',
                customClass: {
                    title: 'text-sm',
                    content: 'text-xs',
                    confirmButton: 'text-xs',
                    cancelButton: 'text-xs'
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

        // Approve Card
        function approveCard(cardId) {
            Swal.fire({
                title: 'تایید کارت گارانتی',
                text: 'آیا از تایید این کارت گارانتی مطمئن هستید؟',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#10b981',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'بله، تایید کن',
                cancelButtonText: 'انصراف',
                customClass: {
                    popup: 'rtl-alert'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('<?php echo URLROOT; ?>/cards/approve', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: 'card_id=' + cardId
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                Swal.fire({
                                    title: 'موفق',
                                    text: data.message,
                                    icon: 'success',
                                    confirmButtonText: 'باشه'
                                }).then(() => {
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire({
                                    title: 'خطا',
                                    text: data.message,
                                    icon: 'error',
                                    confirmButtonText: 'باشه'
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                title: 'خطا',
                                text: 'خطا در برقراری ارتباط با سرور',
                                icon: 'error',
                                confirmButtonText: 'باشه'
                            });
                        });
                }
            });
        }

        // Reject Card
        function rejectCard(cardId) {
            Swal.fire({
                title: 'لغو تایید کارت گارانتی',
                text: 'آیا از لغو تایید این کارت گارانتی مطمئن هستید؟',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'بله، لغو تایید کن',
                cancelButtonText: 'انصراف',
                customClass: {
                    popup: 'rtl-alert'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('<?php echo URLROOT; ?>/cards/reject', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: 'card_id=' + cardId
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                Swal.fire({
                                    title: 'موفق',
                                    text: data.message,
                                    icon: 'success',
                                    confirmButtonText: 'باشه'
                                }).then(() => {
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire({
                                    title: 'خطا',
                                    text: data.message,
                                    icon: 'error',
                                    confirmButtonText: 'باشه'
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                title: 'خطا',
                                text: 'خطا در برقراری ارتباط با سرور',
                                icon: 'error',
                                confirmButtonText: 'باشه'
                            });
                        });
                }
            });
        }
    </script>

    <?php require_once(APPROOT . "/views/public/footer.php"); ?>
</div>