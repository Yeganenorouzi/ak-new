<?php require_once(APPROOT . "/views/public/header.php"); ?>
<?php require_once(APPROOT . "/views/public/sidebarAgent.php"); ?>



<div class="main-content">
    <div class="page-content dark:bg-zinc-700 ">

        <div class="container-fluid px-[0.625rem]">
            <div class="col-span-12">
                <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                    <div class="card-body pb-0">
                        <h6 class="mb-1 text-15 text-gray-700 dark:text-gray-100">لیست کاربران  </h6>
                    </div>
                    <div class="card-body h-full">
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
                                <?php foreach ($data['customersAgent'] as $item): ?>
                                    <tr class="bg-white border-b border-gray-100 hover:bg-gray-50/50 dark:bg-zinc-700 dark:hover:bg-zinc-700/50 dark:border-zinc-600">
                                        <td class="w-4 p-4">
                                            <div class="flex items-center">
                                                <input id="checkbox" type="checkbox" class="w-4 h-4 focus:ring-0 focus:outline-0 border-gray-100 focus:ring-offset-0 rounded dark:bg-zinc-700 dark:border-zinc-500 dark:checked:bg-violet-500">
                                                <label for="checkbox" class="sr-only">چک باکس</label>
                                            </div>
                                        </td>
                                        <th scope="row" class="px-4 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
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
                                                <a href="<?php echo URLROOT; ?>/customers/edit/<?php echo $item->id; ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">ویرایش</a>
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








        <?php require_once(APPROOT . "/views/public/footer.php"); ?>
