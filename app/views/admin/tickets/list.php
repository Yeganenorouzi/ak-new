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
                                        <th scope="col" class="px-4 py-3"> شناسه تیکت </th>
                                        <th scope="col" class="px-4 py-3"> عنوان تیکت </th>
                                        <th scope="col" class="px-6 py-3">وضعیت تیکت  </th>
                                        <th scope="col" class="px-6 py-3"> تاریخ ثبت تیکت </th>
                                        <th scope="col" class="px-6 py-3">تاریخ به روزرسانی تیکت  </th>
                                        <th scope="col" class="px-6 py-3">عملیات</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data['tickets'] as $item): ?>
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
                                            <td class="px-6 py-4"><?php echo $item->title; ?></td>
                                            <td class="px-6 py-4"><?php echo $item->status; ?></td>
                                            <td class="px-6 py-4"><?php echo $item->created_at; ?></td>
                                            <td class="px-6 py-4"><?php echo $item->updated_at; ?></td>
                                            <td class="px-6 py-4">
                                                <a href="<?php echo URLROOT; ?>/tickets/update/<?php echo $item->id; ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">نمایش</a>
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
</div>

<?php require_once(APPROOT . "/views/public/footer.php"); ?>