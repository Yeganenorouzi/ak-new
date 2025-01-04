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

            body {
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

    <div class="max-w-3xl mx-auto bg-white">
        <!-- هدر -->
        <div class="text-center mb-2">
            <h2 class="text-base font-bold mb-1">رسید پذیرش</h2>
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

        <!-- اطلاعات مشتری -->
        <div class="mb-2">
            <h3 class="text-[9px] font-bold bg-gray-200 p-1 rounded mb-1">اطلاعات مشتری</h3>
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
            <h3 class="text-[9px] font-bold bg-gray-200 p-1 rounded mb-1">اطلاعات دستگاه</h3>
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
            <h3 class="text-[9px] font-bold bg-gray-200 p-1 rounded mb-1">اطلاعات پذیرش</h3>
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
                    <span class="font-bold ml-1 w-20 whitespace-nowrap"> ایراد دستگاه:</span>
                    <span><?php echo $data['reception']->problem; ?></span>
                </div>
                <div class="flex items-center">
                    <span class="font-bold ml-1 w-20 whitespace-nowrap">لوازم همراه :</span>
                    <span><?php
                            $accessories = $data['reception']->accessories;
                            $translations = [
                                'box' => 'جعبه',
                                'charger' => 'شارژر',
                                'cable' => 'کابل',
                                'adapter' => 'آداپتور',
                                'case' => 'قاب',
                                'cover' => 'کاور'
                            ];
                            foreach ($translations as $en => $fa) {
                                $accessories = str_ireplace($en, $fa, $accessories);
                            }
                            echo $accessories;
                            ?></span>
                </div>
                <div class="flex items-center">
                    <span class="font-bold ml-1 w-22 whitespace-nowrap"> هزینه تقریبی :</span>
                    <span><?php echo $data['reception']->estimated_cost; ?></span>
                </div>
                <div class="flex items-center">
                    <span class="font-bold ml-1 w-22 whitespace-nowrap"> زمان تقریبی:</span>
                    <span><?php echo $data['reception']->estimated_time; ?></span>
                </div>



            </div>
        </div>

        <!-- اطلاعات -->
        <div class="mb-2">
            <h3 class="text-[9px] font-bold bg-gray-200 p-1 rounded mb-1">توضیحات</h3>
            <p class="text-[7px]">
                لطفا در حفظ و نگهداری این رسید دقت فرمایید. آورنده آن صاحب کالا یا نماینده ذی صلاح وی محسوب میشود.
                <br>
                وضعیت نهایی گارانتی و هزینه قطعی تعمیر گوشی منوط به تشخیص بخش فنی شرکت بوده و در صورت عدم شمول شرایط گارانتی به هر دلیل به مشتری اطلاع رسانی خواهد شد.
                <br>



            </p>
        </div>





        <!-- امضا و تایید -->
        <div class="grid grid-cols-2 gap-2 mt-4 text-center">
            <div>
                <p class="font-bold mb-8 text-[9px]">امضای تحویل گیرنده</p>
                <div class="border-t border-black"></div>
            </div>
            <div>
                <p class="font-bold mb-8 text-[9px]">امضای تحویل دهنده</p>
                <div class="border-t border-black"></div>
            </div>
        </div>
    </div>

    <script>
        window.onload = function() {
            if (window.location.href.includes('/print/')) {
                window.print();
            }
        }
    </script>
</body>

</html>