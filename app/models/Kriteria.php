<?php
class Kriteria extends Model {
    public function getAll() {
        $result = mysqli_query($this->conn, "SELECT * FROM kriteria");
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function getById($id) {
        $result = mysqli_query($this->conn, "SELECT * FROM kriteria WHERE id = $id");
        return mysqli_fetch_assoc($result);
    }

    public function insert($nama, $kode, $tipe, $bobot) {
        $nama = mysqli_real_escape_string($this->conn, $nama);
        $kode = mysqli_real_escape_string($this->conn, $kode);
        $tipe = mysqli_real_escape_string($this->conn, $tipe);
        $bobot = trim($bobot);

        // cek kode duplikat
        $cekQuery = mysqli_query($this->conn, "SELECT id FROM kriteria WHERE kode_kriteria = '$kode'");
        if (mysqli_num_rows($cekQuery) > 0) {
            return ['success' => false, 'message' => 'Kode kriteria sudah digunakan.'];
        }

        // ganti koma jadi titik
        if (strpos($bobot, ',') !== false) {
            $bobot = str_replace(',', '.', $bobot);
        }

        // cek numeric
        if (!is_numeric($bobot)) {
            return ['success' => false, 'message' => 'Bobot harus berupa angka.'];
        }
        $bobot = (float)$bobot;

        // cek total bobot
        $result = mysqli_query($this->conn, "SELECT SUM(bobot_kriteria) as total FROM kriteria");
        $row = mysqli_fetch_assoc($result);
        $total = $row['total'] + $bobot;

        if ($total > 1) {
            return ['success' => false, 'message' => "Total bobot melebihi 1 (saat ini: {$total})."];
        }

        $query = mysqli_query($this->conn, "INSERT INTO kriteria (nama_kriteria, kode_kriteria, tipe_kriteria, bobot_kriteria) 
                                            VALUES ('$nama', '$kode', '$tipe', '$bobot')");

        if ($query) {
            return ['success' => true, 'message' => 'Kriteria berhasil ditambahkan.'];
        } else {
            return ['success' => false, 'message' => 'Gagal menyimpan ke database.'];
        }
    }


    public function update($id, $nama, $tipe, $bobot) {
        $nama = mysqli_real_escape_string($this->conn, $nama);
        $tipe = mysqli_real_escape_string($this->conn, $tipe);
        $bobot = trim($bobot);

        // ganti koma jadi titik
        if (strpos($bobot, ',') !== false) {
            $bobot = str_replace(',', '.', $bobot);
        }

        // cek numeric
        if (!is_numeric($bobot)) {
            return ['success' => false, 'message' => 'Bobot harus berupa angka.'];
        }
        $bobot = (float)$bobot;

        // cek total bobot selain kriteria yg diupdate
        $result = mysqli_query($this->conn, "SELECT SUM(bobot_kriteria) as total FROM kriteria WHERE id != '$id'");
        $row = mysqli_fetch_assoc($result);
        $total = $row['total'] + $bobot;

        if ($total > 1) {
            return ['success' => false, 'message' => "Total bobot melebihi 1 (saat ini: {$total})."];
        }

        $query = mysqli_query($this->conn, "UPDATE kriteria 
                                            SET nama_kriteria='$nama', bobot_kriteria='$bobot', tipe_kriteria='$tipe' 
                                            WHERE id='$id'");

        if ($query) {
            return ['success' => true, 'message' => 'Kriteria berhasil diperbarui.'];
        } else {
            return ['success' => false, 'message' => 'Gagal memperbarui database.'];
        }
    }


    public function delete($id) {
        return mysqli_query($this->conn, "DELETE FROM kriteria WHERE id=$id");
    }
}
