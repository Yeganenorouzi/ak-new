<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="utf-8" />
    <title>AK WARRANTY</title>
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta
        content="Tailwind Admin & Dashboard Template"
        name="description" />
    <meta content="" name="Themesbrand" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo URLROOT . "/assets/images/favicon.ico" ?>" />


    <link rel="stylesheet" href="<?php echo URLROOT . "/assets/libs/swiper/swiper-bundle.min.css" ?>">

    <link rel="stylesheet" href="<?php echo URLROOT . "/assets/css/icons.css" ?>" />
    <link rel="stylesheet" href="<?php echo URLROOT . "/assets/css/tailwind.css" ?>" />

    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">


</head>

<body data-mode="light" data-sidebar-size="lg">

    <div class="container-fluid">
        <div class="h-screen md:overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-12">
                <div class="col-span-12 md:col-span-5 lg:col-span-4 xl:col-span-3 relative z-50">
                    <div class="w-full bg-white xl:p-12 p-10 dark:bg-zinc-800">
                        <div class="flex h-[90vh] flex-col">
                            <div class="mx-auto">
                                <a href="#" class="">
                                    <img src="assets/images/logo-sm.svg" alt="" class="h-6 inline"> 
                                    <span class="text-lg align-middle font-medium ltr:ml-2 rtl:mr-2 dark:text-white">ثبت نام سامانه گارانتی آک</span>
                                </a>
                            </div>
                            <div class="my-auto">
                                <div class="text-center">
                                    <h5 class="text-gray-600 text-sm dark:text-gray-100">فرم زیر را تکمیل کنید و ثبت نام را کلیک کنید</h5>
                                </div>

                                <form class="mt-3" action="<?php echo URLROOT . "/auth/register" ?>" method="POST">
                                    <div class="mb-2">
                                        <label class="text-gray-600 text-sm font-medium mb-1 block dark:text-gray-100">ایمیل</label>
                                        <input type="text" class="w-full border-gray-100 rounded placeholder:text-sm py-1.5 text-sm dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-gray-100 dark:placeholder:text-zinc-100/60" id="email" name="email" placeholder="ایمیل خود را وارد کنید" value="<?php echo $data["email"]; ?>">

                                    </div>
                                    <div class="text-danger">
                                        <?php if (!empty($data["email_err"])): ?>
                                            <?php echo htmlspecialchars($data["email_err"]); ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mb-2">
                                        <div>
                                            <div class="flex-grow-1">
                                                <label class="text-gray-600 text-sm font-medium mb-1 block dark:text-gray-100">رمز عبور</label>
                                            </div>
                                        </div>
                                        <div class="flex">
                                            <input type="password" class="w-full border-gray-100 rounded ltr:rounded-r-none rtl:rounded-l-none placeholder:text-sm py-1.5 text-sm dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-gray-100 dark:placeholder:text-zinc-100/60" placeholder="رمز عبور خود را وارد کنید" aria-label="رمز عبور" aria-describedby="password-addon" id="password" name="password" value="<?php echo $data["password"]; ?>">
                                            <button class="bg-gray-50 px-4 rounded ltr:rounded-l-none rtl:rounded-r-none border border-gray-100 ltr:border-l-0 rtl:border-r-0 dark:bg-zinc-700 dark:border-zinc-600 dark:text-gray-100" type="button" id="password-addon" onclick="togglePassword()"><i class="mdi mdi-eye-outline">
                                                </i></button>
                                        </div>
                                    </div>
                                    <div class="text-danger">
                                        <?php if (!empty($data["password_err"])): ?>
                                            <?php echo htmlspecialchars($data["password_err"]); ?>
                                        <?php endif; ?>
                                    </div>

                                    <div class="mb-2">
                                        <div>
                                            <div class="flex-grow-1">
                                                <label class="text-gray-600 text-sm font-medium mb-1 block dark:text-gray-100">نام و نام خانوادگی </label>
                                            </div>
                                        </div>
                                        <div class="flex">
                                            <input type="text" class="w-full border-gray-100 rounded ltr:rounded-r-none rtl:rounded-l-none placeholder:text-sm py-1.5 text-sm dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-gray-100 dark:placeholder:text-zinc-100/60" placeholder="نام و نام خانوادگی خود را وارد کنید" aria-label="نام و نام خانوادگی" aria-describedby="password-addon" id="name" name="name" value="<?php echo $data["name"]; ?>">
                                        </div>
                                    </div>
                                    <div class="text-danger">
                                        <?php if (!empty($data["name_err"])): ?>
                                            <?php echo htmlspecialchars($data["name_err"]); ?>
                                        <?php endif; ?>
                                    </div>


                                    <div class="mb-2">
                                        <label class="text-gray-600 text-sm font-medium mb-1 block dark:text-gray-100">کد ملی</label>
                                        <input type="text" class="w-full border-gray-100 rounded placeholder:text-sm py-1.5 text-sm dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-gray-100 dark:placeholder:text-zinc-100/60" id="codemelli" name="codemelli" placeholder="کد ملی خود را وارد کنید" value="<?php echo $data["codemelli"]; ?>">

                                    </div>
                                    <div class="text-danger">
                                        <?php if (!empty($data["codemelli_err"])): ?>
                                            <?php echo htmlspecialchars($data["codemelli_err"]); ?>
                                        <?php endif; ?>
                                    </div>

                                    <div class="mb-2">
                                        <div>
                                            <div class="flex-grow-1">
                                                <label class="text-gray-600 text-sm font-medium mb-1 block dark:text-gray-100"> شماره موبایل </label>
                                            </div>
                                        </div>
                                        <div class="flex">
                                            <input type="text" class="w-full border-gray-100 rounded ltr:rounded-r-none rtl:rounded-l-none placeholder:text-sm py-1.5 text-sm dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-gray-100 dark:placeholder:text-zinc-100/60" placeholder="شماره موبایل خود را وارد کنید" aria-label="شماره موبایل" aria-describedby="password-addon" id="mobile" name="mobile" value="<?php echo $data["mobile"]; ?>">
                                        </div>
                                    </div>
                                    <div class="text-danger">
                                        <?php if (!empty($data["mobile_err"])): ?>
                                            <?php echo htmlspecialchars($data["mobile_err"]); ?>
                                        <?php endif; ?>
                                    </div>

                                    <div class="mb-2">
                                        <div>
                                            <div class="flex-grow-1">
                                                <label class="text-gray-600 text-sm font-medium mb-1 block dark:text-gray-100">استان</label>
                                            </div>
                                        </div>
                                        <div class="flex">
                                            <select class="w-full px-3 py-2 bg-white border border-gray-100 text-sm rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-violet-500 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-gray-100" id="ostan" name="ostan">
                                                
                                                <option value="" class="py-2">استان خود را انتخاب کنید</option>
                                                <option value="آذربایجان شرقی" <?php echo ($data["ostan"] == "آذربایجان شرقی") ? 'selected' : ''; ?> class="py-2">آذربایجان شرقی</option>
                                                <option value="آذربایجان غربی" <?php echo ($data["ostan"] == "آذربایجان غربی") ? 'selected' : ''; ?> class="py-2">آذربایجان غربی</option>
                                                <option value="اردبیل" <?php echo ($data["ostan"] == "اردبیل") ? 'selected' : ''; ?> class="py-2">اردبیل</option>
                                                <option value="اصفهان" <?php echo ($data["ostan"] == "اصفهان") ? 'selected' : ''; ?> class="py-2">اصفهان</option>
                                                <option value="البرز" <?php echo ($data["ostan"] == "البرز") ? 'selected' : ''; ?> class="py-2">البرز</option>
                                                <option value="ایلام" <?php echo ($data["ostan"] == "ایلام") ? 'selected' : ''; ?> class="py-2">ایلام</option>
                                                <option value="بوشهر" <?php echo ($data["ostan"] == "بوشهر") ? 'selected' : ''; ?> class="py-2">بوشهر</option>
                                                <option value="تهران" <?php echo ($data["ostan"] == "تهران") ? 'selected' : ''; ?> class="py-2">تهران</option>
                                                <option value="چهارمحال و بختیاری" <?php echo ($data["ostan"] == "چهارمحال و بختیاری") ? 'selected' : ''; ?> class="py-2">چهارمحال و بختیاری</option>
                                                <option value="خراسان جنوبی" <?php echo ($data["ostan"] == "خراسان جنوبی") ? 'selected' : ''; ?> class="py-2">خراسان جنوبی</option>
                                                <option value="خراسان رضوی" <?php echo ($data["ostan"] == "خراسان رضوی") ? 'selected' : ''; ?> class="py-2">خراسان رضوی</option>
                                                <option value="خراسان شمالی" <?php echo ($data["ostan"] == "خراسان شمالی") ? 'selected' : ''; ?> class="py-2">خراسان شمالی</option>
                                                <option value="خوزستان" <?php echo ($data["ostan"] == "خوزستان") ? 'selected' : ''; ?> class="py-2">خوزستان</option>
                                                <option value="زنجان" <?php echo ($data["ostan"] == "زنجان") ? 'selected' : ''; ?> class="py-2">زنجان</option>
                                                <option value="سمنان" <?php echo ($data["ostan"] == "سمنان") ? 'selected' : ''; ?> class="py-2">سمنان</option>
                                                <option value="سیستان و بلوچستان" <?php echo ($data["ostan"] == "سیستان و بلوچستان") ? 'selected' : ''; ?> class="py-2">سیستان و بلوچستان</option>
                                                <option value="فارس" <?php echo ($data["ostan"] == "فارس") ? 'selected' : ''; ?> class="py-2">فارس</option>
                                                <option value="قزوین" <?php echo ($data["ostan"] == "قزوین") ? 'selected' : ''; ?> class="py-2">قزوین</option>
                                                <option value="قم" <?php echo ($data["ostan"] == "قم") ? 'selected' : ''; ?> class="py-2">قم</option>
                                                <option value="کردستان" <?php echo ($data["ostan"] == "کردستان") ? 'selected' : ''; ?> class="py-2">کردستان</option>
                                                <option value="کرمان" <?php echo ($data["ostan"] == "کرمان") ? 'selected' : ''; ?> class="py-2">کرمان</option>
                                                <option value="کرمانشاه" <?php echo ($data["ostan"] == "کرمانشاه") ? 'selected' : ''; ?> class="py-2">کرمانشاه</option>
                                                <option value="کهگیلویه و بویراحمد" <?php echo ($data["ostan"] == "کهگیلویه و بویراحمد") ? 'selected' : ''; ?> class="py-2">کهگیلویه و بویراحمد</option>
                                                <option value="گلستان" <?php echo ($data["ostan"] == "گلستان") ? 'selected' : ''; ?> class="py-2">گلستان</option>
                                                <option value="گیلان" <?php echo ($data["ostan"] == "گیلان") ? 'selected' : ''; ?> class="py-2">گیلان</option>
                                                <option value="لرستان" <?php echo ($data["ostan"] == "لرستان") ? 'selected' : ''; ?> class="py-2">لرستان</option>
                                                <option value="مازندران" <?php echo ($data["ostan"] == "مازندران") ? 'selected' : ''; ?> class="py-2">مازندران</option>
                                                <option value="مرکزی" <?php echo ($data["ostan"] == "مرکزی") ? 'selected' : ''; ?> class="py-2">مرکزی</option>
                                                <option value="هرمزگان" <?php echo ($data["ostan"] == "هرمزگان") ? 'selected' : ''; ?> class="py-2">هرمزگان</option>
                                                <option value="همدان" <?php echo ($data["ostan"] == "همدان") ? 'selected' : ''; ?> class="py-2">همدان</option>
                                                <option value="یزد" <?php echo ($data["ostan"] == "یزد") ? 'selected' : ''; ?> class="py-2">یزد</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="text-danger">
                                        <?php if (!empty($data["ostan_err"])): ?>
                                            <?php echo htmlspecialchars($data["ostan_err"]); ?>
                                        <?php endif; ?>
                                    </div>


                                    <div class="mb-2">
                                        <div>
                                            <div class="flex-grow-1">
                                                <label class="text-gray-600 text-sm font-medium mb-1 block dark:text-gray-100">شهر</label>
                                            </div>
                                        </div>
                                        <div class="flex">
                                            <select class="w-full px-3 py-2 bg-white border text-sm border-gray-100 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-violet-500 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-gray-100" id="shahr" name="shahr">
                                                <option value="">شهر خود را انتخاب کنید</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="text-danger">
                                        <?php if (!empty($data["shahr_err"])): ?>
                                            <?php echo htmlspecialchars($data["shahr_err"]); ?>
                                        <?php endif; ?>
                                    </div>


                                    <div class="mb-2">
                                        <div>
                                            <div class="flex-grow-1">
                                                <label class="text-gray-600 text-sm font-medium mb-1 block dark:text-gray-100"> آدرس </label>
                                            </div>
                                        </div>
                                        <div class="flex">
                                            <textarea
                                                class="w-full border-gray-100 rounded placeholder:text-sm py-1.5 text-sm dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-gray-100 dark:placeholder:text-zinc-100/60 min-h-[60px] resize-none"
                                                placeholder=" آدرس کامل خود را وارد کنید"
                                                aria-label="آدرس"
                                                id="address"
                                                name="address"><?php echo $data["address"]; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="text-danger">
                                        <?php if (!empty($data["address_err"])): ?>
                                            <?php echo htmlspecialchars($data["address_err"]); ?>
                                        <?php endif; ?>
                                    </div>


                                    <div class="mb-2">
                                        <div>
                                            <div class="flex-grow-1">
                                                <label class="text-gray-600 text-sm font-medium mb-1 block dark:text-gray-100"> شماره تلفن ثابت </label>
                                            </div>
                                        </div>
                                        <div class="flex">
                                            <input type="text" class="w-full border-gray-100 rounded ltr:rounded-r-none rtl:rounded-l-none placeholder:text-sm py-1.5 text-sm dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-gray-100 dark:placeholder:text-zinc-100/60" placeholder=" شماره تلفن ثابت  خود را وارد کنید" aria-label="شماره تلفن ثابت" aria-describedby="password-addon" id="phone" name="phone" value="<?php echo $data["phone"]; ?>">
                                        </div>
                                    </div>
                                    <div class="text-danger">
                                        <?php if (!empty($data["phone_err"])): ?>
                                            <?php echo htmlspecialchars($data["phone_err"]); ?>
                                        <?php endif; ?>
                                    </div>

                                    <div class="mb-2">
                                        <div>
                                            <div class="flex-grow-1">
                                                <label class="text-gray-600 text-sm font-medium mb-1 block dark:text-gray-100"> ساعت کاری </label>
                                            </div>
                                        </div>
                                        <div class="flex">
                                            <input type="text" class="w-full border-gray-100 rounded ltr:rounded-r-none rtl:rounded-l-none placeholder:text-sm py-1.5 text-sm dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-gray-100 dark:placeholder:text-zinc-100/60" placeholder=" ساعت کاری خود را وارد کنید" aria-label="شماره تلفن ثابت" aria-describedby="password-addon" id="hours" name="hours" value="<?php echo $data["hours"]; ?>">
                                        </div>
                                    </div>
                                    <div class="text-danger">
                                        <?php if (!empty($data["hours_err"])): ?>
                                            <?php echo htmlspecialchars($data["hours_err"]); ?>
                                        <?php endif; ?>
                                    </div>

                                    <div class="mb-2">
                                        <div>
                                            <div class="flex-grow-1">
                                                <label class="text-gray-600 text-sm font-medium mb-1 block dark:text-gray-100"> کد پستی </label>
                                            </div>
                                        </div>
                                        <div class="flex">
                                            <input type="text" class="w-full border-gray-100 rounded ltr:rounded-r-none rtl:rounded-l-none placeholder:text-sm py-1.5 text-sm dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-gray-100 dark:placeholder:text-zinc-100/60" placeholder=" کد پستی خود را وارد کنید" aria-label="کد پستی" aria-describedby="password-addon" id="codeposti" name="codeposti" value="<?php echo $data["codeposti"]; ?>">
                                        </div>
                                    </div>
                                    <div class="text-danger">
                                        <?php if (!empty($data["codeposti_err"])): ?>
                                            <?php echo htmlspecialchars($data["codeposti_err"]); ?>
                                        <?php endif; ?>
                                    </div>



                                    <div class="mb-3">
                                        <button class="btn border-transparent bg-violet-500 w-full py-2 text-sm text-white w-100 waves-effect waves-light shadow-md shadow-violet-200 dark:shadow-zinc-600" type="submit">ثبت نام</button>
                                    </div>
                                    <div class="mt-3text-center">
                                        <p class="text-gray-500 text-sm dark:text-zinc-100/60">حساب کاربری دارید؟ <a href="<?php echo URLROOT . "/auth/login" ?>" class="text-violet-500 font-semibold"> ورود </a> </p>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- <div class=" text-center">
                            <p class="text-gray-500 text-xs relative mb-3 dark:text-gray-100">© <script>
                                    document.write(new Date().getFullYear())
                                </script> AK WARRANTY . با احساس <i class="mdi mdi-heart text-red-400"></i> توسط YEGI ساخته شده است</p>
                        </div> -->

                    </div>
                </div>
                <div class="col-span-12 md:col-span-7 lg:col-span-8 xl:col-span-9">
                    <div class="h-screen bg-cover relative p-5" style="background-image: url('<?php echo URLROOT . "/assets/images/AK-Brand-Guide-47.jpg" ?>');">
                        <div class="absolute inset-0 bg-violet-500/90"></div>


                        <ul class="bg-bubbles absolute top-0 left-0 w-full h-full overflow-hidden animate-square">
                            <li class="h-10 w-10 rounded-3xl bg-white/10 absolute left-[10%] "></li>
                            <li class="h-28 w-28 rounded-3xl bg-white/10 absolute left-[20%]"></li>
                            <li class="h-10 w-10 rounded-3xl bg-white/10 absolute left-[25%]"></li>
                            <li class="h-20 w-20 rounded-3xl bg-white/10 absolute left-[40%]"></li>
                            <li class="h-24 w-24 rounded-3xl bg-white/10 absolute left-[70%]"></li>
                            <li class="h-32 w-32 rounded-3xl bg-white/10 absolute left-[70%]"></li>
                            <li class="h-36 w-36 rounded-3xl bg-white/10 absolute left-[32%]"></li>
                            <li class="h-20 w-20 rounded-3xl bg-white/10 absolute left-[55%]"></li>
                            <li class="h-12 w-12 rounded-3xl bg-white/10 absolute left-[25%]"></li>
                            <li class="h-36 w-36 rounded-3xl bg-white/10 absolute left-[90%]"></li>
                        </ul>
                    </div>
                </div>

                <script src="<?php echo URLROOT . "/assets/libs/%40popperjs/core/umd/popper.min.js" ?>"></script>
                <script src="<?php echo URLROOT . "/assets/libs/feather-icons/feather.min.js" ?>"></script>
                <script src="<?php echo URLROOT . "/assets/libs/metismenujs/metismenujs.min.js" ?>"></script>
                <script src="<?php echo URLROOT . "/assets/libs/simplebar/simplebar.min.js" ?>"></script>
                <script src="<?php echo URLROOT . "/assets/libs/feather-icons/feather.min.js" ?>"></script>

                <script src="<?php echo URLROOT . "/assets/libs/swiper/swiper-bundle.min.js" ?>"></script>

                <script src="<?php echo URLROOT . "/assets/js/pages/login.init.js" ?> "></script>

                <script src="<?php echo URLROOT . "/assets/js/app.js" ?> "></script>
            </div>


            <!-- Add this JavaScript code before closing body tag -->
            <script>
                const cities = {
                    'تهران': ['تهران', 'شهریار', 'ورامین', 'اسلامشهر', 'پردیس', 'دماوند', 'ملارد', 'ری', 'باقرشهر', 'قرچک', 'رباط‌کریم'],
                    'اصفهان': ['اصفهان', 'کاشان', 'نجف‌آباد', 'خمینی‌شهر', 'شاهین‌شهر', 'فولادشهر', 'گلپایگان', 'آران و بیدگل', 'نطنز'],
                    'خراسان رضوی': ['مشهد', 'نیشابور', 'سبزوار', 'تربت حیدریه', 'کاشمر', 'فریمان', 'قوچان', 'چناران', 'طرقبه'],
                    'آذربایجان شرقی': ['تبریز', 'مراغه', 'میانه', 'مرند', 'شبستر', 'اهر', 'بستان‌آباد', 'اسکو', 'هریس'],
                    'آذربایجان غربی': ['ارومیه', 'خوی', 'مهاباد', 'میاندوآب', 'بوکان', 'سردشت', 'پیرانشهر', 'سلماس', 'شاهین‌دژ'],
                    'اردبیل': ['اردبیل', 'خلخال', 'مشگین‌شهر', 'پارس‌آباد', 'نمین', 'نیر', 'بیله‌سوار', 'گرمی'],
                    'البرز': ['کرج', 'فردیس', 'نظرآباد', 'اشتهارد', 'هشتگرد', 'محمدشهر', 'ماهدشت'],
                    'بوشهر': ['بوشهر', 'برازجان', 'گناوه', 'دشتستان', 'کنگان', 'عسلویه', 'جم', 'خورموج'],
                    'چهارمحال و بختیاری': ['شهرکرد', 'بروجن', 'لردگان', 'فرخ‌شهر', 'فارسان', 'سامان'],
                    'خراسان جنوبی': ['بیرجند', 'قاین', 'فردوس', 'طبس', 'نهبندان', 'سربیشه'],
                    'خراسان شمالی': ['بجنورد', 'شیروان', 'اسفراین', 'آشخانه', 'فاروج'],
                    'خوزستان': ['اهواز', 'آبادان', 'خرمشهر', 'دزفول', 'ماهشهر', 'شادگان', 'ایذه', 'بهبهان', 'شوش'],
                    'زنجان': ['زنجان', 'ابهر', 'خدابنده', 'خرمدره', 'ماه‌نشان', 'سلطانیه'],
                    'سمنان': ['سمنان', 'شاهرود', 'دامغان', 'گرمسار', 'مهدی‌شهر', 'سرخه'],
                    'سیستان و بلوچستان': ['زاهدان', 'چابهار', 'ایرانشهر', 'سراوان', 'خاش', 'کنارک', 'نیک‌شهر', 'زابل'],
                    'فارس': ['شیراز', 'مرودشت', 'کازرون', 'جهرم', 'فسا', 'داراب', 'نی‌ریز', 'لار', 'آباده'],
                    'قزوین': ['قزوین', 'تاکستان', 'آبیک', 'بوئین زهرا', 'الوند'],
                    'قم': ['قم'],
                    'کردستان': ['سنندج', 'سقز', 'بانه', 'مریوان', 'دیواندره', 'بیجار'],
                    'کرمان': ['کرمان', 'رفسنجان', 'جیرفت', 'بم', 'زرند', 'سیرجان', 'کهنوج'],
                    'کرمانشاه': ['کرمانشاه', 'اسلام‌آباد غرب', 'کنگاور', 'سرپل ذهاب', 'پاوه', 'هرسین'],
                    'کهگیلویه و بویراحمد': ['یاسوج', 'دوگنبدان (گچساران)', 'دهدشت', 'سی‌سخت', 'لیکک'],
                    'گلستان': ['گرگان', 'گنبد کاووس', 'علی‌آباد کتول', 'آق‌قلا', 'مینودشت', 'آزادشهر'],
                    'گیلان': ['رشت', 'انزلی', 'لاهیجان', 'رودبار', 'آستارا', 'لنگرود', 'تالش'],
                    'لرستان': ['خرم‌آباد', 'بروجرد', 'دورود', 'الیگودرز', 'نورآباد', 'ازنا', 'الشتر'],
                    'مازندران': ['ساری', 'بابل', 'آمل', 'قائم‌شهر', 'بابلسر', 'تنکابن', 'رامسر', 'نوشهر'],
                    'مرکزی': ['اراک', 'ساوه', 'خمین', 'دلیجان', 'محلات', 'تفرش', 'شازند'],
                    'هرمزگان': ['بندرعباس', 'قشم', 'بندر لنگه', 'میناب', 'بستک', 'رودان'],
                    'همدان': ['همدان', 'ملایر', 'نهاوند', 'اسدآباد', 'رزن', 'کبودرآهنگ'],
                    'یزد': ['یزد', 'میبد', 'اردکان', 'بافق', 'مهریز', 'ابرکوه']
                };


                const ostanSelect = document.getElementById('ostan');
                const shahrSelect = document.getElementById('shahr');

                ostanSelect.addEventListener('change', function() {
                    const selectedOstan = this.value;
                    shahrSelect.innerHTML = '<option value="">شهر خود را انتخاب کنید</option>';

                    if (selectedOstan && cities[selectedOstan]) {
                        cities[selectedOstan].forEach(city => {
                            const option = document.createElement('option');
                            option.value = city;
                            option.textContent = city;
                            if (city === '<?php echo $data["shahr"]; ?>') {
                                option.selected = true;
                            }
                            shahrSelect.appendChild(option);
                        });
                    }
                });

                // Trigger change event on page load if ostan is already selected
                if (ostanSelect.value) {
                    ostanSelect.dispatchEvent(new Event('change'));
                }
            </script>
            <script>
                function togglePassword() {
                    var passwordInput = document.getElementById('password');
                    var icon = document.querySelector('#password-addon i');

                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        icon.classList.remove('mdi-eye-outline');
                        icon.classList.add('mdi-eye-off-outline');
                        icon.title = "پنهان کردن رمز";
                    } else {
                        passwordInput.type = 'password';
                        icon.classList.remove('mdi-eye-off-outline');
                        icon.classList.add('mdi-eye-outline');
                        icon.title = "نمایش رمز";
                    }
                }
            </script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.querySelector('form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // نمایش loading
    Swal.fire({
        title: 'لطفاً صبر کنید...',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });
    
    fetch(this.action, {
        method: 'POST',
        body: new FormData(this)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                title: 'موفقیت‌آمیز!',
                text: 'ثبت نام شما با موفقیت انجام شد',
                icon: 'success',
                confirmButtonText: 'تایید',
                customClass: {
                    popup: 'rtl-alert',
                    confirmButton: 'btn border-transparent bg-violet-500 text-white'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '<?php echo URLROOT . "/auth/login" ?>';
                }
            });
        } else {
            // نمایش پیام خطای دقیق
            let errorMessage = data.message || 'مشکلی در ثبت نام رخ داده است';
            if (data.errors) {
                errorMessage += '<br><ul class="mt-2 text-right">';
                Object.values(data.errors).forEach(error => {
                    if (error) {
                        errorMessage += `<li class="text-sm">${error}</li>`;
                    }
                });
                errorMessage += '</ul>';
            }
            
            Swal.fire({
                title: 'خطا!',
                html: errorMessage,
                icon: 'error',
                confirmButtonText: 'تلاش مجدد',
                customClass: {
                    popup: 'rtl-alert',
                    confirmButton: 'btn border-transparent bg-violet-500 text-white'
                }
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            title: 'خطا!',
            text: 'مشکلی در ارتباط با سرور رخ داده است',
            icon: 'error',
            confirmButtonText: 'تلاش مجدد',
            customClass: {
                popup: 'rtl-alert',
                confirmButton: 'btn border-transparent bg-violet-500 text-white'
            }
        });
    });
});

// اضافه کردن استایل برای RTL
const style = document.createElement('style');
style.textContent = `
    .rtl-alert {
        direction: rtl;
        font-family: inherit;
    }
`;
document.head.appendChild(style);
</script>

</body>

</html>