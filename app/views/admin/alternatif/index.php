<div class="col-md-12">
    <h2 class="text-gray-900">
        Penilaian Awal
    </h2>

    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="modal-title text-gray-900">Daftar Data Alternatif Siswa</h5>
        </div>   

        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>Penilaian</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($data['siswa']) > 0): ?>
                        <?php $no = 1; foreach ($data['siswa'] as $s): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($s['nama_siswa']) ?></td>
                            <td>
                                <?php if (!siswaPunyaPenilaian($s['id'], $data['alternatif'])): ?>
                                    <a href="/spk-saw-siswa-sma5serang-app/admin/alternatif/tambah/<?= $s['id'] ?>" class="btn btn-secondary">
                                        <i class="fas fa-plus"></i> Masukkan Penilaian
                                    </a>
                                <?php else: ?>
                                    <span class="btn btn-success"><i class="fas fa-check"></i> Penilaian Terinput</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (siswaPunyaPenilaian($s['id'], $data['alternatif'])): ?>
                                    <a href="/spk-saw-siswa-sma5serang-app/admin/alternatif/lihat/<?= $s['id'] ?>" class="btn btn-info">
                                        <i class="fas fa-eye"></i> Lihat Data
                                    </a>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center">Belum ada data siswa</td>
                        </tr>
                    <?php endif; ?>
                </tbody>

            </table>
        </div>
    </div>
</div>

<?php
function siswaPunyaPenilaian($siswa_id, $alternatifs) {
    foreach ($alternatifs as $alt) {
        if (isset($alt['id']) && $alt['id'] == $siswa_id) {
            if(isset($alt['nilai']) && count($alt['nilai']) > 0) {
                return true;
            }
        }
    }
    return false;
}
?>

