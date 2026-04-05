<?php
$conn = mysqli_connect("localhost", "root", "", "");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS game_libera");
mysqli_select_db($conn, "game_libera");

mysqli_query($conn, "CREATE TABLE IF NOT EXISTS genres (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_genre VARCHAR(100) NOT NULL
)");

mysqli_query($conn, "CREATE TABLE IF NOT EXISTS games (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_game VARCHAR(100),
    developer VARCHAR(100),
    tahun INT,
    genre_id INT
)");

$check = mysqli_query($conn, "SELECT * FROM genres");
if (mysqli_num_rows($check) == 0) {
    mysqli_query($conn, "INSERT INTO genres (nama_genre) VALUES
    ('RPG'), ('FPS'), ('MOBA'), ('Adventure')");
}
?>
