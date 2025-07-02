<div class="col-md-12">
    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="modal-title text-gray-900">
                Detail Penilaian - <?= htmlspecialchars($data['siswa']['nama_siswa']) ?>
            </h5>
            <a href="/spk-saw-siswa-sma5serang-app/admin/alternatif" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Kriteria</th>
                        <th>Nama Kriteria</th>
                        <th>Nama Subkriteria</th>
                        <th>Nilai Subkriteria</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($data['penilaian']) > 0): ?>
                        <?php $no = 1; foreach ($data['penilaian'] as $row): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= htmlspecialchars($row['kode_kriteria']) ?></td>
                                <td><?= htmlspecialchars($row['nama_kriteria']) ?></td>
                                <td><?= htmlspecialchars($row['nama_subkriteria']) ?></td>
                                <td><?= htmlspecialchars($row['nilai_subkriteria']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">Belum ada data penilaian.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <?php if (count($data['penilaian']) > 0): ?>
                <div class="text-left">
                    <a href="/spk-saw-siswa-sma5serang-app/admin/alternatif/edit/<?= $data['siswa']['id'] ?>" class="btn btn-info">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="/spk-saw-siswa-sma5serang-app/admin/alternatif/hapus/<?= $data['siswa']['id'] ?>" method="post" class="d-inline" onsubmit="return confirm('Apakah anda yakin untuk menghapus penilaian ini?')">
                        <button type="submit" class="btn btn-info">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
