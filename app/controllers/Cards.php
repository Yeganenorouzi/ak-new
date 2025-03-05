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
                'did' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
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

    public function import()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Check if file was uploaded without errors
            if (isset($_FILES['excel_file']) && $_FILES['excel_file']['error'] == 0) {
                $fileName = $_FILES['excel_file']['name'];
                $fileTmpName = $_FILES['excel_file']['tmp_name'];
                $fileSize = $_FILES['excel_file']['size'];
                $fileType = $_FILES['excel_file']['type'];
                $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

                // Define allowed file extensions
                $allowedExtensions = ['xlsx', 'xls'];

                if (in_array($fileExtension, $allowedExtensions)) {
                    // Process the file (e.g., move it to a directory, read its contents, etc.)
                    $uploadDir = APPROOT . '/uploads/';
                    
                    // Check if the directory exists, if not, create it
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }

                    $uploadFile = $uploadDir . basename($fileName);

                    if (move_uploaded_file($fileTmpName, $uploadFile)) {
                        // File successfully uploaded
                        // Add your file processing logic here
                        echo "File successfully uploaded.";
                    } else {
                        echo "Error uploading the file.";
                    }
                } else {
                    echo "Invalid file type. Only .xlsx and .xls files are allowed.";
                }
            } else {
                echo "No file uploaded or there was an error uploading the file.";
            }
        } else {
            // Load the import view
            $this->view('admin/cards/import');
        }
    }
}
