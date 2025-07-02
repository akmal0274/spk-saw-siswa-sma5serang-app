<div class="col-md-12">
    <h2 class="text-gray-900">
        Data Hasil Akhir
    </h2>
    
    <!-- Perankingan -->
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="m-0 text-gray-900">Hasil Akhir (Perankingan)</h5>
            <a href="/spk-saw-siswa-sma5serang-app/admin/rankingakhir/cetak" class="btn btn-secondary">
                <i class="fas fa-print"></i> Cetak Data
            </a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-sm">
                <thead class="thead-light">
                    <tr>
                        <th class="align-middle text-center">Peringkat</th>
                        <th class="align-middle text-center">Nama Siswa</th>
                        <th class="align-middle text-center">Nilai Akhir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $rank = 1;
                    foreach ($data['ranking'] as $r): 
                    ?>
                    <tr>
                        <td class="align-middle text-center"><?= $rank++ ?></td>
                        <td><?= htmlspecialchars($r['nama_siswa']) ?></td>
                        <td class="align-middle text-center"><?= htmlspecialchars($r['nilai_akhir']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
