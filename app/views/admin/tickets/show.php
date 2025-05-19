<?php

use Hekmatinasser\Verta\Verta;
?>
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
                    <h4 class="mb-sm-0 text-lg font-semibold grow text-gray-800 dark:text-gray-100">جزئیات تیکت</h4>
                    <nav class="flex" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 ltr:md:space-x-3 rtl:md:space-x-0">
                            <li class="inline-flex items-center">
                                <a href="<?php echo URLROOT; ?>/tickets/admin"
                                    class="inline-flex items-center text-sm font-medium text-gray-800 hover:text-gray-900 dark:text-zinc-100 dark:hover:text-white">
                                    تیکت‌ها
                                </a>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 text-gray-400 -rotate-180" fill="currentColor"
                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    <a href="#"
                                        class="ltr:ml-1 rtl:mr-1 text-sm font-medium text-gray-500 hover:text-gray-900 ltr:md:ml-2 rtl:md:mr-2 dark:text-gray-100 dark:hover:text-white">جزئیات
                                        تیکت</a>
                                </div>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-5">
                <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                    <div class="card-body">
                        <!-- اطلاعات تیکت -->
                        <div class="mb-6">
                            <h5 class="text-lg font-bold mb-2 text-violet-600 dark:text-violet-400">اطلاعات تیکت</h5>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                <div><b>شماره تیکت:</b> <?php echo htmlspecialchars($data['ticket']->ticket_number); ?>
                                </div>
                                <div><b>موضوع:</b> <?php echo htmlspecialchars($data['ticket']->subject); ?></div>
                                <div><b>وضعیت:</b>
                                    <span class="px-2.5 py-0.5 rounded-full text-xs font-medium
                                        <?php
                                        switch ($data['ticket']->status) {
                                            case 'open':
                                                echo 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300';
                                                break;
                                            case 'in_progress':
                                                echo 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300';
                                                break;
                                            case 'waiting':
                                                echo 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300';
                                                break;
                                            case 'resolved':
                                                echo 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300';
                                                break;
                                            default:
                                                echo 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300';
                                        }
                                        ?>">
                                        <?php
                                        switch ($data['ticket']->status) {
                                            case 'open':
                                                echo 'باز';
                                                break;
                                            case 'in_progress':
                                                echo 'در حال انجام';
                                                break;
                                            case 'waiting':
                                                echo 'در انتظار';
                                                break;
                                            case 'resolved':
                                                echo 'حل شده';
                                                break;
                                            default:
                                                echo $data['ticket']->status;
                                        }
                                        ?>
                                    </span>
                                </div>
                                <div><b>اولویت:</b>
                                    <span class="px-2.5 py-0.5 rounded-full text-xs font-medium
                                        <?php
                                        switch ($data['ticket']->priority) {
                                            case 'low':
                                                echo 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300';
                                                break;
                                            case 'medium':
                                                echo 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300';
                                                break;
                                            case 'high':
                                                echo 'bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-300';
                                                break;
                                            case 'urgent':
                                                echo 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300';
                                                break;
                                            default:
                                                echo 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300';
                                        }
                                        ?>">
                                        <?php
                                        switch ($data['ticket']->priority) {
                                            case 'low':
                                                echo 'کم';
                                                break;
                                            case 'medium':
                                                echo 'متوسط';
                                                break;
                                            case 'high':
                                                echo 'زیاد';
                                                break;
                                            case 'urgent':
                                                echo 'فوری';
                                                break;
                                            default:
                                                echo $data['ticket']->priority;
                                        }
                                        ?>
                                    </span>
                                </div>
                                <div><b>ایجادکننده:</b>
                                    <?php echo htmlspecialchars($data['ticket']->created_by_name); ?></div>
                                <div><b>اختصاص یافته به:</b>
                                    <?php echo $data['ticket']->assigned_to_name ? htmlspecialchars($data['ticket']->assigned_to_name) : '-'; ?>
                                </div>
                                <div><b>تاریخ ایجاد:</b>
                                    <?php
                                    $shamsiDate = new Verta($data['ticket']->created_at);
                                    echo $shamsiDate->format('Y/m/d _ H:i');
                                    ?>
                                </div>

                            </div>
                        </div>

                        <!-- پیام‌های تیکت -->
                        <div class="mb-6">
                            <h5 class="text-lg font-bold mb-2 text-violet-600 dark:text-violet-400">پیام‌ها</h5>
                            <div class="space-y-4">
                                <!-- نمایش متن اصلی تیکت به عنوان اولین پیام -->
                                <div
                                    class="p-4 rounded-lg border dark:border-zinc-600 bg-violet-50 dark:bg-violet-900/20">
                                    <div class="flex items-center mb-2">
                                        <span class="font-semibold text-violet-700 dark:text-violet-300">
                                            ایجادکننده -
                                            <?php echo htmlspecialchars($data['ticket']->created_by_name); ?>
                                        </span>
                                        <span
                                            class="text-sm text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-zinc-600 px-2 py-1 rounded">
                                            <?php
                                            $ticketDate = new Verta($data['ticket']->created_at);
                                            echo $ticketDate->format('Y/m/d _ H:i');
                                            ?>
                                        </span>
                                    </div>
                                    <div class="text-gray-700 dark:text-gray-100 mb-2">
                                        <?php echo nl2br(htmlspecialchars($data['ticket']->description)); ?>
                                    </div>
                                    <?php
                                    // برای دیباگ
                                    // var_dump($data['ticket']->attach); 
                                    if (!empty($data['ticket']->attach)): ?>
                                        <div>
                                            <a href="<?php echo URLROOT . '/' . $data['ticket']->attach; ?>" target="_blank"
                                                class="text-blue-600 dark:text-blue-400 underline">دانلود پیوست</a>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- نمایش سایر پیام‌ها -->
                                <?php if (!empty($data['messages'])): ?>
                                    <?php foreach ($data['messages'] as $msg): ?>
                                        <div
                                            class="p-4 rounded-lg border dark:border-zinc-600 <?php echo $msg->sender == $data['ticket']->created_by ? 'bg-violet-50 dark:bg-violet-900/20' : 'bg-gray-50 dark:bg-zinc-700/50'; ?>">
                                            <div class="flex items-center justify-between mb-2">
                                                <span class="font-semibold text-violet-700 dark:text-violet-300">
                                                    <?php
                                                    // نقش ارسال‌کننده
                                                    if ($msg->sender == $data['ticket']->created_by) {
                                                        echo 'ایجادکننده';
                                                    } elseif ($msg->sender == $data['ticket']->assigned_to) {
                                                        echo 'پاسخ‌دهنده';
                                                    } else {
                                                        echo 'کاربر';
                                                    }
                                                    ?>
                                                    -
                                                    <?php echo htmlspecialchars($msg->sender_name); ?>
                                                </span>
                                                <span
                                                    class="text-sm text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-zinc-600 px-2 py-1 rounded mr-4">
                                                    <?php
                                                    $msgDate = new Verta($msg->created_at);
                                                    echo $msgDate->format('Y/m/d _ H:i');
                                                    ?>
                                                </span>
                                            </div>
                                            <div class="text-gray-700 dark:text-gray-100 mb-2">
                                                <?php echo nl2br(htmlspecialchars($msg->dex)); ?>
                                            </div>
                                            <?php if (!empty($msg->attach)): ?>
                                                <div>
                                                    <a href="<?php echo URLROOT . '/' . $msg->attach; ?>" target="_blank"
                                                        class="text-blue-600 dark:text-blue-400 underline">دانلود پیوست</a>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- فرم پاسخ به تیکت -->
                        <?php if ($_SESSION['id'] == $data['ticket']->created_by || $_SESSION['id'] == $data['ticket']->assigned_to): ?>
                            <?php if ($data['ticket']->status !== 'closed'): ?>
                                <div class="flex justify-end mb-4">
                                    <?php if ($_SESSION['id'] == $data['ticket']->created_by): ?>
                                        <form
                                            action="<?php echo URLROOT; ?>/tickets/updateStatus/<?php echo $data['ticket']->id; ?>"
                                            method="POST" class="inline">
                                            <input type="hidden" name="status" value="closed">
                                            <button type="submit"
                                                class="px-4 py-2 text-sm font-medium text-white bg-red-500 rounded hover:bg-red-600">بستن
                                                تیکت</button>
                                        </form>
                                    <?php endif; ?>
                                </div>

                                <div>
                                    <h5 class="text-lg font-bold mb-2 text-violet-600 dark:text-violet-400">ارسال پاسخ جدید</h5>
                                    <form action="<?php echo URLROOT; ?>/tickets/reply/<?php echo $data['ticket']->id; ?>"
                                        method="POST" enctype="multipart/form-data" class="space-y-4">
                                        <div>
                                            <textarea name="message" rows="4"
                                                class="input-field w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100 text-right"
                                                placeholder="متن پیام خود را وارد کنید..." required></textarea>
                                        </div>
                                        <div>
                                            <label for="attach"
                                                class="block font-medium text-gray-700 dark:text-gray-100 mb-2">پیوست فایل
                                                (اختیاری)</label>
                                            <input type="file" name="attach" id="attach"
                                                class="input-field w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100"
                                                accept="image/*,.pdf,.doc,.docx,.xls,.xlsx">
                                        </div>
                                        <div class="flex justify-end">
                                            <button type="submit"
                                                class="px-4 py-2 text-sm font-medium text-white bg-violet-500 rounded hover:bg-violet-600">ارسال
                                                پاسخ</button>
                                        </div>
                                    </form>
                                </div>
                            <?php else: ?>
                                <div
                                    class="p-4 rounded-lg bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800">
                                    <p class="text-red-700 dark:text-red-300">این تیکت بسته شده است و امکان پاسخ دادن وجود
                                        ندارد.</p>
                                </div>
                            <?php endif; ?>
                        <?php else: ?>
                            <div
                                class="p-4 rounded-lg bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800">
                                <p class="text-yellow-700 dark:text-yellow-300">شما مجاز به پاسخ دادن به این تیکت نیستید.
                                </p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once(APPROOT . "/views/public/footer.php"); ?>