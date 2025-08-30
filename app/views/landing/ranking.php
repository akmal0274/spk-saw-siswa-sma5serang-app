<div class="col-md-12">
    <h2 class="text-gray-900 mb-4">
        Data Hasil Akhir Perankingan
    </h2>

    <!-- Filter Dropdown Tahun Ajaran + Status Validasi -->
    <form method="get" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <label for="tahun" class="form-label">Pilih Tahun Ajaran:</label>
                <select name="tahun" id="tahun" class="form-select">
                    <option value="all" <?= (!isset($_GET['tahun']) || $_GET['tahun'] === 'all') ? 'selected' : '' ?>>Semua Tahun Ajaran</option>
                    <?php foreach ($data['groups'] as $tahun => $group): ?>
                        <option value="<?= htmlspecialchars($tahun) ?>"
                            <?= (isset($_GET['tahun']) && $_GET['tahun'] == $tahun) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($tahun) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-4">
                <label for="status" class="form-label">Status Validasi:</label>
                <select name="status" id="status" class="form-select">
                    <option value="">Semua</option>
                    <option value="valid" <?= (isset($_GET['status']) && $_GET['status'] == 'valid') ? 'selected' : '' ?>>Sudah Validasi</option>
                    <option value="invalid" <?= (isset($_GET['status']) && $_GET['status'] == 'invalid') ? 'selected' : '' ?>>Belum Validasi</option>
                </select>
            </div>

            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-filter"></i> Terapkan Filter
                </button>
            </div>
        </div>
    </form>

    <?php
        // Tentukan filter
        $tahun_aktif = $_GET['tahun'] ?? 'all';
        $status = $_GET['status'] ?? '';

        $groups_to_show = [];

        if ($tahun_aktif === 'all') {
            $groups_to_show = $data['groups'];
        } else {
            if (isset($data['groups'][$tahun_aktif])) {
                $groups_to_show[$tahun_aktif] = $data['groups'][$tahun_aktif];
            }
        }
    ?>

    <?php if (!empty($groups_to_show)): ?>
        <?php foreach ($groups_to_show as $tahun => $group): ?>

            <?php
                // Cek perlu validasi
                $perlu_validasi = false;
                foreach ($group['ranking'] as $r) {
                    if ($r['is_valid'] == 0) {
                        $perlu_validasi = true;
                        break;
                    }
                }

                // Filter ranking per status
                $ranking_terfilter = [];
                foreach ($group['ranking'] as $r) {
                    if ($status === 'valid' && $r['is_valid'] == 0) continue;
                    if ($status === 'invalid' && $r['is_valid'] == 1) continue;
                    $ranking_terfilter[] = $r;
                }
            ?>

            <?php if (count($ranking_terfilter) > 0): ?>
                <div class="card shadow mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="m-0 text-gray-900">
                            Ranking Akhir - Tahun <?= htmlspecialchars($tahun) ?>
                        </h5>
                        <div class="d-flex align-items-center gap-2">
                            <?php if ($perlu_validasi): ?>
                                <a href="/apksawsmanli/user/landing/validasi?tahun=<?= urlencode($tahun) ?>"
                                class="btn btn-success">
                                    <i class="fas fa-check-circle"></i> Validasi Tahun Ini
                                </a>
                            <?php endif; ?>
                            <a href="/apksawsmanli/user/landing/cetak?tahun=<?= urlencode($tahun) ?>"
                            class="btn btn-secondary">
                                <i class="fas fa-print"></i> Cetak Tahun Ini
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered table-sm">
                            <thead class="thead-light">
                                <tr>
                                    <th class="align-middle text-center">Peringkat</th>
                                    <th class="align-middle text-center">Nama Siswa</th>
                                    <th class="align-middle text-center">Nilai Akhir</th>
                                    <th class="align-middle text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $rank = 1; foreach ($ranking_terfilter as $r): ?>
                                    <tr>
                                        <td class="align-middle text-center"><?= $rank++ ?></td>
                                        <td><?= htmlspecialchars($r['nama_siswa']) ?></td>
                                        <td class="align-middle text-center"><?= htmlspecialchars($r['nilai_akhir']) ?></td>
                                        <td class="align-middle text-center">
                                            <?php if ($r['is_valid']): ?>
                                                <span class="badge bg-success">Sudah Divalidasi</span>
                                            <?php else: ?>
                                                <span class="badge bg-warning text-dark">Belum Divalidasi</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php else: ?>
                <div class="alert alert-warning">
                    Data tidak ditemukan untuk filter ini di tahun <?= htmlspecialchars($tahun) ?>.
                </div>
            <?php endif; ?>

        <?php endforeach; ?>
    <?php else: ?>
        <div class="alert alert-warning">Tidak ada data ranking sama sekali.</div>
    <?php endif; ?>
</div>
