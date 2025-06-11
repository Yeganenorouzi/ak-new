<?php require_once(APPROOT . "/views/public/header.php"); ?>
<?php require_once(APPROOT . "/views/public/sidebar.php"); ?>

<div class="min-h-screen flex flex-col">
    <div class="flex-1 main-content mr-[240px]">
        <div class="page-content dark:bg-zinc-700">
            <div class="container-fluid px-[0.625rem]">
                <div class="col-span-12 xl:col-span-6">
                    <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                        <div class="card-header p-4">
                            <h3 class="card-title mb-sm-0 text-lg font-semibold grow text-gray-800 dark:text-gray-100 ">
                                لیست نمایندگان</h3>
                        </div>
                        <div class="card-body">
                            <div class="card-body p-0 mb-4">
                                <div
                                    class="bg-white dark:bg-zinc-800 border border-gray-200 dark:border-zinc-700 rounded-lg shadow-sm p-3 flex flex-col items-center">
                                    <form action="<?php echo URLROOT; ?>/users/indexAgents" method="GET"
                                        class="filter-form w-full max-w-4xl grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 items-end">
                                        <div class="form-group flex flex-col">
                                            <label for="name"
                                                class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">نام
                                                و نام خانوادگی</label>
                                            <input type="text" id="name" name="name"
                                                value="<?php echo isset($data['filters']['name']) ? $data['filters']['name'] : ''; ?>"
                                                class="w-full h-8 text-xs rounded-md border-gray-300 shadow-sm focus:border-violet-500 focus:ring-violet-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white px-2">
                                        </div>
                                        <div class="form-group flex flex-col">
                                            <label for="codemelli"
                                                class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">کد
                                                ملی</label>
                                            <input type="text" id="codemelli" name="codemelli"
                                                value="<?php echo isset($data['filters']['codemelli']) ? $data['filters']['codemelli'] : ''; ?>"
                                                class="w-full h-8 text-xs rounded-md border-gray-300 shadow-sm focus:border-violet-500 focus:ring-violet-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white px-2">
                                        </div>
                                        <div class="form-group flex flex-col">
                                            <label for="mobile"
                                                class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">موبایل</label>
                                            <input type="text" id="mobile" name="mobile"
                                                value="<?php echo isset($data['filters']['mobile']) ? $data['filters']['mobile'] : ''; ?>"
                                                class="w-full h-8 text-xs rounded-md border-gray-300 shadow-sm focus:border-violet-500 focus:ring-violet-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white px-2">
                                        </div>
                                        <div class="form-group flex flex-col">
                                            <label for="email"
                                                class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">ایمیل</label>
                                            <input type="text" id="email" name="email"
                                                value="<?php echo isset($data['filters']['email']) ? $data['filters']['email'] : ''; ?>"
                                                class="w-full h-8 text-xs rounded-md border-gray-300 shadow-sm focus:border-violet-500 focus:ring-violet-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white px-2">
                                        </div>
                                        <div
                                            class="col-span-1 sm:col-span-2 lg:col-span-4 flex flex-wrap gap-2 justify-end mt-2">
                                            <button type="submit"
                                                class="inline-flex items-center px-3 py-1 bg-violet-600 text-white rounded-md hover:bg-violet-700 text-xs">
                                                <i class="fas fa-filter ml-2"></i>
                                                اعمال فیلتر
                                            </button>
                                            <a href="<?php echo URLROOT; ?>/users/indexAgents"
                                                class="inline-flex items-center px-3 py-1 bg-gray-500 text-white rounded-md hover:bg-gray-600 text-xs">
                                                <i class="fas fa-times ml-2"></i>
                                                پاک کردن فیلترها
                                            </a>
                                            <a href="<?php echo URLROOT; ?>/export/exportAgents"
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
                                                <th scope="col" class="px-4 py-3">
                                                    تصویر
                                                </th>
                                                <th scope="col" class="px-4 py-3">
                                                    نام و نام خانوادگی
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    کد ملی
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    موبایل
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    ایمیل
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    وضعیت تایید
                                                </th>
                                                <th scope="col" class="px-6 py-3">
                                                    عملیات
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($data['agents'] as $item): ?>
                                                <tr
                                                    class="bg-white border-b border-gray-100 hover:bg-gray-50/50 dark:bg-zinc-700 dark:hover:bg-zinc-700/50 dark:border-zinc-600">
                                                    <td class="px-4 py-4">
                                                        <img src="<?php echo URLROOT; ?>/assets/uploads/users/<?php echo (!empty($item->avatar)) ? $item->avatar : 'default-avatar.png'; ?>"
                                                            alt="تصویر نماینده" class="w-10 h-10 rounded-full object-cover">
                                                    </td>
                                                    <th scope="row"
                                                        class="px-4 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                        <?php echo $item->name; ?>
                                                    </th>
                                                    <td class="px-6 py-4">
                                                        <?php echo $item->codemelli; ?>
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        <?php echo $item->mobile; ?>
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        <?php echo $item->email; ?>
                                                    </td>
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
                                                                <button onclick="approveAgent(<?php echo $item->id; ?>)"
                                                                    class="font-medium text-green-600 dark:text-green-500 hover:underline cursor-pointer">
                                                                    <i class="fas fa-check ml-1"></i>تایید
                                                                </button>
                                                            <?php else: ?>
                                                                <button onclick="rejectAgent(<?php echo $item->id; ?>)"
                                                                    class="font-medium text-orange-600 dark:text-orange-500 hover:underline cursor-pointer">
                                                                    <i class="fas fa-times ml-1"></i>لغو تایید
                                                                </button>
                                                            <?php endif; ?>
                                                            <a href="<?php echo URLROOT; ?>/users/editAgent/<?php echo $item->id; ?>"
                                                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">ویرایش</a>
                                                            <a href="<?php echo URLROOT; ?>/users/deleteAgent/<?php echo $item->id; ?>"
                                                                class="font-medium text-red-600 dark:text-red-500 hover:underline">حذف</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if (isset($data['pagination']) && $data['pagination']['total_pages'] > 1): ?>
                <div
                    class="flex items-center justify-between mt-4 px-4 py-3 bg-white dark:bg-zinc-800 border-t border-gray-200 dark:border-zinc-700 sm:px-6">
                    <div class="flex-1 flex justify-between sm:hidden">
                        <?php if ($data['pagination']['current_page'] > 1): ?>
                            <a href="<?php echo URLROOT; ?>/users/indexAgents?page=<?php echo $data['pagination']['current_page'] - 1; ?><?php echo !empty($_GET) ? '&' . http_build_query(array_diff_key($_GET, ['page' => ''])) : ''; ?>"
                                class="relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-zinc-600 text-sm font-medium rounded-md text-gray-700 dark:text-gray-200 bg-white dark:bg-zinc-700 hover:bg-gray-50 dark:hover:bg-zinc-600">
                                قبلی
                            </a>
                        <?php endif; ?>
                        <?php if ($data['pagination']['current_page'] < $data['pagination']['total_pages']): ?>
                            <a href="<?php echo URLROOT; ?>/users/indexAgents?page=<?php echo $data['pagination']['current_page'] + 1; ?><?php echo !empty($_GET) ? '&' . http_build_query(array_diff_key($_GET, ['page' => ''])) : ''; ?>"
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
                                <?php if ($data['pagination']['current_page'] > 1): ?>
                                    <a href="<?php echo URLROOT; ?>/users/indexAgents?page=<?php echo $data['pagination']['current_page'] - 1; ?><?php echo !empty($_GET) ? '&' . http_build_query(array_diff_key($_GET, ['page' => ''])) : ''; ?>"
                                        class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-sm font-medium text-gray-500 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-zinc-600">
                                        <span class="sr-only">قبلی</span>
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                <?php endif; ?>
                                <?php
                                $range = 2;
                                $start = max(1, $data['pagination']['current_page'] - $range);
                                $end = min($data['pagination']['total_pages'], $data['pagination']['current_page'] + $range);
                                if ($start > 1) {
                                    echo '<a href="' . URLROOT . '/users/indexAgents?page=1' . (!empty($_GET) ? '&' . http_build_query(array_diff_key($_GET, ['page' => ''])) : '') . '" 
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
                                    if ($i == $data['pagination']['current_page']) {
                                        echo '<span class="relative inline-flex items-center px-4 py-2 border border-violet-500 bg-violet-50 dark:bg-violet-900/20 text-sm font-medium text-violet-600 dark:text-violet-400">
                                            ' . $i . '
                                          </span>';
                                    } else {
                                        echo '<a href="' . URLROOT . '/users/indexAgents?page=' . $i . (!empty($_GET) ? '&' . http_build_query(array_diff_key($_GET, ['page' => ''])) : '') . '" 
                                            class="relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-zinc-600 text-sm font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-zinc-700 hover:bg-gray-50 dark:hover:bg-zinc-600">
                                            ' . $i . '
                                          </a>';
                                    }
                                }
                                if ($end < $data['pagination']['total_pages']) {
                                    if ($end < $data['pagination']['total_pages'] - 1) {
                                        echo '<span class="relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-sm font-medium text-gray-700 dark:text-gray-200">
                                            ...
                                          </span>';
                                    }
                                    echo '<a href="' . URLROOT . '/users/indexAgents?page=' . $data['pagination']['total_pages'] . (!empty($_GET) ? '&' . http_build_query(array_diff_key($_GET, ['page' => ''])) : '') . '" 
                                        class="relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-zinc-600 text-sm font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-zinc-700 hover:bg-gray-50 dark:hover:bg-zinc-600">
                                        ' . $data['pagination']['total_pages'] . '
                                      </a>';
                                }
                                ?>
                                <?php if ($data['pagination']['current_page'] < $data['pagination']['total_pages']): ?>
                                    <a href="<?php echo URLROOT; ?>/users/indexAgents?page=<?php echo $data['pagination']['current_page'] + 1; ?><?php echo !empty($_GET) ? '&' . http_build_query(array_diff_key($_GET, ['page' => ''])) : ''; ?>"
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
    <?php require_once(APPROOT . "/views/public/footer.php"); ?>
</div>

<!-- SweetAlert2 for notifications -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Approve Agent
    function approveAgent(agentId) {
        console.log('Approving agent:', agentId);
        Swal.fire({
            title: 'تایید نماینده',
            text: 'آیا از تایید این نماینده مطمئن هستید؟',
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
                console.log('Sending approval request...');
                fetch('<?php echo URLROOT; ?>/Admin/approveAgent', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'agent_id=' + agentId
                })
                    .then(response => {
                        console.log('Response status:', response.status);
                        return response.json();
                    })
                    .then(data => {
                        console.log('Response data:', data);
                        if (data.success) {
                            Swal.fire({
                                title: 'موفق!',
                                text: data.message,
                                icon: 'success',
                                customClass: { popup: 'rtl-alert' }
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                title: 'خطا!',
                                text: data.message,
                                icon: 'error',
                                customClass: { popup: 'rtl-alert' }
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            title: 'خطا!',
                            text: 'مشکلی در ارتباط با سرور رخ داد',
                            icon: 'error',
                            customClass: { popup: 'rtl-alert' }
                        });
                    });
            }
        });
    }

    // Reject Agent
    function rejectAgent(agentId) {
        Swal.fire({
            title: 'لغو تایید نماینده',
            text: 'آیا از لغو تایید این نماینده مطمئن هستید؟',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#f59e0b',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'بله، لغو کن',
            cancelButtonText: 'انصراف',
            customClass: {
                popup: 'rtl-alert'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('<?php echo URLROOT; ?>/admin/rejectAgent', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'agent_id=' + agentId
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                title: 'موفق!',
                                text: data.message,
                                icon: 'success',
                                customClass: { popup: 'rtl-alert' }
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                title: 'خطا!',
                                text: data.message,
                                icon: 'error',
                                customClass: { popup: 'rtl-alert' }
                            });
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            title: 'خطا!',
                            text: 'مشکلی در ارتباط با سرور رخ داد',
                            icon: 'error',
                            customClass: { popup: 'rtl-alert' }
                        });
                    });
            }
        });
    }
</script>

<style>
    .rtl-alert {
        direction: rtl;
        font-family: 'Yekan', Tahoma, Arial, sans-serif;
    }
</style>