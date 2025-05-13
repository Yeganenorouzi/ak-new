<?php require_once(APPROOT . "/views/public/header.php"); ?>
<?php
if ($_SESSION['is_admin'] == 1) {
    require_once(APPROOT . "/views/public/sidebar.php");
} else {
    require_once(APPROOT . "/views/public/sidebarAgent.php");
}
?>
<div class="main-content">
    <div class="page-content dark:bg-zinc-700">
        <div class="container-fluid px-[0.625rem]">
            <div class="grid grid-cols-1 mb-5">
                <div class="flex items-center justify-between">
                    <h4 class="mb-sm-0 text-lg font-semibold grow text-gray-800 dark:text-gray-100">ایجاد تیکت جدید</h4>
                    <nav class="flex" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 ltr:md:space-x-3 rtl:md:space-x-0">
                            <li class="inline-flex items-center">
                                <a href="<?php echo URLROOT; ?>/tickets/admin" class="inline-flex items-center text-sm font-medium text-gray-800 hover:text-gray-900 dark:text-zinc-100 dark:hover:text-white">
                                    تیکت‌ها
                                </a>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 text-gray-400 -rotate-180" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <a href="#" class="ltr:ml-1 rtl:mr-1 text-sm font-medium text-gray-500 hover:text-gray-900 ltr:md:ml-2 rtl:md:mr-2 dark:text-gray-100 dark:hover:text-white">ایجاد تیکت جدید</a>
                                </div>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="grid grid-cols-1">
                <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                    <div class="card-body">
                        <?php if (isset($data['error'])): ?>
                            <div class="mb-6 p-4 rounded-lg bg-red-50 border border-red-200 dark:bg-red-900/20 dark:border-red-500/30">
                                <div class="flex items-center mb-2">
                                    <svg class="w-5 h-5 text-red-500 dark:text-red-400 ml-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                    </svg>
                                    <h3 class="text-lg font-semibold text-red-800 dark:text-red-400">خطا</h3>
                                </div>
                                <p class="text-red-600 dark:text-red-400 text-sm">
                                    <?php echo $data['error']; ?>
                                </p>
                            </div>
                        <?php endif; ?>

                        <form action="<?php echo URLROOT; ?>/tickets/store" method="POST" enctype="multipart/form-data" class="max-w-2xl">
                            <div class="grid grid-cols-1 gap-5">
                                <!-- موضوع تیکت -->
                                <div>
                                    <label for="subject" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">موضوع تیکت</label>
                                    <input
                                        type="text"
                                        name="subject"
                                        id="subject"
                                        class="input-field w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100 text-right"
                                        placeholder="موضوع تیکت را وارد کنید"
                                        value="<?php echo $data['data']['subject'] ?? ''; ?>"
                                        required>
                                </div>

                                <!-- توضیحات تیکت -->
                                <div>
                                    <label for="description" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">توضیحات تیکت</label>
                                    <textarea
                                        name="description"
                                        id="description"
                                        class="input-field w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100 text-right"
                                        rows="5"
                                        placeholder="توضیحات تیکت را وارد کنید"
                                        required><?php echo $data['data']['description'] ?? ''; ?></textarea>
                                </div>

                                <!-- اولویت تیکت -->
                                <div>
                                    <label for="priority" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">اولویت تیکت</label>
                                    <select
                                        name="priority"
                                        id="priority"
                                        class="input-field w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100 text-right"
                                        required>
                                        <option value="low" <?php echo (isset($data['data']['priority']) && $data['data']['priority'] == 'low') ? 'selected' : ''; ?>>کم</option>
                                        <option value="medium" <?php echo (isset($data['data']['priority']) && $data['data']['priority'] == 'medium') ? 'selected' : ''; ?>>متوسط</option>
                                        <option value="high" <?php echo (isset($data['data']['priority']) && $data['data']['priority'] == 'high') ? 'selected' : ''; ?>>زیاد</option>
                                        <option value="urgent" <?php echo (isset($data['data']['priority']) && $data['data']['priority'] == 'urgent') ? 'selected' : ''; ?>>فوری</option>
                                    </select>
                                </div>

                                <!-- اختصاص به کاربر -->
                                <div class="mb-4">
                                    <label for="assigned_to" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        <?php echo $_SESSION['is_admin'] == 1 ? 'اختصاص به' : 'ارسال به ادمین'; ?>
                                    </label>
                                    <select name="assigned_to" id="assigned_to" class="w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100">
                                        <option value="">انتخاب کنید</option>
                                        <?php foreach ($data['users'] as $user): ?>
                                            <option value="<?php echo $user->id; ?>"><?php echo $user->name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <!-- پیوست فایل -->
                                <div>
                                    <label for="attach" class="block font-medium text-gray-700 dark:text-gray-100 mb-2">پیوست فایل</label>
                                    <input
                                        type="file"
                                        name="attach"
                                        id="attach"
                                        class="input-field w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                        accept="image/*,.pdf,.doc,.docx,.xls,.xlsx">
                                    <div class="mt-2">
                                        <img id="preview" src="#" alt="پیش نمایش تصویر" class="hidden rounded-lg" style="width: 150px; height: 150px; object-fit: cover;">
                                    </div>
                                </div>

                                <!-- دکمه‌های عملیات -->
                                <div class="flex justify-end gap-2">
                                    <a href="<?php echo URLROOT; ?>/tickets/admin" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded hover:bg-gray-200 dark:bg-zinc-600 dark:text-gray-300 dark:hover:bg-zinc-500">
                                        انصراف
                                    </a>
                                    <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-violet-500 rounded hover:bg-violet-600">
                                        ایجاد تیکت
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function previewImage(input) {
    const preview = document.getElementById('preview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('hidden');
        }
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.src = '#';
        preview.classList.add('hidden');
    }
}

document.getElementById('attach').addEventListener('change', function() {
    previewImage(this);
});
</script>

<?php require_once(APPROOT . "/views/public/footer.php"); ?>