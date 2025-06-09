<?php
class Dashboard extends Controller
{
  private $receptionsModel;
  private $cardsModel;
  private $usersModel;




  public function __construct()
  {
    if (!isset($_SESSION['admin']) || empty($_SESSION['admin'])) {
      header("Location: " . URLROOT . "/auth/login");
      exit();
    }
    $this->receptionsModel = $this->model("ReceptionsModel");
    $this->cardsModel = $this->model("CardsModel");
    $this->usersModel = $this->model("UsersModel");
  }

  public function index()
  {
    if (!isset($_SESSION['admin']) || empty($_SESSION['admin'])) {
      header("Location: " . URLROOT . "/auth/login");
      exit();
    }

    if ($_SESSION['is_admin'] == 1) {
      $this->admin();
    } else {
      $this->agent();
    }
  }


  public function admin()
  {
    $data = [
      'total_receptions' => $this->receptionsModel->getTotalReceptions(),
      'total_cards' => $this->cardsModel->getTotalCards(),
      'total_admins' => $this->usersModel->getTotalAdmins(),
      'total_agents' => $this->usersModel->getTotalAgents(),
      'recent_receptions' => $this->receptionsModel->getRecentReceptions(5),
      'status_labels' => [
        'دریافت از دفتر مرکزی',
        'پذیرش در نمایندگی',
        'ارسال از نمایندگی به دفتر مرکزی',
        'در انتظار تکمیل مدارک',
        'ارسال از دفتر مرکزی به نمایندگی',
        'تحویل به مشتری',
        'دریافت از نمایندگی',
        'در انتظار کارشناسی',
        'در انتظار قطعه',
        'در حال تعویض',
        'در حال انجام کار در دفتر مرکزی',
        'اتمام تعمیر',
        'در انتظار تایید هزینه',
        'عدم موافقت با هزینه - مرجوع'
      ],
      'status_counts' => $this->receptionsModel->getReceptionCountsByStatus()
    ];
    return $this->view("admin/dashboard/index", $data);
  }

  public function agent()
  {
    $data = [
      'total_receptions_by_agent' => $this->receptionsModel->getTotalReceptionsByAgent(),
      'status_labels' => [
        'دریافت از دفتر مرکزی',
        'پذیرش در نمایندگی',
        'ارسال از نمایندگی به دفتر مرکزی',
        'در انتظار تکمیل مدارک',
        'ارسال از دفتر مرکزی به نمایندگی',
        'تحویل به مشتری',
        'دریافت از نمایندگی',
        'در انتظار کارشناسی',
        'در انتظار قطعه',
        'در حال تعویض',
        'در حال انجام کار در دفتر مرکزی',
        'اتمام تعمیر',
        'در انتظار تایید هزینه',
        'عدم موافقت با هزینه - مرجوع'
      ],
      'status_counts' => $this->receptionsModel->getReceptionCountsByStatusForAgent()
    ];
    return $this->view("agent/dashboard/index", $data);
  }

  public function getFilteredData()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Get JSON data from request body
      $input = file_get_contents('php://input');
      $data = json_decode($input, true);

      if (!$data || !isset($data['startDate']) || !isset($data['endDate'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid data']);
        return;
      }

      $startDate = $data['startDate'];
      $endDate = $data['endDate'];

      try {
        // Get filtered data based on date range
        $filteredCounts = $this->receptionsModel->getReceptionCountsByStatusWithDateFilter($startDate, $endDate);

        $statusLabels = [
          'دریافت از دفتر مرکزی',
          'پذیرش در نمایندگی',
          'ارسال از نمایندگی به دفتر مرکزی',
          'در انتظار تکمیل مدارک',
          'ارسال از دفتر مرکزی به نمایندگی',
          'تحویل به مشتری',
          'دریافت از نمایندگی',
          'در انتظار کارشناسی',
          'در انتظار قطعه',
          'در حال تعویض',
          'در حال انجام کار در دفتر مرکزی',
          'اتمام تعمیر',
          'در انتظار تایید هزینه',
          'عدم موافقت با هزینه - مرجوع'
        ];

        $response = [
          'status_labels' => $statusLabels,
          'status_counts' => $filteredCounts
        ];

        header('Content-Type: application/json');
        echo json_encode($response);

      } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
      }
    } else {
      http_response_code(405);
      echo json_encode(['error' => 'Method not allowed']);
    }
  }


}
