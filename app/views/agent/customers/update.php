<?php
use Hekmatinasser\Verta\Verta;
?>
<?php require_once(APPROOT . "/views/public/header.php"); ?>
<?php require_once(APPROOT . "/views/public/sidebarAgent.php"); ?>

<div class="main-content">
    <div class="page-content dark:bg-zinc-700">

        <div class="container-fluid px-[0.625rem]">

            <div class="grid grid-cols-1 mb-5">
                <div class="flex items-center justify-between">
                    <h4 class="mb-sm-0 text-lg font-semibold grow text-gray-800 dark:text-gray-100"> اطلاعات مشتری </h4>
                    <nav class="flex" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 ltr:md:space-x-3 rtl:md:space-x-0">
                            <li class="inline-flex items-center">
                                <a href="#" class="inline-flex items-center text-sm font-medium text-gray-800 hover:text-gray-900 dark:text-zinc-100 dark:hover:text-white">
                                    مشتریان
                                </a>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 text-gray-400 -rotate-180" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <a href="#" class="ltr:ml-1 rtl:mr-1 text-sm font-medium text-gray-500 hover:text-gray-900 ltr:md:ml-2 rtl:md:mr-2 dark:text-gray-100 dark:hover:text-white">مشخصات مشتری </a>
                                </div>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>


            <div class="grid grid-cols-1">
                <div class="card dark:bg-zinc-800 dark:border-zinc-600">

                    <div class="card-body">
                        <form action="<?php echo URLROOT; ?>/customers/update/<?php echo $data['customer']->id; ?>" method="POST" enctype="multipart/form-data" class="max-w-full">
                            <?php if (!empty($data['errors'])): ?>
                                <div class="mb-6 p-4 rounded-lg bg-red-50 border border-red-200 dark:bg-red-900/20 dark:border-red-500/30">
                                    <div class="flex items-center mb-2">
                                        <svg class="w-5 h-5 text-red-500 dark:text-red-400 ml-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                        </svg>
                                        <h3 class="text-lg font-semibold text-red-800 dark:text-red-400">لطفاً خطاهای زیر را برطرف کنید:</h3>
                                    </div>
                                    <ul class="list-disc list-inside space-y-1">
                                        
                                        <?php foreach ($data['errors'] as $error): ?>
                                            <li class="text-red-600 dark:text-red-400 text-sm">
                                                <?php echo htmlspecialchars($error); ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>

                            <div class="grid grid-cols-2 gap-5 mx-5">
                                <div class="col-span-1">
                                    <div class="mb-4">
                                        <label for="name" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">نام و نام خانوادگی</label>
                                        <input
                                            name="name"
                                            class="input-field w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                            type="text"
                                            placeholder="نام و نام خانوادگی را وارد کنید"
                                            id="name"
                                            value="<?php echo htmlspecialchars($data['customer']->name ?? ''); ?>">
                                    </div>
                                    <div class="mb-4">
                                        <label for="codemelli" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">کد ملی</label>
                                        <input
                                            name="codemelli"
                                            class="input-field w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                            type="text"
                                            placeholder="کد ملی را وارد کنید"
                                            id="codemelli"
                                            value="<?php echo htmlspecialchars($data['customer']->codemelli ?? ''); ?>">
                                    </div>
                                    <div class="mb-4">
                                        <label for="passport" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">شماره پاسپورت</label>
                                        <input
                                            name="passport"
                                            class="input-field w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                            type="text"
                                            placeholder="شماره پاسپورت را وارد کنید"
                                            id="passport"
                                            value="<?php echo htmlspecialchars($data['customer']->passport ?? ''); ?>">
                                    </div>
                                    <div class="mb-4">
                                        <label for="mobile" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">شماره موبایل</label>
                                        <input
                                            name="mobile"
                                            class="input-field w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100 text-right"
                                            type="tel"
                                            placeholder="شماره موبایل را وارد کنید"
                                            id="mobile"
                                            value="<?php echo htmlspecialchars($data['customer']->mobile ?? ''); ?>">
                                    </div>
                                    <div class="mb-4">
                                        <label for="phone" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">شماره تلفن</label>
                                        <input
                                            name="phone"
                                            class="input-field w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100 text-right"
                                            type="tel"
                                            placeholder="شماره تلفن را وارد کنید"
                                            id="phone"
                                            value="<?php echo htmlspecialchars($data['customer']->phone ?? ''); ?>">
                                    </div>
                                </div>

                                <div class="col-span-1">
                                    <div class="mb-4">
                                        <label for="ostan" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">استان</label>
                                        <input
                                            name="ostan"
                                            class="input-field w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                            type="text"
                                            placeholder="استان را وارد کنید"
                                            id="ostan"
                                            value="<?php echo htmlspecialchars($data['customer']->ostan ?? ''); ?>">
                                    </div>
                                    <div class="mb-4">
                                        <label for="shahr" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">شهر</label>
                                        <input
                                            name="shahr"
                                            class="input-field w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                            type="text"
                                            placeholder="شهر را وارد کنید"
                                            id="shahr"
                                            value="<?php echo htmlspecialchars($data['customer']->shahr ?? ''); ?>">
                                    </div>
                                    <div class="mb-4">
                                        <label for="codeposti" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">کد پستی</label>
                                        <input
                                            name="codeposti"
                                            class="input-field w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                            type="text"
                                            placeholder="کد پستی را وارد کنید"
                                            id="codeposti"
                                            value="<?php echo htmlspecialchars($data['customer']->codeposti ?? ''); ?>">
                                    </div>
                                    <div class="mb-4">
                                        <label for="address" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">آدرس</label>
                                        <textarea
                                            name="address"
                                            class="w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                            style="height: 100px; resize: none;"
                                            type="text"
                                            placeholder="آدرس را وارد کنید"
                                            dir="rtl"
                                            id="address"><?php echo htmlspecialchars($data['customer']->address ?? ''); ?></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6">
                                <button type="submit" class="px-5 py-2.5 bg-violet-500 text-white rounded hover:bg-violet-600 focus:outline-none">
                                    ثبت اطلاعات
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- New Reception History Section -->
                <div class="card dark:bg-zinc-800 dark:border-zinc-600 mt-6">
                    <div class="card-header m-4">
                        <h4 class="mb-sm-0 text-lg font-semibold grow text-gray-800 dark:text-gray-100"> سوابق مشتری </h4>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($data['receptions'])): ?>
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm text-right text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-zinc-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">شماره پذیرش</th>
                                            <th scope="col" class="px-6 py-3">تاریخ و ساعت پذیرش</th>
                                            <th scope="col" class="px-6 py-3">شماره سریال</th>
                                            <th scope="col" class="px-6 py-3">مدل دستگاه</th>
                                            <th scope="col" class="px-6 py-3">وضعیت</th>
                                            <th scope="col" class="px-6 py-3">گزارش کار</th>
                                            <th scope="col" class="px-6 py-3">عملیات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        // Sort receptions by ID in descending order (highest ID first)
                                        usort($data['receptions'], function($a, $b) {
                                            return $b->id - $a->id;
                                        });
                                        
                                        foreach ($data['receptions'] as $reception): 
                                        ?>
                                            <tr class="bg-white border-b dark:bg-zinc-800 dark:border-zinc-700">
                                                <td class="px-6 py-4"><?php echo htmlspecialchars($reception->id); ?></td>
                                                <td class="px-6 py-4">
                                                <?php
                                                $shamsiDate = new Verta($reception->created_at);
                                                echo $shamsiDate->format('Y/m/d H:i');
                                                ?>
                                            </td>
                                                <td class="px-6 py-4"><?php echo htmlspecialchars($reception->serial); ?></td>
                                                <td class="px-6 py-4"><?php echo htmlspecialchars($reception->model); ?></td>
                                                <td class="px-6 py-4">
                                                    <span class="px-2 py-1 text-xs rounded-full <?php
                                                                                                echo $reception->product_status === 'تحویل به مشتری'
                                                                                                    ? 'bg-green-100 text-green-800'
                                                                                                    : 'bg-yellow-100 text-yellow-800'; ?>">
                                                        <?php echo htmlspecialchars($reception->product_status); ?>
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <?php echo htmlspecialchars($reception->kaar); ?>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <a href="<?php echo URLROOT; ?>/receptions/show/<?php echo $reception->id; ?>"
                                                        class="text-violet-500 hover:text-violet-700">مشاهده جزئیات</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <p class="text-gray-500 dark:text-gray-400 text-center py-4">هیچ سابقه پذیرشی برای این مشتری ثبت نشده است.</p>
                        <?php endif; ?>
                    </div>
                </div>

            </div>

            <!-- Modal -->
            <div id="successModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center">
                <div class="bg-white rounded-lg shadow-lg dark:bg-zinc-700 p-5 max-w-md w-full">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-3">عملیات موفق</h3>
                    <p class="text-gray-700 dark:text-gray-300">اطلاعات کاربر با موفقیت ثبت شد.</p>
                    <div class="mt-5 text-right">
                        <button id="closeModal" class="bg-violet-500 text-white px-4 py-2 rounded hover:bg-violet-600">
                            مشاهده لیست کاربران
                        </button>
                    </div>
                </div>
            </div>










            <?php require_once(APPROOT . "/views/public/footer.php"); ?>

            <script>
                function previewImage(input) {
                    const preview = document.getElementById('preview');
                    if (input.files && input.files[0]) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.src = e.target.result;
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                }
            </script>