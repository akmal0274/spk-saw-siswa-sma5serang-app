<div class="col-md-12">
    <h2 class="text-gray-900">
        Data Siswa
    </h2>
    <div class="card shadow my-3">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <h5 class="modal-title text-gray-900">Data Kelas dan Tahun Ajaran</h5>
                <p class="text-gray-600">Input data kelas dan tahun ajaran untuk menginput data siswa</p>
            </div>
            <div>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalTambah">
                    <i class="fas fa-plus"></i> Input Kelas & Tahun
                </button>
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalLihat">
                    <i class="fas fa-eye"></i> Lihat Data
                </button>
            </div>
        </div>
    </div>
    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="modal-title text-gray-900">Daftar Data Siswa</h5>
            <div>
                <a href="/apksawsmanli/admin/siswa/tambah" class="btn btn-primary mr-2">
                    <i class="fas fa-plus"></i> Tambah Data
                </a>
                <a href="/apksawsmanli/admin/siswa/cetak" class="btn btn-secondary">
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
                        <th>Jenis Kelamin</th>
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
                            <td><?= htmlspecialchars($k['jenis_kelamin_siswa']) ?></td>
                            <td><?= htmlspecialchars($k['tahun_ajaran_siswa']) ?></td>
                            <td>
                                <a href="/apksawsmanli/admin/siswa/edit/<?= $k['id'] ?>" class="btn btn-info">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="/apksawsmanli/admin/siswa/hapus/<?= $k['id'] ?>" method="post" class="d-inline" onsubmit="return confirm('Apakah anda yakin untuk menghapus kriteria ini?')">
                                    <button type="submit" class="btn btn-info">
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

<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="modalTambahLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form action="/apksawsmanli/admin/siswa/simpanKelas" method="post">
        <div class="modal-header bg-success">
          <h5 class="modal-title" id="modalTambahLabel">Input Kelas & Tahun Ajaran</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span>&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="form-group text-gray-900">
            <label for="kelas">Kelas</label>
            <input type="text" name="kelas" id="kelas" class="form-control" placeholder="Masukkan kelas" required>
          </div>
          <div class="form-group text-gray-900">
            <label for="tahun">Tahun Ajaran</label>
            <input type="text" name="tahun" id="tahun" class="form-control" placeholder="2025/2026" required>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalLihat" tabindex="-1" role="dialog" aria-labelledby="modalLihatLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5 class="modal-title" id="modalLihatLabel">Data Kelas & Tahun Ajaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span>&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>Kelas</th>
              <th>Tahun Ajaran</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($data['tahun_kelas'])): ?>
              <?php $no = 1; foreach ($data['tahun_kelas'] as $kt): ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($kt['kelas_siswa']) ?></td>
                <td><?= htmlspecialchars($kt['tahun_ajaran_siswa']) ?></td>
                <td>
                  <form action="/apksawsmanli/admin/siswa/hapusTahunKelas/<?= $kt['id'] ?>" method="post" class="d-inline" onsubmit="return confirm('Apakah anda yakin untuk menghapus data tahun ajaran dan kelas ini?')">
                    <button type="submit" class="btn btn-danger">
                      <i class="fas fa-trash"></i>
                    </button>
                  </form>
                </td>
              </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="3" class="text-center">Belum ada data</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>