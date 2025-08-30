<?php
class AdminSiswaController extends Controller {
    public function index() {
        $data['siswa'] = $this->model('Siswa')->getAllSiswa();
        $this->view('admin/siswa/index', $data);
    }

    public function tambah() {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(md5(uniqid(mt_rand(), true)));
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                die('CSRF token tidak valid!');
            }
            $model = $this->model('Siswa');
            $result = $model->insert($_POST['nama_siswa'], $_POST['nis_siswa'], $_POST['kelas_siswa'], $_POST['tahun_ajaran_siswa'], $_POST['jenis_kelamin_siswa']);
            if ($result === false) {
                $_SESSION['message'] = "Gagal menambahkan siswa.";
                $_SESSION['alert-type'] = "danger";
            } else {
                $_SESSION['message'] = "Siswa berhasil ditambahkan.";
                $_SESSION['alert-type'] = "success";
            }
            header('Location: /apksawsmanli/admin/siswa');
            exit;
        }
        $this->view('admin/siswa/tambah');
    }

    public function edit($id) {
        $model = $this->model('Siswa');
        $data['siswa'] = $model->getById($id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                die('CSRF token tidak valid!');
            }
            $result = $model->update($id, $_POST['nama_siswa'], $_POST['nis_siswa'], $_POST['kelas_siswa'], $_POST['tahun_ajaran_siswa'], $_POST['jenis_kelamin_siswa']);
            if ($result === false) {
                $_SESSION['message'] = "Gagal mengedit siswa.";
                $_SESSION['alert-type'] = "danger";
            } else {
                $_SESSION['message'] = "Siswa berhasil diedit.";
                $_SESSION['alert-type'] = "success";
            }
            header('Location: /apksawsmanli/admin/siswa');
            exit;
        }

        $this->view('admin/siswa/edit', $data);
    }

    public function hapus($id) {
        $model = $this->model('Siswa');
        $model->delete($id);
        header('Location: /apksawsmanli/admin/siswa');
    }

    public function cetak() {
        $model = $this->model('Siswa');
        $siswaList = $model->getAll();

        echo '<html><head><title>Cetak</title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            <style>
                @media print { .no-print { display: none; } }
                table th, table td { font-size: 14px; }
            </style>
            </head><body>';
        
        echo '<div class="container mt-4">';
        echo '<h3 class="text-center mb-4">Laporan Data Siswa</h3>';
        echo '<table class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>NIS</th>
                        <th>Kelas</th>
                        <th>Tahun Ajaran</th>
                    </tr>
                </thead>
                <tbody>';

        $no = 1;
        foreach ($siswaList as $siswa) {
            echo '<tr>
                    <td class="text-center">' . $no++ . '</td>
                    <td>' . htmlspecialchars($siswa['nama']) . '</td>
                    <td>' . htmlspecialchars($siswa['nis']) . '</td>
                    <td>' . htmlspecialchars($siswa['kelas']) . '</td>
                    <td>' . htmlspecialchars($siswa['tahun_ajaran']) . '</td>
                </tr>';
        }

        echo '</tbody></table>';

        echo '<div class="text-center no-print">
                <button class="btn btn-primary" onclick="window.print()">Cetak / Print</button>
                <a href="/apksawsmanli/admin/siswa" class="btn btn-secondary">Kembali</a>
            </div>';

        echo '</div></body></html>';
    }

}