<?php

$host = 'localhost';
$user = 'root';
$password = '';
$db = 'apksawsmanli';

$conn = mysqli_connect($host, $user, $password, $db) or die ('Gagal Koneksi Database');

return $conn;