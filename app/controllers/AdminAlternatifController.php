<?php
class AdminAlternatifController extends Controller {
    public function index() {
        $model_kriteria = $this->model('Kriteria');
        $data['kriteria'] = $model_kriteria->getAll();
        $model_siswa = $this->model('Siswa');
        $data['siswa'] = $model_siswa->getAllSiswa();
        $model_alternatif = $this->model('Alternatif');
        $data['alternatif'] = $model_alternatif->getAll();
        $this->view('admin/alternatif/index', $data);
    }

    public function tambah($id) {
        $model_siswa = $this->model('Siswa');
        $data['siswa'] = $model_siswa->getById($id);

        $model_kriteria = $this->model('Kriteria');
        $data['kriteria'] = $model_kriteria->getAll();

        $model_subkriteria = $this->model('Subkriteria');
        $data['subkriteria'] = $model_subkriteria->getAll();

        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(md5(uniqid(mt_rand(), true)));
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                die('CSRF token tidak valid!');
            }

            $id_siswa = isset($_POST['id_siswa']) ? $_POST['id_siswa'] : null;
            $subkriteria = isset($_POST['subkriteria']) ? $_POST['subkriteria'] : [];


            if (!$id_siswa || empty($subkriteria)) {
                $_SESSION['message'] = "Data tidak lengkap. Harap isi semua form.";
                $_SESSION['alert-type'] = "danger";
                header('Location: /spk-saw-siswa-sma5serang-app/admin/alternatif/tambah/' . $id);
                exit;
            }

            $model_nilai = $this->model('Alternatif');

            $sukses = true;

            foreach ($subkriteria as $id_kriteria => $id_subkriteria) {
                $result = $model_nilai->insert($id_siswa, $id_kriteria, $id_subkriteria);
                if (!$result) {
                    $sukses = false;
                    break;
                }
            }

            if ($sukses) {
                $_SESSION['message'] = "Data alternatif berhasil ditambahkan.";
                $_SESSION['alert-type'] = "success";
            } else {
                $_SESSION['message'] = "Gagal menyimpan data alternatif.";
                $_SESSION['alert-type'] = "danger";
            }

            header('Location: /spk-saw-siswa-sma5serang-app/admin/alternatif');
            exit;
        }

        // Tampilkan form
        $this->view('admin/alternatif/tambah', $data);
    }

    public function lihat($id)
    {
        $model_siswa = $this->model('Siswa');
        $model_alternatif = $this->model('Alternatif');

        $data['siswa'] = $model_siswa->getById($id);
        $data['penilaian'] = $model_alternatif->getDetailBySiswaId($id);

        $this->view('admin/alternatif/lihat', $data);
    }


    public function edit($id) {
        $model_siswa = $this->model('Siswa');
        $model_kriteria = $this->model('Kriteria');
        $model_subkriteria = $this->model('Subkriteria');
        $model_alternatif = $this->model('Alternatif');
        $data['siswa'] = $model_siswa->getById($id);
        $data['kriteria'] = $model_kriteria->getAll();
        $data['subkriteria'] = $model_subkriteria->getAll();
        $data['penilaian'] = $model_alternatif->getBySiswaId($id);


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                die('CSRF token tidak valid!');
            }

            $model_alternatif = $this->model('Alternatif');

            $subkriterias = $_POST['subkriteria'];

            $result = $model_alternatif->updateBySiswaId($id, $subkriterias);

            if ($result) {
                $_SESSION['message'] = "Penilaian berhasil diperbarui.";
                $_SESSION['alert-type'] = "success";
            } else {
                $_SESSION['message'] = "Terjadi kesalahan saat update penilaian.";
                $_SESSION['alert-type'] = "danger";
            }

            header('Location: /spk-saw-siswa-sma5serang-app/admin/alternatif/lihat/' . $id);
            exit;
        }

        $this->view('admin/alternatif/edit', $data);
    }

    public function hapus($id) {
        $model = $this->model('Alternatif');
        $model->delete($id);
        header('Location: /spk-saw-siswa-sma5serang-app/admin/alternatif');
    }

}
