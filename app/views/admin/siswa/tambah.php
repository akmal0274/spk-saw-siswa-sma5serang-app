<div class="col-md-12">
    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="modal-title text-gray-900">Tambah Siswa</h5>
            <a href="/apksawsmanli/admin/siswa" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            <form action="/apksawsmanli/admin/siswa/tambah" method="POST">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                <div class="form-group text-gray-900">
                    <label for="nis_siswa">NIS</label>
                    <input type="number" id="nis_siswa" name="nis_siswa" class="form-control" required>
                </div>
                <div class="form-group text-gray-900">
                    <label for="nama_siswa">Nama Siswa</label>
                    <input type="text" id="nama_siswa" name="nama_siswa" class="form-control" required>
                </div>
                <div class="form-group text-gray-900">
                    <label for="kelas_siswa">Kelas</label>
                    <select id="kelas_siswa" name="kelas_siswa" class="form-control" required>
                        <option value="">Pilih Kelas</option>
                        <?php foreach ($data['kelas'] as $k): ?>
                            <option value="<?= htmlspecialchars($k['kelas_siswa']) ?>">
                                <?= htmlspecialchars($k['kelas_siswa']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group text-gray-900">
                    <label for="jenis_kelamin_siswa">Jenis Kelamin</label>
                    <select name="jenis_kelamin_siswa" class="form-control" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
                <div class="form-group text-gray-900">
                    <label for="tahun_ajaran_siswa">Tahun Ajaran</label>
                    <select id="tahun_ajaran_siswa" name="tahun_ajaran_siswa" class="form-control" required>
                        <option value="">Pilih Tahun Ajaran</option>
                        <?php foreach ($data['tahun_ajaran'] as $t): ?>
                            <option value="<?= htmlspecialchars($t['tahun_ajaran_siswa']) ?>">
                                <?= htmlspecialchars($t['tahun_ajaran_siswa']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
