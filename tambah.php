<?php include 'config/koneksi.php'; ?>

<h2>Tambah Game</h2>

<form method="POST">
    Nama Game: <input type="text" name="nama_game" required><br><br>
    Developer: <input type="text" name="developer"><br><br>
    Tahun: <input type="number" name="tahun"><br><br>

    Genre:
    <select name="genre_id">
        <?php
        $genre = mysqli_query($conn, "SELECT * FROM genres");
        while ($g = mysqli_fetch_assoc($genre)) {
            echo "<option value='{$g['id']}'>{$g['nama_genre']}</option>";
        }
        ?>
    </select><br><br>

    <button type="submit" name="submit">Simpan</button>
</form>

<?php
if (isset($_POST['submit'])) {

    if ($_POST['nama_game'] == "") {
        echo "Nama game tidak boleh kosong!";
    } else {

        mysqli_query($conn, "INSERT INTO games VALUES (
            NULL,
            '$_POST[nama_game]',
            '$_POST[developer]',
            '$_POST[tahun]',
            '$_POST[genre_id]'
        )");

        header("Location: index.php");
    }
}
?>