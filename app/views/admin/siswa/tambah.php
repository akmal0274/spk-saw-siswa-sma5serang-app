<div class="col-md-12">
    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="modal-title text-gray-900">Tambah Siswa</h5>
            <a href="/spk-saw-siswa-sma5serang-app/admin/siswa" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            <form action="/spk-saw-siswa-sma5serang-app/admin/siswa/tambah" method="POST">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                <div class="form-group text-gray-900">
                    <label for="nis_siswa">NIS</label>
                    <input type="text" id="nis_siswa" name="nis_siswa" class="form-control" required>
                </div>
                <div class="form-group text-gray-900">
                    <label for="nama_siswa">Nama Siswa</label>
                    <input type="text" id="nama_siswa" name="nama_siswa" class="form-control" required>
                </div>
                <div class="form-group text-gray-900">
                    <label for="kelas_siswa">Kelas</label>
                    <input type="text" id="kelas_siswa" name="kelas_siswa" class="form-control" required>
                </div>
                <div class="form-group text-gray-900">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
                <div class="form-group text-gray-900">
                    <label for="tahun_ajaran_siswa">Tahun Ajaran</label>
                    <input type="text" id="tahun_ajaran_siswa" name="tahun_ajaran_siswa" class="form-control" placeholder="Contoh : 2024/2025" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
