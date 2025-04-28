<?php

use Hekmatinasser\Verta\Verta;
?>
<?php require_once(APPROOT . "/views/public/header.php"); ?>
<?php require_once(APPROOT . "/views/public/sidebar.php"); ?>



<div class="main-content">
    <div class="page-content dark:bg-zinc-700">

        <div class="container-fluid px-[0.625rem]">



            <div class="col-span-12 xl:col-span-6">
                <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                    <div class="card-header p-4">
                        <h3 class="card-title">لیست پذیرش‌ها</h3>
                        
                    </div>
                    <div class="card-body">
                        <!-- فرم فیلتر هوشمند -->
                        
                        <div class="card-body p-4">
                            <form action="<?php echo URLROOT; ?>/receptions" method="GET" class="filter-form">
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
                                    <!-- فیلترهای متنی -->
                                    <div class="form-group">
                                        <label for="reception_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">شماره پذیرش</label>
                                        <input type="text" id="reception_number" name="reception_number" value="<?php echo isset($_GET['reception_number']) ? $_GET['reception_number'] : ''; ?>" 
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-violet-500 focus:border-violet-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="serial" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">سریال</label>
                                        <input type="text" id="serial" name="serial" value="<?php echo isset($_GET['serial']) ? $_GET['serial'] : ''; ?>" 
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-violet-500 focus:border-violet-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="model" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">مدل دستگاه</label>
                                        <input type="text" id="model" name="model" value="<?php echo isset($_GET['model']) ? $_GET['model'] : ''; ?>" 
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-violet-500 focus:border-violet-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="customer_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">نام مشتری</label>
                                        <input type="text" id="customer_name" name="customer_name" value="<?php echo isset($_GET['customer_name']) ? $_GET['customer_name'] : ''; ?>" 
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-violet-500 focus:border-violet-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="codemelli" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">کد ملی</label>
                                        <input type="text" id="codemelli" name="codemelli" value="<?php echo isset($_GET['codemelli']) ? $_GET['codemelli'] : ''; ?>" 
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-violet-500 focus:border-violet-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="mobile" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">موبایل</label>
                                        <input type="text" id="mobile" name="mobile" value="<?php echo isset($_GET['mobile']) ? $_GET['mobile'] : ''; ?>" 
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-violet-500 focus:border-violet-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">وضعیت</label>
                                        <select id="status" name="status" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-violet-500 focus:border-violet-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white">
                                            <option value="">همه</option>
                                            <option value="دریافت از دفتر مرکزی" <?php echo (isset($_GET['status']) && $_GET['status'] == 'دریافت از دفتر مرکزی') ? 'selected' : ''; ?>>دریافت از دفتر مرکزی</option>
                                            <option value="پذیرش در نمایندگی" <?php echo (isset($_GET['status']) && $_GET['status'] == 'پذیرش در نمایندگی') ? 'selected' : ''; ?>>پذیرش در نمایندگی</option>
                                            <option value="ارسال از نمایندگی به دفتر مرکزی" <?php echo (isset($_GET['status']) && $_GET['status'] == 'ارسال از نمایندگی به دفتر مرکزی') ? 'selected' : ''; ?>>ارسال از نمایندگی به دفتر مرکزی</option>
                                            <option value="در انتظار تکمیل مدارک" <?php echo (isset($_GET['status']) && $_GET['status'] == 'در انتظار تکمیل مدارک') ? 'selected' : ''; ?>>در انتظار تکمیل مدارک</option>
                                            <option value="ارسال از دفتر مرکزی به نمایندگی" <?php echo (isset($_GET['status']) && $_GET['status'] == 'ارسال از دفتر مرکزی به نمایندگی') ? 'selected' : ''; ?>>ارسال از دفتر مرکزی به نمایندگی</option>
                                            <option value="تحویل به مشتری" <?php echo (isset($_GET['status']) && $_GET['status'] == 'تحویل به مشتری') ? 'selected' : ''; ?>>تحویل به مشتری</option>
                                            <option value="دریافت از نمایندگی" <?php echo (isset($_GET['status']) && $_GET['status'] == 'دریافت از نمایندگی') ? 'selected' : ''; ?>>دریافت از نمایندگی</option>
                                            <option value="در انتظار کارشناسی" <?php echo (isset($_GET['status']) && $_GET['status'] == 'در انتظار کارشناسی') ? 'selected' : ''; ?>>در انتظار کارشناسی</option>
                                            <option value="در انتظار قطعه" <?php echo (isset($_GET['status']) && $_GET['status'] == 'در انتظار قطعه') ? 'selected' : ''; ?>>در انتظار قطعه</option>
                                            <option value="در حال تعویض" <?php echo (isset($_GET['status']) && $_GET['status'] == 'در حال تعویض') ? 'selected' : ''; ?>>در حال تعویض</option>
                                            <option value="در حال انجام کار در دفتر مرکزی" <?php echo (isset($_GET['status']) && $_GET['status'] == 'در حال انجام کار در دفتر مرکزی') ? 'selected' : ''; ?>>در حال انجام کار در دفتر مرکزی</option>
                                            <option value="اتمام تعمیر" <?php echo (isset($_GET['status']) && $_GET['status'] == 'اتمام تعمیر') ? 'selected' : ''; ?>>اتمام تعمیر</option>
                                            <option value="در انتظار تایید هزینه" <?php echo (isset($_GET['status']) && $_GET['status'] == 'در انتظار تایید هزینه') ? 'selected' : ''; ?>>در انتظار تایید هزینه</option>
                                            <option value="عدم موافقت با هزینه - مرجوع" <?php echo (isset($_GET['status']) && $_GET['status'] == 'عدم موافقت با هزینه - مرجوع') ? 'selected' : ''; ?>>عدم موافقت با هزینه - مرجوع</option>
                                        </select>
                                    </div>
                                    
                                    
                                </div>
                                
                                <!-- دکمه‌های عملیات -->
                                <div class="flex flex-wrap gap-3 items-center justify-between mt-4">
                                    <!-- دکمه‌های فیلتر -->
                                    <div class="flex flex-wrap gap-2">
                                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-violet-600 text-white rounded-md hover:bg-violet-700 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:ring-offset-2">
                                            <i class="fas fa-filter ml-2"></i>
                                            اعمال فیلتر
                                        </button>
                                        <a href="<?php echo URLROOT; ?>/receptions" class="inline-flex items-center px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                                            <i class="fas fa-times ml-2"></i>
                                            پاک کردن فیلترها
                                        </a>
                                    </div>
                                    
                                    <!-- دکمه خروجی اکسل -->
                                    <a href="<?php echo URLROOT; ?>/export/exportReceptions" class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                        <i class="fas fa-file-excel ml-2"></i>
                                        دانلود خروجی اکسل
                                    </a>
                                </div>
                            </form>
                        </div>

                        <div class="card-body">
                            <div class="relative overflow-x-auto rounded-lg">
                                <table class="w-full text-sm text-right text-gray-500">
                                    <thead class="text-xs text-gray-700 dark:text-gray-100 uppercase bg-gray-50/50 dark:bg-zinc-700/50">
                                        <tr>
                                            <th scope="col" class="p-4">
                                                <div class="flex items-center">
                                                    <input id="checkbox-all" type="checkbox" class="w-4 h-4 focus:ring-0 focus:outline-0 border-gray-100 focus:ring-offset-0 rounded dark:bg-zinc-700 dark:border-zinc-500 dark:checked:bg-violet-500">
                                                    <label for="checkbox-all" class="sr-only">چک باکس</label>
                                                </div>
                                            </th>
                                            <th scope="col" class="px-4 py-3">
                                                شماره پذیرش
                                            </th>
                                            <th scope="col" class="px-4 py-3">
                                                نمایندگی
                                            </th>

                                            <th scope="col" class="px-6 py-3">
                                                سریال دستگاه
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                مدل دستگاه
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                نام مشتری
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                وضعیت دستگاه
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                نوع پذیرش
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                تاریخ و ساعت پذیرش
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                عملیات
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($data['receptions'] as $item): ?>
                                            <tr class="bg-white border-b border-gray-100 hover:bg-gray-50/50 dark:bg-zinc-700 dark:hover:bg-zinc-700/50 dark:border-zinc-600">
                                                <td class="w-4 p-4">
                                                    <div class="flex items-center">
                                                        <input id="checkbox" type="checkbox" class="w-4 h-4 focus:ring-0 focus:outline-0 border-gray-100 focus:ring-offset-0 rounded dark:bg-zinc-700 dark:border-zinc-500 dark:checked:bg-violet-500">
                                                        <label for="checkbox" class="sr-only">چک باکس</label>
                                                    </div>
                                                </td>
                                                <th scope="row" class="px-4 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    <?php echo $item->id; ?>
                                                </th>
                                                <th scope="row" class="px-4 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    <?php echo $item->user_name; ?>
                                                </th>
                                                <td class="px-6 py-4">
                                                    <?php echo $item->serial; ?>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <?php echo $item->model; ?>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <?php echo $item->customer_name; ?>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <?php echo $item->product_status; ?>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <?php echo $item->repair_status; ?>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <?php
                                                    $shamsiDate = new Verta($item->created_at);
                                                    echo $shamsiDate->format('Y/m/d _ H:i');
                                                    ?>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <a href="<?php echo URLROOT; ?>/receptions/edit/<?php echo $item->id; ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline ml-2">ویرایش</a>
                                                    <a href="<?php echo URLROOT; ?>/receptions/print/<?php echo $item->id; ?>" class="font-medium text-green-600 dark:text-green-500 hover:underline">پرینت</a>
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


            <?php if (isset($data['pagination']) && $data['pagination']['total_pages'] > 1): ?>
            <div class="flex items-center justify-between mt-4 px-4 py-3 bg-white dark:bg-zinc-800 border-t border-gray-200 dark:border-zinc-700 sm:px-6">
                <div class="flex-1 flex justify-between sm:hidden">
                    <?php if ($data['pagination']['current_page'] > 1): ?>
                    <a href="<?php echo URLROOT; ?>/receptions?page=<?php echo $data['pagination']['current_page'] - 1; ?><?php echo !empty($_GET) ? '&' . http_build_query(array_diff_key($_GET, ['page' => ''])) : ''; ?>"
                       class="relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-zinc-600 text-sm font-medium rounded-md text-gray-700 dark:text-gray-200 bg-white dark:bg-zinc-700 hover:bg-gray-50 dark:hover:bg-zinc-600">
                        قبلی
                    </a>
                    <?php endif; ?>
                    <?php if ($data['pagination']['current_page'] < $data['pagination']['total_pages']): ?>
                    <a href="<?php echo URLROOT; ?>/receptions?page=<?php echo $data['pagination']['current_page'] + 1; ?><?php echo !empty($_GET) ? '&' . http_build_query(array_diff_key($_GET, ['page' => ''])) : ''; ?>"
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
                            <a href="<?php echo URLROOT; ?>/receptions?page=<?php echo $data['pagination']['current_page'] - 1; ?><?php echo !empty($_GET) ? '&' . http_build_query(array_diff_key($_GET, ['page' => ''])) : ''; ?>"
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
                                echo '<a href="' . URLROOT . '/receptions?page=1' . (!empty($_GET) ? '&' . http_build_query(array_diff_key($_GET, ['page' => ''])) : '') . '" 
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
                                    echo '<a href="' . URLROOT . '/receptions?page=' . $i . (!empty($_GET) ? '&' . http_build_query(array_diff_key($_GET, ['page' => ''])) : '') . '" 
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
                                echo '<a href="' . URLROOT . '/receptions?page=' . $data['pagination']['total_pages'] . (!empty($_GET) ? '&' . http_build_query(array_diff_key($_GET, ['page' => ''])) : '') . '" 
                                        class="relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-zinc-600 text-sm font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-zinc-700 hover:bg-gray-50 dark:hover:bg-zinc-600">
                                        ' . $data['pagination']['total_pages'] . '
                                      </a>';
                            }
                            ?>
                            <?php if ($data['pagination']['current_page'] < $data['pagination']['total_pages']): ?>
                            <a href="<?php echo URLROOT; ?>/receptions?page=<?php echo $data['pagination']['current_page'] + 1; ?><?php echo !empty($_GET) ? '&' . http_build_query(array_diff_key($_GET, ['page' => ''])) : ''; ?>"
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
</div>


<?php require_once(APPROOT . "/views/public/footer.php"); ?>