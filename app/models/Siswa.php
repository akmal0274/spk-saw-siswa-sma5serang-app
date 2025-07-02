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

    public function insert($nama, $nis, $kelas, $tahun_ajaran) {
        $nama = mysqli_real_escape_string($this->conn, $nama);
        $nis = mysqli_real_escape_string($this->conn, $nis);
        $kelas = mysqli_real_escape_string($this->conn, $kelas);
        $tahun_ajaran = mysqli_real_escape_string($this->conn, $tahun_ajaran);

        return mysqli_query($this->conn, "INSERT INTO siswa (nama_siswa, nis_siswa, kelas_siswa, tahun_ajaran_siswa) VALUES ('$nama', '$nis', '$kelas', '$tahun_ajaran')");
    }

    public function update($id, $nama, $nis, $kelas, $tahun_ajaran) {
        $nama = mysqli_real_escape_string($this->conn, $nama);
        $nis = mysqli_real_escape_string($this->conn, $nis);
        $kelas = mysqli_real_escape_string($this->conn, $kelas);
        $tahun_ajaran = mysqli_real_escape_string($this->conn, $tahun_ajaran);

        return mysqli_query($this->conn, "UPDATE siswa SET nama_siswa='$nama', nis_siswa='$nis', kelas_siswa='$kelas', tahun_ajaran_siswa='$tahun_ajaran' WHERE id='$id'");
    }

    public function delete($id) {
        return mysqli_query($this->conn, "DELETE FROM siswa WHERE id=$id");
    }
}