<?php
class AdminDashboardController extends Controller {
    public function index() {
        $data['title'] = 'Dashboard';
        $model_user = $this->model('User');
        $data['user'] = $model_user->getAll();
        $model_siswa = $this->model('Siswa');
        $data['siswa'] = $model_siswa->getAllSiswa();
        $model_kriteria = $this->model('Kriteria');
        $data['kriteria'] = $model_kriteria->getAll();
        $model_subkriteria = $this->model('Subkriteria');
        $data['subkriteria'] = $model_subkriteria->getAll();
        
        if (!isset($_SESSION['user'])) {
            header('Location: /spk-saw-siswa-sma5serang-app/auth/login');
            exit;
        }

        $this->view('admin/dashboard/index', $data);   
    }
}
