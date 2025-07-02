<div class="col-md-12">
    <h2 class="text-gray-900 mb-4">
        <i class="fas fa-calculator"></i> Perhitungan SAW
    </h2>

    <!-- Tabs Navigation -->
    <ul class="nav nav-tabs mb-4" id="sawTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="bobot-tab" data-toggle="tab" href="#bobot" role="tab">Bobot Preferensi (W)</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="matriks-tab" data-toggle="tab" href="#matriks" role="tab">Matriks Keputusan (X)</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="normalisasi-tab" data-toggle="tab" href="#normalisasi" role="tab">Matriks Ternormalisasi (R)</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="ranking-tab" data-toggle="tab" href="#ranking" role="tab">Hasil Preferensi (V)</a>
        </li>
    </ul>
    <div class="tab-content" id="sawTabsContent">
        <!-- Bobot -->
        <div class="tab-pane fade show active" id="bobot" role="tabpanel">
            <div class="card shadow mb-4">
                <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                    <h5 class="m-0">Tabel Bobot Preferensi</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-sm">
                        <thead class="thead-light">
                            <tr>
                                <th>Kode Kriteria</th>
                                <th>Nama Kriteria</th>
                                <th>Bobot</th>
                                <th>Tipe</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data['kriteria'] as $k): ?>
                            <tr>
                                <td><?= htmlspecialchars($k['kode_kriteria']) ?></td>
                                <td><?= htmlspecialchars($k['nama_kriteria']) ?></td>
                                <td><?= htmlspecialchars($k['bobot_kriteria']) ?></td>
                                <td><?= ucfirst(htmlspecialchars($k['tipe_kriteria'])) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Matriks -->
        <div class="tab-pane fade" id="matriks" role="tabpanel">
            <div class="card shadow mb-4">
                <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                    <h5 class="m-0">Tabel Matriks Keputusan</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-sm">
                        <thead class="thead-light">
                            <tr>
                                <th rowspan="2" class="align-middle text-center">No</th>
                                <th rowspan="2" class="align-middle text-center">Siswa</th>
                                <?php foreach ($data['kriteria'] as $k): ?>
                                    <th class="align-middle text-center"><?= htmlspecialchars($k['kode_kriteria'])?> - <?=htmlspecialchars($k['nama_kriteria']) ?></th>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <?php foreach ($data['kriteria'] as $k): ?>
                                    <th class="align-middle text-center"><small><?= ucfirst(htmlspecialchars($k['tipe_kriteria'])) ?></small></th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            // Siapkan untuk max min
                            $max = [];
                            $min = [];
                            ?>
                            <?php $no=1; foreach ($data['alternatif'] as $a): ?>
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

                                                // Hitung max min
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
                                <th colspan="2" class="align-middle text-center">Max</th>
                                <?php foreach ($data['kriteria'] as $k): ?>
                                    <th class="align-middle text-center"><?= isset($max[$k['kode_kriteria']]) ? htmlspecialchars($max[$k['kode_kriteria']]) : '-' ?></th>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <th colspan="2" class="align-middle text-center">Min</th>
                                <?php foreach ($data['kriteria'] as $k): ?>
                                    <th class="align-middle text-center" ><?= isset($min[$k['kode_kriteria']]) ? htmlspecialchars($min[$k['kode_kriteria']]) : '-' ?></th>
                                <?php endforeach; ?>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- Normalisasi -->
        <div class="tab-pane fade" id="normalisasi" role="tabpanel">
            <div class="card shadow mb-4">
                <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                    <h5 class="m-0">Hasil Normalisasi</h5>
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
                                    <th class="text-center"><small><?= ucfirst($k['tipe_kriteria']) ?></small></th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach ($data['alternatif'] as $a): ?>
                                <tr>
                                    <td class="align-middle text-center"><?= $no++ ?></td>
                                    <td><?= htmlspecialchars($a['nama_siswa']) ?></td>
                                    <?php foreach ($data['kriteria'] as $k): ?>
                                        <td class="align-middle text-center">
                                            <?php
                                                $kode = $k['kode_kriteria'];
                                                $tipe = $k['tipe_kriteria'];

                                                $nilai = isset($matrix[$a['id']][$kode]) ? $matrix[$a['id']][$kode] : null;
                                                $hasil = isset($a['normalisasi'][$kode]) ? $a['normalisasi'][$kode] : null;

                                                $maxval = isset($max[$kode]) ? $max[$kode] : null;
                                                $minval = isset($min[$kode]) ? $min[$kode] : null;

                                                if ($nilai !== null && $hasil !== null) {
                                                    if ($tipe === 'benefit') {
                                                        echo "{$nilai} / {$maxval} = " . number_format($hasil, 2);
                                                    } else {
                                                        echo "{$minval} / {$nilai} = " . number_format($hasil, 2);
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
                            <!-- Baris Bobot Kriteria -->
                        <tfoot class="thead-light">
                            <tr>
                                <th colspan="2" class="align-middle text-center">Bobot</th>
                                <?php foreach ($data['kriteria'] as $k): ?>
                                    <th class="text-center">
                                        <?= htmlspecialchars($k['bobot_kriteria']) ?>
                                    </th>
                                <?php endforeach; ?>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <!-- Ranking -->
        <div class="tab-pane fade" id="ranking" role="tabpanel">
            <div class="card shadow mb-4">
                <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                    <h5 class="m-0">Hasil Preferensi</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-sm">
                        <thead class="thead-light">
                            <tr>
                                <th class="align-middle text-center">No</th>
                                <th class="align-middle text-center">Siswa</th>
                                <th class="align-middle text-center">Hasil Preferensi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            foreach ($data['hasil_preferensi'] as $hp): 
                            ?>
                                <tr>
                                    <td class="align-middle text-center">
                                        <?= $no++ ?>
                                    </td>
                                    <td>
                                        <?= htmlspecialchars($hp['nama_siswa']) ?>
                                    </td>
                                    <td class="align-middle text-center">
                                        <?= htmlspecialchars($hp['nilai_akhir']) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
</div>
