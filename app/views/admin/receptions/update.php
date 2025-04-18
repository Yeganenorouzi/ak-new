<?php

use Hekmatinasser\Verta\Verta;

?>
<?php require_once(APPROOT . "/views/public/header.php"); ?>

<div class="main-content sm:mr-0 md:mr-0 lg:mr-0 xl:mr-0">
    <div class="page-content dark:bg-zinc-700">
        <div class="container-fluid px-[0.625rem]">



            <?php if (!$data['reception']): ?>
                <div class="alert alert-danger">پذیرش مورد نظر یافت نشد</div>
            <?php else: ?>
                <form action="<?php echo URLROOT; ?>/receptions/update" method="POST" enctype="multipart/form-data" id="reception-form">
                    <input type="hidden" name="id" value="<?php echo $data['reception']->id; ?>">
                    <!-- Header section with title and button -->
                    <nav class="flex" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-3 ltr:md:space-x-3 rtl:md:space-x-0">
                            <li class="inline-flex items-center">
                                <div class="mb-4">
                                    <h5 class="ltr:ml-1 rtl:mr-1 text-sm font-medium text-gray-500 hover:text-gray-900 ltr:md:ml-2 rtl:md:mr-2 dark:text-gray-100 dark:hover:text-white">
                                        شماره پذیرش : <?php echo isset($data['reception']->id) ? htmlspecialchars($data['reception']->id) : 'N/A'; ?>
                                    </h5>
                                </div>
                            </li>
                            <li class="inline-flex items-center mr-10">
                                <div class="mb-4">
                                    <h5 class="ltr:ml-1 rtl:mr-1 text-sm font-medium text-gray-500 hover:text-gray-900 ltr:md:ml-2 rtl:md:mr-2 dark:text-gray-100 dark:hover:text-white">تاریخ پذیرش : <?php echo isset($data['reception']->created_at) ? Verta::instance($data['reception']->created_at)->format('Y/m/d') : 'N/A'; ?></h5>
                                </div>
                            </li>
                        </ol>
                    </nav>
                    <div class="grid grid-cols-1 mb-5">
                        <div class="flex items-center justify-between">
                            <h4 class="mb-sm-0 text-lg font-semibold grow text-gray-800 dark:text-gray-100">فرم پذیرش </h4>
                            <div class="flex gap-2">
                                <!-- دکمه بازگشت به منو -->
                                <a href="<?php echo ($_SESSION['is_admin'] === 1) ? URLROOT . '/receptions/admin' : URLROOT . '/receptions/agent'; ?>"
                                    class="flex btn text-white bg-gray-500 border-gray-500 hover:bg-gray-600 hover:border-gray-600 focus:bg-gray-600 focus:border-gray-600 focus:ring focus:ring-gray-500/30 active:bg-gray-600 active:border-gray-600">
                                    بازگشت به منو
                                </a>
                                <!-- دکمه ثبت پذیرش -->
                                <button type="submit" class="flex btn text-white bg-violet-500 border-violet-500 hover:bg-violet-600 hover:border-violet-600 focus:bg-violet-600 focus:border-violet-600 focus:ring focus:ring-violet-500/30 active:bg-violet-600 active:border-violet-600">
                                    تایید
                                </button>
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
                                                <label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">نام و نام خانوادگی مشتری</label>
                                                <input
                                                    class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                    type="text"
                                                    id="example-text-input"
                                                    name="name"
                                                    readonly
                                                    value="<?php echo htmlspecialchars($data['reception']->name ?? ''); ?>">
                                            </div>
                                            <div class="mb-4">
                                                <label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">شماره تلفن همراه</label>
                                                <input
                                                    class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                                    type="tel"
                                                    id="example-date-input"
                                                    name="mobile"
                                                    readonly
                                                    value="<?php echo htmlspecialchars($data['reception']->mobile ?? ''); ?>">
                                            </div>
                                            <div class="mb-4">
                                                <label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">شماره تلفن ثابت</label>
                                                <input
                                                    class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                                    type="tel"
                                                    id="example-date-input"
                                                    name="phone"
                                                    readonly
                                                    value="<?php echo htmlspecialchars($data['reception']->phone ?? ''); ?>">
                                            </div>
                                            <div class="mb-4">
                                                <div class="mb-3">
                                                    <label class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">استان</label>
                                                    <select class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100"
                                                        name="ostan" id="province-select" readonly>
                                                        <option value="">انتخاب استان</option>
                                                        <?php
                                                        foreach (ProvinceHelper::getProvinces() as $province):
                                                        ?>
                                                            <option <?php echo (isset($data['reception']->ostan) && $data['reception']->ostan === $province) ? 'selected' : ''; ?> value="<?php echo $province; ?>">
                                                                <?php echo $province; ?>
                                                            </option>
                                                        <?php
                                                        endforeach;
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="mb-4">
                                                <div class="mb-3">
                                                    <label class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">شهر</label>
                                                    <select class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100"
                                                        name="shahr" readonly>
                                                        <option value="">انتخاب شهر</option>
                                                        <?php
                                                        foreach (ProvinceHelper::getCities() as $province => $cities):
                                                            foreach ($cities as $city):
                                                        ?>
                                                                <option <?php echo (isset($data['reception']->shahr) && $data['reception']->shahr === $city) ? 'selected' : ''; ?> value="<?php echo $city; ?>">
                                                                    <?php echo $city; ?>
                                                                </option>
                                                        <?php
                                                            endforeach;
                                                        endforeach;
                                                        ?>
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
                                                        readonly
                                                        value="<?php echo htmlspecialchars($data['reception']->codemelli ?? ''); ?>">
                                                </div>
                                            </div>
                                            <div class="mb-4">
                                                <label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">شماره پاسپورت</label>
                                                <input
                                                    class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                                    type="text"
                                                    id="example-date-input"
                                                    name="passport"
                                                    readonly
                                                    value="<?php echo htmlspecialchars($data['reception']->passport ?? ''); ?>">
                                            </div>
                                            <div class="mb-4">
                                                <label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">کد پستی</label>
                                                <input
                                                    class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                                    type="text"
                                                    id="example-date-input"
                                                    name="codeposti"
                                                    readonly
                                                    value="<?php echo htmlspecialchars($data['reception']->codeposti ?? ''); ?>">
                                            </div>

                                            <div class="mb-4">
                                                <label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">آدرس</label>
                                                <textarea
                                                    class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                    style="height: 156px; resize: none;"
                                                    type="text"
                                                    id="example-text-input"
                                                    readonly
                                                    name="address"><?php echo htmlspecialchars($data['reception']->address ?? ''); ?>
                                                </textarea>
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
                                                        readonly
                                                        value="<?php echo htmlspecialchars($data['reception']->serial ?? ''); ?>">
                                                </div>
                                            </div>

                                            <div class="mb-4">
                                                <label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">عنوان درختواره دستگاه </label>
                                                <input
                                                    class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                    type="text"
                                                    name="model"
                                                    readonly
                                                    value="<?php echo htmlspecialchars($data['reception']->model ?? ''); ?>"
                                                    id="example-text-input">
                                            </div>
                                            <div class="mb-4">
                                                <label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">حافظه داخلی دستگاه </label>
                                                <input
                                                    class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                    type="text"
                                                    name="att1_code"
                                                    readonly
                                                    value="<?php echo htmlspecialchars($data['reception']->att1_code ?? ''); ?>"
                                                    id="example-text-input">
                                            </div>

                                            <div class="mb-4">
                                                <label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">رنگ دستگاه </label>
                                                <input
                                                    class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                    type="text"
                                                    name="att3_code"
                                                    readonly
                                                    value="<?php echo htmlspecialchars($data['reception']->att3_code ?? ''); ?>"
                                                    id="example-text-input">
                                            </div>

                                            <div class="mb-4">
                                                <label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">نام شرکت واردکننده دستگاه</label>
                                                <input
                                                    class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                    type="text"
                                                    name="company"
                                                    readonly
                                                    value="<?php echo htmlspecialchars($data['reception']->company ?? ''); ?>"
                                                    id="example-text-input">
                                            </div>
                                            <div class="mb-4">
                                                <label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">تاریخ شروع گارانتی دستگاه</label>
                                                <input
                                                    class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                    type="text"
                                                    name="start_guarantee"
                                                    readonly
                                                    value="<?php echo htmlspecialchars($data['reception']->start_guarantee ?? ''); ?>"
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
                                                    readonly
                                                    value="<?php echo htmlspecialchars($data['reception']->serial2 ?? ''); ?>"
                                                    id="example-text-input">
                                            </div>
                                            <div class="mb-4">
                                                <label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">عنوان دستگاه</label>
                                                <input
                                                    class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                    type="text"
                                                    name="title"
                                                    readonly
                                                    value="<?php echo htmlspecialchars($data['reception']->title ?? ''); ?>"
                                                    id="example-text-input">
                                            </div>
                                            <div class="mb-4">
                                                <label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">حافظه RAM دستگاه </label>
                                                <input
                                                    class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                    type="text"
                                                    name="att2_code"
                                                    readonly
                                                    value="<?php echo htmlspecialchars($data['reception']->att2_code ?? ''); ?>"
                                                    id="example-text-input">
                                            </div>

                                            <div class="mb-4">
                                                <label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">کشور سازنده دستگاه </label>
                                                <input
                                                    class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                    type="text"
                                                    name="att4_code"
                                                    readonly
                                                    value="<?php echo htmlspecialchars($data['reception']->att4_code ?? ''); ?>"
                                                    id="example-text-input">
                                            </div>
                                            <div class="mb-4">
                                                <label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">شماره سند واردات دستگاه</label>
                                                <input
                                                    class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                    type="text"
                                                    name="sh_sanad"
                                                    readonly
                                                    value="<?php echo htmlspecialchars($data['reception']->sh_sanad ?? ''); ?>"
                                                    id="example-text-input">
                                            </div>
                                            <div class="mb-4">
                                                <label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">تاریخ پایان گارانتی دستگاه</label>
                                                <input
                                                    class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                    type="text"
                                                    name="expite_guarantee"
                                                    readonly
                                                    value="<?php echo htmlspecialchars($data['reception']->expite_guarantee ?? ''); ?>"
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
                                    <div class="col-span-12 lg:col-span-2">
                                        <div class="mb-4">
                                            <div class="mb-3">
                                                <label class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">نوع پذیرش</label>
                                                <input class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100"
                                                    name="paziresh_status"
                                                    readonly
                                                    value="<?php echo htmlspecialchars($data['reception']->paziresh_status ?? ''); ?>">
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <label for="activation-date" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">تاریخ فعالسازی </label>
                                            <input class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                                type="text"
                                                id="activation-date"
                                                name="activation_start_date"
                                                readonly
                                                value="<?php echo htmlspecialchars($data['reception']->activation_start_date ?? ''); ?>">
                                        </div>

                                        <div class="mb-4">
                                            <div class="mb-3">
                                                <label class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">وضعیت گارانتی</label>
                                                <input class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100"
                                                    name="guarantee_status"
                                                    readonly
                                                    value="<?php echo htmlspecialchars($data['reception']->guarantee_status ?? ''); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-12 lg:col-span-2">
                                        <div class="mb-4">
                                            <label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">زمان تقریبی تعمیر </label>
                                            <input class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100" type="text" id="example-month-input"
                                                name="estimated_time"
                                                readonly
                                                value="<?php echo htmlspecialchars($data['reception']->estimated_time ?? ''); ?>">
                                        </div>
                                        <div class="mb-4">
                                            <label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2"> هزینه تقریبی تعمیر </label>
                                            <input class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100" type="text" id="example-week-input"
                                                name="estimated_cost"
                                                readonly
                                                value="<?php echo htmlspecialchars($data['reception']->estimated_cost ?? ''); ?>">
                                        </div>
                                        <div class="mb-4">
                                            <label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">توضیحات </label>
                                            <input class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100" type="text" id="example-date-input"
                                                name="dex"
                                                readonly
                                                value="<?php echo htmlspecialchars($data['reception']->dex ?? ''); ?>">
                                        </div>
                                    </div>
                                    <div class="col-span-12 lg:col-span-3">
                                        <div class="mb-4">
                                            <label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">شرایط فیزیکی دستگاه</label>
                                            <input class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100" type="text" id="example-date-input"
                                                name="situation"
                                                readonly
                                                value="<?php echo htmlspecialchars($data['reception']->situation ?? ''); ?>">
                                        </div>
                                        <div class="mb-4">
                                            <label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">ایراد دستگاه به اظهار مشتری </label>
                                            <input class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100" type="text" id="example-date-input"
                                                name="problem"
                                                readonly
                                                value="<?php echo htmlspecialchars($data['reception']->problem ?? ''); ?>">
                                        </div>
                                        <div class="mb-4">
                                            <label class="block font-medium text-gray-700 dark:text-gray-100 mb-2">لوازم همراه</label>
                                            <div class="py-2.5 flex space-x-4">
                                                <?php
                                                // تبدیل رشته accessories ه آرایه (اگر به صورت رشته ذخیره شده باشد)
                                                $accessories = is_string($data['reception']->accessories ?? '') ?
                                                    explode(',', $data['reception']->accessories) : ($data['reception']->accessories ?? []);
                                                ?>

                                                <div class="form-check">
                                                    <label class="ltr:mr-2 rtl:ml-2 font-medium text-gray-700 dark:text-zinc-100" for="acc_box">جعبه</label>
                                                    <input type="checkbox"
                                                        <?php echo in_array('box', $accessories) ? 'checked' : ''; ?>
                                                        class="rounded align-middle ml-2 focus:ring-0 focus:ring-offset-0 dark:bg-zinc-700 dark:border-zinc-400 checked:bg-violet-500 dark:checked:bg-violet-500"
                                                        id="acc_box"
                                                        name="accessories[]"
                                                        readonly
                                                        value="box">
                                                </div>

                                                <div class="form-check">
                                                    <label class="ltr:mr-2 rtl:ml-2 font-medium text-gray-700 dark:text-zinc-100" for="acc_warranty">کارت گارانتی</label>
                                                    <input type="checkbox"
                                                        <?php echo in_array('warrantycard', $accessories) ? 'checked' : ''; ?>
                                                        class="rounded align-middle ml-2 focus:ring-0 focus:ring-offset-0 dark:bg-zinc-700 dark:border-zinc-400 checked:bg-violet-500 dark:checked:bg-violet-500"
                                                        id="acc_warranty"
                                                        name="accessories[]"
                                                        readonly
                                                        value="warrantycard">
                                                </div>

                                                <div class="form-check">
                                                    <label class="ltr:mr-2 rtl:ml-2 font-medium text-gray-700 dark:text-zinc-100" for="acc_adapter">آداپتور</label>
                                                    <input type="checkbox"
                                                        <?php echo in_array('adapter', $accessories) ? 'checked' : ''; ?>
                                                        class="rounded align-middle ml-2 focus:ring-0 focus:ring-offset-0 dark:bg-zinc-700 dark:border-zinc-400 checked:bg-violet-500 dark:checked:bg-violet-500"
                                                        id="acc_adapter"
                                                        name="accessories[]"
                                                        readonly
                                                        value="adapter">
                                                </div>

                                                <div class="form-check">
                                                    <label class="ltr:mr-2 rtl:ml-2 font-medium text-gray-700 dark:text-zinc-100" for="acc_cable">کابل شارژ</label>
                                                    <input type="checkbox"
                                                        <?php echo in_array('cable', $accessories) ? 'checked' : ''; ?>
                                                        class="rounded align-middle ml-2 focus:ring-0 focus:ring-offset-0 dark:bg-zinc-700 dark:border-zinc-400 checked:bg-violet-500 dark:checked:bg-violet-500"
                                                        id="acc_cable"
                                                        name="accessories[]"
                                                        readonly
                                                        value="cable">
                                                </div>

                                                <div class="form-check">
                                                    <label class="ltr:mr-2 rtl:ml-2 font-medium text-gray-700 dark:text-zinc-100" for="acc_handsfree">هندزفری</label>
                                                    <input type="checkbox"
                                                        <?php echo in_array('handsfree', $accessories) ? 'checked' : ''; ?>
                                                        class="rounded align-middle ml-2 focus:ring-0 focus:ring-offset-0 dark:bg-zinc-700 dark:border-zinc-400 checked:bg-violet-500 dark:checked:bg-violet-500"
                                                        id="acc_handsfree"
                                                        name="accessories[]"
                                                        readonly
                                                        value="handsfree">
                                                </div>

                                                <div class="form-check">
                                                    <label class="ltr:mr-2 rtl:ml-2 font-medium text-gray-700 dark:text-zinc-100" for="acc_pin">سوزن</label>
                                                    <input type="checkbox"
                                                        <?php echo in_array('pin', $accessories) ? 'checked' : ''; ?>
                                                        class="rounded align-middle ml-2 focus:ring-0 focus:ring-offset-0 dark:bg-zinc-700 dark:border-zinc-400 checked:bg-violet-500 dark:checked:bg-violet-500"
                                                        id="acc_pin"
                                                        name="accessories[]"
                                                        readonly
                                                        value="pin">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-12 lg:col-span-2 pr-4 border-r border-gray-200">
                                        <div class="mb-4">
                                            <div class="mb-3">
                                                <label class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">وضعیت پذیرش</label>
                                                <select class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100"
                                                    name="product_status"
                                                    required>
                                                    <option value="">انتخاب کنید</option>
                                                    <option value="دریافت از دفتر مرکزی" <?php echo (isset($data['reception']->product_status) && $data['reception']->product_status === 'دریافت از دفتر مرکزی') ? 'selected' : ''; ?>>دریافت از دفتر مرکزی</option>
                                                    <option value="پذیرش در نمایندگی" <?php echo (isset($data['reception']->product_status) && $data['reception']->product_status === 'پذیرش در نمایندگی') ? 'selected' : ''; ?>>پذیرش در نمایندگی</option>
                                                    <option value="ارسال از نمایندگی به دفتر مرکزی" <?php echo (isset($data['reception']->product_status) && $data['reception']->product_status === 'ارسال از نمایندگی به دفتر مرکزی') ? 'selected' : ''; ?>>ارسال از نمایندگی به دفتر مرکزی</option>
                                                    <option value="در انتظار تکمیل مدارک" <?php echo (isset($data['reception']->product_status) && $data['reception']->product_status === 'در انتظار تکمیل مدارک') ? 'selected' : ''; ?>>در انتظار تکمیل مدارک</option>
                                                    <option value="ارسال از دفتر مرکزی به نمایندگی" <?php echo (isset($data['reception']->product_status) && $data['reception']->product_status === 'ارسال از دفتر مرکزی به نمایندگی') ? 'selected' : ''; ?>>ارسال از دفتر مرکزی به نمایندگی</option>
                                                    <option value="تحویل به مشتری" <?php echo (isset($data['reception']->product_status) && $data['reception']->product_status === 'تحویل به مشتری') ? 'selected' : ''; ?>>تحویل به مشتری</option>
                                                    <option value="دریافت از نمایندگی" <?php echo (isset($data['reception']->product_status) && $data['reception']->product_status === 'دریافت از نمایندگی') ? 'selected' : ''; ?>>دریافت از نمایندگی</option>
                                                    <option value="در انتظار کارشناسی" <?php echo (isset($data['reception']->product_status) && $data['reception']->product_status === 'در انتظار کارشناسی') ? 'selected' : ''; ?>>در انتظار کارشناسی</option>
                                                    <option value="در انتظار قطعه" <?php echo (isset($data['reception']->product_status) && $data['reception']->product_status === 'در انتظار قطعه') ? 'selected' : ''; ?>>در انتظار قطعه</option>
                                                    <option value="در حال تعویض" <?php echo (isset($data['reception']->product_status) && $data['reception']->product_status === 'در حال تعویض') ? 'selected' : ''; ?>>در حال تعویض</option>
                                                    <option value="در حال انجام کار در دفتر مرکزی" <?php echo (isset($data['reception']->product_status) && $data['reception']->product_status === 'در حال انجام کار در دفتر مرکزی') ? 'selected' : ''; ?>>در حال انجام کار در دفتر مرکزی</option>
                                                    <option value="اتمام تعمیر" <?php echo (isset($data['reception']->product_status) && $data['reception']->product_status === 'اتمام تعمیر') ? 'selected' : ''; ?>>اتمام تعمیر</option>
                                                    <option value="در انتظار تایید هزینه" <?php echo (isset($data['reception']->product_status) && $data['reception']->product_status === 'در انتظار تایید هزینه') ? 'selected' : ''; ?>>در انتظار تایید هزینه</option>
                                                    <option value="عدم موافقت با هزینه - مرجوع" <?php echo (isset($data['reception']->product_status) && $data['reception']->product_status === 'عدم موافقت با هزینه - مرجوع') ? 'selected' : ''; ?>>عدم موافقت با هزینه - مرجوع</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <label for="activation-date" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">شماره بارنامه ارسال به مرکز </label>
                                            <input class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100" type="text" name="sh_baar"
                                                value="<?php echo htmlspecialchars($data['reception']->sh_baar ?? ''); ?>">
                                        </div>

                                        <div class="mb-4">
                                            <label for="activation-date" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">شماره بارنامه ارسال به نمایندگی </label>
                                            <input class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100" type="text" name="sh_baar2"
                                                value="<?php echo htmlspecialchars($data['reception']->sh_baar2 ?? ''); ?>">
                                        </div>
                                    </div>
                                    <div class="col-span-12 lg:col-span-3">
                                        <div class="mb-4">
                                            <label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">تعمیرات انجام شده </label>
                                            <input class="w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100" type="text"
                                                name="kaar"
                                                value="<?php echo htmlspecialchars($data['reception']->kaar ?? ''); ?>">
                                        </div>
                                        <div class="mb-4">
                                            <label for="example-text-input" class="block font-medium text-gray-700 dark:text-gray-100 mb-2"> سریال قطعه تعویض شده </label>
                                            <input class="w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100" type="text"
                                                name="kaar_serial"
                                                value="<?php echo htmlspecialchars($data['reception']->kaar_serial ?? ''); ?>">
                                        </div>
                                        <div class="mb-4">
                                            <label for="kaar_at" class="block font-medium text-gray-700 dark:text-gray-100 mb-2"> تاریخ گارانتی قطعه</label>
                                            <input
                                                name="kaar_at"
                                                class="input-field w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                                type="text"
                                                id="example-full-input"
                                                value="<?php echo htmlspecialchars($data['reception']->kaar_at ?? ''); ?>">
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
                                                    <div class="flex flex-col gap-2">
                                                        <!-- پیش نمایش تصویر -->
                                                        <img id="preview1"
                                                            src="<?php echo URLROOT; ?>/assets/uploads/receptions/<?php echo $data['reception']->file1; ?>"
                                                            alt="تصویر کارت شناسایی"
                                                            class="rounded-lg"
                                                            style="width: 150px; height: 150px; object-fit: cover;">

                                                        <!-- لینک دانلود -->
                                                        <a href="<?php echo URLROOT; ?>/receptions/download/<?php echo $data['reception']->id; ?>/<?php echo $data['reception']->file1; ?>"
                                                            class="flex items-center gap-2 text-sm text-violet-500 hover:text-violet-600">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                            </svg>
                                                            دانلود تصویر
                                                        </a>
                                                    </div>
                                                <?php else: ?>
                                                    <img id="preview1" src="#" alt="پیش نمایش تصویر" class="hidden rounded-lg" style="width: 150px; height: 150px; object-fit: cover;">
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- تصویر فاکتور خرید -->
                                    <div class="col-span-12 lg:col-span-4">
                                        <div class="mb-4">
                                            <label for="avatar2" class="block font-medium text-gray-700 dark:text-gray-100 mb-2"> تصویر فاکتور خرید</label>
                                            <input
                                                name="image2"
                                                class="input-field w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                                type="file"
                                                id="avatar2"
                                                accept="image/*"
                                                onchange="previewImage(this, 'preview2');">
                                            <div class="mt-2">
                                                <?php if (!empty($data['reception']->file2)): ?>
                                                    <div class="flex flex-col gap-2">
                                                        <!-- پیش نمایش تصویر -->
                                                        <img id="preview2"
                                                            src="<?php echo URLROOT; ?>/assets/uploads/receptions/<?php echo $data['reception']->file2; ?>"
                                                            alt="تصویر فاکتور خرید"
                                                            class="rounded-lg"
                                                            style="width: 150px; height: 150px; object-fit: cover;">

                                                        <!-- لینک دانلود -->
                                                        <a href="<?php echo URLROOT; ?>/receptions/download/<?php echo urlencode($data['reception']->file2); ?>"
                                                            class="flex items-center gap-2 text-sm text-violet-500 hover:text-violet-600">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                            </svg>
                                                            دانلود تصویر
                                                        </a>
                                                    </div>
                                                <?php else: ?>
                                                    <img id="preview2" src="#" alt="پیش نمایش تصویر" class="hidden rounded-lg" style="width: 150px; height: 150px; object-fit: cover;">
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- تصویر ایراد -->
                                    <div class="col-span-12 lg:col-span-4">
                                        <div class="mb-4">
                                            <label for="avatar3" class="block font-medium text-gray-700 dark:text-gray-100 mb-2"> تصویر فاکتور خرید</label>
                                            <input
                                                name="image3"
                                                class="input-field w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                                type="file"
                                                id="avatar3"
                                                accept="image/*"
                                                onchange="previewImage(this, 'preview3');">
                                            <div class="mt-2">
                                                <?php if (!empty($data['reception']->file3)): ?>
                                                    <div class="flex flex-col gap-2">
                                                        <!-- پیش نمایش تصویر -->
                                                        <img id="preview3"
                                                            src="<?php echo URLROOT; ?>/assets/uploads/receptions/<?php echo $data['reception']->file3; ?>"
                                                            alt="تصویر فاکتور خرید"
                                                            class="rounded-lg"
                                                            style="width: 150px; height: 150px; object-fit: cover;">

                                                        <!-- لینک دانلود -->
                                                        <a href="<?php echo URLROOT; ?>/receptions/download/<?php echo urlencode($data['reception']->file3); ?>"
                                                            class="flex items-center gap-2 text-sm text-violet-500 hover:text-violet-600">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                            </svg>
                                                            دانلود تصویر
                                                        </a>
                                                    </div>
                                                <?php else: ?>
                                                    <img id="preview2" src="#" alt="پیش نمایش تصویر" class="hidden rounded-lg" style="width: 150px; height: 150px; object-fit: cover;">
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    document.getElementById('reception-form').addEventListener('submit', function(e) {
        e.preventDefault();

        const form = this;
        const formData = new FormData(form);

        // Show loading indicator
        Swal.fire({
            title: 'در حال پردازش...',
            text: 'لطفاً صبر کنید',
            allowOutsideClick: false,
            allowEscapeKey: false,
            showConfirmButton: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        fetch(form.action, {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('پاسخ سرور ناموفق: ' + response.status);
                }
                return response.json();
            })
            .then(data => {
                console.log('پاسخ سرور:', data); // برای دیباگ
                if (data.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'موفقیت!',
                        text: data.message,
                        confirmButtonText: 'باشه',
                        confirmButtonColor: '#8B5CF6'
                    }).then(() => {
                        // Stay on the current page instead of redirecting
                        window.location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'خطا!',
                        text: data.message,
                        confirmButtonText: 'باشه',
                        confirmButtonColor: '#EF4444'
                    });
                }
            })
            .catch(error => {
                console.error('خطا:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'خطا!',
                    text: 'مشکلی در ارتباط با سرور رخ داد: ' + error.message,
                    confirmButtonText: 'باشه',
                    confirmButtonColor: '#EF4444'
                });
            });
    });
</script>

<?php require_once(APPROOT . "/views/public/footer.php"); ?>