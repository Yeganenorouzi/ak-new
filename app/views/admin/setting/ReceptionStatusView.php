<?php

use Hekmatinasser\Verta\Verta;
?>
<?php require_once(APPROOT . "/views/public/header.php"); ?>
<?php require_once(APPROOT . "/views/public/sidebar.php"); ?>

<style>
    .modal {
        z-index: 2000 !important;
        position: fixed !important;
        top: 0 !important;
        left: 0 !important;
        width: 100% !important;
        height: 100% !important;
        display: none !important;
    }

    .modal.show {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
    }

    .modal-backdrop {
        z-index: 1999 !important;
        position: fixed !important;
        top: 0 !important;
        left: 0 !important;
        width: 100% !important;
        height: 100% !important;
    }

    .modal-dialog {
        margin: auto !important;
        max-width: 500px !important;
        width: 90% !important;
    }

    .modal-content {
        position: relative !important;
        background: white !important;
        border-radius: 8px !important;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15) !important;
    }
</style>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card dark:bg-zinc-800 dark:border-zinc-600">
                        <div class="card-header">
                            <div class="flex justify-between items-center">
                                <h4 class="card-title mb-0 text-gray-700 dark:text-gray-100">انواع وضعیت پذیرش </h4>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addKaarModal">
                                    افزودن وضعیت پذیرش جدید
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <div class="relative overflow-x-auto rounded-lg">
                                <table class="w-full text-sm text-right text-gray-500">
                                    <thead
                                        class="text-xs text-gray-700 dark:text-gray-100 uppercase bg-gray-50/50 dark:bg-zinc-700/50">
                                        <tr>
                                            <th class="px-4 py-3">شناسه</th>
                                            <th class="px-6 py-3">نام وضعیت پذیرش</th>
                                            <th class="px-6 py-3">تاریخ ایجاد</th>
                                            <th class="px-6 py-3">آخرین بروزرسانی</th>
                                            <th class="px-6 py-3">عملیات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty($data['receptionstatuses'])): ?>
                                            <tr
                                                class="bg-white border-b border-gray-100 dark:bg-zinc-700 dark:border-zinc-600">
                                                <td colspan="5"
                                                    class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                                    هیچ نتیجه‌ای یافت نشد
                                                </td>
                                            </tr>
                                        <?php else: ?>
                                            <?php foreach ($data['receptionstatuses'] as $receptionstatus): ?>
                                                <tr
                                                    class="bg-white border-b border-gray-100 hover:bg-gray-50/50 dark:bg-zinc-700 dark:hover:bg-zinc-700/50 dark:border-zinc-600">
                                                    <td
                                                        class="px-4 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                        <?php echo $receptionstatus->id; ?>
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        <?php echo $receptionstatus->status; ?>
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        <?php
                                                        $shamsiDate = new Verta($receptionstatus->created_at);
                                                        echo $shamsiDate->format('Y/m/d H:i');
                                                        ?>
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        <?php
                                                        $shamsiDate = new Verta($receptionstatus->updated_at);
                                                        echo $shamsiDate->format('Y/m/d H:i');
                                                        ?>
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        <button type="button" class="btn btn-sm btn-info edit-receptionstatus"
                                                            data-id="<?php echo $receptionstatus->id; ?>"
                                                            data-receptionstatus="<?php echo htmlspecialchars($receptionstatus->status); ?>"
                                                            data-bs-toggle="modal" data-bs-target="#editReceptionstatusModal">
                                                            ویرایش
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-danger delete-receptionstatus"
                                                            data-id="<?php echo $receptionstatus->id; ?>" data-bs-toggle="modal"
                                                            data-bs-target="#deleteReceptionstatusModal">
                                                            حذف
                                                        </button>
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
    </div>

    <!-- Add Receptionstatus Modal -->
    <div class="modal fade" id="addReceptionstatusModal" tabindex="-1" aria-labelledby="addReceptionstatusModalLabel" aria-hidden="true"
        style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 2000;">
        <div class="modal-dialog modal-dialog-centered">
            <form action="<?php echo URLROOT; ?>/receptionstatuses/store" method="post" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addReceptionstatusModalLabel">افزودن وضعیت جدید</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="status" class="form-label">نام وضعیت</label>
                        <input type="text" class="form-control" id="status" name="status" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">انصراف</button>
                    <button type="submit" class="btn btn-primary">ثبت</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Kaar Modal -->
    <div class="modal fade" id="editReceptionstatusModal" tabindex="-1" aria-labelledby="editReceptionstatusModalLabel" aria-hidden="true"
        style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 2000;">
        <div class="modal-dialog modal-dialog-centered">
            <form action="<?php echo URLROOT; ?>/receptionstatuses/update" method="post" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editReceptionstatusModalLabel">ویرایش وضعیت پذیرش</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit-receptionstatus-id" name="id">
                    <div class="mb-3">
                        <label for="edit-receptionstatus" class="form-label">نام وضعیت پذیرش</label>
                        <input type="text" class="form-control" id="edit-receptionstatus" name="receptionstatus" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">انصراف</button>
                    <button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Kaar Modal -->
    <div class="modal fade" id="deleteReceptionstatusModal" tabindex="-1" aria-labelledby="deleteReceptionstatusModalLabel" aria-hidden="true"
        style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 2000;">
        <div class="modal-dialog modal-dialog-centered">
            <form action="<?php echo URLROOT; ?>/receptionstatuses/delete" method="post" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteReceptionstatusModalLabel">حذف وضعیت پذیرش</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
                </div>
                <div class="modal-body">
                        <input type="hidden" id="delete-receptionstatus-id" name="id">
                        <p>آیا مطمئن هستید که می‌خواهید این وضعیت پذیرش را حذف کنید؟</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">انصراف</button>
                    <button type="submit" class="btn btn-danger">حذف</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Edit Receptionstatus button click handlers
            document.querySelectorAll('.edit-receptionstatus').forEach(btn => {
                btn.addEventListener('click', function () {
                    document.getElementById('edit-receptionstatus-id').value = this.getAttribute('data-id');
                    document.getElementById('edit-receptionstatus').value = this.getAttribute('data-receptionstatus');
                }); 
            });

            // Delete Receptionstatus button click handlers
            document.querySelectorAll('.delete-receptionstatus').forEach(btn => {
                btn.addEventListener('click', function () {
                    document.getElementById('delete-receptionstatus-id').value = this.getAttribute('data-id');
                });
            });
        });
    </script>

    <?php require_once(APPROOT . "/views/public/footer.php"); ?>