<div class="col-md-12">
    <h2 class="text-gray-900">
        Data Siswa
    </h2>
    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="modal-title text-gray-900">Daftar Data Siswa</h5>
            <div>
                <a href="/spk-saw-siswa-sma5serang-app/admin/siswa/tambah" class="btn btn-primary mr-2">
                    <i class="fas fa-plus"></i> Tambah Data
                </a>
                <a href="/spk-saw-siswa-sma5serang-app/admin/siswa/cetak" class="btn btn-secondary">
                    <i class="fas fa-print"></i> Cetak Data
                </a>
            </div>
        </div>   
        
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIS</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Tahun Ajaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($data['siswa']) > 0): ?>
                        <?php $no = 1; foreach ($data['siswa'] as $k): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($k['NIS_siswa']) ?></td>
                            <td><?= htmlspecialchars($k['nama_siswa']) ?></td>
                            <td><?= htmlspecialchars($k['kelas_siswa']) ?></td>
                            <td><?= htmlspecialchars($k['tahun_ajaran_siswa']) ?></td>
                            <td>
                                <a href="/spk-saw-siswa-sma5serang-app/admin/siswa/edit/<?= $k['id'] ?>" class="btn btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="/spk-saw-siswa-sma5serang-app/admin/siswa/hapus/<?= $k['id'] ?>" method="post" class="d-inline" onsubmit="return confirm('Apakah anda yakin untuk menghapus kriteria ini?')">
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="text-center">Belum ada data siswa</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
