<?php require_once(APPROOT . "/views/public/header.php"); ?>
<?php require_once(APPROOT . "/views/public/sidebar.php"); ?>

<div class="main-content">
    <div class="page-content dark:bg-zinc-700">
        <div class="grid grid-cols-1 mb-5">
            <div class="flex items-center justify-between">
                <h4 class="mb-sm-0 text-lg font-semibold grow text-gray-800 dark:text-gray-100">ویرایش کارت گارانتی</h4>
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 ltr:md:space-x-3 rtl:md:space-x-0">
                        <li class="inline-flex items-center">
                            <a href="#" class="inline-flex items-center text-sm font-medium text-gray-800 hover:text-gray-900 dark:text-zinc-100 dark:hover:text-white">
                                کارت گارانتی ها
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 text-gray-400 -rotate-180" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <a href="#" class="ltr:ml-1 rtl:mr-1 text-sm font-medium text-gray-500 hover:text-gray-900 ltr:md:ml-2 rtl:md:mr-2 dark:text-gray-100 dark:hover:text-white">ویرایش کارت گارانتی</a>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="grid grid-cols-1">
            <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                <div class="card-body">
                    <div class="card-body">
                        <form action="<?php echo URLROOT; ?>/cards/update/<?php echo $data['card']->id; ?>" method="POST" enctype="multipart/form-data" class="max-w-2xl">
                            <div class="grid grid-cols-2 gap-5 mx-5">
                                <div class="col-span-1">
                                    <div class="mb-4">
                                        <label for="serial" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">سریال</label>
                                        <input
                                            name="serial"
                                            class="input-field w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                            type="text"
                                            placeholder="سریال را وارد کنید"
                                            id="serial"
                                            value="<?php echo isset($data['card']->serial) ? htmlspecialchars($data['card']->serial) : ''; ?>"
                                            required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="serial2" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">سریال 2</label>
                                        <input
                                            name="serial2"
                                            class="input-field w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                            type="text"
                                            placeholder="سریال 2 را وارد کنید"
                                            id="serial2"
                                            value="<?php echo htmlspecialchars($data['card']->serial2 ?? ''); ?>"
                                            required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="company" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">شرکت واردکننده</label>
                                        <input
                                            name="company"
                                            class="input-field w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                            type="text"
                                            placeholder="شرکت واردکننده را وارد کنید"
                                            id="company"
                                            value="<?php echo htmlspecialchars($data['card']->company ?? ''); ?>"
                                            required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="sh_sanad" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">شماره سند</label>
                                        <input
                                            name="sh_sanad"
                                            class="input-field w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                            type="text"
                                            placeholder="شماره سند را وارد کنید"
                                            id="sh_sanad"
                                            value="<?php echo htmlspecialchars($data['card']->sh_sanad ?? ''); ?>"
                                            required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="code_dastgah" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">کد دستگاه</label>
                                        <input
                                            name="code_dastgah"
                                            class="input-field w-full rounded border-gray-100 placeholder:text-sm focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:placeholder:text-zinc-100 dark:text-zinc-100"
                                            type="text"
                                            placeholder="کد دستگاه را وارد کنید"
                                            id="code_dastgah"
                                            value="<?php echo htmlspecialchars($data['card']->code_dastgah ?? ''); ?>"
                                            required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="title" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">نام دستگاه</label>
                                        <input
                                            name="title"
                                            class="input-field w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100 text-right"
                                            type="text"
                                            placeholder="نام دستگاه را وارد کنید"
                                            id="title"
                                            value="<?php echo htmlspecialchars($data['card']->title ?? ''); ?>"
                                            required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="coding_derakhtvare" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">کد درختواره </label>
                                        <input
                                            name="coding_derakhtvare"
                                            class="input-field w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                            type="text"
                                            placeholder="کد درختواره را وارد کنید"
                                            id="coding_derakhtvare"
                                            value="<?php echo htmlspecialchars($data['card']->coding_derakhtvare ?? ''); ?>"
                                            required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="model" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">مدل</label>
                                        <input
                                            name="model"
                                            class="input-field w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                            type="text"
                                            placeholder="مدل را وارد کنید"
                                            id="model"
                                            value="<?php echo htmlspecialchars($data['card']->model ?? ''); ?>"
                                            required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="start_guarantee" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">تاریخ شروع گارانتی</label>
                                        <input
                                            name="start_guarantee"
                                            class="input-field w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                            type="text"
                                            placeholder="تاریخ شروع گارانتی را وارد کنید"
                                            id="example-full-input"
                                            readonly="readonly"
                                            value="<?php echo htmlspecialchars($data['card']->start_guarantee ?? ''); ?>"
                                            required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="expite_guarantee" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">تاریخ انقضای گارانتی</label>
                                        <input
                                            name="expite_guarantee"
                                            class="input-field w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                            type="text"
                                            placeholder="تاریخ انقضای گارانتی را وارد کنید"
                                            id="example-full-input"
                                            readonly="readonly"
                                            value="<?php echo htmlspecialchars($data['card']->expite_guarantee ?? ''); ?>"
                                            required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="code_agent_service" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">کد نماینده خدمات</label>
                                        <input
                                            name="code_agent_service"
                                            class="input-field w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                            type="text"
                                            placeholder="کد نماینده خدمات را وارد کنید"
                                            id="code_agent_service"
                                            value="<?php echo htmlspecialchars($data['card']->code_agent_service ?? ''); ?>"
                                            required>
                                    </div>
                                </div>
                                <div class="col-span-1">
                                    <div class="mb-4">
                                        <label for="att1_code" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">ویژگی 1</label>
                                        <input
                                            name="att1_code"
                                            class="input-field w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                            type="text"
                                            placeholder=" ویژگی 1 را وارد کنید"
                                            id="att1_code"
                                            value="<?php echo htmlspecialchars($data['card']->att1_code ?? ''); ?>"
                                            required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="att1_val" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">کد ویژگی 1</label>
                                        <input
                                            name="att1_val"
                                            class="input-field w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                            type="text"
                                            placeholder="کد ویژگی 1 را وارد کنید"
                                            id="att1_val"
                                            value="<?php echo htmlspecialchars($data['card']->att1_val ?? ''); ?>"
                                            required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="att2_code" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">ویژگی 2</label>
                                        <input
                                            name="att2_code"
                                            class="input-field w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                            type="text"
                                            placeholder=" ویژگی 2 را وارد کنید"
                                            id="att2_code"
                                            value="<?php echo htmlspecialchars($data['card']->att2_code ?? ''); ?>"
                                            required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="att2_val" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">کد ویژگی 2</label>
                                        <input
                                            name="att2_val"
                                            class="input-field w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                            type="text"
                                            placeholder="کد ویژگی 2 را وارد کنید"
                                            id="att2_val"
                                            value="<?php echo htmlspecialchars($data['card']->att2_val ?? ''); ?>"
                                            required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="att3_code" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">ویژگی 3</label>
                                        <input
                                            name="att3_code"
                                            class="input-field w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                            type="text"
                                            placeholder=" ویژگی 3 را وارد کنید"
                                            id="att3_code"
                                            value="<?php echo htmlspecialchars($data['card']->att3_code ?? ''); ?>"
                                            required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="att3_val" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">کد ویژگی 3</label>
                                        <input
                                            name="att3_val"
                                            class="input-field w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                            type="text"
                                            placeholder="کد ویژگی 3 را وارد کنید"
                                            id="att3_val"
                                            value="<?php echo htmlspecialchars($data['card']->att3_val ?? ''); ?>"
                                            required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="att4_code" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">ویژگی 4</label>
                                        <input
                                            name="att4_code"
                                            class="input-field w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                            type="text"
                                            placeholder=" ویژگی 4 را وارد کنید"
                                            id="att4_code"
                                            value="<?php echo htmlspecialchars($data['card']->att4_code ?? ''); ?>"
                                            required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="att4_val" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">کد ویژگی 4</label>
                                        <input
                                            name="att4_val"
                                            class="input-field w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                            type="text"
                                            placeholder="کد ویژگی 4 را وارد کنید"
                                            id="att4_val"
                                            value="<?php echo htmlspecialchars($data['card']->att4_val ?? ''); ?>"
                                            required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="code_guarantee" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">کد گارانتی </label>
                                        <input
                                            name="code_guarantee"
                                            class="input-field w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                            type="text"
                                            placeholder="کد گارانتی را وارد کنید"
                                            id="code_guarantee"
                                            value="<?php echo htmlspecialchars($data['card']->code_guarantee ?? ''); ?>"
                                            required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="sharh_guarantee" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">شرح گارانتی</label>
                                        <input
                                            name="sharh_guarantee"
                                            class="input-field w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                            type="text"
                                            placeholder="شرح گارانتی را وارد کنید"
                                            id="sharh_guarantee"
                                            value="<?php echo htmlspecialchars($data['card']->sharh_guarantee ?? ''); ?>"
                                            required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="agent_service" class="block font-medium text-gray-700 dark:text-gray-100 mb-2"> نام نماینده خدمات</label>
                                        <input
                                            name="agent_service"
                                            class="input-field w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                            type="text"
                                            placeholder="نام نماینده خدمات را وارد کنید"
                                            id="agent_service"
                                            value="<?php echo htmlspecialchars($data['card']->agent_service ?? ''); ?>"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6 mx-5 flex gap-4">
                                <button type="submit" class="px-5 py-2.5 bg-violet-500 text-white rounded hover:bg-violet-600 focus:outline-none">
                                    ویرایش اطلاعات
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once(APPROOT . "/views/public/footer.php"); ?>
