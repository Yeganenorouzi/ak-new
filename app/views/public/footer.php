<!-- Footer Start -->
<footer class="footer border-t border-gray-50 py-5 px-5 bg-white dark:bg-zinc-700 dark:border-zinc-600 dark:text-gray-200">
    <div class="grid grid-cols-2">
        <div class="grow lg:text-left order-2 md:order-1 text-left md:text-right">
            &copy;
            <script>
                document.write(new Date().getFullYear());
            </script> AK WARRANTY
        </div>
        <div class="hidden md:inline-block text-start order-1 md:order-2">دیزاین و توسعه توسط <a href="https://github.com/Yeganenorouzi"
                class="text-violet-500 underline">Yegane Norouzi</a></div>
    </div>
</footer>
<!-- end Footer -->





<script src="<?php echo URLROOT . "/assets/libs/%40popperjs/core/umd/popper.min.js" ?>"></script>
<script src="<?php echo URLROOT . "/assets/libs/feather-icons/feather.min.js" ?>"></script>
<script src="<?php echo URLROOT . "/assets/libs/metismenujs/metismenujs.min.js" ?>"></script>
<script src="<?php echo URLROOT . "/assets/libs/simplebar/simplebar.min.js" ?>"></script>
<script src="<?php echo URLROOT . "/assets/libs/feather-icons/feather.min.js" ?>"></script>


<!-- jQuery is already loaded in the header, so we don't need to load it again here -->
<!-- apexcharts -->
<script src="<?php echo URLROOT . "/assets/libs/apexcharts/apexcharts.min.js" ?>"></script>

<!-- Script to wait for jQuery to be loaded before loading dependent scripts -->
<script>
    // Function to load scripts that depend on jQuery
    function loadJQueryDependentScripts() {
        // Plugins js
        var vectormapScript = document.createElement('script');
        vectormapScript.src = '<?php echo URLROOT . "/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js" ?>';
        document.body.appendChild(vectormapScript);

        // Dashboard init
        var dashboardScript = document.createElement('script');
        dashboardScript.src = '<?php echo URLROOT . "/assets/js/pages/dashboard.init.js" ?>';
        document.body.appendChild(dashboardScript);

        // Nav & tabs
        var navTabsScript = document.createElement('script');
        navTabsScript.src = '<?php echo URLROOT . "/assets/js/pages/nav%26tabs.js" ?>';
        document.body.appendChild(navTabsScript);

        // Login init
        var loginScript = document.createElement('script');
        loginScript.src = '<?php echo URLROOT . "/assets/js/pages/login.init.js" ?>';
        document.body.appendChild(loginScript);

        // App.js
        var appScript = document.createElement('script');
        appScript.src = '<?php echo URLROOT . "/assets/js/app.js" ?>';
        document.body.appendChild(appScript);
    }

    // Check if jQuery is already loaded
    if (typeof jQuery !== 'undefined') {
        loadJQueryDependentScripts();
    } else {
        // Listen for the jqueryLoaded event
        document.addEventListener('jqueryLoaded', function () {
            loadJQueryDependentScripts();
        });

        // Fallback: Check periodically if jQuery is loaded
        var checkInterval = setInterval(function () {
            if (typeof jQuery !== 'undefined') {
                clearInterval(checkInterval);
                loadJQueryDependentScripts();
            }
        }, 100);

        // Timeout after 5 seconds
        setTimeout(function () {
            clearInterval(checkInterval);
            console.error('jQuery failed to load after 5 seconds');
        }, 5000);
    }
</script>

<script src="<?php echo URLROOT . "/assets/libs/swiper/swiper-bundle.min.js" ?>"></script>

<!-- Jalali Date Picker -->
<link rel="stylesheet" href="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.css">
<script type="text/javascript" src="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.js"></script>


<script>
    // Initialize Jalali Date Picker
    jalaliDatepicker.startWatch({
        daysTitleFormat: 'YYYY/MM/DD',
        monthTitleFormat: 'YYYY/MM',
        autoClose: true,
        position: 'auto',
        showTodayBtn: true,
        showEmptyBtn: true,


    });
</script>


<script>
    // تابع نمایش پیش‌نمایش تصویر آپلود شده
    function previewImage(input, previewId) {
        const preview = document.getElementById(previewId);

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            // وقتی فایل خوانده شد، تصویر را نمایش بده
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                preview.style.display = 'block';
            }

            reader.readAsDataURL(input.files[0]);
        } else {
            // اگر فایلی انتخاب نشده، پیش‌نمایش را مخفی کن
            preview.src = '#';
            preview.classList.add('hidden');
            preview.style.display = 'none';
        }
    }

    // اضافه کردن event listener برای فیلدهای آپلود تصویر
    document.addEventListener('DOMContentLoaded', function () {
        const fileInputs = ['avatar1', 'avatar2', 'avatar3'];

        fileInputs.forEach((inputId, index) => {
            const input = document.getElementById(inputId);
            if (input) {
                input.addEventListener('change', function () {
                    previewImage(this, `preview${index + 1}`);
                });
            }
        });
    });
</script>

<script>
    // جستجوی اطلاعات مشتری با کد ملی
    document.getElementById('search-button').addEventListener('click', function () {
        const codemelli = document.getElementById('codemelli').value;

        // ارسال درخواست به سرور برای جستجوی مشتری
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
                    // اگر مشتری پیدا شد، فرم را با اطلاعات پر کن
                    document.querySelector('[name="name"]').value = data.data.name;
                    document.querySelector('[name="mobile"]').value = data.data.mobile;
                    document.querySelector('[name="phone"]').value = data.data.phone;
                    document.querySelector('[name="address"]').value = data.data.address;
                    document.querySelector('[name="codeposti"]').value = data.data.codeposti;
                    document.querySelector('[name="passport"]').value = data.data.passport;

                    // تنظیم استان و شهر
                    const provinceSelect = document.querySelector('[name="ostan"]');
                    provinceSelect.value = data.data.ostan;

                    // تریگر رویداد change برای بارگذاری شهرها
                    const event = new Event('change');
                    provinceSelect.dispatchEvent(event);

                    // تنظیم شهر پس از بارگذاری لیست شهرها
                    setTimeout(() => {
                        const citySelect = document.querySelector('[name="shahr"]');
                        citySelect.value = data.data.shahr;
                    }, 100);

                } else if (data.status === 'not_found') {
                    // اگر مشتری پیدا نشد، فرم را خالی کن
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

    document.getElementById('customer-form').addEventListener('submit', function (e) {
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
    // مدیریت لیست شهرها بر اساس استان انتخاب شده
    document.addEventListener('DOMContentLoaded', function () {
        const provinceSelect = document.querySelector('select[name="ostan"]');
        const citySelect = document.querySelector('select[name="shahr"]');
        const cities = <?php echo json_encode(ProvinceHelper::getCities()); ?>;

        // به روزرسانی لیست شهرها وقتی استان تغییر می‌کند
        provinceSelect.addEventListener('change', function () {
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
    // جستجوی اطلاعات کارت با سریال
    document.getElementById('search-button-2').addEventListener('click', function () {
        const serial = document.getElementById('serial').value;

        // ارسال درخواست به سرور برای جستجوی کارت
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
                    // اگر کارت پیدا شد، فرم را با اطلاعات پر کن
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
                    // اگر کارت پیدا نشد، فرم را خالی کن
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

    document.getElementById('customer-form').addEventListener('submit', function (e) {
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



</body>


</html>