<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Export extends Controller
{
    private $receptionsModel;
    private $cardsModel;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['admin']) || empty($_SESSION['admin'])) {
            header("Location: " . URLROOT . "/auth/login");
            exit();
        }

        $this->receptionsModel = $this->model("ReceptionsModel");
        $this->cardsModel = $this->model("CardsModel");
    }

    public function exportReceptions()
    {
        // پاک کردن هرگونه خروجی قبلی برای جلوگیری از خرابی فایل
        ob_start();

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // تنظیم هدرها
        $sheet->setCellValue('A1', 'شماره پذیرش');
        $sheet->setCellValue('B1', 'نام مشتری');
        $sheet->setCellValue('C1', 'نام نمایندگی');
        $sheet->setCellValue('D1', 'شماره تماس');
        $sheet->setCellValue('E1', 'آدرس');
        $sheet->setCellValue('F1', 'تاریخ پذیرش');
        $sheet->setCellValue('G1', 'وضعیت');
        $sheet->setCellValue('H1', 'توضیحات');
        $sheet->setCellValue('I1', 'تاریخ اتمام');

        $row = 2;
        $receptions = $this->receptionsModel->getAllReceptions();
        foreach ($receptions as $item) {
            $sheet->setCellValue('A' . $row, $item->id);
            $sheet->setCellValue('B' . $row, $item->customer_name);
            $sheet->setCellValue('C' . $row, $item->agent_name ?? 'N/A');
            $sheet->setCellValue('D' . $row, $item->phone_number ?? 'N/A');
            $sheet->setCellValue('E' . $row, $item->address ?? 'N/A');
            $sheet->setCellValue('F' . $row, $item->reception_date ?? 'N/A');
            $sheet->setCellValue('G' . $row, $item->status ?? 'N/A');
            $sheet->setCellValue('H' . $row, $item->description ?? 'N/A');
            $sheet->setCellValue('I' . $row, $item->completion_date ?? 'N/A');
            $row++;
        }

        // ارسال هدرهای دانلود
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="receptions.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

        // پاک کردن هر خروجی اضافی قبل از ارسال فایل
        ob_end_clean();

        // ارسال فایل به خروجی
        $writer->save('php://output');
        exit();
    }



    private function convertToExcelDate($date)
    {
        try {
            if (empty($date) || $date === '0000-00-00') {
                return 'N/A';
            }
            $dateTime = new \DateTime($date);
            return \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($dateTime);
        } catch (Exception $e) {
            return 'N/A';
        }
    }
}
