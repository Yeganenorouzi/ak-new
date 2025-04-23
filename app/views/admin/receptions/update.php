<?php require_once(APPROOT . "/views/public/header.php"); ?>


<style>
    input[readonly], textarea[readonly], select[disabled] {
        background-color: #f3f4f6;
        cursor: not-allowed;
        opacity: 0.7;
    }
    
    .dark input[readonly], .dark textarea[readonly], .dark select[disabled] {
        background-color: rgba(63, 63, 70, 0.3);
    }
    
    button[disabled] {
        opacity: 0.7;
        cursor: not-allowed;
    }
</style>

<div class="main-content">
    <div class="page-content dark:bg-zinc-700">
        <div class="container-fluid px-[0.625rem]">

            <form id="update-form" action="<?php echo URLROOT; ?>/receptions/store" method="POST" enctype="multipart/form-data">
                <!-- Header section with title and button -->
                <div class="grid grid-cols-1 mb-5">
                    <div class="flex items-center justify-between">
                        <h4 class="mb-sm-0 text-lg font-semibold grow text-gray-800 dark:text-gray-100">ویرایش پذیرش</h4>
                        <button type="submit" id="update-button" class="flex btn text-white bg-violet-500 border-violet-500 hover:bg-violet-600 hover:border-violet-600 focus:bg-violet-600 focus:border-violet-600 focus:ring focus:ring-violet-500/30 active:bg-violet-600 active:border-violet-600 ltr:mr-2 rtl:ml-2">بروزرسانی پذیرش</button>
                    </div>
                </div>

                <!-- Hidden input for reception ID -->
                <input type="hidden" name="id" value="<?php echo $data['reception']->id; ?>">

                <div class="grid grid-cols-12 gap-5">
                    <div class="col-span-12 lg:col-span-6">
                        <div class="card mx-auto dark:bg-zinc-800 dark:border-zinc-600">
                            <div class="card-body pb-0">
                                <h6 class="mb-1 text-15 text-gray-700 dark:text-gray-100">اطلاعات مشتری</h6>
                            </div>
                            <div class="card-body">
                                <div class="grid grid-cols-12 gap-5">
                                    <div class="col-span-12 lg:col-span-6">
                                        <div class="mb-4">
                                            <label for="name" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">نام و نام خانوادگی مشتری</label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                type="text"
                                                id="name"
                                                name="name"
                                                value="<?php echo htmlspecialchars($data['reception']->name); ?>"
                                                readonly>
                                        </div>
                                        <div class="mb-4">
                                            <label for="mobile" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">شماره تلفن همراه</label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                                type="tel"
                                                id="mobile"
                                                name="mobile"
                                                value="<?php echo htmlspecialchars($data['reception']->mobile); ?>"
                                                readonly>
                                        </div>
                                        <div class="mb-4">
                                            <label for="phone" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">شماره تلفن ثابت</label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                                type="tel"
                                                id="phone"
                                                name="phone"
                                                value="<?php echo htmlspecialchars($data['reception']->phone); ?>"
                                                readonly>
                                        </div>
                                        <div class="mb-4">
                                            <div class="mb-3">
                                                <label class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">استان</label>
                                                <select class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100"
                                                    name="ostan" id="province-select" disabled>
                                                    <option value="">انتخاب استان</option>
                                                    <?php foreach (ProvinceHelper::getProvinces() as $province): ?>
                                                        <option value="<?php echo $province; ?>" <?php echo ($data['reception']->ostan === $province) ? 'selected' : ''; ?>>
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
                                                    name="shahr" 
                                                    disabled>
                                                    <option value="">انتخاب شهر</option>
                                                    <?php foreach (ProvinceHelper::getCities() as $province => $cities): ?>
                                                        <?php foreach ($cities as $city): ?>
                                                            <option value="<?php echo $city; ?>" <?php echo ($data['reception']->shahr === $city) ? 'selected' : ''; ?>>
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
                                                    value="<?php echo htmlspecialchars($data['reception']->codemelli); ?>"
                                                    readonly>
                                                <button
                                                    type="button"
                                                    class="btn absolute left-0 top-0 h-full px-3 text-white bg-violet-500 border-violet-500 hover:bg-violet-600 hover:border-violet-600 focus:bg-violet-600 focus:border-violet-600 focus:ring focus:ring-violet-500/30 active:bg-violet-600 active:border-violet-600 rounded-l"
                                                    id="search-button"
                                                    disabled>
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
                                                    value="<?php echo htmlspecialchars($data['reception']->passport); ?>"
                                                    readonly>
                                                <button
                                                    type="button"
                                                    class="btn absolute left-0 top-0 h-full px-3 text-white bg-violet-500 border-violet-500 hover:bg-violet-600 hover:border-violet-600 focus:bg-violet-600 focus:border-violet-600 focus:ring focus:ring-violet-500/30 active:bg-violet-600 active:border-violet-600 rounded-l"
                                                    id="search-passport-button"
                                                    disabled>
                                                    استعلام
                                                </button>
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <label for="codeposti" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">کد پستی</label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                                type="text"
                                                id="codeposti"
                                                name="codeposti"
                                                value="<?php echo htmlspecialchars($data['reception']->codeposti); ?>"
                                                readonly>
                                        </div>

                                        <div class="mb-4">
                                            <label for="address" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">آدرس</label>
                                            <textarea
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                style="height: 210px; resize: none;"
                                                name="address"
                                                id="address"
                                                readonly><?php echo htmlspecialchars($data['reception']->address); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 lg:col-span-6">
                        <div class="card mx-auto dark:bg-zinc-800 dark:border-zinc-600">
                            <div class="card-body pb-0">
                                <h6 class="mb-1 text-15 text-gray-700 dark:text-gray-100">اطلاعات تلفن همراه</h6>
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
                                                    value="<?php echo htmlspecialchars($data['reception']->serial); ?>"
                                                    readonly>
                                                <button
                                                    type="button"
                                                    class="btn absolute left-0 top-0 h-full px-3 text-white bg-violet-500 border-violet-500 hover:bg-violet-600 hover:border-violet-600 focus:bg-violet-600 focus:border-violet-600 focus:ring focus:ring-violet-500/30 active:bg-violet-600 active:border-violet-600 rounded-l"
                                                    id="search-button-2"
                                                    disabled>
                                                    استعلام
                                                </button>
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <label for="model" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">عنوان درختواره دستگاه</label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                type="text"
                                                name="model"
                                                id="model"
                                                value="<?php echo htmlspecialchars($data['reception']->model); ?>"
                                                readonly>
                                        </div>
                                        <div class="mb-4">
                                            <label for="att1_code" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">حافظه داخلی دستگاه</label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                type="text"
                                                name="att1_code"
                                                id="att1_code"
                                                value="<?php echo htmlspecialchars($data['reception']->att1_code); ?>"
                                                readonly>
                                        </div>

                                        <div class="mb-4">
                                            <label for="att3_code" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">رنگ دستگاه</label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                type="text"
                                                name="att3_code"
                                                id="att3_code"
                                                value="<?php echo htmlspecialchars($data['reception']->att3_code); ?>"
                                                readonly>
                                        </div>

                                        <div class="mb-4">
                                            <label for="company" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">نام شرکت واردکننده دستگاه</label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                type="text"
                                                name="company"
                                                id="company"
                                                value="<?php echo htmlspecialchars($data['reception']->company); ?>"
                                                readonly>
                                        </div>
                                        <div class="mb-4">
                                            <label for="start_guarantee" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">تاریخ شروع گارانتی دستگاه</label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                type="text"
                                                name="start_guarantee"
                                                id="start_guarantee"
                                                value="<?php echo htmlspecialchars($data['reception']->start_guarantee); ?>"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="col-span-12 lg:col-span-6">
                                        <div class="mb-4">
                                            <label for="serial2" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">سریال دوم دستگاه</label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                type="text"
                                                name="serial2"
                                                id="serial2"
                                                value="<?php echo htmlspecialchars($data['reception']->serial2); ?>"
                                                readonly>
                                        </div>
                                        <div class="mb-4">
                                            <label for="title" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">عنوان دستگاه</label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                type="text"
                                                name="title"
                                                id="title"
                                                value="<?php echo htmlspecialchars($data['reception']->title); ?>"
                                                readonly>
                                        </div>
                                        <div class="mb-4">
                                            <label for="att2_code" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">حافظه RAM دستگاه</label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                type="text"
                                                name="att2_code"
                                                id="att2_code"
                                                value="<?php echo htmlspecialchars($data['reception']->att2_code); ?>"
                                                readonly>
                                        </div>

                                        <div class="mb-4">
                                            <label for="att4_code" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">کشور سازنده دستگاه</label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                type="text"
                                                name="att4_code"
                                                id="att4_code"
                                                value="<?php echo htmlspecialchars($data['reception']->att4_code); ?>"
                                                readonly>
                                        </div>
                                        <div class="mb-4">
                                            <label for="sh_sanad" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">شماره سند واردات دستگاه</label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                type="text"
                                                name="sh_sanad"
                                                id="sh_sanad"
                                                value="<?php echo htmlspecialchars($data['reception']->sh_sanad); ?>"
                                                readonly>
                                        </div>
                                        <div class="mb-4">
                                            <label for="expite_guarantee" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">تاریخ پایان گارانتی دستگاه</label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                type="text"
                                                name="expite_guarantee"
                                                id="expite_guarantee"
                                                value="<?php echo htmlspecialchars($data['reception']->expite_guarantee); ?>"
                                                readonly>
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
                                <div class="col-span-12 lg:col-span-2">
                                    <div class="mb-4">
                                        <div class="mb-3">
                                            <label class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">نوع پذیرش</label>
                                            <select class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100" name="paziresh_status" disabled>
                                                <option value="">انتخاب</option>
                                                <option value="پذیرش حضوری" <?php echo ($data['reception']->paziresh_status === 'پذیرش حضوری') ? 'selected' : ''; ?>>پذیرش حضوری</option>
                                                <option value="پذیرش غیرحضوری" <?php echo ($data['reception']->paziresh_status === 'پذیرش غیرحضوری') ? 'selected' : ''; ?>>پذیرش غیرحضوری</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label for="activation-date" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">تاریخ فعالسازی</label>
                                        <input class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100" type="text" id="activation-date" name="activation_start_date" required value="<?php echo htmlspecialchars($data['reception']->activation_start_date ?? ''); ?>" readonly data-jdp>
                                    </div>
                                    <div class="mb-4">
                                        <div class="mb-3">
                                            <label class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">وضعیت گارانتی</label>
                                            <select class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100" name="guarantee_status" disabled>
                                                <option value="">انتخاب</option>
                                                <option value="تحت گارانتی" <?php echo ($data['reception']->guarantee_status === 'تحت گارانتی') ? 'selected' : ''; ?>>تحت گارانتی</option>
                                                <option value="ابطال گارانتی" <?php echo ($data['reception']->guarantee_status === 'ابطال گارانتی') ? 'selected' : ''; ?>>ابطال گارانتی</option>
                                                <option value="نیاز به بررسی کارشناس" <?php echo ($data['reception']->guarantee_status === 'نیاز به بررسی کارشناس') ? 'selected' : ''; ?>>نیاز به بررسی کارشناس</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-12 lg:col-span-2">
                                    <div class="mb-4">
                                        <label for="estimated_time" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">زمان تقریبی تعمیر</label>
                                        <input class="w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100" type="text" id="estimated_time" name="estimated_time" required value="<?php echo htmlspecialchars($data['reception']->estimated_time ?? ''); ?>" readonly>
                                    </div>
                                    <div class="mb-4">
                                        <label for="estimated_cost" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">هزینه تقریبی تعمیر</label>
                                        <input class="w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100" type="text" id="estimated_cost" name="estimated_cost" required value="<?php echo htmlspecialchars($data['reception']->estimated_cost ?? ''); ?>" readonly>
                                    </div>
                                    <div class="mb-4">
                                        <label for="dex" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">توضیحات</label>
                                        <input class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100" type="text" id="dex" name="dex" value="<?php echo htmlspecialchars($data['reception']->dex ?? ''); ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-span-12 lg:col-span-3">
                                    <div class="mb-4">
                                        <label for="situation" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">شرایط فیزیکی دستگاه</label>
                                        <input class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100" type="text" id="situation" name="situation" required value="<?php echo htmlspecialchars($data['reception']->situation ?? ''); ?>" readonly>
                                    </div>
                                    <div class="mb-4">
                                        <label for="problem" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">ایراد دستگاه به اظهار مشتری</label>
                                        <input class="w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100" type="text" id="problem" name="problem" required value="<?php echo htmlspecialchars($data['reception']->problem ?? ''); ?>" readonly>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block font-medium text-gray-700 dark:text-gray-100 mb-2">لوازم همراه</label>
                                        <div class="py-2.5 flex space-x-4">
                                            <?php 
                                            $accessories = explode(',', $data['reception']->accessories);
                                            ?>
                                            <div class="form-check">
                                                <label class="ltr:mr-2 rtl:ml-2 font-medium text-gray-700 dark:text-zinc-100" for="acc_box">جعبه</label>
                                                <input type="checkbox" class="rounded align-middle ml-2 focus:ring-0 focus:ring-offset-0 dark:bg-zinc-700 dark:border-zinc-400 checked:bg-violet-500 dark:checked:bg-violet-500" id="acc_box" name="accessories[]" value="box" <?php echo in_array('box', $accessories) ? 'checked' : ''; ?> readonly>
                                            </div>
                                            <div class="form-check">
                                                <label class="ltr:mr-2 rtl:ml-2 font-medium text-gray-700 dark:text-zinc-100" for="acc_warranty">کارت گارانتی</label>
                                                <input type="checkbox" class="rounded align-middle ml-2 focus:ring-0 focus:ring-offset-0 dark:bg-zinc-700 dark:border-zinc-400 checked:bg-violet-500 dark:checked:bg-violet-500" id="acc_warranty" name="accessories[]" value="warrantycard" <?php echo in_array('warrantycard', $accessories) ? 'checked' : ''; ?> readonly>
                                            </div>
                                            <div class="form-check">
                                                <label class="ltr:mr-2 rtl:ml-2 font-medium text-gray-700 dark:text-zinc-100" for="acc_adapter">آداپتور</label>
                                                <input type="checkbox" class="rounded align-middle ml-2 focus:ring-0 focus:ring-offset-0 dark:bg-zinc-700 dark:border-zinc-400 checked:bg-violet-500 dark:checked:bg-violet-500" id="acc_adapter" name="accessories[]" value="adapter" <?php echo in_array('adapter', $accessories) ? 'checked' : ''; ?> readonly>
                                            </div>
                                            <div class="form-check">
                                                <label class="ltr:mr-2 rtl:ml-2 font-medium text-gray-700 dark:text-zinc-100" for="acc_cable">کابل شارژ</label>
                                                <input type="checkbox" class="rounded align-middle ml-2 focus:ring-0 focus:ring-offset-0 dark:bg-zinc-700 dark:border-zinc-400 checked:bg-violet-500 dark:checked:bg-violet-500" id="acc_cable" name="accessories[]" value="cable" <?php echo in_array('cable', $accessories) ? 'checked' : ''; ?> readonly>
                                            </div>
                                            <div class="form-check">
                                                <label class="ltr:mr-2 rtl:ml-2 font-medium text-gray-700 dark:text-zinc-100" for="acc_handsfree">هندزفری</label>
                                                <input type="checkbox" class="rounded align-middle ml-2 focus:ring-0 focus:ring-offset-0 dark:bg-zinc-700 dark:border-zinc-400 checked:bg-violet-500 dark:checked:bg-violet-500" id="acc_handsfree" name="accessories[]" value="handsfree" <?php echo in_array('handsfree', $accessories) ? 'checked' : ''; ?> readonly>
                                            </div>
                                            <div class="form-check">
                                                <label class="ltr:mr-2 rtl:ml-2 font-medium text-gray-700 dark:text-zinc-100" for="acc_pin">سوزن</label>
                                                <input type="checkbox" class="rounded align-middle ml-2 focus:ring-0 focus:ring-offset-0 dark:bg-zinc-700 dark:border-zinc-400 checked:bg-violet-500 dark:checked:bg-violet-500" id="acc_pin" name="accessories[]" value="pin" <?php echo in_array('pin', $accessories) ? 'checked' : ''; ?> readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-12 lg:col-span-2 pr-4 border-r border-gray-200">
                                    <div class="mb-4">
                                        <label class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">وضعیت پذیرش</label>
                                        <select class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100" name="product_status" required>
                                            <option value="">انتخاب</option>
                                            <option value="پذیرش در نمایندگی" <?php echo ($data['reception']->product_status === 'پذیرش در نمایندگی') ? 'selected' : ''; ?>>پذیرش در نمایندگی</option>
                                            <option value="ارسال از نمایندگی به دفتر مرکزی" <?php echo ($data['reception']->product_status === 'ارسال از نمایندگی به دفتر مرکزی') ? 'selected' : ''; ?>>ارسال از نمایندگی به دفتر مرکزی</option>
                                            <option value="دریافت از دفتر مرکزی" <?php echo ($data['reception']->product_status === 'دریافت از دفتر مرکزی') ? 'selected' : ''; ?>>دریافت از دفتر مرکزی</option>
                                            <option value="در حال انجام کار در دفتر مرکزی" <?php echo ($data['reception']->product_status === 'در حال انجام کار در دفتر مرکزی') ? 'selected' : ''; ?>>در حال انجام کار در دفتر مرکزی</option>
                                            <option value="ارسال از دفتر مرکزی به نمایندگی" <?php echo ($data['reception']->product_status === 'ارسال از دفتر مرکزی به نمایندگی') ? 'selected' : ''; ?>>ارسال از دفتر مرکزی به نمایندگی</option>
                                            <option value="تحویل به مشتری" <?php echo ($data['reception']->product_status === 'تحویل به مشتری') ? 'selected' : ''; ?>>تحویل به مشتری</option>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="sh_baar" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">شماره بارنامه ارسال به مرکز</label>
                                        <input class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100" type="text" id="sh_baar" name="sh_baar" value="<?php echo htmlspecialchars($data['reception']->sh_baar ?? ''); ?>">
                                    </div>
                                    <div class="mb-4">
                                        <label for="sh_baar2" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">شماره بارنامه ارسال به نمایندگی</label>
                                        <input class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100" type="text" id="sh_baar2" name="sh_baar2" value="<?php echo htmlspecialchars($data['reception']->sh_baar2 ?? ''); ?>">
                                    </div>
                                </div>
                                <div class="col-span-12 lg:col-span-3">
                                    <div class="mb-4">
                                        <label for="kaar" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">تعمیرات انجام شده</label>
                                        <textarea class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100" id="kaar" name="kaar" rows="4"><?php echo htmlspecialchars($data['reception']->kaar ?? ''); ?></textarea>
                                    </div>
                                    <div class="mb-4">
                                        <label for="kaar_serial" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">سریال قطعه تعویض شده</label>
                                        <input class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100" type="text" id="kaar_serial" name="kaar_serial" value="<?php echo htmlspecialchars($data['reception']->kaar_serial ?? ''); ?>">
                                    </div>
                                    <div class="mb-4">
                                        <label for="kaar_at" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">تاریخ گارانتی قطعه</label>
                                        <input class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100" type="text" id="kaar_at" name="kaar_at" value="<?php echo htmlspecialchars($data['reception']->kaar_at ?? ''); ?>" data-jdp>
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
                                            <?php if (!empty($data['reception']->file1)): ?>
                                                <div class="mb-2">
                                                    <a href="<?php echo URLROOT; ?>/receptions/download/<?php echo $data['reception']->file1; ?>" class="text-violet-500 hover:text-violet-600" target="_blank">دانلود تصویر فعلی</a>
                                                </div>
                                            <?php endif; ?>
                                            <img id="preview1" src="<?php echo !empty($data['reception']->file1) ? URLROOT . '/assets/uploads/receptions/' . $data['reception']->file1 : '#'; ?>" alt="پیش نمایش تصویر" class="<?php echo !empty($data['reception']->file1) ? 'rounded-lg' : 'hidden rounded-lg'; ?>" style="width: 150px; height: 150px; object-fit: cover;">
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
                                            <?php if (!empty($data['reception']->file2)): ?>
                                                <div class="mb-2">
                                                    <a href="<?php echo URLROOT; ?>/receptions/download/<?php echo $data['reception']->file2; ?>" class="text-violet-500 hover:text-violet-600" target="_blank">دانلود تصویر فعلی</a>
                                                </div>
                                            <?php endif; ?>
                                            <img id="preview2" src="<?php echo !empty($data['reception']->file2) ? URLROOT . '/assets/uploads/receptions/' . $data['reception']->file2 : '#'; ?>" alt="پیش نمایش تصویر" class="<?php echo !empty($data['reception']->file2) ? 'rounded-lg' : 'hidden rounded-lg'; ?>" style="width: 150px; height: 150px; object-fit: cover;">
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
                                            <?php if (!empty($data['reception']->file3)): ?>
                                                <div class="mb-2">
                                                    <a href="<?php echo URLROOT; ?>/receptions/download/<?php echo $data['reception']->file3; ?>" class="text-violet-500 hover:text-violet-600" target="_blank">دانلود تصویر فعلی</a>
                                                </div>
                                            <?php endif; ?>
                                            <img id="preview3" src="<?php echo !empty($data['reception']->file3) ? URLROOT . '/assets/uploads/receptions/' . $data['reception']->file3 : '#'; ?>" alt="پیش نمایش تصویر" class="<?php echo !empty($data['reception']->file3) ? 'rounded-lg' : 'hidden rounded-lg'; ?>" style="width: 150px; height: 150px; object-fit: cover;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tracking Log Section -->
                <div class="grid grid-cols-1 mt-5">
                    <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                        <div class="card-body pb-0">
                            <h6 class="mb-1 text-15 text-gray-700 dark:text-gray-100">تاریخچه تغییرات</h6>
                        </div>
                        <div class="card-body">
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm text-right text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-zinc-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">تاریخ</th>
                                            <th scope="col" class="px-6 py-3">کاربر</th>
                                            <th scope="col" class="px-6 py-3">عملیات</th>
                                            <th scope="col" class="px-6 py-3">جزئیات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (isset($data['reception']->tracking_log) && !empty($data['reception']->tracking_log)): ?>
                                            <?php foreach (json_decode($data['reception']->tracking_log, true) as $log): ?>
                                                <tr class="bg-white border-b dark:bg-zinc-800 dark:border-zinc-700">
                                                    <td class="px-6 py-4"><?php echo $log['date']; ?></td>
                                                    <td class="px-6 py-4"><?php echo $log['user']; ?></td>
                                                    <td class="px-6 py-4"><?php echo $log['action']; ?></td>
                                                    <td class="px-6 py-4"><?php echo $log['details']; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr class="bg-white border-b dark:bg-zinc-800 dark:border-zinc-700">
                                                <td colspan="4" class="px-6 py-4 text-center">هیچ تاریخچه‌ای یافت نشد</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Persian Date Picker -->
<script src="https://cdn.jsdelivr.net/npm/persian-date@1.1.0/dist/persian-date.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/persian-datepicker@1.2.0/dist/js/persian-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/persian-datepicker@1.2.0/dist/css/persian-datepicker.min.css">

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
    document.getElementById('update-form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        Swal.fire({
            title: 'آیا مطمئن هستید؟',
            text: "شما در حال ویرایش اطلاعات این پذیرش هستید",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#8b5cf6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'بله، ویرایش شود',
            cancelButtonText: 'انصراف'
        }).then((result) => {
            if (result.isConfirmed) {
                const formData = new FormData(this);
                
                fetch('<?php echo URLROOT; ?>/receptions/update', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        Swal.fire({
                            title: 'موفقیت‌آمیز!',
                            text: 'اطلاعات با موفقیت به‌روزرسانی شد',
                            icon: 'success',
                            confirmButtonColor: '#8b5cf6'
                        }).then(() => {
                            window.location.href = '<?php echo URLROOT; ?>/receptions';
                        });
                    } else {
                        Swal.fire({
                            title: 'خطا!',
                            text: data.message,
                            icon: 'error',
                            confirmButtonColor: '#8b5cf6'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        title: 'خطا!',
                        text: 'خطا در برقراری ارتباط با سرور',
                        icon: 'error',
                        confirmButtonColor: '#8b5cf6'
                    });
                });
            }
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Wait for jQuery to be loaded
        const checkJQuery = setInterval(function() {
            if (window.jQuery) {
                clearInterval(checkJQuery);
                initPersianDatepicker();
            }
        }, 100);
        
        function initPersianDatepicker() {
            jQuery('#activation-date').persianDatepicker({
                format: 'YYYY/MM/DD',
                initialValue: false,
                autoClose: true,
                persianDigit: true,
                observer: true,
                calendar: {
                    persian: {
                        locale: 'fa'
                    }
                },
                onSelect: function(unix) {
                    // Convert to Persian date format
                    const date = new persianDate(unix);
                    const formattedDate = date.format('YYYY/MM/DD');
                    document.getElementById('activation-date').value = formattedDate;
                }
            });
        }
    });
</script>
</rewritten_file>


<?php require_once(APPROOT . "/views/public/footer.php"); ?>


