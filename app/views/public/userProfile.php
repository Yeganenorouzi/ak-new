<?php require_once APPROOT . "/views/public/header.php" ?>

<?php
// بررسی ورود کاربر و وجود اطلاعات
if (!isset($_SESSION['admin']) || !isset($data['user']) || !$data['user']) {
    $_SESSION['error_message'] = 'دسترسی غیرمجاز. لطفاً وارد شوید.';
    header("Location: " . URLROOT . "/auth/login");
    exit();
}

// اطمینان از اینکه اطلاعات کاربر موجود است
$user = $data['user'];
if (!is_object($user) || !isset($user->name)) {
    $_SESSION['error_message'] = 'خطا در بارگذاری اطلاعات کاربر.';
    header("Location: " . URLROOT . "/dashboard");
    exit();
}
?>

<style>
    .card {
        @apply bg-white rounded-lg shadow-sm border border-gray-200 dark:bg-zinc-800 dark:border-zinc-600;
    }

    .card-body {
        @apply p-6;
    }

    /* انیمیشن‌های custom */
    .fade-in {
        animation: fadeIn 0.5s ease-in;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* بهبود ظاهر input ها */
    .form-input:focus {
        box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
    }
</style>

<div class="main-content">
    <div class="page-content dark:bg-zinc-700">
        <div class="container-fluid px-[0.625rem]">

            <!-- page title -->
            <div class="grid grid-cols-1 mb-5">
                <div class="flex items-center justify-between">
                    <h4 class="mb-sm-0 text-lg font-semibold grow text-gray-800 dark:text-gray-100">پروفایل کاربری</h4>
                </div>
            </div>

            <!-- نمایش پیام‌های موفقیت و خطا -->
            <?php if (!empty($data['success'])): ?>
                <div
                    class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-4 dark:bg-green-800/20 dark:border-green-600 dark:text-green-400">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle ml-2"></i>
                        <?php echo $data['success']; ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (!empty($data['errors'])): ?>
                <div
                    class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-4 dark:bg-red-800/20 dark:border-red-600 dark:text-red-400">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-triangle ml-2"></i>
                        <?php echo $data['errors']; ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="grid grid-cols-12 gap-5">
                <!-- کارت اطلاعات کاربر -->
                <div class="col-span-12 xl:col-span-4 fade-in">
                    <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                        <div class="card-body">
                            <div class="text-center">
                                <!-- آواتار کاربر -->
                                <div class="relative inline-block mb-4">
                                    <?php if (!empty($user->avatar)): ?>
                                        <img class="h-32 w-32 rounded-full object-cover mx-auto ring-4 ring-violet-500/20 dark:ring-violet-400/20"
                                            src="<?php echo URLROOT . "/uploads/users/" . $user->avatar; ?>"
                                            alt="Profile Avatar">
                                    <?php else: ?>
                                        <div
                                            class="h-32 w-32 rounded-full bg-violet-500 flex items-center justify-center mx-auto ring-4 ring-violet-500/20">
                                            <i class="fas fa-user text-white text-4xl"></i>
                                        </div>
                                    <?php endif; ?>
                                    <span
                                        class="absolute bottom-2 right-2 h-6 w-6 bg-green-500 border-2 border-white dark:border-zinc-800 rounded-full"></span>
                                </div>

                                <!-- نام کاربر -->
                                <h5 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-2">
                                    <?php echo htmlspecialchars($user->name); ?>
                                </h5>

                                <!-- نقش کاربر -->
                                <div
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium mb-4 
                                            <?php echo (isset($user->admin) && $user->admin == 1) ? 'bg-purple-100 text-purple-800 dark:bg-purple-800/20 dark:text-purple-300' : 'bg-blue-100 text-blue-800 dark:bg-blue-800/20 dark:text-blue-300'; ?>">
                                    <i
                                        class="<?php echo (isset($user->admin) && $user->admin == 1) ? 'fas fa-crown' : 'fas fa-user-tie'; ?> ml-1"></i>
                                    <?php echo (isset($user->admin) && $user->admin == 1) ? 'ادمین' : 'نماینده'; ?>
                                </div>

                                <!-- اطلاعات تماس -->
                                <div class="space-y-3 text-start">
                                    <div class="flex items-center text-gray-600 dark:text-gray-400">
                                        <i class="fas fa-envelope w-5 h-5 ml-3 text-violet-500"></i>
                                        <span class="text-sm"><?php echo htmlspecialchars($user->email); ?></span>
                                    </div>
                                    <div class="flex items-center text-gray-600 dark:text-gray-400">
                                        <i class="fas fa-mobile-alt w-5 h-5 ml-3 text-violet-500"></i>
                                        <span class="text-sm"><?php echo htmlspecialchars($user->mobile); ?></span>
                                    </div>
                                    <div class="flex items-center text-gray-600 dark:text-gray-400">
                                        <i class="fas fa-id-card w-5 h-5 ml-3 text-violet-500"></i>
                                        <span class="text-sm"><?php echo htmlspecialchars($user->codemelli); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- فرم تغییر رمز عبور -->
                <div class="col-span-12 xl:col-span-8 fade-in" style="animation-delay: 0.2s;">
                    <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                        <div class="card-body">
                            <div class="flex items-center mb-6">
                                <div class="h-10 w-10 bg-violet-500 rounded-lg flex items-center justify-center ml-3">
                                    <i class="fas fa-key text-white"></i>
                                </div>
                                <div>
                                    <h5 class="text-lg font-semibold text-gray-800 dark:text-gray-100">تغییر رمز عبور
                                    </h5>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">برای امنیت بیشتر، رمز عبور قوی
                                        انتخاب کنید</p>
                                </div>
                            </div>

                            <form action="<?php echo URLROOT; ?>/users/changePassword" method="POST" class="space-y-6">
                                <!-- رمز عبور فعلی -->
                                <div>
                                    <label for="current_password"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        <i class="fas fa-lock ml-2"></i>رمز عبور فعلی
                                    </label>
                                    <input type="password" id="current_password" name="current_password" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-violet-500 focus:border-violet-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-gray-100 dark:placeholder-gray-400"
                                        placeholder="رمز عبور فعلی را وارد کنید">
                                </div>

                                <!-- رمز عبور جدید -->
                                <div>
                                    <label for="new_password"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        <i class="fas fa-key ml-2"></i>رمز عبور جدید
                                    </label>
                                    <input type="password" id="new_password" name="new_password" required
                                        pattern="[0-9]{8}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-violet-500 focus:border-violet-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-gray-100 dark:placeholder-gray-400"
                                        placeholder="رمز عبور جدید (8 رقم)">
                                </div>

                                <!-- تکرار رمز عبور جدید -->
                                <div>
                                    <label for="confirm_password"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        <i class="fas fa-shield-alt ml-2"></i>تکرار رمز عبور جدید
                                    </label>
                                    <input type="password" id="confirm_password" name="confirm_password" required
                                        pattern="[0-9]{8}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-violet-500 focus:border-violet-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-gray-100 dark:placeholder-gray-400"
                                        placeholder="رمز عبور جدید را مجدداً وارد کنید">
                                </div>

                                <!-- دکمه‌های عملیات -->
                                <div class="flex gap-3 pt-4">
                                    <button type="submit"
                                        class="w-full bg-violet-500 hover:bg-violet-600 text-white py-3 px-6 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center">
                                        <i class="fas fa-save ml-2"></i>
                                        تغییر رمز عبور
                                    </button>
                                </div>
                            </form>

                            <!-- راهنمای امنیت رمز عبور -->
                            <div
                                class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg dark:bg-blue-800/20 dark:border-blue-600">
                                <h6 class="text-sm font-medium text-blue-800 dark:text-blue-300 mb-2">
                                    <i class="fas fa-info-circle ml-1"></i>راهنمای انتخاب رمز عبور:
                                </h6>
                                <ul class="text-xs text-blue-700 dark:text-blue-400 space-y-1 pr-4">
                                    <li>• رمز عبور باید دقیقاً 8 رقم باشد</li>
                                    <li>• فقط از اعداد استفاده کنید</li>
                                    <li>• رمز عبور خود را با دیگران به اشتراک نگذارید</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // بررسی تطابق رمزهای عبور
        const newPasswordInput = document.getElementById('new_password');
        const confirmPasswordInput = document.getElementById('confirm_password');

        function checkPasswordMatch() {
            const newPassword = newPasswordInput.value;
            const confirmPassword = confirmPasswordInput.value;

            if (confirmPassword && newPassword !== confirmPassword) {
                confirmPasswordInput.setCustomValidity('رمزهای عبور باید یکسان باشند');
                confirmPasswordInput.classList.add('border-red-500');
                confirmPasswordInput.classList.remove('border-green-500');
            } else if (confirmPassword && newPassword === confirmPassword) {
                confirmPasswordInput.setCustomValidity('');
                confirmPasswordInput.classList.add('border-green-500');
                confirmPasswordInput.classList.remove('border-red-500');
            } else {
                confirmPasswordInput.setCustomValidity('');
                confirmPasswordInput.classList.remove('border-red-500', 'border-green-500');
            }
        }

        newPasswordInput.addEventListener('input', checkPasswordMatch);
        confirmPasswordInput.addEventListener('input', checkPasswordMatch);

        // انیمیشن برای دکمه ارسال
        const submitButton = document.querySelector('button[type="submit"]');
        if (submitButton) {
            submitButton.addEventListener('click', function (e) {
                const form = this.closest('form');
                if (form.checkValidity()) {
                    this.innerHTML = '<i class="fas fa-spinner fa-spin ml-2"></i>در حال پردازش...';
                    this.disabled = true;
                }
            });
        }
    });

    // نمایش/مخفی کردن رمز عبور
    function togglePassword(inputId) {
        const input = document.getElementById(inputId);
        const icon = input.nextElementSibling?.querySelector('i');

        if (input.getAttribute('type') === 'password') {
            input.setAttribute('type', 'text');
            if (icon) icon.className = 'fas fa-eye-slash';
        } else {
            input.setAttribute('type', 'password');
            if (icon) icon.className = 'fas fa-eye';
        }
    }
</script>

<?php require_once APPROOT . "/views/public/footer.php" ?>