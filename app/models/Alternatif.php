<?php
class Alternatif extends Model {
    public function getAll()
    {
        $query_siswa = mysqli_query($this->conn, "SELECT * FROM siswa");
        if (!$query_siswa) {
            echo "Query error (siswa): " . mysqli_error($this->conn);
            return [];
        }

        $siswas = mysqli_fetch_all($query_siswa, MYSQLI_ASSOC);

        foreach ($siswas as &$siswa) {
            $id_siswa = (int) $siswa['id'];

            $sql_nilai = "
                SELECT 
                    k.nama_kriteria, 
                    k.kode_kriteria,
                    sk.nama_subkriteria, 
                    sk.nilai_subkriteria
                FROM nilai_alternatif na
                JOIN kriteria k ON na.id_kriteria = k.id
                JOIN subkriteria sk ON na.id_subkriteria = sk.id
                WHERE na.id_siswa = $id_siswa
            ";

            $query_nilai = mysqli_query($this->conn, $sql_nilai);

            if (!$query_nilai) {
                echo "Query error (nilai_alternatif): " . mysqli_error($this->conn) . "<br>";
                echo "SQL: " . $sql_nilai . "<br>";
                $siswa['nilai'] = [];
            } else {
                $siswa['nilai'] = mysqli_fetch_all($query_nilai, MYSQLI_ASSOC);
            }
        }

        return $siswas;
    }

    public function getBySiswaId($id_siswa) {
        $id_siswa = (int) $id_siswa;
        $sql = "
            SELECT 
                id_kriteria,
                id_subkriteria
            FROM nilai_alternatif
            WHERE id_siswa = $id_siswa
        ";

        $query = mysqli_query($this->conn, $sql);

        if (!$query) {
            echo "Query error (getBySiswaId): " . mysqli_error($this->conn);
            return [];
        }

        return mysqli_fetch_all($query, MYSQLI_ASSOC);
    }

    public function getDetailBySiswaId($id_siswa)
    {
        $id_siswa = (int) $id_siswa;

        $sql = "
            SELECT 
                k.kode_kriteria,
                k.nama_kriteria,
                sk.nama_subkriteria,
                sk.nilai_subkriteria
            FROM nilai_alternatif na
            JOIN kriteria k ON na.id_kriteria = k.id
            JOIN subkriteria sk ON na.id_subkriteria = sk.id
            WHERE na.id_siswa = $id_siswa
        ";

        $query = mysqli_query($this->conn, $sql);

        if (!$query) {
            echo "Query error (getDetailBySiswaId): " . mysqli_error($this->conn);
            return [];
        }

        return mysqli_fetch_all($query, MYSQLI_ASSOC);
    }



    public function insert($id_siswa, $id_kriteria, $id_subkriteria){
        $id_siswa = (int)$id_siswa;
        $id_kriteria = (int)$id_kriteria;
        $id_subkriteria = (int)$id_subkriteria;
        return mysqli_query($this->conn, "INSERT INTO nilai_alternatif (id_siswa, id_kriteria, id_subkriteria) VALUES ($id_siswa, $id_kriteria, $id_subkriteria)");
    }

    public function updateBySiswaId($id_siswa, $subkriterias)
    {
        $id_siswa = (int) $id_siswa;

        $delete = mysqli_query($this->conn, "DELETE FROM nilai_alternatif WHERE id_siswa = $id_siswa");

        if (!$delete) {
            echo "Query error (delete): " . mysqli_error($this->conn);
            return false;
        }

        foreach ($subkriterias as $id_kriteria => $id_subkriteria) {
            $id_kriteria = (int) $id_kriteria;
            $id_subkriteria = (int) $id_subkriteria;

            $insert = mysqli_query($this->conn, "
                INSERT INTO nilai_alternatif (id_siswa, id_kriteria, id_subkriteria)
                VALUES ($id_siswa, $id_kriteria, $id_subkriteria)
            ");

            if (!$insert) {
                echo "Query error (insert): " . mysqli_error($this->conn);
                return false;
            }
        }

        return true;
    }

    public function delete($id) {
        return mysqli_query($this->conn, "DELETE FROM nilai_alternatif WHERE id_siswa=$id");
    }

}
