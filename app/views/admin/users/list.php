<?php require_once(APPROOT . "/views/public/header.php"); ?>
<?php require_once(APPROOT . "/views/public/sidebar.php"); ?>

<div class="main-content">
    <div class="page-content dark:bg-zinc-700 ">

        <div class="container-fluid px-[0.625rem]">
            <div class="col-span-12">
                <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                    <div class="card-body pb-0">
                        <h6 class="mb-1 text-15 text-gray-700 dark:text-gray-100">لیست کاربران </h6>
                    </div>
                    
                    <!-- فرم فیلتر -->
                    <div class="card-body pb-0">
                        <form action="<?php echo URLROOT; ?>/users/index" method="GET" class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-2">
                            <div class="form-group">
                                <label for="name" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">نام و نام خانوادگی</label>
                                <input type="text" id="name" name="name" value="<?php echo isset($data['filters']['name']) ? $data['filters']['name'] : ''; ?>" 
                                    class="w-full h-8 text-sm rounded-md border-gray-300 shadow-sm focus:border-violet-500 focus:ring-violet-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white">
                            </div>
                            <div class="form-group">
                                <label for="codemelli" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">کد ملی</label>
                                <input type="text" id="codemelli" name="codemelli" value="<?php echo isset($data['filters']['codemelli']) ? $data['filters']['codemelli'] : ''; ?>" 
                                    class="w-full h-8 text-sm rounded-md border-gray-300 shadow-sm focus:border-violet-500 focus:ring-violet-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white">
                            </div>
                            <div class="form-group">
                                <label for="mobile" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">موبایل</label>
                                <input type="text" id="mobile" name="mobile" value="<?php echo isset($data['filters']['mobile']) ? $data['filters']['mobile'] : ''; ?>" 
                                    class="w-full h-8 text-sm rounded-md border-gray-300 shadow-sm focus:border-violet-500 focus:ring-violet-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white">
                            </div>
                            <div class="form-group">
                                <label for="email" class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">ایمیل</label>
                                <input type="text" id="email" name="email" value="<?php echo isset($data['filters']['email']) ? $data['filters']['email'] : ''; ?>" 
                                    class="w-full h-8 text-sm rounded-md border-gray-300 shadow-sm focus:border-violet-500 focus:ring-violet-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white">
                            </div>
                            <div class="form-group md:col-span-3 flex justify-end gap-2">
                                <button type="submit" class="px-3 py-1 text-sm bg-violet-500 text-white rounded-md hover:bg-violet-600 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:ring-offset-2">
                                    فیلتر
                                </button>
                                <a href="<?php echo URLROOT; ?>/users/index" class="px-3 py-1 text-sm bg-gray-500 text-white rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                                    پاک کردن فیلترها
                                </a>
                            </div>
                        </form>
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
                                            عملیات
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data['users'] as $item): ?>
                                        <tr class="bg-white border-b border-gray-100 hover:bg-gray-50/50 dark:bg-zinc-700 dark:hover:bg-zinc-700/50 dark:border-zinc-600">
                                            <td class="w-4 p-4">
                                                <div class="flex items-center">
                                                    <input id="checkbox" type="checkbox" class="w-4 h-4 focus:ring-0 focus:outline-0 border-gray-100 focus:ring-offset-0 rounded dark:bg-zinc-700 dark:border-zinc-500 dark:checked:bg-violet-500">
                                                    <label for="checkbox" class="sr-only">چک باکس</label>
                                                </div>
                                            </td>
                                            <td class="px-4 py-4">
                                                <img src="<?php echo URLROOT; ?>/assets/uploads/users/<?php echo $item->avatar; ?>"
                                                    alt="تصویر کاربر"
                                                    class="w-10 h-10 rounded-full object-cover">
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
                                                <?php echo $item->email; ?>
                                            </td>

                                            <td class="px-6 py-4">
                                                <a href="<?php echo URLROOT; ?>/users/edit/<?php echo $item->id; ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline ml-2">ویرایش</a>
                                                <a href="<?php echo URLROOT; ?>/users/delete/<?php echo $item->id; ?>" class="font-medium text-red-600 dark:text-red-500 hover:underline mr-2">حذف</a>
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