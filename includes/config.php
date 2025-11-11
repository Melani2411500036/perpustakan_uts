<?php

// user pass database
$db_host = 'localhost';
$db_user = 'root';
$db_pass = ''; // salah tulis tadi: $dbb_pass jadi $db_pass
$db_name = 'db_perpustakaan';

// membuat koneksi
$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);

// error handling
if ($mysqli->connect_error) {
    die("Koneksi Gagal: " . $mysqli->connect_error); 
}
?>
