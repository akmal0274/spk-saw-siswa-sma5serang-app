<div class="col-md-12">
    <h2 class="mt-4 text-gray-900 align-middle text-center">Selamat Datang di Sistem Pendukung Keputusan Menggunakan Metode SAW Pemilihan Siswa SMAN 5 Serang Terbaik</h2>
    <hr class="sidebar-divider my-2">
    <div class="row">
        <div class="col-md-3 mb-3">
            <div class="card" style="border-left: 4px solid #17a2b8;">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-info text-uppercase mb-1">Total User</h6>
                        <h5 class="mb-0 text-gray-900"><?= count($data['user']) ?></h5>
                    </div>
                    <div class="text-muted">
                        <i class="fas fa-folder fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card" style="border-left: 4px solid #17a2b8;">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-info text-uppercase mb-1">Total Siswa</h6>
                        <h5 class="mb-0 text-gray-900"><?= count($data['siswa']) ?></h5>
                    </div>
                    <div class="text-muted">
                        <i class="fas fa-folder fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card" style="border-left: 4px solid #17a2b8;">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-info text-uppercase mb-1">Total Kriteria</h6>
                        <h5 class="mb-0 text-gray-900"><?= count($data['kriteria']) ?></h5>
                    </div>
                    <div class="text-muted">
                        <i class="fas fa-folder fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card" style="border-left: 4px solid #17a2b8;">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-info text-uppercase mb-1">Total Sub Kriteria</h6>
                        <h5 class="mb-0 text-gray-900"><?= count($data['subkriteria']) ?></h5>
                    </div>
                    <div class="text-muted">
                        <i class="fas fa-folder fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik
    <div class="card mt-4 shadow">
        <div class="card-header bg-secondary text-white">
            Grafik Hasil Perhitungan
        </div>
        <div class="card-body">
            <canvas id="chartHasil"></canvas>
        </div>
    </div> -->
</div>
