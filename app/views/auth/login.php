<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="utf-8" />
    <title>ورود | سیستم گارانتی آک</title>
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
        }

        .input-group .form-control {
            transition: all 0.3s ease;
        }

        .input-group .form-control:focus {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.15);
        }

        .rtl-alert {
            direction: rtl;
            font-family: inherit;
        }

        /* Modern Left Side Styling */
        .login-container {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
            overflow: hidden;
        }

        .login-form-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
            border: 1px solid rgba(255, 255, 255, 0.18);
            margin: 20px;
            padding: 2rem;
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
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            display: inline-block;
            margin-bottom: 1rem;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .login-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            margin-top: 2rem;
        }

        .feature-card {
            background: rgba(102, 126, 234, 0.05);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            padding: 1rem;
            text-align: center;
            border: 1px solid rgba(102, 126, 234, 0.1);
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            background: rgba(102, 126, 234, 0.1);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.15);
        }

        .feature-icon {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
            color: #667eea;
        }

        .feature-card p {
            color: #4a5568;
            font-weight: 600;
            font-size: 0.875rem;
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

        .stats-container {
            position: absolute;
            bottom: 2rem;
            right: 2rem;
            left: 2rem;
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

        /* Background image fade effects */
        .bg-fade {
            animation: fadeInBackground 2s ease-in-out;
            position: relative;
        }

        .bg-fade::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg,
                    rgba(0, 0, 0, 0.4) 0%,
                    rgba(0, 0, 0, 0.2) 30%,
                    rgba(0, 0, 0, 0.1) 70%,
                    rgba(0, 0, 0, 0.3) 100%);
            z-index: 1;
        }

        .bg-fade::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(ellipse at center,
                    transparent 0%,
                    transparent 60%,
                    rgba(0, 0, 0, 0.3) 100%);
            z-index: 2;
        }

        @keyframes fadeInBackground {
            0% {
                opacity: 0;
                transform: scale(1.1);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Fade edges effect */
        .fade-edges {
            position: relative;
        }

        .fade-edges::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to right,
                    rgba(102, 126, 234, 0.3) 0%,
                    transparent 20%,
                    transparent 80%,
                    rgba(118, 75, 162, 0.3) 100%),
                linear-gradient(to bottom,
                    rgba(0, 0, 0, 0.2) 0%,
                    transparent 20%,
                    transparent 80%,
                    rgba(0, 0, 0, 0.4) 100%);
            z-index: 3;
            pointer-events: none;
        }
    </style>
</head>

<body data-mode="light" data-sidebar-size="lg">
    <div class="container-fluid">
        <div class="h-screen md:overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-12">
                <div class="col-span-12 md:col-span-5 lg:col-span-4 xl:col-span-3 relative z-50">
                    <div class="login-container h-screen flex items-center justify-center">
                        <div class="floating-elements"></div>

                        <div class="login-form-container w-full max-w-md relative z-10">
                            <div class="text-center mb-8">
                                <div class="welcome-badge">
                                    <i class="mdi mdi-shield-check ml-1"></i>
                                    سامانه گارانتی
                                </div>
                                <div class="mx-auto mb-6">
                                    <img src="<?php echo URLROOT . "/assets/images/Logo 400.png" ?>" alt="لوگو"
                                        class="h-16 mx-auto mb-4">
                                    <h1 class="text-2xl font-bold text-gray-800 logo-container">
                                        ورود به سامانه آک
                                    </h1>
                                    <p class="text-gray-600 text-sm mt-2">
                                        خوش آمدید! لطفاً وارد حساب کاربری خود شوید
                                    </p>
                                </div>
                            </div>

                            <form id="loginForm" action="<?php echo URLROOT . "/auth/login" ?>" method="post">
                                <input type="hidden" name="csrf_token" value="<?php echo $data['csrf_token']; ?>">

                                <div class="mb-6 input-group">
                                    <label class="text-gray-700 font-medium mb-2 block">
                                        <i class="mdi mdi-account-outline ml-2 text-violet-500"></i>کد ملی
                                    </label>
                                    <input type="text"
                                        class="form-control w-full border-2 border-gray-200 rounded-xl placeholder:text-sm py-3 px-4 transition-all duration-300 focus:border-violet-500"
                                        id="codemelli" name="codemelli" placeholder="کد ملی ۱۰ رقمی خود را وارد کنید"
                                        value="<?php echo $data["codemelli"]; ?>" maxlength="10" required>
                                    <div class="error-message text-red-500 text-sm mt-1" id="codemelli-error"></div>
                                </div>

                                <div class="mb-6 input-group">
                                    <label class="text-gray-700 font-medium mb-2 block">
                                        <i class="mdi mdi-lock-outline ml-2 text-violet-500"></i>رمز عبور
                                    </label>
                                    <div class="relative">
                                        <input type="password"
                                            class="form-control w-full border-2 border-gray-200 rounded-xl placeholder:text-sm py-3 px-4 pr-12 transition-all duration-300 focus:border-violet-500"
                                            id="password" name="password" placeholder="رمز عبور خود را وارد کنید"
                                            required>
                                        <button type="button"
                                            class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600"
                                            onclick="togglePassword('password')">
                                            <i class="mdi mdi-eye-outline"></i>
                                        </button>
                                    </div>
                                    <div class="error-message text-red-500 text-sm mt-1" id="password-error"></div>
                                </div>

                                <div class="mb-6 flex items-center justify-between">
                                    <div class="flex items-center">
                                        <input type="checkbox" id="remember" name="remember"
                                            class="h-4 w-4 text-violet-500 border-gray-300 rounded focus:ring-violet-500">
                                        <label for="remember" class="mr-2 text-sm text-gray-600">
                                            مرا به خاطر بسپار
                                        </label>
                                    </div>
                                    <a href="#" class="text-sm text-violet-600 hover:text-violet-700 font-medium">
                                        فراموشی رمز عبور؟
                                    </a>
                                </div>

                                <div class="mb-6">
                                    <button type="submit" id="loginBtn"
                                        class="login-btn w-full py-3 text-white rounded-xl font-medium transition-all duration-300">
                                        <span id="loginBtnText">ورود به سیستم</span>
                                        <span id="loginBtnSpinner" class="spinner hidden"></span>
                                    </button>
                                </div>

                                <div class="text-center">
                                    <p class="text-gray-600 text-sm">
                                        حساب کاربری ندارید؟
                                        <a href="<?php echo URLROOT . "/auth/register" ?>"
                                            class="text-violet-600 hover:text-violet-700 font-semibold transition-colors">
                                            ثبت نام کنید
                                        </a>
                                    </p>
                                </div>
                            </form>

                            <!-- Features Grid moved below form -->
                            <div class="mt-8">
                                <div class="features-grid max-w-md mx-auto">
                                    <div class="feature-card">
                                        <div class="feature-icon">🔒</div>
                                        <p class="text-gray-700">امنیت بالا</p>
                                    </div>
                                    <div class="feature-card">
                                        <div class="feature-icon">⚡</div>
                                        <p class="text-gray-700">سرعت عملیات</p>
                                    </div>
                                    <div class="feature-card">
                                        <div class="feature-icon">📊</div>
                                        <p class="text-gray-700">گزارش‌گیری دقیق</p>
                                    </div>
                                    <div class="feature-card">
                                        <div class="feature-icon">🎯</div>
                                        <p class="text-gray-700">رابط کاربری ساده</p>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Stats at bottom -->
                        <div class="stats-container absolute bottom-0 left-0 right-0">
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

                        <!-- Content overlay if needed -->
                        <div class="relative z-30 h-full flex items-center justify-center p-8">
                            <!-- You can add other content here if needed -->
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
    <script src="<?php echo URLROOT . "/assets/js/pages/login.init.js" ?>"></script>
    <script src="<?php echo URLROOT . "/assets/js/app.js" ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Password toggle functionality
        function togglePassword(inputId) {
            const passwordInput = document.getElementById(inputId);
            const button = passwordInput.nextElementSibling;
            const icon = button.querySelector('i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('mdi-eye-outline');
                icon.classList.add('mdi-eye-off-outline');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('mdi-eye-off-outline');
                icon.classList.add('mdi-eye-outline');
            }
        }

        // Real-time validation
        document.getElementById('codemelli').addEventListener('input', function (e) {
            const value = e.target.value;
            const errorElement = document.getElementById('codemelli-error');

            if (value && (value.length !== 10 || !/^\d+$/.test(value))) {
                errorElement.textContent = 'کد ملی باید ۱۰ رقم باشد';
                e.target.classList.add('border-red-300');
            } else {
                errorElement.textContent = '';
                e.target.classList.remove('border-red-300');
            }
        });

        // Enhanced form submission with AJAX
        document.getElementById('loginForm').addEventListener('submit', function (e) {
            e.preventDefault();

            const form = this;
            const submitBtn = document.getElementById('loginBtn');
            const btnText = document.getElementById('loginBtnText');
            const btnSpinner = document.getElementById('loginBtnSpinner');

            // Show loading state
            submitBtn.classList.add('loading');
            btnText.textContent = 'در حال ورود...';
            btnSpinner.classList.remove('hidden');

            // Clear previous errors
            document.querySelectorAll('.error-message').forEach(el => el.textContent = '');
            document.querySelectorAll('.form-control').forEach(el => el.classList.remove('border-red-300'));

            fetch(form.action, {
                method: 'POST',
                body: new FormData(form)
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: '✅ ورود موفقیت‌آمیز!',
                            text: 'به سیستم گارانتی آک خوش آمدید',
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false,
                            customClass: {
                                popup: 'rtl-alert'
                            }
                        }).then(() => {
                            window.location.href = data.redirect;
                        });
                    } else {
                        // Show field-specific errors
                        if (data.errors) {
                            Object.entries(data.errors).forEach(([field, error]) => {
                                if (error) {
                                    const errorElement = document.getElementById(field + '-error');
                                    const inputElement = document.getElementById(field);
                                    if (errorElement) errorElement.textContent = error;
                                    if (inputElement) inputElement.classList.add('border-red-300');
                                }
                            });
                        }

                        Swal.fire({
                            title: '❌ خطا در ورود',
                            text: data.message || 'لطفاً اطلاعات خود را بررسی کنید',
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
                        title: '⚠️ خطای ارتباط',
                        text: 'مشکلی در ارتباط با سرور رخ داده است',
                        icon: 'error',
                        confirmButtonText: 'باشه',
                        customClass: {
                            popup: 'rtl-alert',
                            confirmButton: 'btn border-transparent bg-violet-500 text-white'
                        }
                    });
                })
                .finally(() => {
                    // Reset loading state
                    submitBtn.classList.remove('loading');
                    btnText.textContent = 'ورود';
                    btnSpinner.classList.add('hidden');
                });
        });

        // Auto-focus on first input
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('codemelli').focus();
        });
    </script>
</body>

</html>