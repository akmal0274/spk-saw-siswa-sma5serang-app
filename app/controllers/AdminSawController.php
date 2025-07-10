<?php
class AdminSawController extends Controller
{
    public function index()
    {
        $model_alternatif = $this->model('Alternatif');
        $alternatif = $model_alternatif->getAll(); // Ambil SEMUA alternatif

        $model_kriteria = $this->model('Kriteria');
        $kriteria = $model_kriteria->getAll();

        // Siapkan bobot & tipe
        $bobot = [];
        $tipe = [];
        foreach ($kriteria as $k) {
            $bobot[$k['kode_kriteria']] = (float) $k['bobot_kriteria'];
            $tipe[$k['kode_kriteria']] = $k['tipe_kriteria'];
        }

        // Kelompokkan alternatif berdasarkan tahun ajaran
        $alternatif_by_tahun = [];
        foreach ($alternatif as $a) {
            $alternatif_by_tahun[$a['tahun_ajaran_siswa']][] = $a;
        }

        $hasil = [];

        foreach ($alternatif_by_tahun as $tahun => $alternatif_tahun) {

            $matrix = [];
            $max = [];
            $min = [];

            // Matriks & cari max/min
            foreach ($alternatif_tahun as &$a) {
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

            // Normalisasi & hitung nilai akhir
            $ranking = [];
            foreach ($alternatif_tahun as &$a) {
                $a['normalisasi'] = [];
                foreach ($matrix[$a['id']] as $kode => $nilai) {
                    if ($tipe[$kode] === 'benefit') {
                        $norm = $max[$kode] != 0 ? $nilai / $max[$kode] : 0;
                    } else {
                        $norm = $nilai != 0 ? $min[$kode] / $nilai : 0;
                    }
                    $a['normalisasi'][$kode] = round($norm, 4);
                }

                $nilai_akhir = 0;
                foreach ($a['normalisasi'] as $kode => $norm) {
                    $nilai_akhir += $norm * $bobot[$kode];
                }

                $a['nilai_akhir'] = round($nilai_akhir, 4);

                $ranking[] = [
                    'nama_siswa' => $a['nama_siswa'],
                    'nilai_akhir' => $a['nilai_akhir']
                ];
            }

            // Urutkan ranking
            usort($ranking, function ($a, $b) {
                return $b['nilai_akhir'] <=> $a['nilai_akhir'];
            });

            $hasil[$tahun] = [
                'alternatif' => $alternatif_tahun,
                'ranking' => $ranking,
                'max' => $max,
                'min' => $min,
                'matrix' => $matrix
            ];
        }

        // Kirim ke view
        $data = [
            'kriteria' => $kriteria,
            'hasil' => $hasil
        ];

        $this->view('admin/saw/index', $data);
    }
}
