<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="utf-8" />
    <title>ثبت نام | سیستم گارانتی آک</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta content="سیستم مدیریت گارانتی آک" name="description" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo URLROOT . "/assets/images/favicon.ico" ?>" />
    <link rel="stylesheet" href="<?php echo URLROOT . "/assets/libs/swiper/swiper-bundle.min.css" ?>">
    <link rel="stylesheet" href="<?php echo URLROOT . "/assets/css/icons.css" ?>" />
    <link rel="stylesheet" href="<?php echo URLROOT . "/assets/css/tailwind.css" ?>" />
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

    <style>
        .loading {
            pointer-events: none;
            opacity: 0.7;
        }

        .spinner {
            border: 2px solid #f3f3f3;
            border-top: 2px solid #6366f1;
            border-radius: 50%;
            width: 16px;
            height: 16px;
            animation: spin 1s linear infinite;
            display: inline-block;
            margin-left: 8px;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .input-group {
            position: relative;
            margin-bottom: 1rem;
        }

        .input-group .form-control {
            transition: all 0.3s ease;
        }

        .input-group .form-control:focus {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(99, 102, 241, 0.15);
        }

        .rtl-alert {
            direction: rtl;
            font-family: inherit;
        }

        .form-step {
            display: none;
        }

        .form-step.active {
            display: block;
        }

        .step-indicator {
            display: flex;
            justify-content: center;
            margin-bottom: 2rem;
        }

        .step {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 8px;
            font-size: 12px;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .step.active {
            background: #6366f1;
            color: white;
        }

        .step.completed {
            background: #10b981;
            color: white;
        }

        .step-line {
            width: 50px;
            height: 2px;
            background: #e5e7eb;
            margin-top: 14px;
            transition: all 0.3s ease;
        }

        .step-line.completed {
            background: #10b981;
        }

        .password-strength {
            height: 4px;
            background: #e5e7eb;
            border-radius: 2px;
            margin-top: 5px;
            overflow: hidden;
        }

        .password-strength-bar {
            height: 100%;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .strength-weak {
            background: #ef4444;
            width: 25%;
        }

        .strength-fair {
            background: #f59e0b;
            width: 50%;
        }

        .strength-good {
            background: #3b82f6;
            width: 75%;
        }

        .strength-strong {
            background: #10b981;
            width: 100%;
        }

        /* Modern Left Side Styling */
        .register-container {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
            overflow: hidden;
        }

        .register-form-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
            border: 1px solid rgba(255, 255, 255, 0.18);
            margin: 15px;
            padding: 1.5rem;
            max-height: calc(100vh - 30px);
            overflow-y: auto;
        }

        .floating-elements {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .floating-elements::before,
        .floating-elements::after {
            content: '';
            position: absolute;
            border-radius: 50%;
        }

        .floating-elements::before {
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            top: -100px;
            right: -100px;
            animation: float 6s ease-in-out infinite;
        }

        .floating-elements::after {
            width: 150px;
            height: 150px;
            background: rgba(255, 255, 255, 0.08);
            bottom: -75px;
            left: -75px;
            animation: float 8s ease-in-out infinite reverse;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(180deg);
            }
        }

        .logo-container {
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .welcome-badge {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 500;
            display: inline-block;
            margin-bottom: 1rem;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .register-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
        }

        .register-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        }

        .step-indicator {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }

        .step-title-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .compact-input {
            padding: 0.6rem 0.8rem;
            font-size: 0.875rem;
        }

        .compact-label {
            font-size: 0.8rem;
            margin-bottom: 0.3rem;
        }

        .compact-input-group {
            margin-bottom: 0.8rem;
        }

        .text-shadow {
            text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        /* Improved backdrop blur support */
        @supports (backdrop-filter: blur(20px)) {
            .backdrop-blur-md {
                backdrop-filter: blur(20px);
            }

            .backdrop-blur-sm {
                backdrop-filter: blur(10px);
            }
        }

        /* Slow spin animation for geometric shapes */
        @keyframes spin-slow {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .animate-spin-slow {
            animation: spin-slow 20s linear infinite;
        }

        /* Better background image fit */
        .bg-image-container {
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        @media (max-width: 768px) {
            .bg-image-container {
                background-attachment: scroll;
            }
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            margin-top: 2rem;
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            padding: 1rem;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .feature-icon {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
            color: rgba(255, 255, 255, 0.9);
        }

        .feature-card p {
            color: rgba(255, 255, 255, 0.9);
            font-weight: 600;
            font-size: 0.875rem;
        }

        .stats-container {
            position: absolute;
            bottom: 2rem;
            right: 2rem;
            left: 2rem;
        }
    </style>
</head>

<body data-mode="light" data-sidebar-size="lg">
    <div class="container-fluid">
        <div class="h-screen md:overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-12">
                <div class="col-span-12 md:col-span-5 lg:col-span-4 xl:col-span-3 relative z-50">
                    <div class="register-container h-screen flex items-center justify-center">
                        <div class="floating-elements"></div>

                        <div class="register-form-container w-full max-w-md relative z-10">
                            <!-- Header -->
                            <div class="text-center mb-4">
                                <div class="welcome-badge">
                                    <i class="mdi mdi-account-plus ml-1"></i>
                                    عضویت در سامانه آک
                                </div>
                                <div class="mx-auto">
                                    <img src="<?php echo URLROOT . "/assets/images/Logo 400.png" ?>" alt="لوگو"
                                        class="h-12 mx-auto mb-3">
                                    <h1 class="text-xl font-bold text-gray-800 logo-container">
                                        ثبت نام در سامانه آک
                                    </h1>
                                </div>
                            </div>

                            <!-- Step Indicator -->
                            <div class="step-indicator">
                                <div class="flex justify-center items-center">
                                    <div class="step active" id="step-1">1</div>
                                    <div class="step-line" id="line-1"></div>
                                    <div class="step" id="step-2">2</div>
                                    <div class="step-line" id="line-2"></div>
                                    <div class="step" id="step-3">3</div>
                                </div>
                            </div>

                            <!-- Step Title -->
                            <div class="step-title-container">
                                <h5 class="text-white text-sm font-medium" id="step-title">اطلاعات کاربری</h5>
                                <p class="text-xs text-white/80 mt-1" id="step-desc">لطفاً اطلاعات حساب کاربری خود را
                                    وارد کنید</p>
                            </div>

                            <!-- Form -->
                            <form id="registerForm" action="<?php echo URLROOT . "/auth/register" ?>" method="POST">
                                <input type="hidden" name="csrf_token" value="<?php echo $data['csrf_token']; ?>">

                                <!-- Step 1: Account Info -->
                                <div class="form-step active" id="form-step-1">
                                    <div class="compact-input-group">
                                        <label class="text-gray-700 text-sm font-medium compact-label block">
                                            <i class="mdi mdi-email-outline ml-2 text-violet-500"></i>ایمیل
                                        </label>
                                        <input type="email"
                                            class="form-control w-full border-2 border-gray-200 rounded-xl placeholder:text-sm compact-input transition-all duration-300 focus:border-violet-500"
                                            id="email" name="email" placeholder="ایمیل خود را وارد کنید"
                                            value="<?php echo $data["email"]; ?>">
                                        <div class="error-message text-red-500 text-xs mt-1" id="email-error"></div>
                                    </div>

                                    <div class="compact-input-group">
                                        <label class="text-gray-700 text-sm font-medium compact-label block">
                                            <i class="mdi mdi-lock-outline ml-2 text-violet-500"></i>رمز عبور
                                        </label>
                                        <div class="relative">
                                            <input type="password"
                                                class="form-control w-full border-2 border-gray-200 rounded-xl placeholder:text-sm compact-input pr-10 transition-all duration-300 focus:border-violet-500"
                                                id="password" name="password" placeholder="رمز عبور قوی انتخاب کنید">
                                            <button type="button"
                                                class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600"
                                                onclick="togglePassword('password')">
                                                <i class="mdi mdi-eye-outline"></i>
                                            </button>
                                        </div>
                                        <div class="password-strength">
                                            <div class="password-strength-bar" id="password-strength-bar"></div>
                                        </div>
                                        <div class="error-message text-red-500 text-xs mt-1" id="password-error"></div>
                                    </div>

                                    <div class="compact-input-group">
                                        <label class="text-gray-700 text-sm font-medium compact-label block">
                                            <i class="mdi mdi-lock-check-outline ml-2 text-violet-500"></i>تایید رمز
                                            عبور
                                        </label>
                                        <div class="relative">
                                            <input type="password"
                                                class="form-control w-full border-2 border-gray-200 rounded-xl placeholder:text-sm compact-input pr-10 transition-all duration-300 focus:border-violet-500"
                                                id="confirm_password" name="confirm_password"
                                                placeholder="رمز عبور را مجدداً وارد کنید">
                                            <button type="button"
                                                class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600"
                                                onclick="togglePassword('confirm_password')">
                                                <i class="mdi mdi-eye-outline"></i>
                                            </button>
                                        </div>
                                        <div class="error-message text-red-500 text-xs mt-1"
                                            id="confirm_password-error"></div>
                                    </div>
                                </div>

                                <!-- Step 2: Personal Info -->
                                <div class="form-step" id="form-step-2">
                                    <div class="input-group">
                                        <label class="text-gray-600 text-sm font-medium mb-1 block dark:text-gray-100">
                                            <i class="mdi mdi-account-outline ml-2"></i>نام و نام خانوادگی
                                        </label>
                                        <input type="text"
                                            class="form-control w-full border-gray-100 rounded placeholder:text-sm py-2.5 text-sm dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-gray-100"
                                            id="name" name="name" placeholder="نام و نام خانوادگی خود را وارد کنید"
                                            value="<?php echo $data["name"]; ?>">
                                        <div class="error-message text-red-500 text-xs mt-1" id="name-error"></div>
                                    </div>

                                    <div class="input-group">
                                        <label class="text-gray-600 text-sm font-medium mb-1 block dark:text-gray-100">
                                            <i class="mdi mdi-card-account-details-outline ml-2"></i>کد ملی
                                        </label>
                                        <input type="text"
                                            class="form-control w-full border-gray-100 rounded placeholder:text-sm py-2.5 text-sm dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-gray-100"
                                            id="codemelli" name="codemelli"
                                            placeholder="کد ملی ۱۰ رقمی خود را وارد کنید"
                                            value="<?php echo $data["codemelli"]; ?>" maxlength="10">
                                        <div class="error-message text-red-500 text-xs mt-1" id="codemelli-error"></div>
                                    </div>

                                    <div class="input-group">
                                        <label class="text-gray-600 text-sm font-medium mb-1 block dark:text-gray-100">
                                            <i class="mdi mdi-cellphone ml-2"></i>شماره موبایل
                                        </label>
                                        <input type="text"
                                            class="form-control w-full border-gray-100 rounded placeholder:text-sm py-2.5 text-sm dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-gray-100"
                                            id="mobile" name="mobile" placeholder="شماره موبایل خود را وارد کنید"
                                            value="<?php echo $data["mobile"]; ?>" maxlength="11">
                                        <div class="error-message text-red-500 text-xs mt-1" id="mobile-error"></div>
                                    </div>

                                    <div class="input-group">
                                        <label class="text-gray-600 text-sm font-medium mb-1 block dark:text-gray-100">
                                            <i class="mdi mdi-phone ml-2"></i>شماره تلفن ثابت
                                        </label>
                                        <input type="text"
                                            class="form-control w-full border-gray-100 rounded placeholder:text-sm py-2.5 text-sm dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-gray-100"
                                            id="phone" name="phone" placeholder="شماره تلفن ثابت خود را وارد کنید"
                                            value="<?php echo $data["phone"]; ?>">
                                        <div class="error-message text-red-500 text-xs mt-1" id="phone-error"></div>
                                    </div>
                                </div>

                                <!-- Step 3: Address Info -->
                                <div class="form-step" id="form-step-3">
                                    <div class="grid grid-cols-2 gap-3">
                                        <div class="input-group">
                                            <label
                                                class="text-gray-600 text-sm font-medium mb-1 block dark:text-gray-100">
                                                <i class="mdi mdi-map-marker-outline ml-2"></i>استان
                                            </label>
                                            <select
                                                class="form-control w-full px-3 py-2.5 bg-white border border-gray-100 text-sm rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-violet-500 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-gray-100"
                                                id="ostan" name="ostan">
                                                <option value="">انتخاب استان</option>
                                                <option value="آذربایجان شرقی" <?php echo ($data["ostan"] == "آذربایجان شرقی") ? 'selected' : ''; ?>>آذربایجان شرقی</option>
                                                <option value="آذربایجان غربی" <?php echo ($data["ostan"] == "آذربایجان غربی") ? 'selected' : ''; ?>>آذربایجان غربی</option>
                                                <option value="اردبیل" <?php echo ($data["ostan"] == "اردبیل") ? 'selected' : ''; ?>>اردبیل</option>
                                                <option value="اصفهان" <?php echo ($data["ostan"] == "اصفهان") ? 'selected' : ''; ?>>اصفهان</option>
                                                <option value="البرز" <?php echo ($data["ostan"] == "البرز") ? 'selected' : ''; ?>>البرز</option>
                                                <option value="ایلام" <?php echo ($data["ostan"] == "ایلام") ? 'selected' : ''; ?>>ایلام</option>
                                                <option value="بوشهر" <?php echo ($data["ostan"] == "بوشهر") ? 'selected' : ''; ?>>بوشهر</option>
                                                <option value="تهران" <?php echo ($data["ostan"] == "تهران") ? 'selected' : ''; ?>>تهران</option>
                                                <option value="چهارمحال و بختیاری" <?php echo ($data["ostan"] == "چهارمحال و بختیاری") ? 'selected' : ''; ?>>چهارمحال و بختیاری</option>
                                                <option value="خراسان جنوبی" <?php echo ($data["ostan"] == "خراسان جنوبی") ? 'selected' : ''; ?>>خراسان جنوبی</option>
                                                <option value="خراسان رضوی" <?php echo ($data["ostan"] == "خراسان رضوی") ? 'selected' : ''; ?>>خراسان رضوی</option>
                                                <option value="خراسان شمالی" <?php echo ($data["ostan"] == "خراسان شمالی") ? 'selected' : ''; ?>>خراسان شمالی</option>
                                                <option value="خوزستان" <?php echo ($data["ostan"] == "خوزستان") ? 'selected' : ''; ?>>خوزستان</option>
                                                <option value="زنجان" <?php echo ($data["ostan"] == "زنجان") ? 'selected' : ''; ?>>زنجان</option>
                                                <option value="سمنان" <?php echo ($data["ostan"] == "سمنان") ? 'selected' : ''; ?>>سمنان</option>
                                                <option value="سیستان و بلوچستان" <?php echo ($data["ostan"] == "سیستان و بلوچستان") ? 'selected' : ''; ?>>سیستان و بلوچستان</option>
                                                <option value="فارس" <?php echo ($data["ostan"] == "فارس") ? 'selected' : ''; ?>>فارس</option>
                                                <option value="قزوین" <?php echo ($data["ostan"] == "قزوین") ? 'selected' : ''; ?>>قزوین</option>
                                                <option value="قم" <?php echo ($data["ostan"] == "قم") ? 'selected' : ''; ?>>قم</option>
                                                <option value="کردستان" <?php echo ($data["ostan"] == "کردستان") ? 'selected' : ''; ?>>کردستان</option>
                                                <option value="کرمان" <?php echo ($data["ostan"] == "کرمان") ? 'selected' : ''; ?>>کرمان</option>
                                                <option value="کرمانشاه" <?php echo ($data["ostan"] == "کرمانشاه") ? 'selected' : ''; ?>>کرمانشاه</option>
                                                <option value="کهگیلویه و بویراحمد" <?php echo ($data["ostan"] == "کهگیلویه و بویراحمد") ? 'selected' : ''; ?>>
                                                    کهگیلویه و بویراحمد</option>
                                                <option value="گلستان" <?php echo ($data["ostan"] == "گلستان") ? 'selected' : ''; ?>>گلستان</option>
                                                <option value="گیلان" <?php echo ($data["ostan"] == "گیلان") ? 'selected' : ''; ?>>گیلان</option>
                                                <option value="لرستان" <?php echo ($data["ostan"] == "لرستان") ? 'selected' : ''; ?>>لرستان</option>
                                                <option value="مازندران" <?php echo ($data["ostan"] == "مازندران") ? 'selected' : ''; ?>>مازندران</option>
                                                <option value="مرکزی" <?php echo ($data["ostan"] == "مرکزی") ? 'selected' : ''; ?>>مرکزی</option>
                                                <option value="هرمزگان" <?php echo ($data["ostan"] == "هرمزگان") ? 'selected' : ''; ?>>هرمزگان</option>
                                                <option value="همدان" <?php echo ($data["ostan"] == "همدان") ? 'selected' : ''; ?>>همدان</option>
                                                <option value="یزد" <?php echo ($data["ostan"] == "یزد") ? 'selected' : ''; ?>>یزد</option>
                                            </select>
                                            <div class="error-message text-red-500 text-xs mt-1" id="ostan-error"></div>
                                        </div>

                                        <div class="input-group">
                                            <label
                                                class="text-gray-600 text-sm font-medium mb-1 block dark:text-gray-100">
                                                <i class="mdi mdi-home-city-outline ml-2"></i>شهر
                                            </label>
                                            <select
                                                class="form-control w-full px-3 py-2.5 bg-white border border-gray-100 text-sm rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-violet-500 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-gray-100"
                                                id="shahr" name="shahr">
                                                <option value="">انتخاب شهر</option>
                                            </select>
                                            <div class="error-message text-red-500 text-xs mt-1" id="shahr-error"></div>
                                        </div>
                                    </div>

                                    <div class="input-group">
                                        <label class="text-gray-600 text-sm font-medium mb-1 block dark:text-gray-100">
                                            <i class="mdi mdi-home-outline ml-2"></i>آدرس کامل
                                        </label>
                                        <textarea
                                            class="form-control w-full border-gray-100 rounded placeholder:text-sm py-2.5 text-sm dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-gray-100 min-h-[60px] resize-none"
                                            id="address" name="address"
                                            placeholder="آدرس کامل خود را وارد کنید"><?php echo $data["address"]; ?></textarea>
                                        <div class="error-message text-red-500 text-xs mt-1" id="address-error"></div>
                                    </div>

                                    <div class="grid grid-cols-2 gap-3">
                                        <div class="input-group">
                                            <label
                                                class="text-gray-600 text-sm font-medium mb-1 block dark:text-gray-100">
                                                <i class="mdi mdi-mailbox-outline ml-2"></i>کد پستی
                                            </label>
                                            <input type="text"
                                                class="form-control w-full border-gray-100 rounded placeholder:text-sm py-2.5 text-sm dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-gray-100"
                                                id="codeposti" name="codeposti" placeholder="کد پستی ۱۰ رقمی"
                                                value="<?php echo $data["codeposti"]; ?>" maxlength="10">
                                            <div class="error-message text-red-500 text-xs mt-1" id="codeposti-error">
                                            </div>
                                        </div>

                                        <div class="input-group">
                                            <label
                                                class="text-gray-600 text-sm font-medium mb-1 block dark:text-gray-100">
                                                <i class="mdi mdi-clock-outline ml-2"></i>ساعت کاری
                                            </label>
                                            <input type="text"
                                                class="form-control w-full border-gray-100 rounded placeholder:text-sm py-2.5 text-sm dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-gray-100"
                                                id="hours" name="hours" placeholder="مثال: 8 تا 17"
                                                value="<?php echo $data["hours"]; ?>">
                                            <div class="error-message text-red-500 text-xs mt-1" id="hours-error"></div>
                                        </div>
                                    </div>

                                    <div class="input-group">
                                        <div class="flex items-center">
                                            <input type="checkbox" id="terms" name="terms"
                                                class="h-4 w-4 text-violet-500 border-gray-300 rounded focus:ring-violet-500">
                                            <label for="terms" class="mr-2 text-sm text-gray-600 dark:text-gray-100">
                                                قوانین و مقررات را مطالعه کرده و <a href="#"
                                                    class="text-violet-500 hover:text-violet-600">موافقم</a>
                                            </label>
                                        </div>
                                        <div class="error-message text-red-500 text-xs mt-1" id="terms-error"></div>
                                    </div>
                                    <div class="error-message text-red-500 text-xs mt-1" id="terms-error"></div>
                                </div>

                                <!-- Navigation Buttons -->
                                <div class="flex justify-between mt-6">
                                    <button type="button" id="prevBtn"
                                        class="btn bg-gray-200 text-gray-700 py-2 px-4 rounded-xl hover:bg-gray-300 transition-all duration-300"
                                        style="display: none;">
                                        <i class="mdi mdi-arrow-right ml-2"></i>قبلی
                                    </button>
                                    <button type="button" id="nextBtn"
                                        class="register-btn text-white py-2 px-6 rounded-xl font-medium transition-all duration-300">
                                        بعدی<i class="mdi mdi-arrow-left mr-2"></i>
                                    </button>
                                    <button type="submit" id="submitBtn"
                                        class="register-btn text-white py-2 px-6 rounded-xl font-medium transition-all duration-300"
                                        style="display: none;">
                                        <span id="submitBtnText">ثبت نام</span>
                                        <span id="submitBtnSpinner" class="spinner hidden"></span>
                                    </button>
                                </div>

                                <div class="mt-4 text-center">
                                    <p class="text-gray-600 text-sm">
                                        حساب کاربری دارید؟
                                        <a href="<?php echo URLROOT . "/auth/login" ?>"
                                            class="text-violet-600 hover:text-violet-700 font-semibold transition-colors">
                                            وارد شوید
                                        </a>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Right Side Background -->
                <div class="col-span-12 md:col-span-7 lg:col-span-8 xl:col-span-9">
                    <div class="h-screen bg-cover bg-center bg-no-repeat relative overflow-hidden bg-image-container"
                        style="background-image: url('<?php echo URLROOT . "/assets/images/AK-Brand-Guide-47.jpg" ?>');">
                        <!-- Gradient overlay for better visual blend -->
                        <div class="absolute inset-0 bg-gradient-to-l from-transparent via-black/10 to-black/30 z-10">
                        </div>

                        <!-- Additional subtle gradient from form side -->
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-violet-900/20 via-transparent to-transparent z-20">
                        </div>

                        <!-- Content overlay -->
                        <div class="relative z-30 h-full flex items-end justify-center p-8">
                            <div class="text-center text-white/90">
                                <div class="mb-4">
                                    <h2 class="text-3xl md:text-4xl font-bold mb-2 text-shadow">سیستم مدیریت گارانتی
                                    </h2>
                                    <p class="text-lg md:text-xl text-white/80 text-shadow">عضویت در پلتفرم حرفه‌ای
                                        مدیریت محصولات</p>
                                </div>

                                <div class="features-grid max-w-md mx-auto">
                                    <div class="feature-card">
                                        <div class="feature-icon">👤</div>
                                        <p class="text-white/90">حساب کاربری امن</p>
                                    </div>
                                    <div class="feature-card">
                                        <div class="feature-icon">⚡</div>
                                        <p class="text-white/90">فرآیند ساده ثبت‌نام</p>
                                    </div>
                                    <div class="feature-card">
                                        <div class="feature-icon">🛡️</div>
                                        <p class="text-white/90">حفاظت از اطلاعات</p>
                                    </div>
                                    <div class="feature-card">
                                        <div class="feature-icon">📱</div>
                                        <p class="text-white/90">پشتیبانی 24/7</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Stats at bottom -->
                        <div class="stats-container">
                            <div class="text-center text-white/80 text-xs">
                                ©
                                <script>document.write(new Date().getFullYear())</script>
                                سیستم گارانتی آک | دیزاین و توسعه توسط <a href="https://github.com/Yeganenorouzi"
                                    class="text-white-500 underline">Yegane
                                    Norouzi</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="<?php echo URLROOT . "/assets/libs/%40popperjs/core/umd/popper.min.js" ?>"></script>
    <script src="<?php echo URLROOT . "/assets/libs/feather-icons/feather.min.js" ?>"></script>
    <script src="<?php echo URLROOT . "/assets/libs/metismenujs/metismenujs.min.js" ?>"></script>
    <script src="<?php echo URLROOT . "/assets/libs/simplebar/simplebar.min.js" ?>"></script>
    <script src="<?php echo URLROOT . "/assets/libs/swiper/swiper-bundle.min.js" ?>"></script>
    <script src="<?php echo URLROOT . "/assets/js/app.js" ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        let currentStep = 1;
        const totalSteps = 3;

        // Step titles and descriptions
        const stepInfo = {
            1: { title: 'اطلاعات کاربری', desc: 'لطفاً اطلاعات حساب کاربری خود را وارد کنید' },
            2: { title: 'اطلاعات شخصی', desc: 'اطلاعات هویتی و تماس خود را وارد کنید' },
            3: { title: 'اطلاعات آدرس', desc: 'آدرس و اطلاعات مکانی خود را کامل کنید' }
        };

        // Multi-step form functionality
        function showStep(step) {
            // Hide all steps
            document.querySelectorAll('.form-step').forEach(el => el.classList.remove('active'));
            // Show current step
            document.getElementById(`form-step-${step}`).classList.add('active');

            // Update step indicators
            for (let i = 1; i <= totalSteps; i++) {
                const stepEl = document.getElementById(`step-${i}`);
                const lineEl = document.getElementById(`line-${i}`);

                if (i < step) {
                    stepEl.classList.add('completed');
                    stepEl.classList.remove('active');
                    if (lineEl) lineEl.classList.add('completed');
                } else if (i === step) {
                    stepEl.classList.add('active');
                    stepEl.classList.remove('completed');
                } else {
                    stepEl.classList.remove('active', 'completed');
                    if (lineEl) lineEl.classList.remove('completed');
                }
            }

            // Update title and description
            document.getElementById('step-title').textContent = stepInfo[step].title;
            document.getElementById('step-desc').textContent = stepInfo[step].desc;

            // Show/hide navigation buttons
            document.getElementById('prevBtn').style.display = step === 1 ? 'none' : 'inline-block';
            document.getElementById('nextBtn').style.display = step === totalSteps ? 'none' : 'inline-block';
            document.getElementById('submitBtn').style.display = step === totalSteps ? 'inline-block' : 'none';
        }

        // Navigation event listeners
        document.getElementById('nextBtn').addEventListener('click', function () {
            if (validateCurrentStep()) {
                if (currentStep < totalSteps) {
                    currentStep++;
                    showStep(currentStep);
                }
            }
        });

        document.getElementById('prevBtn').addEventListener('click', function () {
            if (currentStep > 1) {
                currentStep--;
                showStep(currentStep);
            }
        });

        // Validation functions
        function validateCurrentStep() {
            let isValid = true;
            const currentStepEl = document.querySelector('.form-step.active');
            const inputs = currentStepEl.querySelectorAll('input, select, textarea');

            inputs.forEach(input => {
                // Skip validation for optional fields that are empty
                if (input.value.trim() === '' && !isRequiredField(input.name)) {
                    return;
                }

                if (!validateField(input)) {
                    isValid = false;
                }
            });

            return isValid;
        }

        function isRequiredField(fieldName) {
            // فقط فیلدهای اصلی الزامی باشند
            const requiredFields = ['email', 'password', 'confirm_password', 'name', 'codemelli', 'mobile', 'terms'];
            return requiredFields.includes(fieldName);
        }

        function validateField(field) {
            const value = field.type === 'checkbox' ? field.checked : field.value.trim();
            const fieldName = field.name;
            let isValid = true;
            let errorMessage = '';

            // Clear previous error
            const errorEl = document.getElementById(fieldName + '-error');
            if (errorEl) errorEl.textContent = '';
            field.classList.remove('border-red-300');

            switch (fieldName) {
                case 'email':
                    if (!value) {
                        errorMessage = 'لطفا ایمیل را وارد کنید';
                        isValid = false;
                    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
                        errorMessage = 'ایمیل نامعتبر است';
                        isValid = false;
                    }
                    break;

                case 'password':
                    if (!value) {
                        errorMessage = 'لطفا رمز عبور را وارد کنید';
                        isValid = false;
                    } else if (value.length < 8) {
                        errorMessage = 'رمز عبور باید حداقل 8 کاراکتر باشد';
                        isValid = false;
                    } else if (!/\d/.test(value)) {
                        errorMessage = 'رمز عبور باید حداقل شامل یک عدد باشد';
                        isValid = false;
                    }
                    break;

                case 'confirm_password':
                    const password = document.getElementById('password').value;
                    if (!value) {
                        errorMessage = 'لطفا تکرار رمز عبور را وارد کنید';
                        isValid = false;
                    } else if (value !== password) {
                        errorMessage = 'تکرار رمز عبور مطابقت ندارد';
                        isValid = false;
                    }
                    break;

                case 'name':
                    if (!value) {
                        errorMessage = 'لطفا نام و نام خانوادگی را وارد کنید';
                        isValid = false;
                    } else if (value.length < 3) {
                        errorMessage = 'نام باید حداقل 3 کاراکتر باشد';
                        isValid = false;
                    }
                    break;

                case 'codemelli':
                    if (!value) {
                        errorMessage = 'لطفا کد ملی را وارد کنید';
                        isValid = false;
                    } else if (!/^\d{10}$/.test(value)) {
                        errorMessage = 'کد ملی باید 10 رقم باشد';
                        isValid = false;
                    } else if (!isValidNationalId(value)) {
                        errorMessage = 'کد ملی نامعتبر است';
                        isValid = false;
                    }
                    break;

                case 'mobile':
                    if (!value) {
                        errorMessage = 'لطفا شماره موبایل را وارد کنید';
                        isValid = false;
                    } else if (!/^09\d{9}$/.test(value)) {
                        errorMessage = 'شماره موبایل نامعتبر است';
                        isValid = false;
                    }
                    break;

                case 'phone':
                    // Phone is optional, only validate if filled
                    if (value && !/^0\d{10}$/.test(value)) {
                        errorMessage = 'شماره تلفن نامعتبر است';
                        isValid = false;
                    }
                    break;

                case 'ostan':
                    if (!value) {
                        errorMessage = 'لطفا استان را انتخاب کنید';
                        isValid = false;
                    }
                    break;

                case 'shahr':
                    if (!value) {
                        errorMessage = 'لطفا شهر را انتخاب کنید';
                        isValid = false;
                    }
                    break;

                case 'address':
                    if (!value) {
                        errorMessage = 'لطفا آدرس را وارد کنید';
                        isValid = false;
                    } else if (value.length < 10) {
                        errorMessage = 'آدرس باید حداقل 10 کاراکتر باشد';
                        isValid = false;
                    }
                    break;

                case 'hours':
                    if (!value) {
                        errorMessage = 'لطفا ساعت کاری را وارد کنید';
                        isValid = false;
                    }
                    break;

                case 'codeposti':
                    if (!value) {
                        errorMessage = 'لطفا کد پستی را وارد کنید';
                        isValid = false;
                    } else if (!/^\d{10}$/.test(value)) {
                        errorMessage = 'کد پستی باید 10 رقم باشد';
                        isValid = false;
                    }
                    break;

                case 'terms':
                    if (!field.checked) {
                        errorMessage = 'لطفا قوانین و مقررات را مطالعه کرده و تایید کنید';
                        isValid = false;
                    }
                    break;
            }

            if (errorEl && errorMessage) {
                errorEl.textContent = errorMessage;
                field.classList.add('border-red-300');
            }

            return isValid;
        }

        function isValidNationalId(code) {
            // Remove any non-digit characters
            code = code.replace(/\D/g, '');

            // Check length
            if (code.length !== 10) return false;

            // Check for invalid patterns
            if (/^(\d)\1{9}$/.test(code)) return false;

            // Calculate checksum
            let sum = 0;
            for (let i = 0; i < 9; i++) {
                sum += parseInt(code[i]) * (10 - i);
            }

            const remainder = sum % 11;
            const checkDigit = parseInt(code[9]);

            return (remainder < 2 && checkDigit === remainder) ||
                (remainder >= 2 && checkDigit === 11 - remainder);
        }

        // Password strength indicator
        function updatePasswordStrength(password) {
            const strengthBar = document.getElementById('password-strength-bar');
            const strengthText = document.getElementById('password-strength-text');

            let strength = 0;
            let text = '';

            if (password.length >= 8) strength++;
            if (/\d/.test(password)) strength++;
            if (password.length >= 10) strength++;

            strengthBar.className = 'password-strength-bar';

            switch (strength) {
                case 0:
                    strengthBar.classList.add('strength-weak');
                    text = 'رمز عبور باید حداقل 8 کاراکتر و شامل عدد باشد';
                    break;
                case 1:
                    strengthBar.classList.add('strength-fair');
                    text = 'رمز عبور متوسط';
                    break;
                case 2:
                    strengthBar.classList.add('strength-good');
                    text = 'رمز عبور خوب';
                    break;
                case 3:
                    strengthBar.classList.add('strength-strong');
                    text = 'رمز عبور قوی';
                    break;
            }

            strengthText.textContent = text;
        }

        // Real-time validation
        document.querySelectorAll('input, select, textarea').forEach(field => {
            field.addEventListener('blur', () => validateField(field));
            field.addEventListener('input', () => {
                if (field.name === 'password') {
                    updatePasswordStrength(field.value);
                }
                if (field.value.trim() !== '') {
                    validateField(field);
                }
            });
        });

        // Password toggle functionality
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = field.nextElementSibling.querySelector('i');

            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.remove('mdi-eye-outline');
                icon.classList.add('mdi-eye-off-outline');
            } else {
                field.type = 'password';
                icon.classList.remove('mdi-eye-off-outline');
                icon.classList.add('mdi-eye-outline');
            }
        }

        // Cities data and functionality
        const cities = {
            'تهران': ['تهران', 'شهریار', 'ورامین', 'اسلامشهر', 'پردیس', 'دماوند', 'ملارد', 'ری', 'باقرشهر', 'قرچک', 'رباط‌کریم'],
            'اصفهان': ['اصفهان', 'کاشان', 'نجف‌آباد', 'خمینی‌شهر', 'شاهین‌شهر', 'فولادشهر', 'گلپایگان', 'آران و بیدگل', 'نطنز'],
            'خراسان رضوی': ['مشهد', 'نیشابور', 'سبزوار', 'تربت حیدریه', 'کاشمر', 'فریمان', 'قوچان', 'چناران', 'طرقبه'],
            'آذربایجان شرقی': ['تبریز', 'مراغه', 'میانه', 'مرند', 'شبستر', 'اهر', 'بستان‌آباد', 'اسکو', 'هریس'],
            'آذربایجان غربی': ['ارومیه', 'خوی', 'مهاباد', 'میاندوآب', 'بوکان', 'سردشت', 'پیرانشهر', 'سلماس', 'شاهین‌دژ'],
            'اردبیل': ['اردبیل', 'خلخال', 'مشگین‌شهر', 'پارس‌آباد', 'نمین', 'نیر', 'بیله‌سوار', 'گرمی'],
            'البرز': ['کرج', 'فردیس', 'نظرآباد', 'اشتهارد', 'هشتگرد', 'محمدشهر', 'ماهدشت'],
            'ایلام': ['ایلام', 'دهلران', 'آبدانان', 'مهران', 'دره‌شهر', 'چرداول'],
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

        document.getElementById('ostan').addEventListener('change', function () {
            const selectedOstan = this.value;
            const shahrSelect = document.getElementById('shahr');
            shahrSelect.innerHTML = '<option value="">انتخاب شهر</option>';

            if (selectedOstan && cities[selectedOstan]) {
                cities[selectedOstan].forEach(city => {
                    const option = document.createElement('option');
                    option.value = city;
                    option.textContent = city;
                    shahrSelect.appendChild(option);
                });
            }
        });

        // Form submission
        document.getElementById('registerForm').addEventListener('submit', function (e) {
            e.preventDefault();

            console.log('Form submitted!'); // Debug

            // Validate all steps before submission
            let allValid = true;
            const allSteps = document.querySelectorAll('.form-step');

            allSteps.forEach(stepEl => {
                const inputs = stepEl.querySelectorAll('input, select, textarea');

                inputs.forEach(input => {
                    // Skip empty optional fields
                    if (input.value.trim() === '' && !isRequiredField(input.name)) {
                        return;
                    }

                    // Special handling for checkbox
                    if (input.type === 'checkbox' && input.name === 'terms') {
                        if (!input.checked) {
                            console.log(`Validation failed for field: ${input.name} - not checked`); // Debug
                            allValid = false;
                        }
                        return;
                    }

                    if (!validateField(input)) {
                        console.log(`Validation failed for field: ${input.name}, value: ${input.value}`); // Debug
                        allValid = false;
                    }
                });
            });

            if (!allValid) {
                console.log('Client-side validation failed!'); // Debug
                Swal.fire({
                    title: '❌ خطا در اطلاعات',
                    text: 'لطفاً همه فیلدها را به درستی پر کنید',
                    icon: 'error',
                    confirmButtonText: 'باشه',
                    customClass: { popup: 'rtl-alert' }
                });
                return;
            }

            console.log('Client-side validation passed!'); // Debug

            const submitBtn = document.getElementById('submitBtn');
            const btnText = document.getElementById('submitBtnText');
            const btnSpinner = document.getElementById('submitBtnSpinner');

            // Show loading state
            submitBtn.classList.add('loading');
            btnText.textContent = 'در حال ثبت نام...';
            btnSpinner.classList.remove('hidden');

            fetch(this.action, {
                method: 'POST',
                body: new FormData(this)
            })
                .then(response => {
                    console.log('Response status:', response.status); // Debug
                    return response.json();
                })
                .then(data => {
                    console.log('Server response:', data); // Debug

                    if (data.success) {
                        Swal.fire({
                            title: '✅ ثبت نام موفقیت‌آمیز!',
                            text: 'حساب شما با موفقیت ایجاد شد',
                            icon: 'success',
                            confirmButtonText: 'ورود به سیستم',
                            customClass: { popup: 'rtl-alert' }
                        }).then(() => {
                            window.location.href = '<?php echo URLROOT . "/auth/login" ?>';
                        });
                    } else {
                        console.log('Server response:', data); // برای debugging

                        // Show errors
                        if (data.errors) {
                            console.log('Validation errors:', data.errors); // برای debugging
                            Object.entries(data.errors).forEach(([field, error]) => {
                                if (error) {
                                    // Remove _err suffix if exists
                                    const fieldName = field.replace('_err', '');
                                    const errorEl = document.getElementById(fieldName + '-error');
                                    const inputEl = document.getElementById(fieldName);

                                    console.log(`Field: ${fieldName}, Error: ${error}`); // برای debugging

                                    if (errorEl) errorEl.textContent = error;
                                    if (inputEl) inputEl.classList.add('border-red-300');
                                }
                            });

                            // Go to first step to show errors
                            currentStep = 1;
                            showStep(1);
                        }

                        Swal.fire({
                            title: '❌ خطا در ثبت نام',
                            text: data.message || 'لطفاً اطلاعات را بررسی کنید',
                            icon: 'error',
                            confirmButtonText: 'باشه',
                            customClass: { popup: 'rtl-alert' }
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        title: '⚠️ خطای ارتباط',
                        text: 'مشکلی در ارتباط با سرور رخ داده است',
                        icon: 'error',
                        confirmButtonText: 'باشه',
                        customClass: { popup: 'rtl-alert' }
                    });
                })
                .finally(() => {
                    // Reset loading state
                    submitBtn.classList.remove('loading');
                    btnText.textContent = 'ثبت نام';
                    btnSpinner.classList.add('hidden');
                });
        });

        // Initialize
        showStep(1);
        document.getElementById('email').focus();
    </script>
</body>

</html>