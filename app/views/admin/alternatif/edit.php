<div class="col-md-12">
    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="modal-title text-gray-900">
                Edit Penilaian - <?= htmlspecialchars($data['siswa']['nama_siswa']) ?>
            </h5>
            <a href="/apksawsmanli/admin/alternatif/lihat/<?= $data['siswa']['id'] ?>" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            <form action="/apksawsmanli/admin/alternatif/edit/<?= $data['siswa']['id'] ?>" method="POST">
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                <input type="hidden" name="id_siswa" value="<?= $data['siswa']['id'] ?>">

                <?php foreach ($data['kriteria'] as $kriteria): ?>
                    <?php
                        // Ambil subkriteria yang sudah dipilih siswa untuk kriteria ini
                        $selected_sub = '';
                        foreach ($data['penilaian'] as $nilai) {
                            if ($nilai['id_kriteria'] == $kriteria['id']) {
                                $selected_sub = $nilai['id_subkriteria'];
                                break;
                            }
                        }
                    ?>
                    <div class="form-group text-gray-900">
                        <label for="kriteria_<?= $kriteria['id'] ?>">
                            <?= htmlspecialchars($kriteria['nama_kriteria']) ?>
                        </label>
                        <select 
                            id="kriteria_<?= $kriteria['id'] ?>" 
                            name="subkriteria[<?= $kriteria['id'] ?>]" 
                            class="form-control" 
                            required
                        >
                            <option value="">-- Pilih Subkriteria --</option>
                            <?php foreach ($data['subkriteria'] as $sub): ?>
                                <?php if ($sub['id_kriteria'] == $kriteria['id']): ?>
                                    <option 
                                        value="<?= $sub['id'] ?>"
                                        <?= $sub['id'] == $selected_sub ? 'selected' : '' ?>
                                    >
                                        <?= htmlspecialchars($sub['nama_subkriteria']) ?>
                                    </option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                <?php endforeach; ?>

                <button type="submit" class="btn btn-success">Update</button>
            </form>
        </div>
    </div>
</div>
