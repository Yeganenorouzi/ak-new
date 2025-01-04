<?php
class Dashboard extends Controller
{
  private $receptionsModel;
  private $cardsModel;


  public function __construct()
  {
    if (!isset($_SESSION['admin']) || empty($_SESSION['admin'])) {
      header("Location: " . URLROOT . "/auth/login");
      exit();
    }
    $this->receptionsModel = $this->model("ReceptionsModel");
    $this->cardsModel = $this->model("CardsModel");
  }
  public function admin()
  {
    $data = [
      'total_receptions' => $this->receptionsModel->getTotalReceptions(),
      'total_cards' => $this->cardsModel->getTotalCards(),
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
      'total_receptions_by_agent' => $this->receptionsModel->getTotalReceptionsByAgent()
    ];
    return $this->view("agent/dashboard/index", $data);
  }
}
