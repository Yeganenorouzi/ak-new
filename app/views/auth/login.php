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


</head>

<body data-mode="light" data-sidebar-size="lg">
    <div class="container-fluid">
        <div class="h-screen md:overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-12">
                <div class="col-span-12 md:col-span-5 lg:col-span-4 xl:col-span-3 relative z-50">
                    <div class="w-full bg-white xl:p-12 p-10 dark:bg-zinc-800">
                        <div class="flex h-[90vh] flex-col">
                            <div class="mx-auto text-center">
                                <a href="index-2.html" class="flex flex-col items-center">
                                    <img src="<?php echo URLROOT . "/assets/images/Logo 400.png" ?>" alt="" class="h-16 inline mb-5">
                                    <span class="text-xl align-middle font-medium ltr:ml-2 rtl:mr-2 dark:text-white">ورود سامانه گارانتی آک</span>
                                </a>
                            </div>

                            <div class="my-auto">
                                <div class="text-center">
                                    <h5 class="text-gray-600 dark:text-gray-100">فرم زیر را تکمیل کنید و ورود را کلیک کنید</h5>
                                </div>

                                <form class="mt-6 pt-2" action="<?php echo URLROOT . "/auth/login" ?>" method="post">

                                    <div class="mb-4">
                                        <label class="text-gray-600 font-medium mb-2 block dark:text-gray-100">کد ملی</label>
                                        <input type="text" class="w-full border-gray-100 rounded placeholder:text-sm py-2 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-gray-100 dark:placeholder:text-zinc-100/60" id="codemelli" name="codemelli" placeholder="کد ملی خود را وارد کنید" value="<?php echo $data["codemelli"]; ?>" required>
                                    </div>
                                    <div class="text-danger">
                                        <?php if (!empty($data["codemelli_err"])): ?>
                                            <?php echo htmlspecialchars($data["codemelli_err"]); ?>
                                        <?php endif; ?>
                                    </div>

                                    <div class="mb-3">
                                        <div>
                                            <div class="flex-grow-1">
                                                <label class="text-gray-600 font-medium mb-2 block dark:text-gray-100">رمز عبور</label>
                                            </div>
                                        </div>
                                        <div class="flex">
                                            <input type="password" class="w-full border-gray-100 rounded ltr:rounded-r-none rtl:rounded-l-none placeholder:text-sm py-2 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-gray-100 dark:placeholder:text-zinc-100/60" placeholder="رمز عبور خود را وارد کنید" aria-label="رمز عبور" aria-describedby="password-addon" id="password" name="password" value="<?php echo $data["password"]; ?>" required>

                                            <button class="bg-gray-50 px-4 rounded ltr:rounded-l-none rtl:rounded-r-none border border-gray-100 ltr:border-l-0 rtl:border-r-0 dark:bg-zinc-700 dark:border-zinc-600 dark:text-gray-100" type="button" id="password-addon" onclick="togglePassword()"><i class="mdi mdi-eye-outline">
                                                </i></button>
                                        </div>
                                    </div>
                                    <div class="text-danger">
                                        <?php if (!empty($data["password_err"])): ?>
                                            <?php echo htmlspecialchars($data["password_err"]); ?>
                                        <?php endif; ?>
                                    </div>

                                    <div class="mb-3">
                                        <button class="btn border-transparent bg-violet-500 w-full py-2.5 text-white w-100 waves-effect waves-light shadow-md shadow-violet-200 dark:shadow-zinc-600" type="submit">ورود </button>
                                    </div>
                                    <div class="mt-12 text-center">
                                        <p class="text-gray-500 dark:text-zinc-100/60">حساب کاربری ندارید؟ <a href="<?php echo URLROOT . "/auth/register" ?>" class="text-violet-500 font-semibold"> ثبت نام </a> </p>
                                    </div>
                                </form>

                            </div>
                        </div>
                        <div class=" text-center">
                            <p class="text-gray-500 relative mb-5 dark:text-gray-100">© <script>
                                    document.write(new Date().getFullYear())
                                </script> AK WARRANTY . با احساس <i class="mdi mdi-heart text-red-400"></i> توسط YEGI ساخته شده است</p>
                        </div>
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

            </div>
        </div>
</body>

</html>