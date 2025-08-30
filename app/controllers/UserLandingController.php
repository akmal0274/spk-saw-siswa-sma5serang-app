<?php
class UserLandingController extends Controller {
    public function home() {
        $data['title'] = 'Home - SMA N 5 Serang';
        $this->view('landing/home', $data);
    }

    public function about() {
        $data['title'] = 'About - SMA N 5 Serang';
        $this->view('landing/about', $data);
    }

    public function ranking() {
        $data['title'] = 'Ranking - SMA N 5 Serang';
        $model_alternatif = $this->model('Alternatif');
        $alternatifs = $model_alternatif->getAll();

        $model_kriteria = $this->model('Kriteria');
        $kriteria = $model_kriteria->getAll();

        $bobot = [];
        $tipe = [];
        foreach ($kriteria as $k) {
            $bobot[$k['kode_kriteria']] = (float) $k['bobot_kriteria'];
            $tipe[$k['kode_kriteria']] = $k['tipe_kriteria'];
        }

        // Kelompokkan alternatif berdasarkan tahun ajaran
        $groups = [];
        foreach ($alternatifs as $a) {
            $tahun = $a['tahun_ajaran_siswa'] ?? 'Unknown';
            if (!isset($groups[$tahun])) {
                $groups[$tahun] = [
                    'alternatif' => [],
                    'matrix' => [],
                    'max' => [],
                    'min' => [],
                    'ranking' => []
                ];
            }
            $groups[$tahun]['alternatif'][] = $a;

            // Matriks + max min per tahun
            foreach ($a['nilai'] as $n) {
                $kode = $n['kode_kriteria'];
                $nilai = (float) $n['nilai_subkriteria'];

                $groups[$tahun]['matrix'][$a['id']][$kode] = $nilai;

                if (!isset($groups[$tahun]['max'][$kode]) || $nilai > $groups[$tahun]['max'][$kode]) {
                    $groups[$tahun]['max'][$kode] = $nilai;
                }
                if (!isset($groups[$tahun]['min'][$kode]) || $nilai < $groups[$tahun]['min'][$kode]) {
                    $groups[$tahun]['min'][$kode] = $nilai;
                }
            }
        }

        // Normalisasi + ranking per tahun ajaran
        foreach ($groups as $tahun => &$group) {
            foreach ($group['alternatif'] as &$a) {
                $a['normalisasi'] = [];
                foreach ($group['matrix'][$a['id']] as $kode => $nilai) {
                    if ($tipe[$kode] === 'benefit') {
                        $norm = $group['max'][$kode] != 0 ? $nilai / $group['max'][$kode] : 0;
                    } else {
                        $norm = $nilai != 0 ? $group['min'][$kode] / $nilai : 0;
                    }
                    $a['normalisasi'][$kode] = round($norm, 4);
                }

                $nilai_akhir = 0;
                foreach ($a['normalisasi'] as $kode => $norm) {
                    $nilai_akhir += $norm * $bobot[$kode];
                }
                $a['nilai_akhir'] = round($nilai_akhir, 4);

                $group['ranking'][] = [
                    'nama_siswa' => $a['nama_siswa'],
                    'nilai_akhir' => $a['nilai_akhir'],
                    'is_valid' => $a['is_valid']
                ];
            }

            // Urutkan ranking descending
            usort($group['ranking'], function ($a, $b) {
                return $b['nilai_akhir'] <=> $a['nilai_akhir'];
            });
        }

        $data = [
            'groups' => $groups,
            'kriteria' => $kriteria
        ];

        $this->view('landing/ranking', $data);
    }

    public function validasi()
    {
        $tahun = $_GET['tahun'] ?? null;
        echo $tahun;

        if (!$tahun) {
            header('Location: /apksawsmanli/user/landing/ranking');
            exit;
        }

        $model_alternatif = $this->model('Alternatif');

        $model_alternatif->validasiTahun($tahun);

        header('Location: /apksawsmanli/user/landing/ranking?tahun=' . urlencode($tahun));
        exit;
    }


    public function cetak()
    {
        $tahun = $_GET['tahun'] ?? null;

        $model_alternatif = $this->model('Alternatif');
        $alternatif = $model_alternatif->getAll();

        $model_kriteria = $this->model('Kriteria');
        $kriteria = $model_kriteria->getAll();

        // Kelompokkan per tahun ajaran
        $groups = [];
        foreach ($alternatif as $a) {
            $tahun_ajaran = $a['tahun_ajaran_siswa'] ?? 'Unknown';

            if ($tahun && $tahun != $tahun_ajaran) {
                continue;
            }

            if (!isset($groups[$tahun_ajaran])) {
                $groups[$tahun_ajaran] = [
                    'alternatif' => [],
                    'ranking' => [],
                ];
            }

            $groups[$tahun_ajaran]['alternatif'][] = $a;
        }

        // Hitung ranking per grup
        foreach ($groups as $tahun_ajaran => &$group) {
            $bobot = [];
            $tipe = [];
            foreach ($kriteria as $k) {
                $bobot[$k['kode_kriteria']] = (float) $k['bobot_kriteria'];
                $tipe[$k['kode_kriteria']] = $k['tipe_kriteria'];
            }

            $matrix = [];
            $max = [];
            $min = [];

            foreach ($group['alternatif'] as &$a) {
                $matrix[$a['id']] = [];
                foreach ($a['nilai'] as $n) {
                    $kode = $n['kode_kriteria'];
                    $nilai = (float) $n['nilai_subkriteria'];
                    $matrix[$a['id']][$kode] = $nilai;

                    if (!isset($max[$kode]) || $nilai > $max[$kode]) {
                        $max[$kode] = $nilai;
                    }
                    if (!isset($min[$kode]) || $nilai < $min[$kode]) {
                        $min[$kode] = $nilai;
                    }
                }
            }

            foreach ($group['alternatif'] as &$a) {
                $a['normalisasi'] = [];
                foreach ($matrix[$a['id']] as $kode => $nilai) {
                    if ($tipe[$kode] === 'benefit') {
                        $norm = $max[$kode] != 0 ? $nilai / $max[$kode] : 0;
                    } else {
                        $norm = $nilai != 0 ? $min[$kode] / $nilai : 0;
                    }
                    $a['normalisasi'][$kode] = round($norm, 4);
                }
            }

            $ranking = [];
            foreach ($group['alternatif'] as &$a) {
                $nilai_akhir = 0;
                foreach ($a['normalisasi'] as $kode => $norm) {
                    $nilai_akhir += $norm * $bobot[$kode];
                }
                $a['nilai_akhir'] = round($nilai_akhir, 4);
                $ranking[] = [
                    'nama_siswa' => $a['nama_siswa'],
                    'nilai_akhir' => $a['nilai_akhir'],
                    'jenis_kelamin_siswa' => $a['jenis_kelamin_siswa'] ?? '-'
                ];
            }

            usort($ranking, function ($a, $b) {
                return $b['nilai_akhir'] <=> $a['nilai_akhir'];
            });

            $group['ranking'] = $ranking;
        }

        // Cetak HTML
        echo '<html><head><title>Cetak Ranking</title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            <style>@media print { .no-print { display: none; } }</style>
            </head><body>';
        echo '<div class="container mt-4">';
        echo '<h2 class="text-center mb-4">Laporan Hasil Akhir Perankingan</h2>';

        foreach ($groups as $tahun_ajaran => $group) {
            echo '<h4 class="mt-4">Tahun Ajaran: ' . htmlspecialchars($tahun_ajaran) . '</h4>';
            echo '<table class="table table-bordered table-sm mt-2">
                    <thead>
                        <tr>
                            <th class="text-center">Peringkat</th>
                            <th>Nama Siswa</th>
                            <th class="text-center">Nilai Akhir</th>
                        </tr>
                    </thead>
                    <tbody>';

            $rank = 1;
            foreach ($group['ranking'] as $r) {
                echo '<tr>
                        <td class="text-center">' . $rank++ . '</td>
                        <td>' . htmlspecialchars($r['nama_siswa']) . '</td>
                        <td class="text-center">' . htmlspecialchars($r['nilai_akhir']) . '</td>
                    </tr>';
            }

            echo '</tbody></table>';
        }

        echo '<div class="text-center no-print mt-4">
                <button class="btn btn-primary" onclick="window.print()">Cetak / Print</button>
                <a href="/apksawsmanli/user/landing/ranking" class="btn btn-secondary">Kembali</a>
            </div>';

        echo '</div></body></html>';
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION = [];
        session_destroy();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        session_regenerate_id(true);

        header('Location: /apksawsmanli/auth/login');
        exit;
    }
}
