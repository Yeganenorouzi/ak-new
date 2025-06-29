<?php
use Hekmatinasser\Verta\Verta;
?>
<?php require_once(APPROOT . "/views/public/header.php"); ?>

<div class="main-content">
    <div class="page-content dark:bg-zinc-700">
        <div class="container-fluid px-[0.625rem]">

            <form action="<?php echo URLROOT; ?>/receptions/update/<?php echo $data['reception']->id; ?>" method="POST"
                enctype="multipart/form-data" id="reception-form">
                <!-- Header section with title and button -->
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-3 ltr:md:space-x-3 rtl:md:space-x-0">
                        <li class="inline-flex items-center">
                            <div class="mb-4">
                                <h5
                                    class="ltr:ml-1 rtl:mr-1 text-sm font-medium text-gray-500 hover:text-gray-900 ltr:md:ml-2 rtl:md:mr-2 dark:text-gray-100 dark:hover:text-white">
                                    شماره پذیرش :
                                    <?php echo isset($data['reception']->id) ? htmlspecialchars($data['reception']->id) : 'N/A'; ?>
                                </h5>
                            </div>
                        </li>
                        <li class="inline-flex items-center mr-10">
                            <div class="mb-4">
                                <h5
                                    class="ltr:ml-1 rtl:mr-1 text-sm font-medium text-gray-500 hover:text-gray-900 ltr:md:ml-2 rtl:md:mr-2 dark:text-gray-100 dark:hover:text-white">
                                    تاریخ پذیرش :
                                    <?php echo isset($data['reception']->created_at) ? Verta::instance($data['reception']->created_at)->format('Y/m/d') : 'N/A'; ?>
                                </h5>
                            </div>
                        </li>
                    </ol>
                </nav>
                <div class="grid grid-cols-1 mb-5">
                    <div class="flex items-center justify-between">
                        <h4 class="mb-sm-0 text-lg font-semibold grow text-gray-800 dark:text-gray-100">فرم پذیرش </h4>
                        <div class="flex gap-2">
                            <!-- دکمه بازگشت به منو -->
                            <a href="<?php echo ($_SESSION['is_admin'] === 1) ? URLROOT . '/customers/index' : URLROOT . '/customers/agent'; ?>"
                                class="flex btn text-white bg-gray-500 border-gray-500 hover:bg-gray-600 hover:border-gray-600 focus:bg-gray-600 focus:border-gray-600 focus:ring focus:ring-gray-500/30 active:bg-gray-600 active:border-gray-600">
                                بازگشت به منو
                            </a>
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
                                                نام خانوادگی مشتری</label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                type="text" id="example-text-input" name="name" readonly
                                                value="<?php echo htmlspecialchars($data['reception']->name ?? ''); ?>">
                                        </div>
                                        <div class="mb-4">
                                            <label for="example-text-input"
                                                class="block font-medium text-gray-700 dark:text-gray-100 mb-2">شماره
                                                تلفن همراه</label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                                type="tel" id="example-date-input" name="mobile" readonly
                                                value="<?php echo htmlspecialchars($data['reception']->mobile ?? ''); ?>">
                                        </div>
                                        <div class="mb-4">
                                            <label for="example-text-input"
                                                class="block font-medium text-gray-700 dark:text-gray-100 mb-2">شماره
                                                تلفن ثابت</label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                                type="tel" id="example-date-input" name="phone" readonly
                                                value="<?php echo htmlspecialchars($data['reception']->phone ?? ''); ?>">
                                        </div>
                                        <div class="mb-4">
                                            <div class="mb-3">
                                                <label
                                                    class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">استان</label>
                                                <select
                                                    class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100"
                                                    name="ostan" id="province-select" readonly>
                                                    <option value="">انتخاب استان</option>
                                                    <?php
                                                    foreach (ProvinceHelper::getProvinces() as $province):
                                                        ?>
                                                        <option <?php echo (isset($data['reception']->ostan) && $data['reception']->ostan === $province) ? 'selected' : ''; ?>
                                                            value="<?php echo $province; ?>">
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
                                                <label
                                                    class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">شهر</label>
                                                <select
                                                    class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100"
                                                    name="shahr" readonly>
                                                    <option value="">انتخاب شهر</option>
                                                    <?php
                                                    foreach (ProvinceHelper::getCities() as $province => $cities):
                                                        foreach ($cities as $city):
                                                            ?>
                                                            <option <?php echo (isset($data['reception']->shahr) && $data['reception']->shahr === $city) ? 'selected' : ''; ?>
                                                                value="<?php echo $city; ?>">
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
                                            <label for="codemelli"
                                                class="block font-medium text-gray-700 dark:text-gray-100 mb-2">کدملی</label>
                                            <div class="relative">
                                                <input
                                                    class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100 pr-[90px]"
                                                    type="text" id="codemelli" name="codemelli" readonly
                                                    value="<?php echo htmlspecialchars($data['reception']->codemelli ?? ''); ?>">

                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <label for="example-text-input"
                                                class="block font-medium text-gray-700 dark:text-gray-100 mb-2">شماره
                                                پاسپورت</label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                                type="text" id="example-date-input" name="passport" readonly
                                                value="<?php echo htmlspecialchars($data['reception']->passport ?? ''); ?>">
                                        </div>
                                        <div class="mb-4">
                                            <label for="example-text-input"
                                                class="block font-medium text-gray-700 dark:text-gray-100 mb-2">کد
                                                پستی</label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                                type="text" id="example-date-input" name="codeposti" readonly
                                                value="<?php echo htmlspecialchars($data['reception']->codeposti ?? ''); ?>">
                                        </div>

                                        <div class="mb-4">
                                            <label for="example-text-input"
                                                class="block font-medium text-gray-700 dark:text-gray-100 mb-2">آدرس</label>
                                            <textarea
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                style="height: 156px; resize: none;" type="text" id="example-text-input"
                                                readonly name="address"><?php echo htmlspecialchars($data['reception']->address ?? ''); ?>
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
                                            <label for="serial"
                                                class="block font-medium text-gray-700 dark:text-gray-100 mb-2">سریال</label>
                                            <div class="relative">
                                                <input
                                                    class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100 pr-[90px]"
                                                    type="text" id="serial" name="serial" readonly
                                                    value="<?php echo htmlspecialchars($data['reception']->serial ?? ''); ?>">

                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <label for="example-text-input"
                                                class="block font-medium text-gray-700 dark:text-gray-100 mb-2">عنوان
                                                درختواره دستگاه </label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                type="text" name="model" readonly
                                                value="<?php echo htmlspecialchars($data['reception']->model ?? ''); ?>"
                                                id="example-text-input">
                                        </div>
                                        <div class="mb-4">
                                            <label for="example-text-input"
                                                class="block font-medium text-gray-700 dark:text-gray-100 mb-2">حافظه
                                                داخلی دستگاه </label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                type="text" name="att1_code" readonly
                                                value="<?php echo htmlspecialchars($data['reception']->att1_code ?? ''); ?>"
                                                id="example-text-input">
                                        </div>

                                        <div class="mb-4">
                                            <label for="example-text-input"
                                                class="block font-medium text-gray-700 dark:text-gray-100 mb-2">رنگ
                                                دستگاه </label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                type="text" name="att3_code" readonly
                                                value="<?php echo htmlspecialchars($data['reception']->att3_code ?? ''); ?>"
                                                id="example-text-input">
                                        </div>

                                        <div class="mb-4">
                                            <label for="example-text-input"
                                                class="block font-medium text-gray-700 dark:text-gray-100 mb-2">نام شرکت
                                                واردکننده دستگاه</label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                type="text" name="company" readonly
                                                value="<?php echo htmlspecialchars($data['reception']->company ?? ''); ?>"
                                                id="example-text-input">
                                        </div>
                                        <div class="mb-4">
                                            <label for="example-text-input"
                                                class="block font-medium text-gray-700 dark:text-gray-100 mb-2">تاریخ
                                                شروع گارانتی دستگاه</label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                type="text" name="start_guarantee" readonly
                                                value="<?php echo htmlspecialchars($data['reception']->start_guarantee ?? ''); ?>"
                                                id="example-text-input">
                                        </div>


                                    </div>
                                    <div class="col-span-12 lg:col-span-6">
                                        <div class="mb-4">
                                            <label for="example-text-input"
                                                class="block font-medium text-gray-700 dark:text-gray-100 mb-2">سریال
                                                دوم دستگاه</label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                type="text" name="serial2" readonly
                                                value="<?php echo htmlspecialchars($data['reception']->serial2 ?? ''); ?>"
                                                id="example-text-input">
                                        </div>
                                        <div class="mb-4">
                                            <label for="example-text-input"
                                                class="block font-medium text-gray-700 dark:text-gray-100 mb-2">عنوان
                                                دستگاه</label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                type="text" name="title" readonly
                                                value="<?php echo htmlspecialchars($data['reception']->title ?? ''); ?>"
                                                id="example-text-input">
                                        </div>
                                        <div class="mb-4">
                                            <label for="example-text-input"
                                                class="block font-medium text-gray-700 dark:text-gray-100 mb-2">حافظه
                                                RAM دستگاه </label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                type="text" name="att2_code" readonly
                                                value="<?php echo htmlspecialchars($data['reception']->att2_code ?? ''); ?>"
                                                id="example-text-input">
                                        </div>

                                        <div class="mb-4">
                                            <label for="example-text-input"
                                                class="block font-medium text-gray-700 dark:text-gray-100 mb-2">کشور
                                                سازنده دستگاه </label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                type="text" name="att4_code" readonly
                                                value="<?php echo htmlspecialchars($data['reception']->att4_code ?? ''); ?>"
                                                id="example-text-input">
                                        </div>
                                        <div class="mb-4">
                                            <label for="example-text-input"
                                                class="block font-medium text-gray-700 dark:text-gray-100 mb-2">شماره
                                                سند واردات دستگاه</label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                type="text" name="sh_sanad" readonly
                                                value="<?php echo htmlspecialchars($data['reception']->sh_sanad ?? ''); ?>"
                                                id="example-text-input">
                                        </div>
                                        <div class="mb-4">
                                            <label for="example-text-input"
                                                class="block font-medium text-gray-700 dark:text-gray-100 mb-2">تاریخ
                                                پایان گارانتی دستگاه</label>
                                            <input
                                                class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                                type="text" name="expite_guarantee" readonly
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
                                            <label class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">نوع
                                                پذیرش</label>
                                            <input
                                                class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100"
                                                name="paziresh_status" readonly
                                                value="<?php echo htmlspecialchars($data['reception']->paziresh_status ?? ''); ?>">

                                            </input>

                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label for="activation-date"
                                            class="block font-medium text-gray-700 dark:text-gray-100 mb-2">وضعیت
                                            فعالسازی </label>
                                        <input
                                            class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                            type="text" id="activation-date" name="activation_status" readonly
                                            value="<?php echo htmlspecialchars($data['reception']->activation_status ?? ''); ?>">
                                    </div>
                                    <div class="mb-4">
                                        <label for="activation-date"
                                            class="block font-medium text-gray-700 dark:text-gray-100 mb-2">تاریخ
                                            فعالسازی </label>
                                        <input
                                            class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                            type="text" id="activation-date" name="activation_start_date" readonly
                                            value="<?php echo htmlspecialchars($data['reception']->activation_start_date ?? ''); ?>">
                                    </div>
                                    <div class="mb-4">
                                        <div class="mb-3">
                                            <label class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">
                                                تعداد روز فعالسازی
                                                فعالسازی </label>
                                            <input
                                                class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100"
                                                name="activation_day" readonly
                                                value="<?php echo htmlspecialchars($data['reception']->activation_day ?? ''); ?>">

                                            </input>
                                        </div>
                                    </div>



                                </div>
                                <div class="col-span-12 lg:col-span-2">
                                    <div class="mb-4">
                                        <div class="mb-3">
                                            <label class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">وضعیت
                                                گارانتی</label>
                                            <input
                                                class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100"
                                                name="guarantee_status" readonly
                                                value="<?php echo htmlspecialchars($data['reception']->guarantee_status ?? ''); ?>">

                                            </input>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label for="example-text-input"
                                            class="block font-medium text-gray-700 dark:text-gray-100 mb-2">زمان تقریبی
                                            تعمیر </label>
                                        <input
                                            class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                            type="text" id="example-month-input" name="estimated_time" readonly
                                            value="<?php echo htmlspecialchars($data['reception']->estimated_time ?? ''); ?>">
                                    </div>
                                    <div class="mb-4">
                                        <label for="example-text-input"
                                            class="block font-medium text-gray-700 dark:text-gray-100 mb-2"> هزینه
                                            تقریبی تعمیر </label>
                                        <input
                                            class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                            type="text" id="example-week-input" name="estimated_cost" readonly
                                            value="<?php echo htmlspecialchars($data['reception']->estimated_cost ?? ''); ?>">
                                    </div>
                                    <div class="mb-4">
                                        <label for="example-text-input"
                                            class="block font-medium text-gray-700 dark:text-gray-100 mb-2">توضیحات
                                        </label>
                                        <input
                                            class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                            type="text" id="example-date-input" name="dex" readonly
                                            value="<?php echo htmlspecialchars($data['reception']->dex ?? ''); ?>">
                                    </div>


                                </div>

                                <div class="col-span-12 lg:col-span-3">
                                    <div class="mb-4">
                                        <label for="example-text-input"
                                            class="block font-medium text-gray-700 dark:text-gray-100 mb-2"> وضعیت
                                            تعمیر</label>
                                        <input
                                            class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                            type="text" id="example-date-input" name="repair_status" readonly
                                            value="<?php echo htmlspecialchars($data['reception']->repair_status ?? ''); ?>">
                                    </div>

                                    <div class="mb-4">
                                        <label for="example-text-input"
                                            class="block font-medium text-gray-700 dark:text-gray-100 mb-2">شرایط فیزیکی
                                            دستگاه</label>
                                        <input
                                            class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                            type="text" id="example-date-input" name="situation" readonly
                                            value="<?php echo htmlspecialchars($data['reception']->situation ?? ''); ?>">
                                    </div>
                                    <div class="mb-4">
                                        <label for="example-text-input"
                                            class="block font-medium text-gray-700 dark:text-gray-100 mb-2">ایراد دستگاه
                                            به اظهار مشتری </label>
                                        <input
                                            class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                            type="text" id="example-date-input" name="problem" readonly
                                            value="<?php echo htmlspecialchars($data['reception']->problem ?? ''); ?>">
                                    </div>
                                    <div class="mb-4">
                                        <label class="block font-medium text-gray-700 dark:text-gray-100 mb-2">لوازم
                                            همراه</label>
                                        <div class="relative">
                                            <?php
                                            // تبدیل رشته accessories به آرایه (اگر به صورت رشته ذخیره شده باشد)
                                            $accessories = is_string($data['reception']->accessories ?? '') ?
                                                explode(',', $data['reception']->accessories) : ($data['reception']->accessories ?? []);

                                            // تعریف لیست لوازم موجود
                                            $accessoryOptions = [
                                                'box' => 'جعبه',
                                                'warrantycard' => 'کارت گارانتی',
                                                'adapter' => 'آداپتور',
                                                'cable' => 'کابل شارژ',
                                                'handsfree' => 'هندزفری',
                                                'pin' => 'سوزن',
                                                'case' => 'کاور',
                                                'screenprotector' => 'محافظ صفحه',
                                                'memorycard' => 'کارت حافظه'
                                            ];

                                            // ساخت متن نمایشی برای انتخاب‌های فعلی
                                            $selectedText = '';
                                            if (!empty($accessories)) {
                                                $selectedNames = [];
                                                foreach ($accessories as $acc) {
                                                    if (isset($accessoryOptions[$acc])) {
                                                        $selectedNames[] = $accessoryOptions[$acc];
                                                    }
                                                }
                                                $selectedText = implode(', ', $selectedNames);
                                            }
                                            ?>
                                            
                                            <!-- فیلد نمایش انتخاب‌های فعلی -->
                                            <div 
                                                id="accessories-display"
                                                class="w-full rounded border-gray-100 py-2.5 px-3 text-sm text-gray-500 bg-white dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100 cursor-pointer border"
                                                onclick="toggleAccessoriesDropdown()"
                                            >
                                                <div class="flex justify-between items-center">
                                                    <span id="selected-accessories-text">
                                                        <?php echo !empty($selectedText) ? htmlspecialchars($selectedText) : 'انتخاب لوازم همراه...'; ?>
                                                    </span>
                                                    <svg class="w-4 h-4 transform transition-transform" id="dropdown-arrow" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                                    </svg>
                                                </div>
                                            </div>

                                            <!-- درپ‌داون انتخاب -->
                                            <div 
                                                id="accessories-dropdown" 
                                                class="absolute z-10 w-full mt-1 bg-white dark:bg-zinc-800 border border-gray-200 dark:border-zinc-600 rounded-md shadow-lg hidden"
                                            >
                                                <div class="py-2 max-h-60 overflow-y-auto">
                                                    <?php foreach ($accessoryOptions as $value => $label): ?>
                                                                <div class="px-3 py-2 hover:bg-gray-100 dark:hover:bg-zinc-700 cursor-pointer">
                                                                    <label class="flex items-center cursor-pointer">
                                                                        <input 
                                                                            type="checkbox"
                                                                            name="accessories[]"
                                                                            value="<?php echo $value; ?>"
                                                                            <?php echo in_array($value, $accessories) ? 'checked' : ''; ?>
                                                                            class="rounded mr-2 focus:ring-0 focus:ring-offset-0 dark:bg-zinc-700 dark:border-zinc-400 checked:bg-violet-500 dark:checked:bg-violet-500"
                                                                            onchange="updateAccessoriesDisplay()"
                                                                        >
                                                                        <span class="text-sm text-gray-700 dark:text-gray-100"><?php echo $label; ?></span>
                                                                    </label>
                                                                </div>
                                                    <?php endforeach; ?>
                                                </div>
                                                
                                                <!-- دکمه‌های عملیات -->
                                                <div class="border-t border-gray-200 dark:border-zinc-600 p-2 flex gap-2">
                                                    <button 
                                                        type="button"
                                                        onclick="selectAllAccessories()"
                                                        class="px-3 py-1 text-xs bg-violet-500 text-white rounded hover:bg-violet-600"
                                                    >
                                                        انتخاب همه
                                                    </button>
                                                    <button 
                                                        type="button"
                                                        onclick="clearAllAccessories()"
                                                        class="px-3 py-1 text-xs bg-gray-500 text-white rounded hover:bg-gray-600"
                                                    >
                                                        پاک کردن همه
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-span-12 lg:col-span-2 pr-4 border-r border-gray-200">
                                    <div class="mb-4">
                                        <label class="block font-medium text-gray-700 dark:text-zinc-100 mb-2">وضعیت پذیرش</label>
                                        <input class="dark:bg-zinc-800 dark:border-zinc-700 w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:text-zinc-100"
                                            name="product_status"
                                            readonly
                                            value="<?php echo htmlspecialchars($data['reception']->product_status ?? ''); ?>">
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
                                                            <img id="preview1"
                                                                src="<?php echo URLROOT; ?>/assets/uploads/receptions/<?php echo $data['reception']->file1; ?>"
                                                                alt="تصویر کارت شناسایی"
                                                                class="rounded-lg"
                                                                style="width: 150px; height: 150px; object-fit: cover;">
                                                            <a href="<?php echo URLROOT; ?>/receptions/download/<?php echo $data['reception']->id; ?>/<?php echo $data['reception']->file1; ?>"
                                                                class="flex items-center gap-2 text-sm text-violet-500 hover:text-violet-600">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                                </svg>
                                                                دانلود تصویر
                                                            </a>
                                                        </div>
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
                                                            <img id="preview2"
                                                                src="<?php echo URLROOT; ?>/assets/uploads/receptions/<?php echo $data['reception']->file2; ?>"
                                                                alt="تصویر فاکتور خرید"
                                                                class="rounded-lg"
                                                                style="width: 150px; height: 150px; object-fit: cover;">
                                                            <a href="<?php echo URLROOT; ?>/receptions/download/<?php echo urlencode($data['reception']->file2); ?>"
                                                                class="flex items-center gap-2 text-sm text-violet-500 hover:text-violet-600">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                                </svg>
                                                                دانلود تصویر
                                                            </a>
                                                        </div>
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
                                                            <img id="preview3"
                                                                src="<?php echo URLROOT; ?>/assets/uploads/receptions/<?php echo $data['reception']->file3; ?>"
                                                                alt="تصویر فاکتور خرید"
                                                                class="rounded-lg"
                                                                style="width: 150px; height: 150px; object-fit: cover;">
                                                            <a href="<?php echo URLROOT; ?>/receptions/download/<?php echo urlencode($data['reception']->file3); ?>"
                                                                class="flex items-center gap-2 text-sm text-violet-500 hover:text-violet-600">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                                </svg>
                                                                دانلود تصویر
                                                            </a>
                                                        </div>
                                            <?php endif; ?>
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
                        preview.style.display = 'block';
                    }

                    reader.readAsDataURL(input.files[0]);
                } else {
                    preview.src = '#';
                    preview.classList.add('hidden');
                    preview.style.display = 'none';
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                const fileInputs = ['avatar1', 'avatar2', 'avatar3'];

                fileInputs.forEach((inputId, index) => {
                    const input = document.getElementById(inputId);
                    if (input) {
                        input.addEventListener('change', function() {
                            previewImage(this, `preview${index + 1}`);
                        });
                    }
                });

                // کلیک خارج از dropdown برای بستن آن
                document.addEventListener('click', function(event) {
                    const dropdown = document.getElementById('accessories-dropdown');
                    const display = document.getElementById('accessories-display');
                    
                    if (dropdown && display && !dropdown.contains(event.target) && !display.contains(event.target)) {
                        dropdown.classList.add('hidden');
                        const arrow = document.getElementById('dropdown-arrow');
                        if (arrow) {
                            arrow.style.transform = 'rotate(0deg)';
                        }
                    }
                });
            });

            // توابع مدیریت dropdown لوازم همراه
            function toggleAccessoriesDropdown() {
                const dropdown = document.getElementById('accessories-dropdown');
                const arrow = document.getElementById('dropdown-arrow');
                
                if (dropdown) {
                    dropdown.classList.toggle('hidden');
                    
                    if (arrow) {
                        if (dropdown.classList.contains('hidden')) {
                            arrow.style.transform = 'rotate(0deg)';
                        } else {
                            arrow.style.transform = 'rotate(180deg)';
                        }
                    }
                }
            }

            function updateAccessoriesDisplay() {
                const checkboxes = document.querySelectorAll('input[name="accessories[]"]:checked');
                const selectedText = Array.from(checkboxes).map(cb => {
                    return cb.nextElementSibling.textContent;
                }).join(', ');
                
                const displayText = selectedText || 'انتخاب لوازم همراه...';
                const textElement = document.getElementById('selected-accessories-text');
                if (textElement) {
                    textElement.textContent = displayText;
                }
            }

            function selectAllAccessories() {
                const checkboxes = document.querySelectorAll('input[name="accessories[]"]');
                checkboxes.forEach(checkbox => {
                    checkbox.checked = true;
                });
                updateAccessoriesDisplay();
            }

            function clearAllAccessories() {
                const checkboxes = document.querySelectorAll('input[name="accessories[]"]');
                checkboxes.forEach(checkbox => {
                    checkbox.checked = false;
                });
                updateAccessoriesDisplay();
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