<?php require_once(APPROOT . "/views/public/header.php"); ?>

<div class="min-h-screen flex flex-col">
    <?php require_once(APPROOT . "/views/public/sidebar.php"); ?>

    <div class="flex-1 main-content mr-[240px]">
        <div class="page-content dark:bg-zinc-700 ">
            <div class="container-fluid px-[0.625rem]">
                <div class="col-span-12">
                    <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                        <div class="card-body pb-0">
                            <h6 class="mb-1 text-15 text-gray-700 dark:text-gray-100">لیست کاربران </h6>

                            <!-- Search Form -->
                            <form action="<?php echo URLROOT; ?>/customers" method="GET" class="mt-4">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div>
                                        <input type="text" name="search_name"
                                            value="<?php echo isset($_GET['search_name']) ? htmlspecialchars($_GET['search_name']) : ''; ?>"
                                            class="form-input w-full rounded-lg dark:bg-zinc-700 dark:border-zinc-600 dark:text-gray-100"
                                            placeholder="جستجو بر اساس نام...">
                                    </div>
                                    <div>
                                        <input type="text" name="search_codemelli"
                                            value="<?php echo isset($_GET['search_codemelli']) ? htmlspecialchars($_GET['search_codemelli']) : ''; ?>"
                                            class="form-input w-full rounded-lg dark:bg-zinc-700 dark:border-zinc-600 dark:text-gray-100"
                                            placeholder="جستجو بر اساس کد ملی...">
                                    </div>
                                    <div>
                                        <input type="text" name="search_mobile"
                                            value="<?php echo isset($_GET['search_mobile']) ? htmlspecialchars($_GET['search_mobile']) : ''; ?>"
                                            class="form-input w-full rounded-lg dark:bg-zinc-700 dark:border-zinc-600 dark:text-gray-100"
                                            placeholder="جستجو بر اساس موبایل...">
                                    </div>
                                </div>
                                <div class="mt-4 flex justify-end">
                                    <button type="submit" class="btn bg-violet-500 text-white hover:bg-violet-600">
                                        جستجو
                                    </button>
                                    <?php if (isset($_GET['search_name']) || isset($_GET['search_codemelli']) || isset($_GET['search_mobile'])): ?>
                                        <a href="<?php echo URLROOT; ?>/customers"
                                            class="btn bg-gray-500 text-white hover:bg-gray-600 mr-2">
                                            پاک کردن فیلترها
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </form>
                        </div>
                        <div class="card-body h-full">
                            <div class="relative overflow-x-auto rounded-lg">
                                <table class="w-full text-sm text-right text-gray-500">
                                    <thead
                                        class="text-xs text-gray-700 dark:text-gray-100 uppercase bg-gray-50/50 dark:bg-zinc-700/50">
                                        <tr>
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
                                                آدرس
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                عملیات
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($data['customers'] as $item): ?>
                                            <tr
                                                class="bg-white border-b border-gray-100 hover:bg-gray-50/50 dark:bg-zinc-700 dark:hover:bg-zinc-700/50 dark:border-zinc-600">
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
                                                    <?php echo $item->address; ?>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <a href="<?php echo URLROOT; ?>/customers/edit/<?php echo $item->id; ?>"
                                                        style="background-color: #24a0ed;"
                                                        class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-white rounded-md hover:brightness-110 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 transition-colors duration-200 ml-2">
                                                        <i class="fas fa-edit ml-1"></i>ویرایش
                                                    </a>
                                                    <a href="<?php echo URLROOT; ?>/customers/delete/<?php echo $item->id; ?>"
                                                        class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-white bg-red-500 rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors duration-200">
                                                        <i class="fas fa-trash ml-1"></i>حذف
                                                    </a>
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

            <!-- Pagination -->
            <?php if ($data['pagination']['total_pages'] > 1): ?>
                <div class="flex justify-center items-center pt-4">
                    <nav aria-label="مثال صفحه‌بندی">
                        <ul class="flex list-style-none">
                            <li
                                class="border ltr:rounded-l rtl:rounded-r ltr:border-r-0 rtl:border-l-0 dark:border-zinc-600 <?php echo ($data['pagination']['current_page'] <= 1) ? 'opacity-50 pointer-events-none' : ''; ?>">
                                <a class="page-link relative block py-2 px-4 border-0 bg-transparent outline-none transition-all duration-300 text-gray-500 hover:text-violet-500 focus:shadow-none dark:text-zinc-100 dark:hover:bg-zinc-600 hover:bg-gray-50/50"
                                    href="<?php echo URLROOT; ?>/customers?page=<?php echo $data['pagination']['current_page'] - 1; ?><?php echo !empty($_GET['search_name']) ? '&search_name=' . urlencode($_GET['search_name']) : ''; ?><?php echo !empty($_GET['search_codemelli']) ? '&search_codemelli=' . urlencode($_GET['search_codemelli']) : ''; ?><?php echo !empty($_GET['search_mobile']) ? '&search_mobile=' . urlencode($_GET['search_mobile']) : ''; ?>">قبلی</a>
                            </li>

                            <!-- صفحه اول -->
                            <li
                                class="border <?php echo (1 == $data['pagination']['current_page']) ? 'border-violet-500 bg-violet-100' : 'dark:border-zinc-600'; ?>">
                                <a class="page-link relative block py-2 px-4 border-0 bg-transparent outline-none transition-all duration-300 <?php echo (1 == $data['pagination']['current_page']) ? 'text-violet-500' : 'text-gray-500'; ?> hover:text-violet-500 hover:bg-gray-50/50 focus:shadow-none dark:text-zinc-100 dark:hover:bg-zinc-600"
                                    href="<?php echo URLROOT; ?>/customers?page=1<?php echo !empty($_GET['search_name']) ? '&search_name=' . urlencode($_GET['search_name']) : ''; ?><?php echo !empty($_GET['search_codemelli']) ? '&search_codemelli=' . urlencode($_GET['search_codemelli']) : ''; ?><?php echo !empty($_GET['search_mobile']) ? '&search_mobile=' . urlencode($_GET['search_mobile']) : ''; ?>">1</a>
                            </li>

                            <?php if ($data['pagination']['current_page'] > 3): ?>
                                <li class="border dark:border-zinc-600">
                                    <span
                                        class="page-link relative block py-2 px-4 border-0 bg-transparent outline-none text-gray-500 dark:text-zinc-100">...</span>
                                </li>
                            <?php endif; ?>

                            <?php
                            $start = max(2, $data['pagination']['current_page'] - 1);
                            $end = min($data['pagination']['total_pages'] - 1, $data['pagination']['current_page'] + 1);

                            for ($i = $start; $i <= $end; $i++):
                                ?>
                                <li
                                    class="border <?php echo ($i == $data['pagination']['current_page']) ? 'border-violet-500 bg-violet-100' : 'dark:border-zinc-600'; ?> border-l-0 rtl:border-l">
                                    <a class="page-link relative block py-2 px-4 border-0 bg-transparent outline-none transition-all duration-300 <?php echo ($i == $data['pagination']['current_page']) ? 'text-violet-500' : 'text-gray-500'; ?> hover:text-violet-500 hover:bg-gray-50/50 focus:shadow-none dark:text-zinc-100 dark:hover:bg-zinc-600"
                                        href="<?php echo URLROOT; ?>/customers?page=<?php echo $i; ?><?php echo !empty($_GET['search_name']) ? '&search_name=' . urlencode($_GET['search_name']) : ''; ?><?php echo !empty($_GET['search_codemelli']) ? '&search_codemelli=' . urlencode($_GET['search_codemelli']) : ''; ?><?php echo !empty($_GET['search_mobile']) ? '&search_mobile=' . urlencode($_GET['search_mobile']) : ''; ?>"><?php echo $i; ?></a>
                                </li>
                            <?php endfor; ?>

                            <?php if ($data['pagination']['current_page'] < $data['pagination']['total_pages'] - 2): ?>
                                <li class="border dark:border-zinc-600 border-l-0 rtl:border-l">
                                    <span
                                        class="page-link relative block py-2 px-4 border-0 bg-transparent outline-none text-gray-500 dark:text-zinc-100">...</span>
                                </li>
                            <?php endif; ?>

                            <!-- صفحه آخر -->
                            <?php if ($data['pagination']['total_pages'] > 1): ?>
                                <li
                                    class="border <?php echo ($data['pagination']['total_pages'] == $data['pagination']['current_page']) ? 'border-violet-500 bg-violet-100' : 'dark:border-zinc-600'; ?> border-l-0 rtl:border-l">
                                    <a class="page-link relative block py-2 px-4 border-0 bg-transparent outline-none transition-all duration-300 <?php echo ($data['pagination']['total_pages'] == $data['pagination']['current_page']) ? 'text-violet-500' : 'text-gray-500'; ?> hover:text-violet-500 hover:bg-gray-50/50 focus:shadow-none dark:text-zinc-100 dark:hover:bg-zinc-600"
                                        href="<?php echo URLROOT; ?>/customers?page=<?php echo $data['pagination']['total_pages']; ?><?php echo !empty($_GET['search_name']) ? '&search_name=' . urlencode($_GET['search_name']) : ''; ?><?php echo !empty($_GET['search_codemelli']) ? '&search_codemelli=' . urlencode($_GET['search_codemelli']) : ''; ?><?php echo !empty($_GET['search_mobile']) ? '&search_mobile=' . urlencode($_GET['search_mobile']) : ''; ?>"><?php echo $data['pagination']['total_pages']; ?></a>
                                </li>
                            <?php endif; ?>

                            <li
                                class="border ltr:rounded-r rtl:rounded-l dark:border-zinc-600 border-l-0 rtl:border-l <?php echo ($data['pagination']['current_page'] >= $data['pagination']['total_pages']) ? 'opacity-50 pointer-events-none' : ''; ?>">
                                <a class="page-link relative block py-2 px-4 border-0 bg-transparent outline-none transition-all duration-300 text-gray-500 hover:text-violet-500 hover:bg-gray-50/50 focus:shadow-none dark:text-zinc-100 dark:hover:bg-zinc-600"
                                    href="<?php echo URLROOT; ?>/customers?page=<?php echo $data['pagination']['current_page'] + 1; ?><?php echo !empty($_GET['search_name']) ? '&search_name=' . urlencode($_GET['search_name']) : ''; ?><?php echo !empty($_GET['search_codemelli']) ? '&search_codemelli=' . urlencode($_GET['search_codemelli']) : ''; ?><?php echo !empty($_GET['search_mobile']) ? '&search_mobile=' . urlencode($_GET['search_mobile']) : ''; ?>">بعدی</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php require_once(APPROOT . "/views/public/footer.php"); ?>
</div>

<script>
    function confirmDelete(deleteUrl, name, codemelli) {
        Swal.fire({
            title: 'آیا مطمئن هستید؟',
            text: 'آیا می‌خواهید مشتری با مشخصات زیر را حذف کنید؟\nنام: ' + name + '\nکد ملی: ' + codemelli,
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
</script>