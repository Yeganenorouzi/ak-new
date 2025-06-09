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
                                <h4 class="card-title mb-0 text-gray-700 dark:text-gray-100">انواع تعمیرات </h4>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addKaarModal">
                                    افزودن تعمیر جدید
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
                                            <th class="px-6 py-3">نام تعمیر</th>
                                            <th class="px-6 py-3">تاریخ ایجاد</th>
                                            <th class="px-6 py-3">آخرین بروزرسانی</th>
                                            <th class="px-6 py-3">عملیات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty($data['kaars'])): ?>
                                            <tr
                                                class="bg-white border-b border-gray-100 dark:bg-zinc-700 dark:border-zinc-600">
                                                <td colspan="5"
                                                    class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                                    هیچ نتیجه‌ای یافت نشد
                                                </td>
                                            </tr>
                                        <?php else: ?>
                                            <?php foreach ($data['kaars'] as $kaar): ?>
                                                <tr
                                                    class="bg-white border-b border-gray-100 hover:bg-gray-50/50 dark:bg-zinc-700 dark:hover:bg-zinc-700/50 dark:border-zinc-600">
                                                    <td
                                                        class="px-4 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                        <?php echo $kaar->id; ?>
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        <?php echo $kaar->kaar; ?>
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        <?php
                                                        $shamsiDate = new Verta($kaar->created_at);
                                                        echo $shamsiDate->format('Y/m/d H:i');
                                                        ?>
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        <?php
                                                        $shamsiDate = new Verta($kaar->updated_at);
                                                        echo $shamsiDate->format('Y/m/d H:i');
                                                        ?>
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        <button type="button" class="btn btn-sm btn-info edit-kaar"
                                                            data-id="<?php echo $kaar->id; ?>"
                                                            data-kaar="<?php echo htmlspecialchars($kaar->kaar); ?>"
                                                            data-bs-toggle="modal" data-bs-target="#editKaarModal">
                                                            ویرایش
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-danger delete-kaar"
                                                            data-id="<?php echo $kaar->id; ?>" data-bs-toggle="modal"
                                                            data-bs-target="#deleteKaarModal">
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

    <!-- Add Kaar Modal -->
    <div class="modal fade" id="addKaarModal" tabindex="-1" aria-labelledby="addKaarModalLabel" aria-hidden="true"
        style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 2000;">
        <div class="modal-dialog modal-dialog-centered">
            <form action="<?php echo URLROOT; ?>/kaars/store" method="post" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addKaarModalLabel">افزودن کار جدید</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="kaar" class="form-label">نام کار</label>
                        <input type="text" class="form-control" id="kaar" name="kaar" required>
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
    <div class="modal fade" id="editKaarModal" tabindex="-1" aria-labelledby="editKaarModalLabel" aria-hidden="true"
        style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 2000;">
        <div class="modal-dialog modal-dialog-centered">
            <form action="<?php echo URLROOT; ?>/kaars/update" method="post" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editKaarModalLabel">ویرایش کار</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit-kaar-id" name="id">
                    <div class="mb-3">
                        <label for="edit-kaar" class="form-label">نام کار</label>
                        <input type="text" class="form-control" id="edit-kaar" name="kaar" required>
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
    <div class="modal fade" id="deleteKaarModal" tabindex="-1" aria-labelledby="deleteKaarModalLabel" aria-hidden="true"
        style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 2000;">
        <div class="modal-dialog modal-dialog-centered">
            <form action="<?php echo URLROOT; ?>/kaars/delete" method="post" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteKaarModalLabel">حذف کار</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="delete-kaar-id" name="id">
                    <p>آیا مطمئن هستید که می‌خواهید این کار را حذف کنید؟</p>
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
            // Edit Kaar button click handlers
            document.querySelectorAll('.edit-kaar').forEach(btn => {
                btn.addEventListener('click', function () {
                    document.getElementById('edit-kaar-id').value = this.getAttribute('data-id');
                    document.getElementById('edit-kaar').value = this.getAttribute('data-kaar');
                });
            });

            // Delete Kaar button click handlers
            document.querySelectorAll('.delete-kaar').forEach(btn => {
                btn.addEventListener('click', function () {
                    document.getElementById('delete-kaar-id').value = this.getAttribute('data-id');
                });
            });
        });
    </script>

    <?php require_once(APPROOT . "/views/public/footer.php"); ?>