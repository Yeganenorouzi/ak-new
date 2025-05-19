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
                    <h4 class="mb-sm-0 text-lg font-semibold grow text-gray-800 dark:text-gray-100">مدیریت تیکت‌ها</h4>
                    <nav class="flex" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 ltr:md:space-x-3 rtl:md:space-x-0">
                            <li class="inline-flex items-center">
                                <a href="#" class="inline-flex items-center text-sm font-medium text-gray-800 hover:text-gray-900 dark:text-zinc-100 dark:hover:text-white">
                                    تیکت‌ها
                                </a>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 text-gray-400 -rotate-180" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <a href="#" class="ltr:ml-1 rtl:mr-1 text-sm font-medium text-gray-500 hover:text-gray-900 ltr:md:ml-2 rtl:md:mr-2 dark:text-gray-100 dark:hover:text-white">لیست تیکت‌ها</a>
                                </div>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="col-span-12 xl:col-span-6">
                <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                    <!-- فرم فیلتر -->
                    <div class="card-header px-4">
                        <form action="<?php echo URLROOT; ?>/tickets/admin" method="GET" class="flex flex-wrap items-end gap-3">
                            <div class="w-[180px] p-2">
                                <label for="ticket_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">شماره تیکت</label>
                                <input type="text" name="ticket_number" id="ticket_number" value="<?php echo $_GET['ticket_number'] ?? ''; ?>" 
                                    class="w-full rounded border-gray-100 py-1.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100" 
                                    placeholder="شماره تیکت">
                            </div>
                            <div class="w-[180px] p-2">
                                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">وضعیت</label>
                                <select name="status" id="status" class="w-full rounded border-gray-100 py-1.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100">
                                    <option value="">همه</option>
                                    <option value="open" <?php echo (isset($_GET['status']) && $_GET['status'] == 'open') ? 'selected' : ''; ?>>باز</option>
                                    <option value="in_progress" <?php echo (isset($_GET['status']) && $_GET['status'] == 'in_progress') ? 'selected' : ''; ?>>در حال انجام</option>
                                    <option value="waiting" <?php echo (isset($_GET['status']) && $_GET['status'] == 'waiting') ? 'selected' : ''; ?>>در انتظار</option>
                                    <option value="resolved" <?php echo (isset($_GET['status']) && $_GET['status'] == 'resolved') ? 'selected' : ''; ?>>حل شده</option>
                                </select>
                            </div>
                            <div class="w-[180px] p-2">
                                <label for="priority" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">اولویت</label>
                                <select name="priority" id="priority" class="w-full rounded border-gray-100 py-1.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100">
                                    <option value="">همه</option>
                                    <option value="low" <?php echo (isset($_GET['priority']) && $_GET['priority'] == 'low') ? 'selected' : ''; ?>>کم</option>
                                    <option value="medium" <?php echo (isset($_GET['priority']) && $_GET['priority'] == 'medium') ? 'selected' : ''; ?>>متوسط</option>
                                    <option value="high" <?php echo (isset($_GET['priority']) && $_GET['priority'] == 'high') ? 'selected' : ''; ?>>زیاد</option>
                                    <option value="urgent" <?php echo (isset($_GET['priority']) && $_GET['priority'] == 'urgent') ? 'selected' : ''; ?>>فوری</option>
                                </select>
                            </div>
                            <div class="flex gap-2 p-2">
                                <button type="submit" class="px-3 py-1.5 text-sm font-medium text-white bg-violet-500 rounded hover:bg-violet-600">
                                    اعمال فیلتر
                                </button>
                                <a href="<?php echo URLROOT; ?>/tickets/admin" class="px-3 py-1.5 text-sm font-medium text-gray-700 bg-gray-100 rounded hover:bg-gray-200 dark:bg-zinc-600 dark:text-gray-300 dark:hover:bg-zinc-500">
                                    پاک کردن
                                </a>
                            </div>
                        </form>
                    </div>

                    <div class="card-body">
                        <div class="relative overflow-x-auto rounded-lg">
                            <table class="w-full text-sm text-right text-gray-500">
                                <thead class="text-xs text-gray-700 dark:text-gray-100 uppercase bg-gray-50/50 dark:bg-zinc-700/50">
                                    <tr>
                                        
                                        <th scope="col" class="px-4 py-3">شماره تیکت</th>
                                        <th scope="col" class="px-4 py-3">موضوع</th>
                                        <th scope="col" class="px-4 py-3">وضعیت</th>
                                        <th scope="col" class="px-4 py-3">اولویت</th>
                                        <th scope="col" class="px-4 py-3">ایجاد کننده</th>
                                        <th scope="col" class="px-4 py-3">اختصاص داده شده به</th>
                                        <th scope="col" class="px-4 py-3">تاریخ ایجاد</th>
                                        <th scope="col" class="px-4 py-3">عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data['tickets'] as $ticket): ?>
                                        <tr class="bg-white border-b border-gray-100 hover:bg-gray-50/50 dark:bg-zinc-700 dark:hover:bg-zinc-700/50 dark:border-zinc-600">
                                            
                                            <td class="px-4 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                <?php echo $ticket->ticket_number; ?>
                                            </td>
                                            <td class="px-4 py-4"><?php echo $ticket->subject; ?></td>
                                            <td class="px-4 py-4">
                                                <span class="px-2.5 py-0.5 rounded-full text-xs font-medium
                                                    <?php
                                                    switch($ticket->status) {
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
                                                    switch($ticket->status) {
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
                                                            echo $ticket->status;
                                                    }
                                                    ?>
                                                </span>
                                            </td>
                                            <td class="px-4 py-4">
                                                <span class="px-2.5 py-0.5 rounded-full text-xs font-medium
                                                    <?php
                                                    switch($ticket->priority) {
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
                                                    switch($ticket->priority) {
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
                                                            echo $ticket->priority;
                                                    }
                                                    ?>
                                                </span>
                                            </td>
                                            <td class="px-4 py-4"><?php echo $ticket->created_by_name; ?></td>
                                            <td class="px-4 py-4"><?php echo $ticket->assigned_to_name ?? '-'; ?></td>
                                            <td class="px-4 py-4">
                                                <?php
                                                    $shamsiDate = new Verta($ticket->created_at);
                                                    echo $shamsiDate->format('Y/m/d _ H:i');
                                                ?>
                                            </td>
                                            <td class="px-4 py-4">
                                                <div class="flex items-center gap-2">
                                                    <a href="<?php echo URLROOT; ?>/tickets/show/<?php echo $ticket->id; ?>" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300" title="مشاهده">
                                                        <i class="bx bx-show text-xl"></i>
                                                    </a>
                                                    <!-- <a href="<?php echo URLROOT; ?>/tickets/reply/<?php echo $ticket->id; ?>" class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300" title="پاسخ">
                                                        <i class="bx bx-reply text-xl"></i>
                                                    </a> -->
                                                    <button type="button" class="text-violet-600 hover:text-violet-900 dark:text-violet-400 dark:hover:text-violet-300" title="تغییر وضعیت" onclick="showStatusModal(<?php echo $ticket->id; ?>)">
                                                        <i class="bx bx-refresh text-xl"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- پیجینیشن -->
                        <?php if ($data['total_pages'] > 1): ?>
                        <div class="flex justify-center mt-4">
                            <nav class="inline-flex rounded-md shadow">
                                <?php if ($data['current_page'] > 1): ?>
                                    <a href="<?php echo URLROOT; ?>/tickets/admin?page=<?php echo $data['current_page'] - 1; ?><?php echo isset($_GET['status']) ? '&status=' . $_GET['status'] : ''; ?><?php echo isset($_GET['priority']) ? '&priority=' . $_GET['priority'] : ''; ?><?php echo isset($_GET['ticket_number']) ? '&ticket_number=' . $_GET['ticket_number'] : ''; ?>" 
                                        class="px-3 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 dark:bg-zinc-700 dark:border-zinc-600 dark:text-gray-300 dark:hover:bg-zinc-600">
                                        قبلی
                                    </a>
                                <?php endif; ?>

                                <?php for ($i = 1; $i <= $data['total_pages']; $i++): ?>
                                    <a href="<?php echo URLROOT; ?>/tickets/admin?page=<?php echo $i; ?><?php echo isset($_GET['status']) ? '&status=' . $_GET['status'] : ''; ?><?php echo isset($_GET['priority']) ? '&priority=' . $_GET['priority'] : ''; ?><?php echo isset($_GET['ticket_number']) ? '&ticket_number=' . $_GET['ticket_number'] : ''; ?>" 
                                        class="px-3 py-2 border-t border-b border-gray-300 bg-white text-sm font-medium <?php echo $i == $data['current_page'] ? 'text-violet-600 bg-violet-50' : 'text-gray-700 hover:bg-gray-50'; ?> dark:bg-zinc-700 dark:border-zinc-600 dark:text-gray-300 dark:hover:bg-zinc-600">
                                        <?php echo $i; ?>
                                    </a>
                                <?php endfor; ?>

                                <?php if ($data['current_page'] < $data['total_pages']): ?>
                                    <a href="<?php echo URLROOT; ?>/tickets/admin?page=<?php echo $data['current_page'] + 1; ?><?php echo isset($_GET['status']) ? '&status=' . $_GET['status'] : ''; ?><?php echo isset($_GET['priority']) ? '&priority=' . $_GET['priority'] : ''; ?><?php echo isset($_GET['ticket_number']) ? '&ticket_number=' . $_GET['ticket_number'] : ''; ?>" 
                                        class="px-3 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 dark:bg-zinc-700 dark:border-zinc-600 dark:text-gray-300 dark:hover:bg-zinc-600">
                                        بعدی
                                    </a>
                                <?php endif; ?>
                            </nav>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal تغییر وضعیت -->
<div id="statusModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center">
    <div class="bg-white rounded-lg shadow-lg dark:bg-zinc-700 p-5 max-w-md w-full">
        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-3">تغییر وضعیت تیکت</h3>
        <form id="statusForm" method="POST">
            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">وضعیت جدید</label>
                <select name="status" id="status" class="w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100">
                    <option value="open">باز</option>
                    <option value="in_progress">در حال انجام</option>
                    <option value="waiting">در انتظار</option>
                    <option value="resolved">حل شده</option>
                </select>
            </div>
            <div class="flex justify-end gap-2">
                <button type="button" onclick="hideStatusModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded hover:bg-gray-200 dark:bg-zinc-600 dark:text-gray-300 dark:hover:bg-zinc-500">
                    انصراف
                </button>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-violet-500 rounded hover:bg-violet-600">
                    ذخیره تغییرات
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function showStatusModal(ticketId) {
    const modal = document.getElementById('statusModal');
    const form = document.getElementById('statusForm');
    form.action = `<?php echo URLROOT; ?>/tickets/updateStatus/${ticketId}`;
    modal.classList.remove('hidden');
}

function hideStatusModal() {
    const modal = document.getElementById('statusModal');
    modal.classList.add('hidden');
}
</script>

<?php require_once(APPROOT . "/views/public/footer.php"); ?>