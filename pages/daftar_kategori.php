<?php
//proteksi agar file tidak dapat diakses langsung
if(!defined('MY_APP')) {
    die('Akses langsung tidak diperbolehkan!');
}

$sql = "SELECT * FROM kategori ORDER BY id_kategori DESC";

$result = $mysqli->query($sql);
if(!$result) {
    die("QUERY Error: " . $mysql->error);
}
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Kategori</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Daftar Kategori</li>
    </ol>

    <div class="card mb-4">
        <div class="card-body">
  <div class="container mt-4">
        <a href="index.php?hal=tambah_kategori" class="btn btn-primary mb-3">Tambah Kategori</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">NO</th>
                    <th scope="col">Nama Kategori</th>
                     <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php while($row = $result->fetch_assoc()) : ?>
                            <tr>
                                <td ><?php echo $no ?></td>
                                <td><?php echo $row['nama_kategori'] ?></td>
                                <td>
                                    <a href="index.php?hal=ubah_kategori&id=<?php echo $row['id_kategori']; ?>" class="btn btn-warning btn-sm">Ubah</a>
                                </td>
                            </tr>
                            <?php $no++ ?>
                            <?php endwhile ?>
                </tbody>
         </table>
        </div>
    </div>
</div>