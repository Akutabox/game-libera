<?php
include 'config/koneksi.php';
$id = $_GET['id'];

$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM games WHERE id=$id"));
?>

<h2>Edit Game</h2>

<form method="POST">
    Nama Game: <input type="text" name="nama_game" value="<?= $data['nama_game'] ?>"><br><br>
    Developer: <input type="text" name="developer" value="<?= $data['developer'] ?>"><br><br>
    Tahun: <input type="number" name="tahun" value="<?= $data['tahun'] ?>"><br><br>
    Genre:
<select name="genre_id">
    <?php
    $genre = mysqli_query($conn, "SELECT * FROM genres");
    while ($g = mysqli_fetch_assoc($genre)) {
        $selected = ($g['id'] == $data['genre_id']) ? 'selected' : '';
        echo "<option value='{$g['id']}' $selected>{$g['nama_genre']}</option>";
    }
    ?>
</select>
<br><br>

    <button type="submit" name="update">Update</button>
</form>

<?php
if (isset($_POST['update'])) {
    mysqli_query($conn, "UPDATE games SET 
        nama_game='$_POST[nama_game]',
        developer='$_POST[developer]',
        tahun='$_POST[tahun]',
        genre_id='$_POST[genre_id]'
        WHERE id=$id");

    header("Location: index.php");
}
?>