<?php
class Siswa extends Model {
    public function getAllSiswa() {
        $result = mysqli_query($this->conn, "SELECT * FROM siswa");
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function getById($id) {
        $result = mysqli_query($this->conn, "SELECT * FROM siswa WHERE id = $id");
        return mysqli_fetch_assoc($result);
    }

    public function insert($nama, $nis, $kelas, $tahun_ajaran, $jenis_kelamin) {
        $nama = mysqli_real_escape_string($this->conn, $nama);
        $nis = mysqli_real_escape_string($this->conn, $nis);
        $kelas = mysqli_real_escape_string($this->conn, $kelas);
        $tahun_ajaran = mysqli_real_escape_string($this->conn, $tahun_ajaran);
        $jenis_kelamin = mysqli_real_escape_string($this->conn, $jenis_kelamin);

        return mysqli_query($this->conn, "INSERT INTO siswa (nama_siswa, nis_siswa, kelas_siswa, tahun_ajaran_siswa, jenis_kelamin_siswa) VALUES ('$nama', '$nis', '$kelas', '$tahun_ajaran', '$jenis_kelamin')");
    }

    public function update($id, $nama, $nis, $kelas, $tahun_ajaran, $jenis_kelamin) {
        $nama = mysqli_real_escape_string($this->conn, $nama);
        $nis = mysqli_real_escape_string($this->conn, $nis);
        $kelas = mysqli_real_escape_string($this->conn, $kelas);
        $tahun_ajaran = mysqli_real_escape_string($this->conn, $tahun_ajaran);
        $jenis_kelamin = mysqli_real_escape_string($this->conn, $jenis_kelamin);

        return mysqli_query($this->conn, "UPDATE siswa SET nama_siswa='$nama', nis_siswa='$nis', kelas_siswa='$kelas', tahun_ajaran_siswa='$tahun_ajaran', jenis_kelamin_siswa='$jenis_kelamin' WHERE id='$id'");
    }

    public function delete($id) {
        return mysqli_query($this->conn, "DELETE FROM siswa WHERE id=$id");
    }

    public function getAllTahunKelas() {
        $result = mysqli_query($this->conn, "SELECT * FROM pengaturan_kriteria");
        return mysqli_fetch_all($result,MYSQLI_ASSOC);
    }

    public function getAllTahunInput() {
        $result = mysqli_query($this->conn, "SELECT DISTINCT tahun_ajaran_siswa FROM pengaturan_kriteria");
        return mysqli_fetch_all($result,MYSQLI_ASSOC);
    }

    public function getAllKelasInput() {
        $result = mysqli_query($this->conn, "SELECT DISTINCT kelas_siswa FROM pengaturan_kriteria");
        return mysqli_fetch_all($result,MYSQLI_ASSOC);
    }

    public function insertTahunKelas($kelas, $tahun) {
        $cekDuplikat = mysqli_query($this->conn, "SELECT * FROM pengaturan_kriteria WHERE kelas_siswa = '$kelas' AND tahun_ajaran_siswa = '$tahun' LIMIT 1");
        if (mysqli_num_rows($cekDuplikat) > 0) {
            return false;
        }
        $stmt = $this->conn->prepare("INSERT INTO pengaturan_kriteria (kelas_siswa, tahun_ajaran_siswa) VALUES (?, ?)");
        $stmt->bind_param("ss", $kelas, $tahun);
        return $stmt->execute();
    }

    public function deleteTahunKelas($id) {
        return mysqli_query($this->conn, "DELETE FROM pengaturan_kriteria WHERE id=$id");
    }
}