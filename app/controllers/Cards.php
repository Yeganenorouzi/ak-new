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
}
