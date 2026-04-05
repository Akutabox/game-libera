<?php
include 'config/koneksi.php';

$cari = isset($_GET['cari']) ? $_GET['cari'] : '';
?>
<div style="background:white; padding:20px; border-radius:10px;">

<style>
body {
    font-family: Arial;
    background-color: #f4f6f9;
    padding: 20px;
}

h2 {
    color: #333;
}

a {
    text-decoration: none;
    background: #3498db;
    color: white;
    padding: 6px 10px;
    border-radius: 5px;
}

a:hover {
    background: #2980b9;
}

table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

th {
    background: #3498db;
    color: white;
}

th, td {
    padding: 10px;
    text-align: center;
}

tr:nth-child(even) {
    background: #f2f2f2;
}

form input, form select {
    padding: 8px;
    margin: 5px;
}

button {
    padding: 8px 12px;
    background: #2ecc71;
    color: white;
    border: none;
    border-radius: 5px;
}

button:hover {
    background: #27ae60;
}

</style>
<?php
$total_game = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM games"));
$total_genre = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM genres"));
?>

<div style="display:flex; gap:20px; margin-bottom:20px;">
    <div style="background:#3498db; color:white; padding:15px; border-radius:10px;">
        Total Game: <?= $total_game['total'] ?>
    </div>
    <div style="background:#2ecc71; color:white; padding:15px; border-radius:10px;">
        Total Genre: <?= $total_genre['total'] ?>
    </div>
</div>
<h2>Game Library</h2>
<a href="tambah.php">+ Tambah Game</a>
<form method="GET">
    <input type="text" name="cari" placeholder="Cari game...">
    <button type="submit">Cari</button>
</form>
<?php if ($cari != "") { ?>
    <p>Hasil pencarian untuk: <b><?= $cari ?></b></p>
<?php } ?>
<br>

<table border="1" cellpadding="10">
<tr>
    <th>No</th>
    <th>Nama Game</th>
    <th>Developer</th>
    <th>Tahun</th>
    <th>Genre</th>
    <th>Aksi</th>
</tr>

<?php
$cari = isset($_GET['cari']) ? $_GET['cari'] : '';
$no = 1;


$query = mysqli_query($conn, "SELECT games.*, genres.nama_genre 
FROM games 
JOIN genres ON games.genre_id = genres.id
WHERE nama_game LIKE '%$cari%'");

while ($data = mysqli_fetch_assoc($query)) {
?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $data['nama_game'] ?></td>
    <td><?= $data['developer'] ?></td>
    <td><?= $data['tahun'] ?></td>
    <td><?= $data['nama_genre'] ?></td>
    <td>
        <a href="edit.php?id=<?= $data['id'] ?>">Edit</a> |
        <a href="hapus.php?id=<?= $data['id'] ?>" onclick="return confirm('Hapus?')">Hapus</a>
    </td>
</tr>
</div>
<?php } ?>
</table>