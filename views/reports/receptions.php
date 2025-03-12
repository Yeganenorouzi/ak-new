<?php require_once(APPROOT . "/views/public/header.php"); ?>

<div class="container">
    <h1>لیست پذیرش‌ها</h1>
    
    <table class="table">
        <thead>
            <tr>
                <th>شماره</th>
                <th>نام</th>
                <!-- سایر ستون‌های مورد نیاز -->
            </tr>
        </thead>
        <tbody>
            <?php foreach($data['receptions'] as $reception) : ?>
                <tr>
                    <td><?php echo $reception->id; ?></td>
                    <td><?php echo $reception->name; ?></td>
                    <!-- نمایش سایر اطلاعات -->
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="text-center mt-3">
        <a href="<?php echo URLROOT; ?>/export/exportReceptions" class="btn btn-primary">
            دانلود خروجی اکسل
        </a>
    </div>
</div>

<?php require APPROOT . '/views/public/footer.php'; ?> 