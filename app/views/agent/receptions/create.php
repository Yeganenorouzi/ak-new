<?php require_once(APPROOT . "/views/public/header.php"); ?>
<?php require_once(APPROOT . "/views/public/sidebarAgent.php"); ?>


<?php if (isset($data['errors']) && !empty($data['errors'])): ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'خطا',
            html: `<?php echo implode('<br>', array_map('htmlspecialchars', $data['errors'])); ?>`,
            confirmButtonText: 'باشه'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?php echo URLROOT; ?>/receptions/agent";
            }
        });
    </script>
<?php endif; ?>

<div class="main-content">
    <div class="page-content dark:bg-zinc-700">
        <div class="container-fluid px-[0.625rem]">

            <form action="<?php echo URLROOT; ?>/receptions/store" method="POST" enctype="multipart/form-data">
                <!-- Header section with title and button -->
                <div class="grid grid-cols-1 mb-5">
                    <div class="flex items-center justify-between">
                        <h4 class="mb-sm-0 text-lg font-semibold grow text-gray-800 dark:text-gray-100">فرم پذیرش </h4>
                        <div class="flex gap-2">
                            <a href="<?php echo URLROOT; ?>/receptions/agent"
                                class="flex btn text-gray-700 bg-gray-200 border-gray-200 hover:bg-gray-300 hover:border-gray-300 focus:bg-gray-300 focus:border-gray-300 focus:ring focus:ring-gray-200/30 active:bg-gray-300 active:border-gray-300 dark:bg-zinc-600 dark:text-zinc-100 dark:border-zinc-600 dark:hover:bg-zinc-700 dark:hover:border-zinc-700">انصراف</a>
                            <button type="submit"
                                class="flex btn text-white bg-violet-500 border-violet-500 hover:bg-violet-600 hover:border-violet-600 focus:bg-violet-600 focus:border-violet-600 focus:ring focus:ring-violet-500/30 active:bg-violet-600 active:border-violet-600"
                                onclick="return validateForm()">ثبت پذیرش</button>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-5">
                    <div class="col-span-12 lg:col-span-6">
                        <div class="card mx-auto dark:bg-zinc-800 dark:border-zinc-600">
                            <div class="card-body pb-0">
                                <h6 class="mb-1 text-15 text-gray-700 dark:text-gray-100">اطلاعات مشتری </h6>
                            </div>
                            <div class="card-body">
                                <div class="grid grid-cols-12 gap-5">
                                    <div class="col-span-12 lg:col-span-6">
                                        <div class="mb-4">
                                            <label for="example-text-input"
                                                class="block font-medium text-gray-700 dark:text-gray-100 mb-2">نام و
                                                نام خانوادگی مشتری <span class="text-red-500">*</span></label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                type="text" id="example-text-input" name="name"
                                                value="<?php echo htmlspecialchars($data['name'] ?? ''); ?>" required>
                                        </div>
                                        <div class="mb-4">
                                            <label for="example-text-input"
                                                class="block font-medium text-gray-700 dark:text-gray-100 mb-2">شماره
                                                تلفن همراه <span class="text-red-500">*</span></label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                                type="tel" name="mobile"
                                                value="<?php echo htmlspecialchars($data['mobile'] ?? ''); ?>" required>
                                        </div>
                                        <div class="mb-4">
                                            <label for="example-text-input"
                                                class="block font-medium text-gray-700 dark:text-gray-100 mb-2">شماره
                                                تلفن ثابت <span class="text-red-500">*</span></label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                                type="tel" name="phone"
                                                value="<?php echo htmlspecialchars($data['phone'] ?? ''); ?>" required>
                                        </div>
                                        <div class="mb-4">
                                            <div class="mb-3">
                                                <label
                                                    class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">استان
                                                    <span class="text-red-500">*</span></label>
                                                <select
                                                    class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100"
                                                    name="ostan" id="province-select" required>
                                                    <option value="">انتخاب استان</option>
                                                    <?php foreach (ProvinceHelper::getProvinces() as $province): ?>
                                                        <option value="<?php echo $province; ?>" <?php echo (isset($data['ostan']) && $data['ostan'] === $province) ? 'selected' : ''; ?>>
                                                            <?php echo $province; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <div class="mb-3">
                                                <label
                                                    class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">شهر
                                                    <span class="text-red-500">*</span></label>
                                                <select
                                                    class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100"
                                                    name="shahr" required>
                                                    <option value="">انتخاب شهر</option>
                                                    <?php foreach (ProvinceHelper::getCities() as $province => $cities): ?>
                                                        <?php foreach ($cities as $city): ?>
                                                            <option value="<?php echo $city; ?>" <?php echo (isset($data['shahr']) && $data['shahr'] === $city) ? 'selected' : ''; ?>>
                                                                <?php echo $city; ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>




                                    </div>
                                    <div class="col-span-12 lg:col-span-6">
                                        <div class="mb-4">
                                            <label for="codemelli"
                                                class="block font-medium text-gray-700 dark:text-gray-100 mb-2">کدملی
                                                <span class="text-red-500">*</span></label>
                                            <div class="relative">
                                                <input
                                                    class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100 pr-[90px]"
                                                    type="text" id="codemelli" name="codemelli"
                                                    value="<?php echo htmlspecialchars($data['codemelli'] ?? ''); ?>"
                                                    required>
                                                <button type="button"
                                                    class="btn absolute left-0 top-0 h-full px-3 text-white bg-violet-500 border-violet-500 hover:bg-violet-600 hover:border-violet-600 focus:bg-violet-600 focus:border-violet-600 focus:ring focus:ring-violet-500/30 active:bg-violet-600 active:border-violet-600 rounded-l"
                                                    id="search-button">
                                                    استعلام
                                                </button>
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <label for="passport"
                                                class="block font-medium text-gray-700 dark:text-gray-100 mb-2">شماره
                                                پاسپورت</label>
                                            <div class="relative">
                                                <input
                                                    class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100 pr-[90px]"
                                                    type="text" id="passport" name="passport"
                                                    value="<?php echo htmlspecialchars($data['passport'] ?? ''); ?>">
                                                <button type="button"
                                                    class="btn absolute left-0 top-0 h-full px-3 text-white bg-violet-500 border-violet-500 hover:bg-violet-600 hover:border-violet-600 focus:bg-violet-600 focus:border-violet-600 focus:ring focus:ring-violet-500/30 active:bg-violet-600 active:border-violet-600 rounded-l"
                                                    id="search-passport-button">
                                                    استعلام
                                                </button>
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <label for="example-text-input"
                                                class="block font-medium text-gray-700 dark:text-gray-100 mb-2">کد پستی
                                                <span class="text-red-500">*</span></label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                                type="text" name="codeposti"
                                                value="<?php echo htmlspecialchars($data['codeposti'] ?? ''); ?>"
                                                required>
                                        </div>

                                        <div class="mb-4">
                                            <label for="example-text-input"
                                                class="block font-medium text-gray-700 dark:text-gray-100 mb-2">آدرس
                                                <span class="text-red-500">*</span></label>
                                            <textarea
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                style="height: 210px; resize: none;" name="address"
                                                required><?php echo htmlspecialchars($data['address'] ?? ''); ?></textarea>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 lg:col-span-6">
                        <div class="card mx-auto dark:bg-zinc-800 dark:border-zinc-600">
                            <div class="card-body pb-0">
                                <h6 class="mb-1 text-15 text-gray-700 dark:text-gray-100">اطلاعات تلفن همراه </h6>
                            </div>
                            <div class="card-body">
                                <div class="grid grid-cols-12 gap-5">
                                    <div class="col-span-12 lg:col-span-6">
                                        <div class="mb-4">
                                            <label for="serial"
                                                class="block font-medium text-gray-700 dark:text-gray-100 mb-2">سریال
                                                <span class="text-red-500">*</span></label>
                                            <div class="relative">
                                                <input
                                                    class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100 pr-[90px]"
                                                    type="text" id="serial" name="serial"
                                                    value="<?php echo htmlspecialchars($data['serial'] ?? ''); ?>"
                                                    required>
                                                <button type="button"
                                                    class="btn absolute left-0 top-0 h-full px-3 text-white bg-violet-500 border-violet-500 hover:bg-violet-600 hover:border-violet-600 focus:bg-violet-600 focus:border-violet-600 focus:ring focus:ring-violet-500/30 active:bg-violet-600 active:border-violet-600 rounded-l"
                                                    id="search-button-2">
                                                    استعلام
                                                </button>
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <label for="example-text-input"
                                                class="block font-medium text-gray-700 dark:text-gray-100 mb-2">عنوان
                                                درختواره دستگاه </label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                type="text" name="model" id="example-text-input">
                                        </div>
                                        <div class="mb-4">
                                            <label for="example-text-input"
                                                class="block font-medium text-gray-700 dark:text-gray-100 mb-2">حافظه
                                                داخلی دستگاه </label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                type="text" name="att1_code" id="example-text-input">
                                        </div>

                                        <div class="mb-4">
                                            <label for="example-text-input"
                                                class="block font-medium text-gray-700 dark:text-gray-100 mb-2">رنگ
                                                دستگاه </label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                type="text" name="att3_code" id="example-text-input">
                                        </div>

                                        <div class="mb-4">
                                            <label for="example-text-input"
                                                class="block font-medium text-gray-700 dark:text-gray-100 mb-2">نام شرکت
                                                واردکننده دستگاه</label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                type="text" name="company" id="example-text-input">
                                        </div>
                                        <div class="mb-4">
                                            <label for="example-text-input"
                                                class="block font-medium text-gray-700 dark:text-gray-100 mb-2">تاریخ
                                                شروع گارانتی دستگاه</label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                type="text" name="start_guarantee" id="example-text-input">
                                        </div>


                                    </div>
                                    <div class="col-span-12 lg:col-span-6">
                                        <div class="mb-4">
                                            <label for="example-text-input"
                                                class="block font-medium text-gray-700 dark:text-gray-100 mb-2">سریال
                                                دوم دستگاه</label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                type="text" name="serial2" id="example-text-input">
                                        </div>
                                        <div class="mb-4">
                                            <label for="example-text-input"
                                                class="block font-medium text-gray-700 dark:text-gray-100 mb-2">عنوان
                                                دستگاه</label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                type="text" name="title" id="example-text-input">
                                        </div>
                                        <div class="mb-4">
                                            <label for="example-text-input"
                                                class="block font-medium text-gray-700 dark:text-gray-100 mb-2">حافظه
                                                RAM دستگاه </label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                type="text" name="att2_code" id="example-text-input">
                                        </div>

                                        <div class="mb-4">
                                            <label for="example-text-input"
                                                class="block font-medium text-gray-700 dark:text-gray-100 mb-2">کشور
                                                سازنده دستگاه </label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                type="text" name="att4_code" id="example-text-input">
                                        </div>
                                        <div class="mb-4">
                                            <label for="example-text-input"
                                                class="block font-medium text-gray-700 dark:text-gray-100 mb-2">شماره
                                                سند واردات دستگاه</label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                type="text" name="sh_sanad" id="example-text-input">
                                        </div>
                                        <div class="mb-4">
                                            <label for="example-text-input"
                                                class="block font-medium text-gray-700 dark:text-gray-100 mb-2">تاریخ
                                                پایان گارانتی دستگاه</label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                type="text" name="expite_guarantee" id="example-text-input">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1">
                    <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                        <div class="card-body pb-0">
                            <h6 class="mb-1 text-15 text-gray-700 dark:text-gray-100">اطلاعات تکمیلی پذیرش</h6>
                        </div>
                        <div class="card-body">
                            <div class="grid grid-cols-12 gap-5">
                                <div class="col-span-12 lg:col-span-4">
                                    <div class="mb-4">
                                        <div class="mb-3">
                                            <label class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">نوع
                                                پذیرش <span class="text-red-500">*</span></label>
                                            <select
                                                class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100"
                                                name="paziresh_status" required
                                                value="<?php echo htmlspecialchars($data['paziresh_status'] ?? ''); ?>">
                                                <option>انتخاب</option>
                                                <option> پذیرش حضوری</option>
                                                <option> پذیرش غیرحضوری</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block font-medium text-gray-700 dark:text-gray-100 mb-2">وضعیت
                                            فعال‌سازی <span class="text-red-500">*</span></label>
                                        <select
                                            class="w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                            name="activation_status" id="activation_status" required>
                                            <option value="">انتخاب کنید</option>
                                            <option value="فعالسازی شده" <?php echo (isset($data['activation_status']) && $data['activation_status'] == 'فعالسازی شده') ? 'selected' : ''; ?>>
                                                فعال‌سازی شده</option>
                                            <option value="فعالسازی نشده" <?php echo (isset($data['activation_status']) && $data['activation_status'] == 'فعالسازی نشده') ? 'selected' : ''; ?>>
                                                فعال‌سازی نشده</option>
                                        </select>
                                    </div>
                                    <div class="mb-4" id="activation_date_container"
                                        style="display: <?php echo (isset($data['activation_status']) && $data['activation_status'] == 'فعالسازی شده') ? 'block' : 'none'; ?>;">
                                        <label for="activation_start_date"
                                            class="block font-medium text-gray-700 dark:text-gray-100 mb-2">تاریخ
                                            فعالسازی <span class="text-red-500">*</span></label>
                                        <input
                                            class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                            type="text" name="activation_start_date" id="activation_start_date" <?php echo (isset($data['activation_status']) && $data['activation_status'] == 'فعالسازی شده') ? 'required' : 'disabled'; ?>
                                            value="<?php echo htmlspecialchars($data['activation_start_date'] ?? ''); ?>">

                                        <label for="activation_day"
                                            class="block font-medium text-gray-700 dark:text-gray-100 mb-2 mt-2">تعداد
                                            روز فعالسازی <span class="text-red-500">*</span></label>
                                        <input
                                            class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                            type="text" name="activation_day" id="activation_day" required
                                            value="<?php echo htmlspecialchars($data['activation_day'] ?? ''); ?>"
                                            readonly <?php echo (isset($data['activation_status']) && $data['activation_status'] == 'active') ? '' : 'disabled'; ?>>
                                    </div>
                                </div>
                                <div class="col-span-12 lg:col-span-4">
                                    <div class="mb-4">
                                        <div class="mb-3">
                                            <label class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">وضعیت
                                                گارانتی <span class="text-red-500">*</span></label>
                                            <select
                                                class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100"
                                                name="guarantee_status" required
                                                value="<?php echo htmlspecialchars($data['guarantee_status'] ?? ''); ?>">
                                                <option>انتخاب</option>
                                                <option>تحت گارانتی</option>
                                                <option>ابطال گارانتی</option>
                                                <option>نیاز به بررسی کارشناس </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label for="example-text-input"
                                            class="block font-medium text-gray-700 dark:text-gray-100 mb-2">شرایط فیزیکی
                                            دستگاه <span class="text-red-500">*</span></label>
                                        <input
                                            class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                            type="text" name="situation" required
                                            value="<?php echo htmlspecialchars($data['situation'] ?? ''); ?>">
                                    </div>
                                    <div class="mb-4">
                                        <label for="example-text-input"
                                            class="block font-medium text-gray-700 dark:text-gray-100 mb-2">ایراد دستگاه
                                            به اظهار مشتری <span class="text-red-500">*</span></label>
                                        <input
                                            class="w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                            type="text" id="example-month-input" name="problem" required
                                            value="<?php echo htmlspecialchars($data['problem'] ?? ''); ?>">
                                    </div>
                                    <div class="mb-4">
                                        <label class="block font-medium text-gray-700 dark:text-gray-100 mb-3">لوازم
                                            همراه</label>
                                        <div
                                            class="grid grid-cols-2 md:grid-cols-3 gap-3 p-4 bg-gray-50 dark:bg-zinc-700/30 rounded-lg border border-gray-200 dark:border-zinc-600">
                                            <div
                                                class="flex items-center space-x-3 rtl:space-x-reverse p-2 bg-white dark:bg-zinc-800 rounded-md border border-gray-100 dark:border-zinc-600">
                                                <input type="checkbox"
                                                    class="rounded focus:ring-0 focus:ring-offset-0 dark:bg-zinc-700 dark:border-zinc-400 checked:bg-violet-500 dark:checked:bg-violet-500"
                                                    id="acc_box" name="accessories[]" value="box">
                                                <label
                                                    class="font-medium text-gray-700 dark:text-zinc-100 cursor-pointer"
                                                    for="acc_box">جعبه</label>
                                            </div>

                                            <div
                                                class="flex items-center space-x-3 rtl:space-x-reverse p-2 bg-white dark:bg-zinc-800 rounded-md border border-gray-100 dark:border-zinc-600">
                                                <input type="checkbox"
                                                    class="rounded focus:ring-0 focus:ring-offset-0 dark:bg-zinc-700 dark:border-zinc-400 checked:bg-violet-500 dark:checked:bg-violet-500"
                                                    id="acc_warranty" name="accessories[]" value="warrantycard">
                                                <label
                                                    class="font-medium text-gray-700 dark:text-zinc-100 cursor-pointer"
                                                    for="acc_warranty">کارت گارانتی</label>
                                            </div>

                                            <div
                                                class="flex items-center space-x-3 rtl:space-x-reverse p-2 bg-white dark:bg-zinc-800 rounded-md border border-gray-100 dark:border-zinc-600">
                                                <input type="checkbox"
                                                    class="rounded focus:ring-0 focus:ring-offset-0 dark:bg-zinc-700 dark:border-zinc-400 checked:bg-violet-500 dark:checked:bg-violet-500"
                                                    id="acc_adapter" name="accessories[]" value="adapter">
                                                <label
                                                    class="font-medium text-gray-700 dark:text-zinc-100 cursor-pointer"
                                                    for="acc_adapter">آداپتور</label>
                                            </div>

                                            <div
                                                class="flex items-center space-x-3 rtl:space-x-reverse p-2 bg-white dark:bg-zinc-800 rounded-md border border-gray-100 dark:border-zinc-600">
                                                <input type="checkbox"
                                                    class="rounded focus:ring-0 focus:ring-offset-0 dark:bg-zinc-700 dark:border-zinc-400 checked:bg-violet-500 dark:checked:bg-violet-500"
                                                    id="acc_cable" name="accessories[]" value="cable">
                                                <label
                                                    class="font-medium text-gray-700 dark:text-zinc-100 cursor-pointer"
                                                    for="acc_cable">کابل شارژ</label>
                                            </div>

                                            <div
                                                class="flex items-center space-x-3 rtl:space-x-reverse p-2 bg-white dark:bg-zinc-800 rounded-md border border-gray-100 dark:border-zinc-600">
                                                <input type="checkbox"
                                                    class="rounded focus:ring-0 focus:ring-offset-0 dark:bg-zinc-700 dark:border-zinc-400 checked:bg-violet-500 dark:checked:bg-violet-500"
                                                    id="acc_handsfree" name="accessories[]" value="handsfree">
                                                <label
                                                    class="font-medium text-gray-700 dark:text-zinc-100 cursor-pointer"
                                                    for="acc_handsfree">هندزفری</label>
                                            </div>

                                            <div
                                                class="flex items-center space-x-3 rtl:space-x-reverse p-2 bg-white dark:bg-zinc-800 rounded-md border border-gray-100 dark:border-zinc-600">
                                                <input type="checkbox"
                                                    class="rounded focus:ring-0 focus:ring-offset-0 dark:bg-zinc-700 dark:border-zinc-400 checked:bg-violet-500 dark:checked:bg-violet-500"
                                                    id="acc_pin" name="accessories[]" value="pin">
                                                <label
                                                    class="font-medium text-gray-700 dark:text-zinc-100 cursor-pointer"
                                                    for="acc_pin">سوزن</label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-span-12 lg:col-span-4">
                                    <div class="mb-4">
                                        <div class="mb-3">
                                            <label class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">نوع
                                                تعمیر <span class="text-red-500">*</span></label>
                                            <select
                                                class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100"
                                                name="repair_status" required
                                                value="<?php echo htmlspecialchars($data['repair_status'] ?? ''); ?>">
                                                <option>انتخاب</option>
                                                <option>تعمیر</option>
                                                <option>تعویض </option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label for="example-text-input"
                                            class="block font-medium text-gray-700 dark:text-gray-100 mb-2">زمان تقریبی
                                            تعمیر <span class="text-red-500">*</span></label>
                                        <input
                                            class="w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                            type="text" id="example-month-input" name="estimated_time" required
                                            value="<?php echo htmlspecialchars($data['estimated_time'] ?? ''); ?>">
                                    </div>
                                    <div class="mb-4">
                                        <label for="example-text-input"
                                            class="block font-medium text-gray-700 dark:text-gray-100 mb-2"> هزینه
                                            تقریبی تعمیر <span class="text-red-500">*</span></label>
                                        <input
                                            class="w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                            type="text" value="" id="example-week-input" name="estimated_cost" required
                                            value="<?php echo htmlspecialchars($data['estimated_cost'] ?? ''); ?>">
                                    </div>

                                    <div class="mb-4">
                                        <label for="example-text-input"
                                            class="block font-medium text-gray-700 dark:text-gray-100 mb-2">توضیحات
                                        </label>
                                        <input
                                            class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                            type="text" name="dex"
                                            value="<?php echo htmlspecialchars($data['dex'] ?? ''); ?>">
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1">
                    <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                        <div class="card-body pb-0">
                            <h6 class="mb-1 text-15 text-gray-700 dark:text-gray-100">پیوست‌ها</h6>
                        </div>
                        <div class="card-body">
                            <div class="grid grid-cols-12 gap-5">
                                <!-- کارت شناسایی -->
                                <div class="col-span-12 lg:col-span-4">
                                    <div class="mb-4">
                                        <label for="avatar1"
                                            class="block font-medium text-gray-700 dark:text-gray-100 mb-2">کارت
                                            شناسایی</label>
                                        <input name="image1"
                                            class="input-field w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                            type="file" id="avatar1" accept="image/*"
                                            onchange="previewImage(this, 'preview1');">
                                        <div class="mt-2">
                                            <img id="preview1" src="#" alt="پیش نمایش تصویر" class="hidden rounded-lg"
                                                style="width: 150px; height: 150px; object-fit: cover;">
                                        </div>
                                    </div>
                                </div>

                                <!-- تصویر فاکتور خرید -->
                                <div class="col-span-12 lg:col-span-4">
                                    <div class="mb-4">
                                        <label for="avatar2"
                                            class="block font-medium text-gray-700 dark:text-gray-100 mb-2">تصویر فاکتور
                                            خرید</label>
                                        <input name="image2"
                                            class="input-field w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                            type="file" id="avatar2" accept="image/*"
                                            onchange="previewImage(this, 'preview2');">
                                        <div class="mt-2">
                                            <img id="preview2" src="#" alt="پیش نمایش تصویر" class="hidden rounded-lg"
                                                style="width: 150px; height: 150px; object-fit: cover;">
                                        </div>
                                    </div>
                                </div>

                                <!-- تصویر ایراد -->
                                <div class="col-span-12 lg:col-span-4">
                                    <div class="mb-4">
                                        <label for="avatar3"
                                            class="block font-medium text-gray-700 dark:text-gray-100 mb-2">تصویر
                                            ایراد</label>
                                        <input name="image3"
                                            class="input-field w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                            type="file" id="avatar3" accept="image/*"
                                            onchange="previewImage(this, 'preview3');">
                                        <div class="mt-2">
                                            <img id="preview3" src="#" alt="پیش نمایش تصویر" class="hidden rounded-lg"
                                                style="width: 150px; height: 150px; object-fit: cover;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>





</form>

<?php require_once(APPROOT . "/views/public/footer.php"); ?>

<script>
    function previewImage(input, previewId) {
        const preview = document.getElementById(previewId);
        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function (e) {
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

<script>
    // تابع اعتبارسنجی شماره موبایل ایران
    function validateMobile(mobile) {
        // شماره موبایل ایران: 09xxxxxxxxx (11 رقم)
        return /^09\d{9}$/.test(mobile);
    }

    // تابع اعتبارسنجی شماره تلفن ثابت ایران
    function validatePhone(phone) {
        // تلفن ثابت: کد شهر (2-3 رقم) + شماره (6-8 رقم) = 8-11 رقم کل
        return /^0\d{2,3}\d{6,8}$/.test(phone);
    }

    // تابع اعتبارسنجی کد پستی ایران
    function validatePostalCode(code) {
        // کد پستی ایران: 10 رقم
        return /^\d{10}$/.test(code);
    }

    // تابع اعتبارسنجی کامل فرم
    function validateForm() {
        const name = document.querySelector('[name="name"]').value.trim();
        const mobile = document.querySelector('[name="mobile"]').value.trim();
        const phone = document.querySelector('[name="phone"]').value.trim();
        const codemelli = document.querySelector('[name="codemelli"]').value.trim();
        const codeposti = document.querySelector('[name="codeposti"]').value.trim();
        const serial = document.querySelector('[name="serial"]').value.trim();

        // بررسی فیلدهای اجباری
        if (!name) {
            Swal.fire({
                icon: 'warning',
                title: 'هشدار',
                text: 'لطفاً نام و نام خانوادگی را وارد کنید',
                confirmButtonText: 'باشه'
            });
            return false;
        }

        if (!mobile) {
            Swal.fire({
                icon: 'warning',
                title: 'هشدار',
                text: 'لطفاً شماره موبایل را وارد کنید',
                confirmButtonText: 'باشه'
            });
            return false;
        }

        if (!validateMobile(mobile)) {
            Swal.fire({
                icon: 'error',
                title: 'شماره موبایل نامعتبر',
                text: 'شماره موبایل باید به صورت 09xxxxxxxxx باشد',
                confirmButtonText: 'باشه'
            });
            return false;
        }

        if (!phone) {
            Swal.fire({
                icon: 'warning',
                title: 'هشدار',
                text: 'لطفاً شماره تلفن ثابت را وارد کنید',
                confirmButtonText: 'باشه'
            });
            return false;
        }

        if (!validatePhone(phone)) {
            Swal.fire({
                icon: 'error',
                title: 'شماره تلفن نامعتبر',
                text: 'شماره تلفن ثابت را به درستی وارد کنید (مثال: 02112345678)',
                confirmButtonText: 'باشه'
            });
            return false;
        }

        if (!codemelli) {
            Swal.fire({
                icon: 'warning',
                title: 'هشدار',
                text: 'لطفاً کد ملی را وارد کنید',
                confirmButtonText: 'باشه'
            });
            return false;
        }

        if (!validateNationalCode(codemelli)) {
            Swal.fire({
                icon: 'error',
                title: 'کد ملی نامعتبر',
                text: 'کد ملی وارد شده صحیح نمی‌باشد',
                confirmButtonText: 'باشه'
            });
            return false;
        }

        if (!codeposti) {
            Swal.fire({
                icon: 'warning',
                title: 'هشدار',
                text: 'لطفاً کد پستی را وارد کنید',
                confirmButtonText: 'باشه'
            });
            return false;
        }

        if (!validatePostalCode(codeposti)) {
            Swal.fire({
                icon: 'error',
                title: 'کد پستی نامعتبر',
                text: 'کد پستی باید 10 رقم باشد',
                confirmButtonText: 'باشه'
            });
            return false;
        }

        if (!serial) {
            Swal.fire({
                icon: 'warning',
                title: 'هشدار',
                text: 'لطفاً سریال دستگاه را وارد کنید',
                confirmButtonText: 'باشه'
            });
            return false;
        }

        if (!validateSerial(serial)) {
            Swal.fire({
                icon: 'error',
                title: 'سریال نامعتبر',
                text: 'سریال دستگاه باید حداقل 8 کاراکتر و شامل حروف انگلیسی و اعداد باشد',
                confirmButtonText: 'باشه'
            });
            return false;
        }

        return true;
    }

    // تابع اعتبارسنجی کد ملی ایران
    function validateNationalCode(code) {
        if (!code || code.length !== 10) return false;
        
        // چک کردن اینکه همه ارقام یکسان نباشند
        if (/^(\d)\1{9}$/.test(code)) return false;
        
        // محاسبه چک‌سام
        let sum = 0;
        for (let i = 0; i < 9; i++) {
            sum += parseInt(code.charAt(i)) * (10 - i);
        }
        
        let remainder = sum % 11;
        let checkDigit = parseInt(code.charAt(9));
        
        if (remainder < 2) {
            return checkDigit === remainder;
        } else {
            return checkDigit === 11 - remainder;
        }
    }

    document.getElementById('search-button').addEventListener('click', function() {
        const codemelli = document.getElementById('codemelli').value.trim();

        if (!codemelli) {
            Swal.fire({
                icon: 'warning',
                title: 'هشدار',
                text: 'لطفاً کد ملی را وارد کنید',
                confirmButtonText: 'باشه'
            });
            return;
        }

        if (!/^\d{10}$/.test(codemelli)) {
            Swal.fire({
                icon: 'error',
                title: 'خطا',
                text: 'کد ملی باید 10 رقم باشد',
                confirmButtonText: 'باشه'
            });
            return;
        }

        if (!validateNationalCode(codemelli)) {
            Swal.fire({
                icon: 'error',
                title: 'کد ملی نامعتبر',
                text: 'کد ملی وارد شده صحیح نمی‌باشد',
                confirmButtonText: 'باشه'
            });
            return;
        }

        fetch('<?php echo URLROOT; ?>/customers/searchOrCreate', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `codemelli=${encodeURIComponent(codemelli)}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'found') {
                    // پر کردن سایر فیلدها
                    document.querySelector('[name="name"]').value = data.data.name;
                    document.querySelector('[name="mobile"]').value = data.data.mobile;
                    document.querySelector('[name="phone"]').value = data.data.phone;
                    document.querySelector('[name="address"]').value = data.data.address;
                    document.querySelector('[name="codeposti"]').value = data.data.codeposti;
                    document.querySelector('[name="passport"]').value = data.data.passport;

                    // ست کردن استان
                    const provinceSelect = document.querySelector('[name="ostan"]');
                    provinceSelect.value = data.data.ostan;

                    // تریگر کردن رویداد change برای لود شدن شهرها
                    const event = new Event('change');
                    provinceSelect.dispatchEvent(event);

                    // کمی تاخیر برای اطمینان از لود شدن شهرها و سپس ست کردن شهر
                    setTimeout(() => {
                        const citySelect = document.querySelector('[name="shahr"]');
                        citySelect.value = data.data.shahr;
                    }, 100);

                } else if (data.status === 'not_found') {
                    Swal.fire({
                        icon: 'info',
                        title: 'مشتری جدید',
                        text: 'کد ملی در سیستم نیست. لطفاً اطلاعات مشتری جدید را وارد کنید.',
                        confirmButtonText: 'باشه'
                    });
                    // پاک کردن فیلدها
                    document.querySelector('[name="name"]').value = '';
                    document.querySelector('[name="mobile"]').value = '';
                    document.querySelector('[name="phone"]').value = '';
                    document.querySelector('[name="ostan"]').value = '';
                    document.querySelector('[name="shahr"]').value = '';
                    document.querySelector('[name="address"]').value = '';
                    document.querySelector('[name="codeposti"]').value = '';
                    document.querySelector('[name="passport"]').value = '';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'خطا',
                    text: 'خطا در برقراری ارتباط با سرور',
                    confirmButtonText: 'باشه'
                });
            });
    });

    
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const provinceSelect = document.querySelector('select[name="ostan"]');
        const citySelect = document.querySelector('select[name="shahr"]');
        const cities = <?php echo json_encode(ProvinceHelper::getCities()); ?>;

        provinceSelect.addEventListener('change', function() {
            const selectedProvince = this.value;
            citySelect.innerHTML = '<option value="">انتخاب شهر</option>';

            if (cities[selectedProvince]) {
                cities[selectedProvince].forEach(city => {
                    const option = document.createElement('option');
                    option.value = city;
                    option.textContent = city;
                    citySelect.appendChild(option);
                });
            }
        });
    });
</script>


<script>
    // تابع اعتبارسنجی سریال دستگاه
    function validateSerial(serial) {
        // حداقل 8 کاراکتر، فقط حروف، اعداد و کاراکترهای مجاز
        if (!serial || serial.length < 8) return false;
        
        // فقط حروف انگلیسی، اعداد و کاراکترهای خاص مجاز
        if (!/^[A-Za-z0-9\-\_\.]+$/.test(serial)) return false;
        
        return true;
    }

    document.getElementById('search-button-2').addEventListener('click', function(e) {
        e.preventDefault();
        const serial = document.getElementById('serial').value.trim();

        if (!serial) {
            Swal.fire({
                icon: 'warning',
                title: 'هشدار',
                text: 'لطفاً سریال دستگاه را وارد کنید',
                confirmButtonText: 'باشه'
            });
            return;
        }

        if (!validateSerial(serial)) {
            Swal.fire({
                icon: 'error',
                title: 'سریال نامعتبر',
                text: 'سریال دستگاه باید حداقل 8 کاراکتر و شامل حروف انگلیسی و اعداد باشد',
                confirmButtonText: 'باشه'
            });
            return;
        }

        fetch('<?php echo URLROOT; ?>/cards/searchOrCreate', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `serial=${encodeURIComponent(serial)}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'found') {
                    // پر کردن سایر فیلدها
                    document.querySelector('[name="serial2"]').value = data.data.serial2;
                    document.querySelector('[name="model"]').value = data.data.model;
                    document.querySelector('[name="title"]').value = data.data.title;
                    document.querySelector('[name="att1_code"]').value = data.data.att1_code;
                    document.querySelector('[name="att2_code"]').value = data.data.att2_code;
                    document.querySelector('[name="att3_code"]').value = data.data.att3_code;
                    document.querySelector('[name="att4_code"]').value = data.data.att4_code;
                    document.querySelector('[name="company"]').value = data.data.company;
                    document.querySelector('[name="sh_sanad"]').value = data.data.sh_sanad;
                    document.querySelector('[name="start_guarantee"]').value = data.data.start_guarantee;
                    document.querySelector('[name="expite_guarantee"]').value = data.data.expite_guarantee;


                } else if (data.status === 'not_found') {
                    Swal.fire({
                        icon: 'info',
                        title: 'کارت جدید',
                        text: 'کارت در سیستم نیست. لطفاً اطلاعات کارت جدید را وارد کنید.',
                        confirmButtonText: 'باشه'
                    });
                    // فقط سایر فیلدها پاک شوند
                    document.querySelector('[name="serial2"]').value = '';
                    document.querySelector('[name="model"]').value = '';
                    document.querySelector('[name="title"]').value = '';
                    document.querySelector('[name="att1_code"]').value = '';
                    document.querySelector('[name="att2_code"]').value = '';
                    document.querySelector('[name="att3_code"]').value = '';
                    document.querySelector('[name="att4_code"]').value = '';
                    document.querySelector('[name="company"]').value = '';
                    document.querySelector('[name="sh_sanad"]').value = '';
                    document.querySelector('[name="start_guarantee"]').value = '';
                    document.querySelector('[name="expite_guarantee"]').value = '';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'خطا',
                    text: 'خطا در برقراری ارتباط با سرور',
                    confirmButtonText: 'باشه'
                });
            });
    });

   
</script>

<script>
    // تابع اعتبارسنجی پاسپورت
    function validatePassport(passport) {
        // حداقل 6 کاراکتر، حداکثر 15 کاراکتر، حروف انگلیسی و اعداد
        if (!passport || passport.length < 6 || passport.length > 15) return false;
        
        // فقط حروف انگلیسی و اعداد
        if (!/^[A-Za-z0-9]+$/.test(passport)) return false;
        
        return true;
    }

    document.getElementById('search-passport-button').addEventListener('click', function() {
        const passport = document.getElementById('passport').value.trim();
        
        if (!passport) {
            Swal.fire({
                icon: 'warning',
                title: 'هشدار',
                text: 'لطفا شماره پاسپورت را وارد کنید',
                confirmButtonText: 'باشه'
            });
            return;
        }

        if (!validatePassport(passport)) {
            Swal.fire({
                icon: 'error',
                title: 'پاسپورت نامعتبر',
                text: 'شماره پاسپورت باید 6 تا 15 کاراکتر و شامل حروف انگلیسی و اعداد باشد',
                confirmButtonText: 'باشه'
            });
            return;
        }

        fetch('<?php echo URLROOT; ?>/customers/searchOrCreate', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `search_type=passport&passport=${encodeURIComponent(passport)}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'found') {
                // پر کردن سایر فیلدها
                document.querySelector('[name="name"]').value = data.data.name;
                document.querySelector('[name="mobile"]').value = data.data.mobile;
                document.querySelector('[name="phone"]').value = data.data.phone;
                document.querySelector('[name="address"]').value = data.data.address;
                document.querySelector('[name="codeposti"]').value = data.data.codeposti;
                document.querySelector('[name="codemelli"]').value = data.data.codemelli;

                // ست کردن استان
                const provinceSelect = document.querySelector('[name="ostan"]');
                provinceSelect.value = data.data.ostan;

                // تریگر کردن رویداد change برای لود شدن شهرها
                const event = new Event('change');
                provinceSelect.dispatchEvent(event);

                // کمی تاخیر برای اطمینان از لود شدن شهرها و سپس ست کردن شهر
                setTimeout(() => {
                    const citySelect = document.querySelector('[name="shahr"]');
                    citySelect.value = data.data.shahr;
                }, 100);
            } else if (data.status === 'not_found') {
                Swal.fire({
                    icon: 'info',
                    title: 'مشتری جدید',
                    text: 'شماره پاسپورت در سیستم نیست. لطفاً اطلاعات مشتری جدید را وارد کنید.',
                    confirmButtonText: 'باشه'
                });
                // پاک کردن فیلدها
                document.querySelector('[name="name"]').value = '';
                document.querySelector('[name="mobile"]').value = '';
                document.querySelector('[name="phone"]').value = '';
                document.querySelector('[name="ostan"]').value = '';
                document.querySelector('[name="shahr"]').value = '';
                document.querySelector('[name="address"]').value = '';
                document.querySelector('[name="codeposti"]').value = '';
                document.querySelector('[name="codemelli"]').value = '';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'خطا',
                text: 'خطا در برقراری ارتباط با سرور',
                confirmButtonText: 'باشه'
            });
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add data-jdp attribute to date inputs
        const startGuarantee = document.querySelector('[name="start_guarantee"]');
        const expireGuarantee = document.querySelector('[name="expite_guarantee"]');
        const activationDate = document.querySelector('[name="activation_start_date"]');
        
        if (startGuarantee) {
            startGuarantee.setAttribute('data-jdp', '');
            startGuarantee.setAttribute('placeholder', 'تاریخ شروع گارانتی');
        }
        
        if (expireGuarantee) {
            expireGuarantee.setAttribute('data-jdp', '');
            expireGuarantee.setAttribute('placeholder', 'تاریخ پایان گارانتی');
        }

        if (activationDate) {
            activationDate.setAttribute('data-jdp', '');
            activationDate.setAttribute('placeholder', 'تاریخ فعالسازی');
        }
    });
</script>

<script>
document.getElementById('activation_status').addEventListener('change', function() {
    var container = document.getElementById('activation_date_container');
    var dateInput = document.getElementById('activation_start_date');
    var dayInput = document.getElementById('activation_day');
    if (this.value === 'فعالسازی شده') {
        container.style.display = 'block';
        dateInput.removeAttribute('disabled');
        dateInput.setAttribute('required', 'required');
        dayInput.removeAttribute('disabled');
    } else {
        container.style.display = 'none';
        dateInput.removeAttribute('required');
        dateInput.setAttribute('disabled', 'disabled');
        dateInput.value = '';
        dayInput.setAttribute('disabled', 'disabled');
        dayInput.value = '';
    }
});
</script>
<script src="https://unpkg.com/jalali-moment@3.3.11/dist/jalali-moment.browser.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const activationStatus = document.getElementById('activation_status');
    const activationDateInput = document.getElementById('activation_start_date');
    const activationDayInput = document.getElementById('activation_day');
    const activationDateContainer = document.getElementById('activation_date_container');

    if (!activationStatus || !activationDateInput || !activationDayInput || !activationDateContainer) return;

    function toggleActivationDateContainer() {
        // نمایش/مخفی کردن کانتینر تاریخ بر اساس وضعیت
        activationDateContainer.style.display = activationStatus.value === 'فعالسازی شده' ? 'block' : 'none';
        // خالی کردن فیلد تعداد روز اگه وضعیت غیرفعال باشه
        if (activationStatus.value !== 'فعالسازی شده') {
            activationDayInput.value = '';
        }
    }

    function calculateDays() {
        if (activationStatus.value === 'فعالسازی شده' && activationDateInput.value) {
            const startDate = moment(activationDateInput.value.replace(/-/g, '/'), 'jYYYY/jMM/jDD');
            if (!startDate.isValid()) {
                activationDayInput.value = '';
                return;
            }
            const today = moment();
            const diffDays = today.diff(startDate, 'days');
            activationDayInput.value = diffDays >= 0 ? diffDays : 'تاریخ آینده';
        } else {
            activationDayInput.value = '';
        }
    }

    // رویدادها
    activationStatus.addEventListener('change', function() {
        toggleActivationDateContainer();
        calculateDays();
    });
    activationDateInput.addEventListener('change', calculateDays);

    // اجرای اولیه
    toggleActivationDateContainer();
    calculateDays();
});
</script>
