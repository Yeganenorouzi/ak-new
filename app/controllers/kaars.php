<?php
class Kaars extends Controller
{
    private $kaarModel;

    public function __construct()
    {
        $this->kaarModel = $this->model('KaarsModel');
    }

    public function index()
    {
        $kaars = $this->kaarModel->getAll();
        $data = ['kaars' => $kaars];
        $this->view('admin/setting/KaarsView', $data);
    }

    public function create()
    {
        $kaars = $this->kaarModel->getAll();
        $data = ['kaars' => $kaars];
        $this->view('admin/setting/KaarsView', $data);
    }

    public function store()
    {
        error_log("POST data received: " . print_r($_POST, true));
        try {
            $this->kaarModel->add($_POST);
            header('Location: ' . URLROOT . '/kaars/index');
            exit;
        } catch (Exception $e) {
            error_log("Error in store method: " . $e->getMessage());
            // Redirect back with error
            header('Location: ' . URLROOT . '/kaars/index?error=' . urlencode($e->getMessage()));
            exit;
        }
    }

    public function delete()
    {
        if (isset($_POST['id'])) {
            $this->kaarModel->delete($_POST['id']);
        }
        header('Location: ' . URLROOT . '/kaars/index');
        exit;
    }

    public function show($id)
    {
        $kaars = $this->kaarModel->get($id);
        $data = ['kaars' => $kaars];
        $this->view('admin/setting/KaarsView', $data);
    }

    public function edit($id)
    {
        $kaars = $this->kaarModel->get($id);
        $data = ['kaars' => $kaars];
        $this->view('admin/setting/KaarsView', $data);
    }

    public function update()
    {
        if (isset($_POST['id']) && isset($_POST['kaar'])) {
            $this->kaarModel->update([
                'id' => $_POST['id'],
                'kaar' => $_POST['kaar']
            ]);
        }
        header('Location: ' . URLROOT . '/kaars/index');
        exit;
    }

    public function destroy()
    {
        if (isset($_POST['id'])) {
            $this->kaarModel->delete($_POST['id']);
        }
        header('Location: ' . URLROOT . '/kaars/index');
        exit;
    }

}
