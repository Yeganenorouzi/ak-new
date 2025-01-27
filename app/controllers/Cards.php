<?php

use Shuchkin\SimpleXLSX;

class Cards extends Controller
{
    private $cardModel;

    public function __construct()
    {
        $this->cardModel = $this->model("CardsModel");
    }

    public function index($page = 1)
    {
        $page = (int)$page;

        $cardsPerPage = 50;
        $totalCards = $this->cardModel->getTotalCards();
        $totalPages = ceil($totalCards / $cardsPerPage);

        // اطمینان از اینکه شماره صفحه معتبر است
        if ($page < 1) {
            $page = 1;
        } elseif ($page > $totalPages) {
            $page = $totalPages;
        }

        $offset = ($page - 1) * $cardsPerPage;
        $cards = $this->cardModel->getPaginatedCards($cardsPerPage, $offset);

        $data = [
            "cards" => $cards,
            "currentPage" => $page,
            "totalPages" => $totalPages
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

            if (empty($cardData['serial'])) {
                $data['errors'][] = 'سریال نمی‌تواند خالی باشد';
            }

            if (empty($data['errors'])) {
                try {
                    if ($this->cardModel->createCard($cardData)) {
                        header("Location: " . URLROOT . "/cards/index");
                        exit();
                    } else {
                        throw new Exception('خطا در ثبت کارت');
                    }
                } catch (Exception $e) {
                    $data['errors'][] = $e->getMessage();
                    $data['data'] = $cardData;
                }
            } else {
                $data['data'] = $cardData;
            }
        }

        $this->view('admin/cards/create', $data);
    }

    public function importExcel()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            die('Invalid request method');
        }

        try {
            require APPROOT . '/libraries/vendor/autoload.php';

            if (!isset($_FILES['excel_file'])) {
                throw new Exception('فایلی آپلود نشده است');
            }

            if ($_FILES['excel_file']['error'] != 0) {
                throw new Exception('خطا در آپلود فایل');
            }

            $xlsx = SimpleXLSX::parse($_FILES['excel_file']['tmp_name']);
            if (!$xlsx) {
                throw new Exception('خطا در خواندن فایل اکسل: ' . SimpleXLSX::parseError());
            }

            $rows = $xlsx->rows();
            array_shift($rows);

            $cards = [];
            foreach ($rows as $row) {
                $cards[] = [
                    'code_dastgah' => $row[0] ?? '',
                    'title' => $row[1] ?? '',
                    'coding_derakhtvare' => $row[2] ?? '',
                    'model' => $row[3] ?? '',
                    'att1_code' => $row[4] ?? '',
                    'att1_val' => $row[5] ?? '',
                    'att2_code' => $row[6] ?? '',
                    'att2_val' => $row[7] ?? '',
                    'att3_code' => $row[8] ?? '',
                    'att3_val' => $row[9] ?? '',
                    'att4_code' => $row[10] ?? '',
                    'att4_val' => $row[11] ?? '',
                    'serial' => $row[12] ?? '',
                    'serial2' => $row[13] ?? '',
                    'company' => $row[14] ?? '',
                    'sh_sanad' => $row[15] ?? '',
                    'code_guarantee' => $row[16] ?? '',
                    'sharh_guarantee' => $row[17] ?? '',
                    'code_agent_service' => $row[18] ?? '',
                    'agent_service' => $row[19] ?? '',
                    'start_guarantee' => $row[20] ?? '',
                    'expite_guarantee' => $row[21] ?? ''
                ];
            }

            if (empty($cards)) {
                throw new Exception('هیچ داده‌ای در فایل اکسل یافت نشد');
            }

            if ($this->cardModel->createMultipleCards($cards)) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'فایل اکسل با موفقیت آپلود شد'
                ]);
            }
        } catch (Exception $e) {
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function update($id)
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $this->cardModel->updateCard($id, $_POST);
                header("Location: " . URLROOT . "/cards/index");
                exit();
            }
            // اگر متد POST نبود، به صفحه قبل برگردد
            header("Location: " . URLROOT . "/cards/update/" . $id);
            exit();
        } catch (Exception $e) {
            $data['errors'][] = $e->getMessage();
            $this->view('admin/cards/update', $data);
        }
    }
}
