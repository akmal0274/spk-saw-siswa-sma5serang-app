<div class="col-md-12">
    <h2 class="text-gray-900 mb-4">
        <i class="fas fa-calculator"></i> Perhitungan SAW
    </h2>

    <?php foreach ($data['hasil'] as $tahun => $group): ?>

    <h4 class="mb-3 text-gray-900">Tahun Ajaran: <?= htmlspecialchars($tahun) ?></h4>

    <!-- Tabs Navigation per Tahun -->
    <ul class="nav nav-tabs mb-4" id="sawTabs-<?= htmlspecialchars($tahun) ?>" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#bobot-<?= htmlspecialchars($tahun) ?>">Bobot Preferensi (W)</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#matriks-<?= htmlspecialchars($tahun) ?>">Matriks Keputusan (X)</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#normalisasi-<?= htmlspecialchars($tahun) ?>">Normalisasi (R)</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#ranking-<?= htmlspecialchars($tahun) ?>">Hasil Preferensi (V)</a>
        </li>
    </ul>

    <div class="tab-content">
        <!-- Bobot -->
        <div class="tab-pane fade show active" id="bobot-<?= htmlspecialchars($tahun) ?>">
            <div class="card mb-4">
                <div class="card-header bg-info text-white">Tabel Bobot Preferensi</div>
                <div class="card-body">
                    <table class="table table-bordered table-sm">
                        <thead class="table-light">
                            <tr>
                                <th>Kode</th><th>Nama</th><th>Bobot</th><th>Tipe</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($data['kriteria'] as $k): ?>
                            <tr>
                                <td><?= $k['kode_kriteria'] ?></td>
                                <td><?= $k['nama_kriteria'] ?></td>
                                <td><?= $k['bobot_kriteria'] ?></td>
                                <td><?= ucfirst($k['tipe_kriteria']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Matriks -->
        <div class="tab-pane fade" id="matriks-<?= htmlspecialchars($tahun) ?>">
            <div class="card mb-4">
                <div class="card-header bg-info text-white">Tabel Matriks Keputusan</div>
                <div class="card-body">
                    <table class="table table-bordered table-sm">
                        <thead class="thead-light">
                            <tr>
                                <th class="align-middle text-center" rowspan="2">No</th>
                                <th class="align-middle text-center" rowspan="2">Nama Siswa</th>
                                <?php foreach ($data['kriteria'] as $k): ?>
                                    <th class="align-middle text-center"><?= htmlspecialchars($k['kode_kriteria']) ?>-<?= htmlspecialchars($k['nama_kriteria']) ?></th>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <?php foreach ($data['kriteria'] as $k): ?>
                                    <th class="align-middle text-center">
                                        <small><?= ucfirst(htmlspecialchars($k['tipe_kriteria'])) ?></small>
                                    </th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $max = [];
                        $min = [];
                        ?>
                        <?php $no=1; foreach ($group['alternatif'] as $a): ?>
                        <tr>
                            <td class="align-middle text-center"><?= $no++ ?></td>
                            <td><?= htmlspecialchars($a['nama_siswa']) ?></td>
                            <?php foreach ($data['kriteria'] as $k): ?>
                            <td class="align-middle text-center">
                                <?php
                                $nilai_sub = '-';
                                foreach ($a['nilai'] as $n) {
                                    if ($n['kode_kriteria'] === $k['kode_kriteria']) {
                                        $nilai_sub = $n['nilai_subkriteria'];

                                        // Hitung max/min
                                        if (!isset($max[$k['kode_kriteria']]) || $nilai_sub > $max[$k['kode_kriteria']]) {
                                        $max[$k['kode_kriteria']] = $nilai_sub;
                                        }
                                        if (!isset($min[$k['kode_kriteria']]) || $nilai_sub < $min[$k['kode_kriteria']]) {
                                        $min[$k['kode_kriteria']] = $nilai_sub;
                                        }
                                        break;
                                    }
                                }
                                echo htmlspecialchars($nilai_sub);
                                ?>
                            </td>
                            <?php endforeach; ?>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                        <tfoot class="thead-light">
                            <tr>
                                <th colspan="2" class="text-center">Max</th>
                                <?php foreach ($data['kriteria'] as $k): ?>
                                    <th class="text-center"><?= $group['max'][$k['kode_kriteria']] ?? '-' ?></th>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <th colspan="2" class="text-center">Min</th>
                                <?php foreach ($data['kriteria'] as $k): ?>
                                    <th class="text-center"><?= $group['min'][$k['kode_kriteria']] ?? '-' ?></th>
                                <?php endforeach; ?>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- Normalisasi -->
        <div class="tab-pane fade" id="normalisasi-<?= htmlspecialchars($tahun) ?>">
            <div class="card mb-4">
                <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                    Hasil Normalisasi
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-sm">
                        <thead class="thead-light">
                            <tr>
                                <th rowspan="2" class="align-middle text-center">No</th>
                                <th rowspan="2" class="align-middle text-center">Siswa</th>
                                <?php $no_kriteria = 1; ?>
                                <?php foreach ($data['kriteria'] as $k): ?>
                                    <th class="align-middle text-center"><?= 'R' . $no_kriteria++ ?></th>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <?php foreach ($data['kriteria'] as $k): ?>
                                    <th class="text-center">
                                        <small><?= ucfirst(htmlspecialchars($k['tipe_kriteria'])) ?></small>
                                    </th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach ($group['alternatif'] as $a): ?>
                                <tr>
                                    <td class="align-middle text-center"><?= $no++ ?></td>
                                    <td><?= htmlspecialchars($a['nama_siswa']) ?></td>
                                    <?php foreach ($data['kriteria'] as $k): ?>
                                        <td class="align-middle text-center">
                                            <?php
                                                $kode = $k['kode_kriteria'];
                                                $tipe = $k['tipe_kriteria'];

                                                $nilai = isset($group['matrix'][$a['id']][$kode]) ? $group['matrix'][$a['id']][$kode] : null;
                                                $hasil = isset($a['normalisasi'][$kode]) ? $a['normalisasi'][$kode] : null;

                                                $maxval = isset($group['max'][$kode]) ? $group['max'][$kode] : null;
                                                $minval = isset($group['min'][$kode]) ? $group['min'][$kode] : null;

                                                if ($nilai !== null && $hasil !== null) {
                                                    if ($tipe === 'benefit') {
                                                        echo "{$nilai} / {$maxval} = " . number_format($hasil, 3);
                                                    } else {
                                                        echo "{$minval} / {$nilai} = " . number_format($hasil, 3);
                                                    }
                                                } else {
                                                    echo "-";
                                                }
                                            ?>
                                        </td>
                                    <?php endforeach; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot class="thead-light">
                            <tr>
                                <th colspan="2" class="align-middle text-center">Bobot</th>
                                <?php foreach ($data['kriteria'] as $k): ?>
                                    <th class="text-center"><?= htmlspecialchars($k['bobot_kriteria']) ?></th>
                                <?php endforeach; ?>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>


        <!-- Ranking -->
        <div class="tab-pane fade" id="ranking-<?= htmlspecialchars($tahun) ?>">
            <div class="card mb-4">
                <div class="card-header bg-info text-white">Hasil Preferensi</div>
                <div class="card-body">
                    <table class="table table-bordered table-sm">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th><th>Nama Siswa</th><th>Nilai Akhir</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $no = 1; foreach ($group['ranking_unsorted'] as $r): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $r['nama_siswa'] ?></td>
                                <td><?= $r['nilai_akhir'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <?php endforeach; ?>

</div>
