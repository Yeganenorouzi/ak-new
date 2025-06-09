<?php
class ReceptionStatuses extends Controller
{
    private $statusModel;

    public function __construct()
    {
        $this->statusModel = $this->model('ReceptionStatusModel');
    }

    public function index()
    {
        $statuses = $this->statusModel->getAll();
        $data = ['statuses' => $statuses];
        $this->view('admin/setting/ReceptionStatusView', $data);
    }

    public function create()
    {
        $statuses = $this->statusModel->getAll();
        $data = ['statuses' => $statuses];
        $this->view('admin/setting/ReceptionStatusView', $data);
    }

    public function store()
    {
        error_log("POST data received: " . print_r($_POST, true));
        try {
            $this->statusModel->add($_POST);
            header('Location: ' . URLROOT . '/receptionstatuses/index');
            exit;
        } catch (Exception $e) {
            error_log("Error in store method: " . $e->getMessage());
            // Redirect back with error
            header('Location: ' . URLROOT . '/receptionstatuses/index?error=' . urlencode($e->getMessage()));
            exit;
        }
    }

    public function delete()
    {
        $statuses = $this->statusModel->getAll();
        $data = ['statuses' => $statuses];
        $this->view('admin/setting/ReceptionStatusView', $data);
    }

    public function show($id)
    {
        $status = $this->statusModel->get($id);
        $data = ['status' => $status];
        $this->view('admin/setting/ReceptionStatusView', $data);
    }

    public function edit($id)
    {
        $status = $this->statusModel->get($id);
        $data = ['status' => $status];
        $this->view('admin/setting/ReceptionStatusView', $data);
    }

    public function update()
    {
        if (isset($_POST['id']) && isset($_POST['status'])) {
            $this->statusModel->update([
                'id' => $_POST['id'],
                'status' => $_POST['status']
            ]);
        }
        header('Location: ' . URLROOT . '/receptionstatuses/index');
        exit;
    }

    public function destroy()
    {
        if (isset($_POST['id'])) {
            $this->statusModel->delete($_POST['id']);
        }
        header('Location: ' . URLROOT . '/receptionstatuses/index');
        exit;
    }

}
