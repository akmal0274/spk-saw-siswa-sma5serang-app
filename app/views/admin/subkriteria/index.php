<div class="col-md-12">
    <h2 class="text-gray-900">
        Data Subkriteria
    </h2>
    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="modal-title text-gray-900">Daftar Data Kriteria & Subkriteria</h5>
        </div>   
        
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Kriteria</th>
                        <th>Kriteria</th>
                        <th>Subkriteria</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($data['kriteria']) > 0): ?>
                        <?php $no = 1; foreach ($data['kriteria'] as $k): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($k['kode_kriteria']) ?></td>
                            <td><?= htmlspecialchars($k['nama_kriteria']) ?></td>
                            <td>
                                <a href="/apksawsmanli/admin/subkriteria/tambah/<?= $k['id'] ?>" class="btn btn-info">
                                    <i class="fas fa-plus"></i> Masukkan Subkriteria 
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center">Belum ada data kriteria</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
