<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>پرینت پذیرش #<?php echo $data['reception']->id; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/assets/css/iranSans.css">
    <style>
        body {
            font-family: 'IRANSans', 'iran-sans', tahoma !important;
        }

        @media print {
            @page {
                size: A5 landscape;
                margin: 0.3cm;
            }

            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            body {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
                font-size: 8px !important;
                width: 100% !important;
                margin: 0 !important;
                padding: 0.5cm !important;
            }

            .max-w-3xl {
                max-width: none !important;
                width: 100% !important;
            }

            .print-button {
                display: none !important;
            }

            .gap-2 {
                gap: 0.25rem !important;
            }

            .p-2 {
                padding: 0.25rem !important;
            }

            .mb-2 {
                margin-bottom: 0.25rem !important;
            }

            .mb-4 {
                margin-bottom: 0.5rem !important;
            }
        }
    </style>
    <?php

    use Hekmatinasser\Verta\Verta;

    ?>
</head>

<body class="p-2 text-[8px]">
    <button onclick="window.print()" class="print-button bg-blue-500 text-white px-4 py-2 rounded mb-4 print:hidden">پرینت</button>

    <div class="max-w-3xl mx-auto bg-white border-2 border-gray-100 rounded-lg shadow-md p-2">
        <!-- هدر -->
        <div class="text-center mb-2 border-b-2 border-gray-300 p-2">
            <h2 class="text-base font-bold mb-1">رسید پذیرش ضمانت ماندگار عدالت</h2>
            <div class="border rounded p-1 bg-gray-50">
                <div class="grid grid-cols-2 gap-1">
                    <div class="flex items-center">
                        <span class="font-bold ml-1">شماره پذیرش:</span>
                        <span><?php echo $data['reception']->id; ?></span>
                    </div>
                    <div class="flex items-center">
                        <span class="font-bold ml-1">تاریخ و ساعت:</span>
                        <span>
                            <?php
                            $datetime = new Verta($data['reception']->created_at);
                            echo $datetime->format('Y/m/d H:i');
                            ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-4">
            <!-- اطلاعات مشتری -->
            <div class="mb-2">
                <h4 class="text-[9px] font-bold bg-gray-200 p-1 rounded mb-1">اطلاعات مشتری</h4>
                <div class="grid grid-cols-2 gap-1 border border-gray-300 rounded p-2">
                    <div class="flex items-center">
                        <span class="font-bold ml-1 w-16">نام مشتری:</span>
                        <span><?php echo $data['reception']->name; ?></span>
                    </div>
                    <div class="flex items-center">
                        <span class="font-bold ml-1 w-16">کد ملی:</span>
                        <span><?php echo $data['reception']->codemelli; ?></span>
                    </div>
                    <div class="flex items-center">
                        <span class="font-bold ml-1 w-16">کد پاسپورت:</span>
                        <span><?php echo $data['reception']->passport; ?></span>
                    </div>
                    <div class="flex items-center">
                        <span class="font-bold ml-1 w-16">تلفن ثابت:</span>
                        <span><?php echo $data['reception']->phone; ?></span>
                    </div>
                    <div class="flex items-center">
                        <span class="font-bold ml-1 w-16">تلفن همراه:</span>
                        <span><?php echo $data['reception']->mobile; ?></span>
                    </div>

                    <div class="flex items-center">
                        <span class="font-bold ml-1 w-16">استان:</span>
                        <span><?php echo $data['reception']->ostan; ?></span>
                    </div>
                    <div class="flex items-center">
                        <span class="font-bold ml-1 w-16">شهر:</span>
                        <span><?php echo $data['reception']->shahr; ?></span>
                    </div>
                    <div class="flex items-center">
                        <span class="font-bold ml-1 w-16">کد پستی:</span>
                        <span><?php echo $data['reception']->codeposti; ?></span>
                    </div>
                    <div class="flex items-center col-span-2">
                        <span class="font-bold ml-1 w-16">آدرس:</span>
                        <span class="text-[7px]"><?php echo $data['reception']->address; ?></span>
                    </div>
                </div>
            </div>

            <!-- اطلاعات دستگاه -->
            <div class="mb-2">
                <h4 class="text-[9px] font-bold bg-gray-200 p-1 rounded mb-1">اطلاعات دستگاه</h4>
                <div class="grid grid-cols-2 gap-1 border border-gray-300 rounded p-2">
                    <div class="flex items-center col-span-2">
                        <span class="font-bold ml-1 w-16">مدل :</span>
                        <span class="text-[7px]"><?php echo $data['reception']->model; ?></span>
                    </div>

                    <div class="flex items-center">
                        <span class="font-bold ml-1 w-20 whitespace-nowrap">سریال اول:</span>
                        <span><?php echo $data['reception']->serial; ?></span>
                    </div>
                    <div class="flex items-center">
                        <span class="font-bold ml-1 w-20 whitespace-nowrap">سریال دوم:</span>
                        <span><?php echo $data['reception']->serial2; ?></span>
                    </div>
                    <div class="flex items-center">
                        <span class="font-bold ml-1 w-20 whitespace-nowrap">شرکت واردکننده:</span>
                        <span><?php echo $data['reception']->company; ?></span>
                    </div>
                    <div class="flex items-center">
                        <span class="font-bold ml-1 w-20 whitespace-nowrap">تاریخ فعالسازی :</span>
                        <span><?php echo $data['reception']->activation_start_date; ?></span>
                    </div>
                    <div class="flex items-center">
                        <span class="font-bold ml-1 w-22 whitespace-nowrap">تاریخ شروع گارانتی:</span>
                        <span><?php echo $data['reception']->start_guarantee; ?></span>
                    </div>
                    <div class="flex items-center">
                        <span class="font-bold ml-1 w-22 whitespace-nowrap">تاریخ انقضای گارانتی:</span>
                        <span><?php echo $data['reception']->expite_guarantee; ?></span>
                    </div>


                </div>
            </div>

            <!-- اطلاعات پذیرش -->
            <div class="mb-2">
                <h4 class="text-[9px] font-bold bg-gray-200 p-1 rounded mb-1">اطلاعات پذیرش</h4>
                <div class="grid grid-cols-2 gap-1 border border-gray-300 rounded p-2">
                    <div class="flex items-center">
                        <span class="font-bold ml-1 w-20 whitespace-nowrap"> نوع پذیرش :</span>
                        <span class="break-words"><?php echo $data['reception']->paziresh_status; ?></span>
                    </div>

                    <div class="flex items-center">
                        <span class="font-bold ml-1 w-20 whitespace-nowrap">وضعیت گارانتی</span>
                        <span><?php echo $data['reception']->guarantee_status; ?></span>
                    </div>
                    <div class="flex items-center">
                        <span class="font-bold ml-1 w-20 whitespace-nowrap">شرایط فیزیکی :</span>
                        <span><?php echo $data['reception']->situation; ?></span>
                    </div>
                    <div class="flex items-center">
                        <span class="font-bold ml-1 w-20 whitespace-nowrap"> زمان تقریبی:</span>
                        <span><?php echo $data['reception']->estimated_time; ?></span>
                    </div>

                    <div class="flex items-center">
                        <span class="font-bold ml-1 w-20 whitespace-nowrap">لوازم همراه :</span>
                        <span><?php
                                $accessories = $data['reception']->accessories;
                                $translations = [
                                    'box' => 'جعبه',
                                    'warrantycard' => 'کارت گارانتی',
                                    'adapter' => 'آداپتور',
                                    'cable' => 'کابل شارژ',
                                    'handsfree' => 'هندزفری',
                                    'pin' => 'سوزن'
                                    
                                ];
                                foreach ($translations as $en => $fa) {
                                    $accessories = str_ireplace($en, $fa, $accessories);
                                }
                                echo $accessories;
                                ?></span>
                    </div>
                    <div class="flex items-center">
                        <span class="font-bold ml-1 w-20 whitespace-nowrap"> هزینه تقریبی :</span>
                        <span><?php echo $data['reception']->estimated_cost; ?></span>
                    </div>

                    <div class="flex items-center col-span-2">
                        <span class="font-bold ml-1 w-20">ایراد دستگاه:</span>
                        <span class="text-[7px]"><?php echo $data['reception']->problem; ?></span>
                    </div>


                </div>
            </div>

            <!-- اطلاعات -->
            <div class="mb-2">
                <p class="text-[7px]">
                    لطفا در حفظ و نگهداری این رسید دقت فرمایید. آورنده آن صاحب کالا یا نماینده ذی صلاح وی محسوب میشود.
                    <br>
                    وضعیت نهایی گارانتی و هزینه قطعی تعمیر گوشی منوط به تشخیص بخش فنی شرکت بوده و در صورت عدم شمول شرایط گارانتی به هر دلیل به مشتری اطلاع رسانی خواهد شد.
                    <br>
                    در صورت وجود هر کدام از موارد زیر شرکت مسئولیتی در مقابل بازگرداندن گوشی به وضعیت اولیه (زمان رسید) نخواهد داشت:
                    <br>
                    الف: رطوبت خوردگی توسط هرگونه مایعات ب:تعمیر و یا دستکاری توسط افراد و مراکز غیر مجاز ج : هرگونه صدمه فیزیکی و ضربه خوردگی
                    <br>
                    چنانچه مشتری ظرف مدت 15 روز از زمان پذیرش جهت دریافت گوشی خود مراجعه ننماید دستگاه شامل هزینه های انبارداری خواهد شد.
                    <br>
                    شرکت مسئولیتی در خصوص حفظ اطلاعات فایل ها و برنامه های شخصی مشتریان، تهیه نسخه پشتیبان و محافظ صفحه نمایش نخواهد داشت.
                    <br>
                    دستگاه ها در زمان عودت به مشتری تست شده و سالم تحویل مشتری می گردد.
                    <br>
                    امضای مشتری در پایین این رسید به منزله قبول و تایید کلیه شرایط و توضیحات فوق می باشد.
                </p>
            </div>
            <hr>





            <!-- امضا و تایید -->
            <div class="grid grid-cols-2 gap-4 p-2 border-t-2 border-gray-300 bg-gray-50">
                <div class="space-y-1">
                    <div>
                        <span class="font-bold ml-1 w-20 whitespace-nowrap">آدرس: </span>
                        <span>هفت تیر، ابتدای پل کریمخان ، پلاک 63 ، طبقه همکف</span>
                    </div>
                    <div>
                        <span class="font-bold ml-1 w-20 whitespace-nowrap">ساعت کاری: </span>
                        <span>شنبه تا چهارشنبه ساعت 10 الی 16</span>
                    </div>
                    <div>
                        <span class="font-bold ml-1 w-20 whitespace-nowrap">نام و امضا پذیرشگر: </span>
                        <span><?php echo $_SESSION['name']; ?></span>
                    </div>

                </div>

                <!-- ستون امضاها -->
                <div class="space-y-1">
                    <div>
                        <span class="font-bold ml-1 w-20 whitespace-nowrap">وبسایت: </span>
                        <span>www.akwarranty.com</span>
                    </div>
                    <div>
                        <span class="font-bold ml-1 w-20 whitespace-nowrap">تلفن: </span>
                        <span>02145365</span>
                    </div>

                    <div class="mt-8">
                        <span class="font-bold ml-1 w-20 whitespace-nowrap">نام و امضا مشتری: </span>
                        <span><?php echo $data['reception']->name; ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.onload = function() {
            if (window.location.href.includes('/print/')) {
                setTimeout(function() {
                    window.print();
                }, 1000);
            }
        }

        document.querySelector('.print-button').addEventListener('click', function(e) {
            e.preventDefault();
            setTimeout(function() {
                window.print();
            }, 500);
        });
    </script>
</body>

</html>