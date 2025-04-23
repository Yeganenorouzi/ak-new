<?php require_once(APPROOT . "/views/public/header.php"); ?>
<?php require_once(APPROOT . "/views/public/sidebar.php"); ?>

<div class="main-content">
    <div class="page-content dark:bg-zinc-700">

        <div class="container-fluid px-[0.625rem]">

            <div class="grid grid-cols-1 mb-5">
                <div class="flex items-center justify-between">
                    <h4 class="mb-sm-0 text-lg font-semibold grow text-gray-800 dark:text-gray-100">تعریف کاربر جدید</h4>
                    <nav class="flex" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 ltr:md:space-x-3 rtl:md:space-x-0">
                            <li class="inline-flex items-center">
                                <a href="#" class="inline-flex items-center text-sm font-medium text-gray-800 hover:text-gray-900 dark:text-zinc-100 dark:hover:text-white">
                                    کاربران
                                </a>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 text-gray-400 -rotate-180" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <a href="#" class="ltr:ml-1 rtl:mr-1 text-sm font-medium text-gray-500 hover:text-gray-900 ltr:md:ml-2 rtl:md:mr-2 dark:text-gray-100 dark:hover:text-white">تعریف کاربر جدید</a>
                                </div>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>


            <div class="grid grid-cols-1">
                <div class="card dark:bg-zinc-800 dark:border-zinc-600">

                    <div class="card-body">
                        <form action="<?php echo URLROOT; ?>/users/create" method="POST" enctype="multipart/form-data" class="max-w-2xl">
                            <?php if (!empty($data['errors'])): ?>
                                <div class="mb-6 p-4 rounded-lg bg-red-50 border border-red-200 dark:bg-red-900/20 dark:border-red-500/30">
                                    <div class="flex items-center mb-2">
                                        <svg class="w-5 h-5 text-red-500 dark:text-red-400 ml-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                        </svg>
                                        <h3 class="text-lg font-semibold text-red-800 dark:text-red-400">لطفاً خطاهای زیر را برطرف کنید:</h3>
                                    </div>
                                    <ul class="list-disc list-inside space-y-1">
                                        <?php foreach ($data['errors'] as $error): ?>
                                            <li class="text-red-600 dark:text-red-400 text-sm">
                                                <?php echo htmlspecialchars($error); ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>

                            <div class="grid grid-cols-8 gap-5 mx-5">
                                <div class="col-span-8 ">
                                    <div class="mb-4">
                                        <label for="codemelli" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">کد ملی</label>
                                        <input
                                            name="codemelli"
                                            class="input-field w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                            type="text"
                                            placeholder="کد ملی را وارد کنید"
                                            id="codemelli"
                                            value="<?php echo htmlspecialchars($data['data']['codemelli'] ?? ''); ?>"
                                            required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="mobile" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">شماره موبایل</label>
                                        <input
                                            name="mobile"
                                            class="input-field w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100 text-right"
                                            type="tel"
                                            placeholder="شماره موبایل را وارد کنید"
                                            id="mobile"
                                            value="<?php echo htmlspecialchars($data['data']['mobile'] ?? ''); ?>"
                                            required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="email" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">ایمیل</label>
                                        <input
                                            name="email"
                                            class="input-field w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                            type="email"
                                            placeholder="ایمیل را وارد کنید"
                                            id="email"
                                            value="<?php echo htmlspecialchars($data['data']['email'] ?? ''); ?>"
                                            required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="password" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">رمزعبور</label>
                                        <input
                                            name="password"
                                            class="input-field w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                            type="password"
                                            placeholder="رمزعبور را وارد کنید"
                                            id="password"
                                            required>
                                    </div>

                                    <div class="mb-4">
                                        <label for="name" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">نام و نام خانوادگی</label>
                                        <input
                                            name="name"
                                            class="input-field w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                            type="text"
                                            placeholder="نام و نام خانوادگی را وارد کنید"
                                            id="name"
                                            value="<?php echo htmlspecialchars($data['data']['name'] ?? ''); ?>"
                                            required>
                                    </div>

                                    <div class="mb-4">
                                        <label for="avatar" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">تصویر</label>
                                        <input
                                            name="image"
                                            class="input-field w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                            type="file"
                                            id="avatar"
                                            accept="image/*"
                                            onchange="previewImage(this);">
                                        <div class="mt-2">
                                            <img id="preview" src="#" alt="پیش نمایش تصویر" class="hidden rounded-lg" style="width: 150px; height: 150px; object-fit: cover;">
                                        </div>
                                    </div>


                                </div>

                            </div>

                            <div class="mt-6">
                                <button type="submit" class="px-5 py-2.5 bg-violet-500 text-white rounded hover:bg-violet-600 focus:outline-none">
                                    ثبت اطلاعات
                                </button>
                            </div>



                            <div class="col-span-12 lg:col-span-6">

                        </form>
                    </div>
                </div>

            </div>

            <!-- Modal -->
            <div id="successModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center">
                <div class="bg-white rounded-lg shadow-lg dark:bg-zinc-700 p-5 max-w-md w-full">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-3">عملیات موفق</h3>
                    <p class="text-gray-700 dark:text-gray-300">اطلاعات کاربر با موفقیت ثبت شد.</p>
                    <div class="mt-5 text-right">
                        <button id="closeModal" class="bg-violet-500 text-white px-4 py-2 rounded hover:bg-violet-600">
                            مشاهده لیست کاربران
                        </button>
                    </div>
                </div>
            </div>










            <?php require_once(APPROOT . "/views/public/footer.php"); ?>

            <script>
                function previewImage(input) {
                    const preview = document.getElementById('preview');
                    if (input.files && input.files[0]) {
                        const reader = new FileReader();

                        reader.onload = function(e) {
                            preview.src = e.target.result;
                            preview.classList.remove('hidden');
                        }

                        reader.readAsDataURL(input.files[0]);
                    } else {
                        preview.src = '#';
                        preview.classList.add('hidden');
                    }
                }
            </script>
           