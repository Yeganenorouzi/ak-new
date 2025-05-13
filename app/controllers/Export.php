<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Morilog\Jalali\Jalalian;

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
        $sheet->setCellValue('C1', 'سریال ');
        $sheet->setCellValue('D1', 'شماره تماس');
        $sheet->setCellValue('E1', 'آدرس');
        $sheet->setCellValue('F1', 'تاریخ پذیرش');
        $sheet->setCellValue('G1', 'وضعیت');
        $sheet->setCellValue('H1', 'توضیحات');
        $sheet->setCellValue('I1', ' وضعیت گارانتی ');
        $sheet->setCellValue('J1', 'نام نمایندگی ');
        $sheet->setCellValue('K1', 'ایراد دستگاه  ');
        $sheet->setCellValue('L1', ' مشکل ظاهری  ');
        $sheet->setCellValue('M1', '  نوع پذیرش  ');

        $row = 2;
        $receptions = $this->receptionsModel->getAllReceptions();
        foreach ($receptions as $item) {
            $sheet->setCellValue('A' . $row, $item->id);
            $sheet->setCellValue('B' . $row, $item->customer_name);
            $sheet->setCellValue('C' . $row, $item->serial ?? 'N/A');
            $sheet->setCellValue('D' . $row, $item->mobile ?? 'N/A');
            $sheet->setCellValue('E' . $row, $item->address ?? 'N/A');
            // تبدیل تاریخ میلادی به شمسی
            $persianDate = empty($item->created_at) ? 'N/A' : \Morilog\Jalali\Jalalian::fromDateTime($item->created_at)->format('Y/m/d');
            $sheet->setCellValue('F' . $row, $persianDate); 
            
            $sheet->setCellValue('G' . $row, $item->product_status ?? 'N/A');
            $sheet->setCellValue('H' . $row, $item->dex ?? 'N/A');
            $sheet->setCellValue('I' . $row, $item->guarantee_status ?? 'N/A');
            $sheet->setCellValue('J' . $row, $item->user_name ?? 'N/A');
            $sheet->setCellValue('K' . $row, $item->problem ?? 'N/A');
            $sheet->setCellValue('L' . $row, $item->situation ?? 'N/A');
            $sheet->setCellValue('M' . $row, $item->paziresh_status ?? 'N/A');
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


    public function exportCards($filters = [])
    {
        // پاک کردن هرگونه خروجی قبلی برای جلوگیری از خرابی فایل
        ob_start();

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // تنظیم هدرها
        $sheet->setCellValue('A1', ' مدل');
        $sheet->setCellValue('B1', 'کد دستگاه');
        $sheet->setCellValue('C1', 'عنوان');
        $sheet->setCellValue('D1', 'کدینگ درختواره');
        $sheet->setCellValue('E1', ' ویژگی 1');
        $sheet->setCellValue('F1', 'کد ویژگی 1');
        $sheet->setCellValue('G1', 'ویژگی 2');
        $sheet->setCellValue('H1', 'کد ویژکی 2');
        $sheet->setCellValue('I1', 'ویژگی 3');
        $sheet->setCellValue('J1', 'کد ویژگی 3');
        $sheet->setCellValue('K1', 'ویژگی 4');
        $sheet->setCellValue('L1', 'کد ویژگی 4');
        $sheet->setCellValue('M1', 'سریال 1');
        $sheet->setCellValue('N1', 'سریال 2');
        $sheet->setCellValue('O1', 'شرکت وارد کننده');
        $sheet->setCellValue('P1', 'شماره سند');
        $sheet->setCellValue('Q1', 'تاریخ شروع گارانتی');
        $sheet->setCellValue('R1', 'تاریخ پایان گارانتی');

        $row = 2;
        $cards = $this->cardsModel->getFilteredCardsWithoutPagination($filters);
        foreach ($cards as $item) {
            $sheet->setCellValue('A' . $row, $item->model ?? 'N/A');
            $sheet->setCellValue('B' . $row, $item->code_dastgah ?? 'N/A');
            $sheet->setCellValue('C' . $row, $item->title ?? 'N/A');
            $sheet->setCellValue('D' . $row, $item->coding_derakhtvare ?? 'N/A');
            $sheet->setCellValue('E' . $row, $item->att1_code ?? 'N/A');
            $sheet->setCellValue('F' . $row, $item->att1_val ?? 'N/A');
            $sheet->setCellValue('G' . $row, $item->att2_code ?? 'N/A');
            $sheet->setCellValue('H' . $row, $item->att2_val ?? 'N/A');
            $sheet->setCellValue('I' . $row, $item->att3_code ?? 'N/A');
            $sheet->setCellValue('J' . $row, $item->att2_val ?? 'N/A');
            $sheet->setCellValue('K' . $row, $item->att4_code ?? 'N/A');
            $sheet->setCellValue('L' . $row, $item->att4_val ?? 'N/A');
            $sheet->setCellValue('M' . $row, $item->serial ?? 'N/A');
            $sheet->setCellValue('N' . $row, $item->serial2 ?? 'N/A');
            $sheet->setCellValue('O' . $row, $item->company ?? 'N/A');
            $sheet->setCellValue('P' . $row, $item->sh_sanad ?? 'N/A');
            $sheet->setCellValue('Q' . $row, $item->start_guarantee ?? 'N/A');
            $sheet->setCellValue('R' . $row, $item->expite_guarantee ?? 'N/A');
            $row++;
        }

        // ارسال هدرهای دانلود
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="cards.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

        // پاک کردن هر خروجی اضافی قبل از ارسال فایل
        ob_end_clean();

        // ارسال فایل به خروجی
        $writer->save('php://output');
        exit();
    }
}
