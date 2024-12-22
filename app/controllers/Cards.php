<?php

class Cards extends Controller
{
    private $cardModel;

    public function __construct()
    {
        $this->cardModel = $this->model("CardsModel");
    }

    public function index()
    {
        $data = [
            "cards" => $this->cardModel->getAllCards()
        ];
        return $this->view("admin/cards/list", $data);
    }

    public function searchOrCreate()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $serial = $_POST['serial'];

            $card = $this->cardModel->getCardBySerial($serial);

            if ($card) {
                echo json_encode([
                    'status' => 'found',
                    'data' => $card
                ]);
            } else {
                echo json_encode([
                    'status' => 'not_found'
                ]);
            }
        }
    }

    public function create()
    {
        $data = [
            'data' => [],
            'errors' => []
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // دریافت داده‌ها از فرم
            $cardData = [
                'code_dastgah' => trim($_POST['code_dastgah'] ?? ''),
                'title' => trim($_POST['title'] ?? ''),
                'coding_derakhtvare' => trim($_POST['coding_derakhtvare'] ?? ''),
                'model' => trim($_POST['model'] ?? ''),
                'att1_code' => trim($_POST['att1_code'] ?? ''),
                'att1_val' => trim($_POST['att1_val'] ?? ''),
                'att2_code' => trim($_POST['att2_code'] ?? ''),
                'att2_val' => trim($_POST['att2_val'] ?? ''),
                'att3_code' => trim($_POST['att3_code'] ?? ''),
                'att3_val' => trim($_POST['att3_val'] ?? ''),
                'att4_code' => trim($_POST['att4_code'] ?? ''),
                'att4_val' => trim($_POST['att4_val'] ?? ''),
                'serial' => trim($_POST['serial'] ?? ''),
                'serial2' => trim($_POST['serial2'] ?? ''),
                'company' => trim($_POST['company'] ?? ''),
                'sh_sanad' => trim($_POST['sh_sanad'] ?? ''),
                'code_guarantee' => trim($_POST['code_guarantee'] ?? ''),
                'sharh_guarantee' => trim($_POST['sharh_guarantee'] ?? ''),
                'code_agent_service' => trim($_POST['code_agent_service'] ?? ''),
                'agent_service' => trim($_POST['agent_service'] ?? ''),
                'start_guarantee' => trim($_POST['start_guarantee'] ?? ''),
                'expite_guarantee' => trim($_POST['expite_guarantee'] ?? ''),
                'is_import' => 0,
                'added_by_user' => 0,
                'approved' => 1,
                'did' => 0
            ];

            // اعتبارسنجی داده‌ها
            if (empty($cardData['serial'])) {
                $data['errors'][] = 'سریال نمی‌تواند خالی باشد';
            }
            // سایر اعتبارسنجی‌ها را اضافه کنید

            if (empty($data['errors'])) {
                try {
                    if ($this->cardModel->createCard($cardData)) {
                        $_SESSION['card_message'] = 'کارت با موفقیت ایجاد شد';
                        header("Location: " . URLROOT . "/cards/index");
                        exit();
                    } else {
                        throw new Exception('خطا در ثبت کارت');
                    }
                } catch (Exception $e) {
                    $data['errors'][] = $e->getMessage();
                    $data['data'] = $cardData; // حفظ داده‌های فرم
                }
            } else {
                $data['data'] = $cardData; // حفظ داده‌های فرم در صورت خطا
            }
        }

        $this->view('admin/cards/create', $data);
    }
}
