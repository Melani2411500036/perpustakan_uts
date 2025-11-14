<?php
// proteksi agar file tidak dapat diakses langsung
if (!defined('MY_APP')) {
    die('Akses langsung tidak diperbolehkan!');
}

// ini query anggota
$sql = "SELECT * FROM anggota ORDER BY id_anggota DESC";

$result = $mysqli->query($sql);
if (!$result) {
    die("QUERY Error: " . $mysqli->error);
}
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Anggota</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Daftar Anggota</li>
    </ol>

    <div class="card mb-4">
        <div class="card-body">
            <a href="index.php?hal=tambah_anggota" class="btn btn-success mb-3">Tambah Anggota</a>

            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th>No Telepon</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- disini perulangan -->
                    <?php $no = 1 ?>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo $no ?></td>
                            <td>
                                <!-- disini ada kondisi jika cover tidak ada -->
                                <div class="d-flex align-items-center">
                                    <?php if (!empty($row['foto_profil'])) : ?>
                                        <img src="uploads/users/<?php echo htmlspecialchars($row['foto_profil']) ?>" alt="Foto Profil" width="60" height="80" style="object-fit: cover; border-radius: 5px; margin-right: 10px;" />
                                    <?php else : ?>
                                        <!-- jika tidak ada cover, tampilkan cover kosong -->
                                        <div style="width: 60px; height:80px; background:#ddd; border-radius:5px; margin-right:10px; display:flex; align-items:center; justify-content: center; color:#999;">No<br>Foto</div>
                                    <?php endif ?>
                                    <span><?php echo htmlspecialchars($row['nama_lengkap']) ?></span>
                                </div>
                            </td>
                            <td><?php echo htmlspecialchars($row['email']) ?></td>
                            <td><?php echo htmlspecialchars($row['alamat']) ?></td>
                            <td><?php echo htmlspecialchars($row['no_telepon']) ?></td>
                            <td>
                                <a href="index.php?hal=ubah_password&id_anggota=<?php echo $row['id_anggota'] ?>" class="btn btn-primary btn-sm"><span class="fas fa-key"></span> Ubah</a>
                            </td>
                        </tr>
                        <?php $no++ ?>
                    <?php endwhile; ?>
                    <?php $mysqli->close(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>