<?php

use Hekmatinasser\Verta\Verta;
?>
<?php require_once(APPROOT . "/views/public/header.php"); ?>
<?php require_once(APPROOT . "/views/public/sidebarAgent.php"); ?>



<div class="main-content">
    <div class="page-content dark:bg-zinc-700">
        <div class="container-fluid px-[0.625rem]">
            <div class="col-span-12 xl:col-span-6">
                <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                    <div class="card-body pb-0">
                        <h6 class="mb-1 text-15 text-gray-700 dark:text-gray-100">لیست پذیرش ها </h6>
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
                                            تاریخ پذیرش
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            عملیات
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data['receptionsAgent'] as $item): ?>
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
                                            <td class="px-6 py-4">
                                                <?php echo $item->serial; ?>
                                            </td>
                                            <td class="px-6 py-4">
                                                <?php echo $item->model; ?>
                                            </td>
                                            <td class="px-6 py-4">
                                                <?php echo $item->name; ?>
                                            </td>
                                            <td class="px-6 py-4">
                                                <?php echo $item->product_status; ?>
                                            </td>
                                            <td class="px-6 py-4">
                                                <?php
                                                $shamsiDate = new Verta($item->created_at);
                                                echo $shamsiDate->format('Y/m/d');
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








            <?php require_once(APPROOT . "/views/public/footer.php"); ?>