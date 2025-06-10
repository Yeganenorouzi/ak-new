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

<div class="min-h-screen flex flex-col">
    <div class="flex-1 main-content mr-[240px]">
        <div class="page-content dark:bg-zinc-700">
            <div class="container-fluid px-[0.625rem]">
                <div class="col-span-12 xl:col-span-6">
                    <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                        <div class="card-header p-4">
                            <h3 class="card-title mb-sm-0 text-lg font-semibold grow text-gray-800 dark:text-gray-100">
                                مدیریت تیکت‌ها</h3>
                        </div>
                        <div class="card-body">
                            <div class="card-body p-0 mb-4">
                                <div
                                    class="bg-white dark:bg-zinc-800 border border-gray-200 dark:border-zinc-700 rounded-lg shadow-sm p-3 flex flex-col items-center">
                                    <form action="<?php echo URLROOT; ?>/tickets/admin" method="GET"
                                        class="filter-form w-full max-w-4xl grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 items-end">
                                        <div class="form-group flex flex-col">
                                            <label for="ticket_number"
                                                class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">شماره
                                                تیکت</label>
                                            <input type="text" id="ticket_number" name="ticket_number"
                                                value="<?php echo $_GET['ticket_number'] ?? ''; ?>"
                                                class="w-full max-w-20 h-8 text-xs rounded-md border-gray-300 shadow-sm focus:border-violet-500 focus:ring-violet-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white px-2">
                                        </div>
                                        <div class="form-group flex flex-col">
                                            <label for="status"
                                                class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">وضعیت</label>
                                            <select id="status" name="status"
                                                class="w-full h-8 text-xs rounded-md border-gray-300 shadow-sm focus:border-violet-500 focus:ring-violet-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white px-2">
                                                <option value="">همه</option>
                                                <option value="open" <?php echo (isset($_GET['status']) && $_GET['status'] == 'open') ? 'selected' : ''; ?>>باز</option>
                                                <option value="in_progress" <?php echo (isset($_GET['status']) && $_GET['status'] == 'in_progress') ? 'selected' : ''; ?>>در حال انجام
                                                </option>
                                                <option value="waiting" <?php echo (isset($_GET['status']) && $_GET['status'] == 'waiting') ? 'selected' : ''; ?>>در انتظار</option>
                                                <option value="resolved" <?php echo (isset($_GET['status']) && $_GET['status'] == 'resolved') ? 'selected' : ''; ?>>حل شده</option>
                                            </select>
                                        </div>
                                        <div class="form-group flex flex-col">
                                            <label for="priority"
                                                class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">اولویت</label>
                                            <select id="priority" name="priority"
                                                class="w-full h-8 text-xs rounded-md border-gray-300 shadow-sm focus:border-violet-500 focus:ring-violet-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white px-2">
                                                <option value="">همه</option>
                                                <option value="low" <?php echo (isset($_GET['priority']) && $_GET['priority'] == 'low') ? 'selected' : ''; ?>>کم</option>
                                                <option value="medium" <?php echo (isset($_GET['priority']) && $_GET['priority'] == 'medium') ? 'selected' : ''; ?>>متوسط</option>
                                                <option value="high" <?php echo (isset($_GET['priority']) && $_GET['priority'] == 'high') ? 'selected' : ''; ?>>زیاد</option>
                                                <option value="urgent" <?php echo (isset($_GET['priority']) && $_GET['priority'] == 'urgent') ? 'selected' : ''; ?>>فوری</option>
                                            </select>
                                        </div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div
                                            class="col-span-1 sm:col-span-2 lg:col-span-4 flex flex-wrap gap-2 justify-end mt-2">
                                            <button type="submit"
                                                class="inline-flex items-center px-3 py-1 bg-violet-600 text-white rounded-md hover:bg-violet-700 text-xs">
                                                <i class="fas fa-filter ml-2"></i>
                                                اعمال فیلتر
                                            </button>
                                            <a href="<?php echo URLROOT; ?>/tickets/admin"
                                                class="inline-flex items-center px-3 py-1 bg-gray-500 text-white rounded-md hover:bg-gray-600 text-xs">
                                                <i class="fas fa-times ml-2"></i>
                                                پاک کردن فیلترها
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="relative overflow-x-auto rounded-lg">
                                    <table class="w-full text-sm text-right text-gray-500">
                                        <thead
                                            class="text-xs text-gray-700 dark:text-gray-100 uppercase bg-gray-50/50 dark:bg-zinc-700/50">
                                            <tr>
                                                <th scope="col" class="px-4 py-3">شماره تیکت</th>
                                                <th scope="col" class="px-6 py-3">موضوع</th>
                                                <th scope="col" class="px-6 py-3">وضعیت</th>
                                                <th scope="col" class="px-6 py-3">اولویت</th>
                                                <th scope="col" class="px-6 py-3">ایجاد کننده</th>
                                                <th scope="col" class="px-6 py-3">اختصاص داده شده به</th>
                                                <th scope="col" class="px-6 py-3">تاریخ ایجاد</th>
                                                <th scope="col" class="px-6 py-3">عملیات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (empty($data['tickets'])): ?>
                                                <tr
                                                    class="bg-white border-b border-gray-100 dark:bg-zinc-700 dark:border-zinc-600">
                                                    <td colspan="8"
                                                        class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                                        هیچ نتیجه‌ای یافت نشد
                                                    </td>
                                                </tr>
                                            <?php else: ?>
                                                <?php foreach ($data['tickets'] as $ticket): ?>
                                                    <tr
                                                        class="bg-white border-b border-gray-100 hover:bg-gray-50/50 dark:bg-zinc-700 dark:hover:bg-zinc-700/50 dark:border-zinc-600">

                                                        <th scope="row"
                                                            class="px-4 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                            <?php echo $ticket->ticket_number; ?>
                                                        </th>
                                                        <td class="px-6 py-4"><?php echo $ticket->subject; ?></td>
                                                        <td class="px-6 py-4">
                                                            <span class="px-2.5 py-0.5 rounded-full text-xs font-medium
                                                                <?php
                                                                switch ($ticket->status) {
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
                                                                switch ($ticket->status) {
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
                                                        <td class="px-6 py-4">
                                                            <span class="px-2.5 py-0.5 rounded-full text-xs font-medium
                                                                <?php
                                                                switch ($ticket->priority) {
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
                                                                switch ($ticket->priority) {
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
                                                        <td class="px-6 py-4"><?php echo $ticket->created_by_name; ?></td>
                                                        <td class="px-6 py-4"><?php echo $ticket->assigned_to_name ?? '-'; ?>
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            <?php
                                                            $shamsiDate = new Verta($ticket->created_at);
                                                            echo $shamsiDate->format('Y/m/d _ H:i');
                                                            ?>
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            <div class="flex flex-row gap-2">
                                                                <a href="<?php echo URLROOT; ?>/tickets/show/<?php echo $ticket->id; ?>"
                                                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline">مشاهده</a>
                                                                <button type="button"
                                                                    onclick="showStatusModal(<?php echo $ticket->id; ?>)"
                                                                    class="font-medium text-violet-600 dark:text-violet-500 hover:underline">تغییر
                                                                    وضعیت</button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php if (isset($data['total_pages']) && $data['total_pages'] > 1): ?>
                <div
                    class="flex items-center justify-between mt-4 px-4 py-3 bg-white dark:bg-zinc-800 border-t border-gray-200 dark:border-zinc-700 sm:px-6">
                    <div class="flex-1 flex justify-between sm:hidden">
                        <?php if ($data['current_page'] > 1): ?>
                            <a href="<?php echo URLROOT; ?>/tickets/admin?page=<?php echo $data['current_page'] - 1; ?><?php echo isset($_GET['status']) ? '&status=' . $_GET['status'] : ''; ?><?php echo isset($_GET['priority']) ? '&priority=' . $_GET['priority'] : ''; ?><?php echo isset($_GET['ticket_number']) ? '&ticket_number=' . $_GET['ticket_number'] : ''; ?>"
                                class="relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-zinc-600 text-sm font-medium rounded-md text-gray-700 dark:text-gray-200 bg-white dark:bg-zinc-700 hover:bg-gray-50 dark:hover:bg-zinc-600">
                                قبلی
                            </a>
                        <?php endif; ?>
                        <?php if ($data['current_page'] < $data['total_pages']): ?>
                            <a href="<?php echo URLROOT; ?>/tickets/admin?page=<?php echo $data['current_page'] + 1; ?><?php echo isset($_GET['status']) ? '&status=' . $_GET['status'] : ''; ?><?php echo isset($_GET['priority']) ? '&priority=' . $_GET['priority'] : ''; ?><?php echo isset($_GET['ticket_number']) ? '&ticket_number=' . $_GET['ticket_number'] : ''; ?>"
                                class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-zinc-600 text-sm font-medium rounded-md text-gray-700 dark:text-gray-200 bg-white dark:bg-zinc-700 hover:bg-gray-50 dark:hover:bg-zinc-600">
                                بعدی
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <!-- اگر نمی‌خواهی متن نمایش بازه را نشان بدهی، این div را خالی بگذار یا حذف کن -->
                        </div>
                        <div>
                            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                <?php if ($data['current_page'] > 1): ?>
                                    <a href="<?php echo URLROOT; ?>/tickets/admin?page=<?php echo $data['current_page'] - 1; ?><?php echo isset($_GET['status']) ? '&status=' . $_GET['status'] : ''; ?><?php echo isset($_GET['priority']) ? '&priority=' . $_GET['priority'] : ''; ?><?php echo isset($_GET['ticket_number']) ? '&ticket_number=' . $_GET['ticket_number'] : ''; ?>"
                                        class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-sm font-medium text-gray-500 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-zinc-600">
                                        <span class="sr-only">قبلی</span>
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                <?php endif; ?>
                                <?php
                                $range = 2;
                                $start = max(1, $data['current_page'] - $range);
                                $end = min($data['total_pages'], $data['current_page'] + $range);
                                if ($start > 1) {
                                    echo '<a href="' . URLROOT . '/tickets/admin?page=1' . (isset($_GET['status']) ? '&status=' . $_GET['status'] : '') . (isset($_GET['priority']) ? '&priority=' . $_GET['priority'] : '') . (isset($_GET['ticket_number']) ? '&ticket_number=' . $_GET['ticket_number'] : '') . '" 
                                        class="relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-zinc-600 text-sm font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-zinc-700 hover:bg-gray-50 dark:hover:bg-zinc-600">
                                        1
                                      </a>';
                                    if ($start > 2) {
                                        echo '<span class="relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-sm font-medium text-gray-700 dark:text-gray-200">
                                            ...
                                          </span>';
                                    }
                                }
                                for ($i = $start; $i <= $end; $i++) {
                                    if ($i == $data['current_page']) {
                                        echo '<span class="relative inline-flex items-center px-4 py-2 border border-violet-500 bg-violet-50 dark:bg-violet-900/20 text-sm font-medium text-violet-600 dark:text-violet-400">
                                            ' . $i . '
                                          </span>';
                                    } else {
                                        echo '<a href="' . URLROOT . '/tickets/admin?page=' . $i . (isset($_GET['status']) ? '&status=' . $_GET['status'] : '') . (isset($_GET['priority']) ? '&priority=' . $_GET['priority'] : '') . (isset($_GET['ticket_number']) ? '&ticket_number=' . $_GET['ticket_number'] : '') . '" 
                                            class="relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-zinc-600 text-sm font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-zinc-700 hover:bg-gray-50 dark:hover:bg-zinc-600">
                                            ' . $i . '
                                          </a>';
                                    }
                                }
                                if ($end < $data['total_pages']) {
                                    if ($end < $data['total_pages'] - 1) {
                                        echo '<span class="relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-sm font-medium text-gray-700 dark:text-gray-200">
                                            ...
                                          </span>';
                                    }
                                    echo '<a href="' . URLROOT . '/tickets/admin?page=' . $data['total_pages'] . (isset($_GET['status']) ? '&status=' . $_GET['status'] : '') . (isset($_GET['priority']) ? '&priority=' . $_GET['priority'] : '') . (isset($_GET['ticket_number']) ? '&ticket_number=' . $_GET['ticket_number'] : '') . '" 
                                        class="relative inline-flex items-center px-4 py-2 border border-gray-300 dark:border-zinc-600 text-sm font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-zinc-700 hover:bg-gray-50 dark:hover:bg-zinc-600">
                                        ' . $data['total_pages'] . '
                                      </a>';
                                }
                                ?>
                                <?php if ($data['current_page'] < $data['total_pages']): ?>
                                    <a href="<?php echo URLROOT; ?>/tickets/admin?page=<?php echo $data['current_page'] + 1; ?><?php echo isset($_GET['status']) ? '&status=' . $_GET['status'] : ''; ?><?php echo isset($_GET['priority']) ? '&priority=' . $_GET['priority'] : ''; ?><?php echo isset($_GET['ticket_number']) ? '&ticket_number=' . $_GET['ticket_number'] : ''; ?>"
                                        class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 dark:border-zinc-600 bg-white dark:bg-zinc-700 text-sm font-medium text-gray-500 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-zinc-600">
                                        <span class="sr-only">بعدی</span>
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                <?php endif; ?>
                            </nav>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Modal تغییر وضعیت -->
    <div id="statusModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white rounded-lg shadow-lg dark:bg-zinc-700 p-5 max-w-md w-full">
            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-3">تغییر وضعیت تیکت</h3>
            <form id="statusForm" method="POST">
                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">وضعیت
                        جدید</label>
                    <select name="status" id="status"
                        class="w-full rounded border-gray-100 py-2.5 text-sm text-gray-500 focus:border focus:border-violet-500 focus:ring-0 dark:bg-zinc-700/50 dark:border-zinc-600 dark:text-zinc-100">
                        <option value="open">باز</option>
                        <option value="in_progress">در حال انجام</option>
                        <option value="waiting">در انتظار</option>
                        <option value="resolved">حل شده</option>
                    </select>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="hideStatusModal()"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded hover:bg-gray-200 dark:bg-zinc-600 dark:text-gray-300 dark:hover:bg-zinc-500">
                        انصراف
                    </button>
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-violet-500 rounded hover:bg-violet-600">
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
</div>