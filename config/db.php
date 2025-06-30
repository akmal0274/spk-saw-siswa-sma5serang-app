<?php

$host = 'localhost';
$user = 'root';
$password = '';
$db = 'spk_saw_siswa_sma5serang_app';

$conn = mysqli_connect($host, $user, $password, $db) or die ('Gagal Koneksi Database');

return $conn;