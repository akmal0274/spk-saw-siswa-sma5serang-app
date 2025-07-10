<div class="col-md-12">
    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="modal-title text-gray-900">
                Tambah Subkriteria - <?= htmlspecialchars($data['kriteria']['nama_kriteria']) ?>
            </h5>
        </div>
        <div class="card-body">
            <form action="/spk-saw-siswa-sma5serang-app/admin/subkriteria/tambah/<?= $data['kriteria']['id'] ?>" method="POST">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

                <div class="form-row">
                    <div class="form-group col-md-6 text-gray-900">
                        <label for="nama_subkriteria">Nama Subkriteria</label>
                        <input type="text" id="nama_subkriteria" name="nama_subkriteria" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6 text-gray-900">
                        <label for="nilai_subkriteria">Nilai Subkriteria</label>
                        <select id="nilai_subkriteria" name="nilai_subkriteria" class="form-control" required>
                            <option value="">-- Pilih Nilai --</option>
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                </div>
                <a href="/spk-saw-siswa-sma5serang-app/admin/subkriteria" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>

    <div class="card shadow my-3">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="modal-title text-gray-900">Daftar Data Subkriteria - <?= htmlspecialchars($data['kriteria']['nama_kriteria']) ?></h5>
        </div>   
        
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Subkriteria</th>
                        <th>Nilai Subkriteria</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sub_found = false;
                    $no = 1;
                    foreach ($data['subkriteria'] as $sub):
                        if ($sub['id_kriteria'] == $data['kriteria']['id']):
                            $sub_found = true;
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($sub['nama_subkriteria']) ?></td>
                        <td><?= htmlspecialchars($sub['nilai_subkriteria']) ?></td>
                        <td>
                            <a href="/spk-saw-siswa-sma5serang-app/admin/subkriteria/edit/<?= $sub['id'] ?>" class="btn btn-info">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="/spk-saw-siswa-sma5serang-app/admin/subkriteria/hapus/<?= $sub['id'] ?>" method="post" class="d-inline" onsubmit="return confirm('Apakah anda yakin ingin menghapus subkriteria ini?')">
                                <button type="submit" class="btn btn-info">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php
                        endif;
                    endforeach;
                    ?>

                    <?php if (!$sub_found): ?>
                    <tr>
                        <td colspan="4" class="text-center">Belum ada subkriteria untuk kriteria ini</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
