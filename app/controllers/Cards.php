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
        return $this->view("admin/cards/read", $data);
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

    public function createCard()
    {
        $data = [
            'serial' => $_POST['serial'],
            'model' => $_POST['model']
        ];

        $result = $this->cardModel->createCard($data);
        if ($result) {
            echo json_encode(['status' => 'created']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }
}
