<div class="col-md-12">
    <h2 class="text-gray-900 mb-4">
        Data Hasil Akhir Perankingan
    </h2>

    <!-- Filter Dropdown Tahun Ajaran -->
    <form method="get" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <label for="tahun" class="form-label text-gray-900">Pilih Tahun Ajaran:</label>
                <select name="tahun" id="tahun" class="form-select" onchange="this.form.submit()">
                    <?php foreach ($data['groups'] as $tahun => $group): ?>
                        <option value="<?= htmlspecialchars($tahun) ?>"
                            <?= (isset($_GET['tahun']) && $_GET['tahun'] == $tahun) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($tahun) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </form>

    <?php
        // Tentukan tahun aktif
        $tahun_aktif = $_GET['tahun'] ?? array_key_first($data['groups']);
        $group = $data['groups'][$tahun_aktif] ?? null;
    ?>

    <?php if ($group): ?>
        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="m-0 text-gray-900">
                    Ranking Akhir - Tahun <?= htmlspecialchars($tahun_aktif) ?>
                </h5>
                <a href="/apksawsmanli/admin/rankingakhir/cetak?tahun=<?= urlencode($tahun_aktif) ?>"
                   class="btn btn-secondary">
                    <i class="fas fa-print"></i> Cetak Tahun Ini
                </a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-sm">
                    <thead class="thead-light">
                        <tr>
                            <th class="align-middle text-center">Peringkat</th>
                            <th class="align-middle text-center">Nama Siswa</th>
                            <th class="align-middle text-center">Jenis Kelamin</th>
                            <th class="align-middle text-center">Nilai Akhir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $rank = 1; foreach ($group['ranking'] as $r): ?>
                            <tr>
                                <td class="align-middle text-center"><?= $rank++ ?></td>
                                <td><?= htmlspecialchars($r['nama_siswa']) ?></td>
                                <td class="align-middle text-center"><?= htmlspecialchars($r['jenis_kelamin_siswa']) ?></td>
                                <td class="align-middle text-center"><?= htmlspecialchars($r['nilai_akhir']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-warning">Data tidak ditemukan untuk tahun ajaran ini.</div>
    <?php endif; ?>
</div>
