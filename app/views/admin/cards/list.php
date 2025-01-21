<?php require_once(APPROOT . "/views/public/header.php"); ?>
<?php require_once(APPROOT . "/views/public/sidebar.php"); ?>

<div class="main-content">
    <div class="page-content dark:bg-zinc-700">
        <div class="container-fluid px-[0.625rem]">
            <div class="col-span-12 xl:col-span-6">
                <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                    <form class="app-search hidden xl:block px-5">
                        <div class="relative inline-block">
                            <input type="text" class="bg-gray-50/30 dark:bg-zinc-700/50 border-0 rounded focus:ring-0 placeholder:text-sm px-4 dark:placeholder:text-gray-200 dark:text-gray-100 dark:border-zinc-700 " placeholder="جستجو...">
                            <button class="py-1.5 px-2.5 text-white bg-violet-500 inline-block absolute ltr:right-1 top-1 rounded shadow shadow-violet-100 dark:shadow-gray-900 rtl:left-1 rtl:right-auto" type="button"><i class="bx bx-search-alt align-middle"></i></button>
                        </div>
                    </form>
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
                                    <?php foreach ($data['cards'] as $item): ?>
                                        <tr class="bg-white border-b border-gray-100 hover:bg-gray-50/50 dark:bg-zinc-700 dark:hover:bg-zinc-700/50 dark:border-zinc-600">
                                            <td class="w-4 p-4">
                                                <div class="flex items-center">
                                                    <input id="checkbox" type="checkbox" class="w-4 h-4 focus:ring-0 focus:outline-0 border-gray-100 focus:ring-offset-0 rounded dark:bg-zinc-700 dark:border-zinc-500 dark:checked:bg-violet-500">
                                                    <label for="checkbox" class="sr-only">چک باکس</label>
                                                </div>
                                            </td>
                                            <th scope="row" class="px-4 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                <?php echo $item->serial; ?>
                                            </th>
                                            <td class="px-6 py-4"><?php echo $item->serial2; ?></td>
                                            <td class="px-6 py-4"><?php echo $item->model; ?></td>
                                            <td class="px-6 py-4"><?php echo $item->company; ?></td>
                                            <td class="px-6 py-4"><?php echo $item->sh_sanad; ?></td>
                                            <td class="px-6 py-4"><?php echo $item->start_guarantee; ?></td>
                                            <td class="px-6 py-4"><?php echo $item->expite_guarantee; ?></td>
                                            <td class="px-6 py-4">
                                                <a href="<?php echo URLROOT; ?>/cards/update/<?php echo $item->id; ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">ویرایش</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="flex justify-center items-center pt-4">
                            <nav aria-label="مثال صفحه‌بندی">
                                <ul class="flex list-style-none">
                                    <li class="border ltr:rounded-l rtl:rounded-r ltr:border-r-0 rtl:border-l-0 dark:border-zinc-600 <?php echo ($data['currentPage'] <= 1) ? 'opacity-50 pointer-events-none' : ''; ?>">
                                        <a class="page-link relative block py-2 px-4 border-0 bg-transparent outline-none transition-all duration-300 text-gray-500 hover:text-violet-500 focus:shadow-none dark:text-zinc-100 dark:hover:bg-zinc-600 hover:bg-gray-50/50"
                                            href="<?php echo URLROOT; ?>/cards/index/<?php echo $data['currentPage'] - 1; ?>">قبلی</a>
                                    </li>

                                    <!-- صفحه اول -->
                                    <li class="border <?php echo (1 == $data['currentPage']) ? 'border-violet-500 bg-violet-100' : 'dark:border-zinc-600'; ?>">
                                        <a class="page-link relative block py-2 px-4 border-0 bg-transparent outline-none transition-all duration-300 <?php echo (1 == $data['currentPage']) ? 'text-violet-500' : 'text-gray-500'; ?> hover:text-violet-500 hover:bg-gray-50/50 focus:shadow-none dark:text-zinc-100 dark:hover:bg-zinc-600"
                                            href="<?php echo URLROOT; ?>/cards/index/1">1</a>
                                    </li>

                                    <?php if ($data['currentPage'] > 3): ?>
                                        <li class="border dark:border-zinc-600">
                                            <span class="page-link relative block py-2 px-4 border-0 bg-transparent outline-none text-gray-500 dark:text-zinc-100">...</span>
                                        </li>
                                    <?php endif; ?>

                                    <?php
                                    $start = max(2, $data['currentPage'] - 1);
                                    $end = min($data['totalPages'] - 1, $data['currentPage'] + 1);

                                    for ($i = $start; $i <= $end; $i++):
                                    ?>
                                        <li class="border <?php echo ($i == $data['currentPage']) ? 'border-violet-500 bg-violet-100' : 'dark:border-zinc-600'; ?> border-l-0 rtl:border-l">
                                            <a class="page-link relative block py-2 px-4 border-0 bg-transparent outline-none transition-all duration-300 <?php echo ($i == $data['currentPage']) ? 'text-violet-500' : 'text-gray-500'; ?> hover:text-violet-500 hover:bg-gray-50/50 focus:shadow-none dark:text-zinc-100 dark:hover:bg-zinc-600"
                                                href="<?php echo URLROOT; ?>/cards/index/<?php echo $i; ?>"><?php echo $i; ?></a>
                                        </li>
                                    <?php endfor; ?>

                                    <?php if ($data['currentPage'] < $data['totalPages'] - 2): ?>
                                        <li class="border dark:border-zinc-600 border-l-0 rtl:border-l">
                                            <span class="page-link relative block py-2 px-4 border-0 bg-transparent outline-none text-gray-500 dark:text-zinc-100">...</span>
                                        </li>
                                    <?php endif; ?>

                                    <!-- صفحه آخر -->
                                    <?php if ($data['totalPages'] > 1): ?>
                                        <li class="border <?php echo ($data['totalPages'] == $data['currentPage']) ? 'border-violet-500 bg-violet-100' : 'dark:border-zinc-600'; ?> border-l-0 rtl:border-l">
                                            <a class="page-link relative block py-2 px-4 border-0 bg-transparent outline-none transition-all duration-300 <?php echo ($data['totalPages'] == $data['currentPage']) ? 'text-violet-500' : 'text-gray-500'; ?> hover:text-violet-500 hover:bg-gray-50/50 focus:shadow-none dark:text-zinc-100 dark:hover:bg-zinc-600"
                                                href="<?php echo URLROOT; ?>/cards/index/<?php echo $data['totalPages']; ?>"><?php echo $data['totalPages']; ?></a>
                                        </li>
                                    <?php endif; ?>

                                    <li class="border ltr:rounded-r rtl:rounded-l dark:border-zinc-600 border-l-0 rtl:border-l <?php echo ($data['currentPage'] >= $data['totalPages']) ? 'opacity-50 pointer-events-none' : ''; ?>">
                                        <a class="page-link relative block py-2 px-4 border-0 bg-transparent outline-none transition-all duration-300 text-gray-500 hover:text-violet-500 hover:bg-gray-50/50 focus:shadow-none dark:text-zinc-100 dark:hover:bg-zinc-600"
                                            href="<?php echo URLROOT; ?>/cards/index/<?php echo $data['currentPage'] + 1; ?>">بعدی</a>
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

<?php require_once(APPROOT . "/views/public/footer.php"); ?>