<?php require_once(APPROOT . "/views/public/header.php"); ?>
<?php require_once(APPROOT . "/views/public/sidebarAgent.php"); ?>

<div class="main-content">
    <div class="page-content dark:bg-zinc-700">
        <div class="container-fluid px-[0.625rem]">

            <form action="<?php echo URLROOT; ?>/receptions/store" method="POST" enctype="multipart/form-data">
                <!-- Header section with title and button -->
                <div class="grid grid-cols-1 mb-5">
                    <div class="flex items-center justify-between">
                        <h4 class="mb-sm-0 text-lg font-semibold grow text-gray-800 dark:text-gray-100">فرم پذیرش </h4>
                        <button type="submit" class="flex btn text-white bg-violet-500 border-violet-500 hover:bg-violet-600 hover:border-violet-600 focus:bg-violet-600 focus:border-violet-600 focus:ring focus:ring-violet-500/30 active:bg-violet-600 active:border-violet-600 ltr:mr-2 rtl:ml-2">ثبت پذیرش </button>

                        
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
                                            <label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">نام و نام خانوادگی مشتری</label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                type="text"
                                                id="example-text-input"
                                                name="name"
                                                value="<?php echo htmlspecialchars($data['name'] ?? ''); ?>"
                                                required>
                                        </div>
                                        <div class="mb-4">
                                            <label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">شماره تلفن همراه</label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                                type="tel"
                                                id="example-date-input"
                                                name="mobile"
                                                value="<?php echo htmlspecialchars($data['mobile'] ?? ''); ?>"
                                                required>
                                        </div>
                                        <div class="mb-4">
                                            <label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">شماره تلفن ثابت</label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                                type="tel"
                                                id="example-date-input"
                                                name="phone"
                                                value="<?php echo htmlspecialchars($data['phone'] ?? ''); ?>"
                                                required>
                                        </div>
                                        <div class="mb-4">
                                            <div class="mb-3">
                                                <label class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">استان</label>
                                                <select class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100"
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
                                                <label class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">شهر</label>
                                                <select class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100"
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
                                            <label for="codemelli" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">کدملی</label>
                                            <div class="relative">
                                                <input
                                                    class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100 pr-[90px]"
                                                    type="text"
                                                    id="codemelli"
                                                    name="codemelli"
                                                    value="<?php echo htmlspecialchars($data['codemelli'] ?? ''); ?>"
                                                    required>
                                                <button
                                                    type="button"
                                                    class="btn absolute left-0 top-0 h-full px-3 text-white bg-violet-500 border-violet-500 hover:bg-violet-600 hover:border-violet-600 focus:bg-violet-600 focus:border-violet-600 focus:ring focus:ring-violet-500/30 active:bg-violet-600 active:border-violet-600 rounded-l"
                                                    id="search-button">
                                                    استعلام
                                                </button>
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <label for="passport" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">شماره پاسپورت</label>
                                            <div class="relative">
                                                <input
                                                    class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100 pr-[90px]"
                                                    type="text"
                                                    id="passport"
                                                    name="passport"
                                                    value="<?php echo htmlspecialchars($data['passport'] ?? ''); ?>">
                                                <button
                                                    type="button"
                                                    class="btn absolute left-0 top-0 h-full px-3 text-white bg-violet-500 border-violet-500 hover:bg-violet-600 hover:border-violet-600 focus:bg-violet-600 focus:border-violet-600 focus:ring focus:ring-violet-500/30 active:bg-violet-600 active:border-violet-600 rounded-l"
                                                    id="search-passport-button">
                                                    استعلام
                                                </button>
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">کد پستی</label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                                type="text"
                                                id="example-date-input"
                                                name="codeposti"
                                                value="<?php echo htmlspecialchars($data['codeposti'] ?? ''); ?>"
                                                required>
                                        </div>

                                        <div class="mb-4">
                                            <label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">آدرس</label>
                                            <textarea
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                style="height: 156px; resize: none;"
                                                name="address"
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
                                            <label for="serial" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">سریال</label>
                                            <div class="relative">
                                                <input
                                                    class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100 pr-[90px]"
                                                    type="text"
                                                    id="serial"
                                                    name="serial"
                                                    value="<?php echo htmlspecialchars($data['serial'] ?? ''); ?>"
                                                    required>
                                                <button
                                                    type="button"
                                                    class="btn absolute left-0 top-0 h-full px-3 text-white bg-violet-500 border-violet-500 hover:bg-violet-600 hover:border-violet-600 focus:bg-violet-600 focus:border-violet-600 focus:ring focus:ring-violet-500/30 active:bg-violet-600 active:border-violet-600 rounded-l"
                                                    id="search-button-2">
                                                    استعلام
                                                </button>
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">عنوان درختواره دستگاه </label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                type="text"
                                                name="model"
                                                id="example-text-input">
                                        </div>
                                        <div class="mb-4">
                                            <label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">حافظه داخلی دستگاه </label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                type="text"
                                                name="att1_code"
                                                id="example-text-input">
                                        </div>

                                        <div class="mb-4">
                                            <label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">رنگ دستگاه </label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                type="text"
                                                name="att3_code"
                                                id="example-text-input">
                                        </div>

                                        <div class="mb-4">
                                            <label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">نام شرکت واردکننده دستگاه</label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                type="text"
                                                name="company"
                                                id="example-text-input">
                                        </div>
                                        <div class="mb-4">
                                            <label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">تاریخ شروع گارانتی دستگاه</label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                type="text"
                                                name="start_guarantee"
                                                id="example-text-input">
                                        </div>


                                    </div>
                                    <div class="col-span-12 lg:col-span-6">
                                        <div class="mb-4">
                                            <label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">سریال دوم دستگاه</label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                type="text"
                                                name="serial2"
                                                id="example-text-input">
                                        </div>
                                        <div class="mb-4">
                                            <label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">عنوان دستگاه</label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                type="text"
                                                name="title"
                                                id="example-text-input">
                                        </div>
                                        <div class="mb-4">
                                            <label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">حافظه RAM دستگاه </label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                type="text"
                                                name="att2_code"
                                                id="example-text-input">
                                        </div>

                                        <div class="mb-4">
                                            <label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">کشور سازنده دستگاه </label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                type="text"
                                                name="att4_code"
                                                id="example-text-input">
                                        </div>
                                        <div class="mb-4">
                                            <label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">شماره سند واردات دستگاه</label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                type="text"
                                                name="sh_sanad"
                                                id="example-text-input">
                                        </div>
                                        <div class="mb-4">
                                            <label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">تاریخ پایان گارانتی دستگاه</label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                type="text"
                                                name="expite_guarantee"
                                                id="example-text-input">
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
                                            <label class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">نوع پذیرش</label>
                                            <select class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100" name="paziresh_status" required
                                                value="<?php echo htmlspecialchars($data['paziresh_status'] ?? ''); ?>">
                                                <option>انتخاب</option>
                                                <option> پذیرش حضوری</option>
                                                <option> پذیرش غیرحضوری</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label for="activation-date" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">تاریخ فعالسازی </label>
                                        <input class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100" type="text" id="activation-date" name="activation_start_date" required
                                            value="<?php echo htmlspecialchars($data['activation_start_date'] ?? ''); ?>">
                                    </div>
                                    <!-- <script>
                                           flatpickr("#activation-date", {
                                               dateFormat: "Y-m-d", // فرمت تاریخ
                                           });
                                       </script> -->
                                    <div class="mb-4">
                                        <div class="mb-3">
                                            <label class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">وضعیت گارانتی</label>
                                            <select class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100"
                                                name="guarantee_status" required
                                                value="<?php echo htmlspecialchars($data['guarantee_status'] ?? ''); ?>">
                                                <option>انتخاب</option>
                                                <option>تحت گارانتی</option>
                                                <option>ابطال گارانتی</option>
                                                <option>نیاز به بررسی کارشناس </option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-span-12 lg:col-span-4">
                                    <div class="mb-4">
                                        <label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">شرایط فیزیکی دستگاه</label>
                                        <input class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100" type="text" id="example-date-input"
                                            name="situation"
                                            required
                                            value="<?php echo htmlspecialchars($data['situation'] ?? ''); ?>">
                                    </div>
                                    <div class="mb-4">
                                        <label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">ایراد دستگاه به اظهار مشتری </label>
                                        <input class="w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100" type="text" id="example-month-input"
                                            name="problem"
                                            required
                                            value="<?php echo htmlspecialchars($data['problem'] ?? ''); ?>">
                                    </div>
                                    <div class="mb-4">
                                        <label class="block font-medium text-gray-700 dark:text-gray-100 mb-2">لوازم همراه</label>
                                        <div class="py-2.5 flex space-x-4">
                                            <div class="form-check">
                                                <label class="ltr:mr-2 rtl:ml-2 font-medium text-gray-700 dark:text-zinc-100" for="acc_box">جعبه</label>
                                                <input type="checkbox"
                                                    class="rounded align-middle ml-2 focus:ring-0 focus:ring-offset-0 dark:bg-zinc-700 dark:border-zinc-400 checked:bg-violet-500 dark:checked:bg-violet-500"
                                                    id="acc_box"
                                                    name="accessories[]"
                                                    value="box">
                                            </div>
                                            <div class="form-check">
                                                <label class="ltr:mr-2 rtl:ml-2 font-medium text-gray-700 dark:text-zinc-100" for="acc_warranty">کارت گارانتی</label>
                                                <input type="checkbox"
                                                    class="rounded align-middle ml-2 focus:ring-0 focus:ring-offset-0 dark:bg-zinc-700 dark:border-zinc-400 checked:bg-violet-500 dark:checked:bg-violet-500"
                                                    id="acc_warranty"
                                                    name="accessories[]"
                                                    value="warrantycard">
                                            </div>
                                            <div class="form-check">
                                                <label class="ltr:mr-2 rtl:ml-2 font-medium text-gray-700 dark:text-zinc-100" for="acc_adapter">آداپتور</label>
                                                <input type="checkbox"
                                                    class="rounded align-middle ml-2 focus:ring-0 focus:ring-offset-0 dark:bg-zinc-700 dark:border-zinc-400 checked:bg-violet-500 dark:checked:bg-violet-500"
                                                    id="acc_adapter"
                                                    name="accessories[]"
                                                    value="adapter">
                                            </div>
                                            <div class="form-check">
                                                <label class="ltr:mr-2 rtl:ml-2 font-medium text-gray-700 dark:text-zinc-100" for="acc_cable">کابل شارژ</label>
                                                <input type="checkbox"
                                                    class="rounded align-middle ml-2 focus:ring-0 focus:ring-offset-0 dark:bg-zinc-700 dark:border-zinc-400 checked:bg-violet-500 dark:checked:bg-violet-500"
                                                    id="acc_cable"
                                                    name="accessories[]"
                                                    value="cable">
                                            </div>
                                            <div class="form-check">
                                                <label class="ltr:mr-2 rtl:ml-2 font-medium text-gray-700 dark:text-zinc-100" for="acc_handsfree">هندزفری</label>
                                                <input type="checkbox"
                                                    class="rounded align-middle ml-2 focus:ring-0 focus:ring-offset-0 dark:bg-zinc-700 dark:border-zinc-400 checked:bg-violet-500 dark:checked:bg-violet-500"
                                                    id="acc_handsfree"
                                                    name="accessories[]"
                                                    value="handsfree">
                                            </div>
                                            <div class="form-check">
                                                <label class="ltr:mr-2 rtl:ml-2 font-medium text-gray-700 dark:text-zinc-100" for="acc_pin">سوزن</label>
                                                <input type="checkbox"
                                                    class="rounded align-middle ml-2 focus:ring-0 focus:ring-offset-0 dark:bg-zinc-700 dark:border-zinc-400 checked:bg-violet-500 dark:checked:bg-violet-500"
                                                    id="acc_pin"
                                                    name="accessories[]"
                                                    value="pin">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-span-12 lg:col-span-4">
                                    <div class="mb-4">
                                        <label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">توضیحات </label>
                                        <input class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100" type="text" id="example-date-input"
                                            name="dex"

                                            value="<?php echo htmlspecialchars($data['dex'] ?? ''); ?>">
                                    </div>
                                    <div class="mb-4">
                                        <label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">زمان تقریبی تعمیر </label>
                                        <input class="w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100" type="text" id="example-month-input"
                                            name="estimated_time" required
                                            value="<?php echo htmlspecialchars($data['estimated_time'] ?? ''); ?>">
                                    </div>
                                    <div class="mb-4">
                                        <label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2"> هزینه تقریبی تعمیر </label>
                                        <input class="w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100" type="text" value="" id="example-week-input"
                                            name="estimated_cost" required
                                            value="<?php echo htmlspecialchars($data['estimated_cost'] ?? ''); ?>">
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
                                        <label for="avatar1" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">کارت شناسایی</label>
                                        <input
                                            name="image1"
                                            class="input-field w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                            type="file"
                                            id="avatar1"
                                            accept="image/*"
                                            onchange="previewImage(this, 'preview1');">
                                        <div class="mt-2">
                                            <img id="preview1" src="#" alt="پیش نمایش تصویر" class="hidden rounded-lg" style="width: 150px; height: 150px; object-fit: cover;">
                                        </div>
                                    </div>
                                </div>

                                <!-- تصویر فاکتور خرید -->
                                <div class="col-span-12 lg:col-span-4">
                                    <div class="mb-4">
                                        <label for="avatar2" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">تصویر فاکتور خرید</label>
                                        <input
                                            name="image2"
                                            class="input-field w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                            type="file"
                                            id="avatar2"
                                            accept="image/*"
                                            onchange="previewImage(this, 'preview2');">
                                        <div class="mt-2">
                                            <img id="preview2" src="#" alt="پیش نمایش تصویر" class="hidden rounded-lg" style="width: 150px; height: 150px; object-fit: cover;">
                                        </div>
                                    </div>
                                </div>

                                <!-- تصویر ایراد -->
                                <div class="col-span-12 lg:col-span-4">
                                    <div class="mb-4">
                                        <label for="avatar3" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">تصویر ایراد</label>
                                        <input
                                            name="image3"
                                            class="input-field w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                            type="file"
                                            id="avatar3"
                                            accept="image/*"
                                            onchange="previewImage(this, 'preview3');">
                                        <div class="mt-2">
                                            <img id="preview3" src="#" alt="پیش نمایش تصویر" class="hidden rounded-lg" style="width: 150px; height: 150px; object-fit: cover;">
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

<script>
    document.getElementById('search-button').addEventListener('click', function() {
        const codemelli = document.getElementById('codemelli').value;

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
                    alert('کد ملی در سیستم نیست. لطفاً اطلاعات را وارد کنید.');
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
                alert('خطا در برقراری ارتباط با سرور');
            });
    });

    document.getElementById('customer-form').addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);

        fetch('controller.php?action=createCustomer', {
                method: 'POST',
                body: new URLSearchParams(formData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'created') {
                    alert('مشتری با موفقیت ایجاد شد.');
                } else {
                    alert('خطا در ذخیره اطلاعات.');
                }
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
    document.getElementById('search-button-2').addEventListener('click', function() {
        const serial = document.getElementById('serial').value;

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
                    document.querySelector('[name="serial"]').value = data.data.serial;
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
                    alert('سریال در سیستم نیست. لطفاً اطلاعات را وارد کنید.');
                    // پاک کردن فیلدها
                    document.querySelector('[name="serial"]').value = '';
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
                alert('خطا در برقراری ارتباط با سرور');
            });
    });

    document.getElementById('customer-form').addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);

        fetch('controller.php?action=createCard', {
                method: 'POST',
                body: new URLSearchParams(formData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'created') {
                    alert('کارت با موفقیت ایجاد شد.');
                } else {
                    alert('خطا در ذخیره اطلاعات.');
                }
            });
    });
</script>

<script>
    document.getElementById('search-passport-button').addEventListener('click', function() {
        const passport = document.getElementById('passport').value;
        
        if (!passport) {
            alert('لطفا شماره پاسپورت را وارد کنید');
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
                alert('شماره پاسپورت در سیستم نیست. لطفاً اطلاعات را وارد کنید.');
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
            alert('خطا در برقراری ارتباط با سرور');
        });
    });
</script>