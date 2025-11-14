<?php
// proteksi agar file tidak dapat diakses langsung
if (!defined('MY_APP')) {
    die('Akses langsung tidak diperbolehkan!');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_lengkap = $_POST['nama_lengkap'];
    $alamat = $_POST['alamat'];
    $no_telepon = $_POST['no_telepon'];
    $email = $_POST['email'];
    $password = md5($_POST['password']); // langsung disini, jadi post akan dirubah ke md5 baru dijadikan variable $password

    // proses upload foto
    $foto_profil = null;  
    if (!empty($_FILES['foto_profil']['name'])) {
    $target_dir = "uploads/users/"; 

    // buat folder jika belum ada
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $file_name = time() . '-' . basename($_FILES['foto_profil']['name']); 
    $target_file = $target_dir . $file_name; 

    if (move_uploaded_file($_FILES['foto_profil']['tmp_name'], $target_file)) {
        $foto_profil = $file_name;
    }
}


    // proses masuk ke database.
// proses masuk ke database.
$sql = "INSERT INTO anggota 
        (nama_lengkap, email, password, alamat, no_telepon, foto_profil) 
        VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $mysqli->prepare($sql);

// ERROR DEBUG → agar tahu penyebab sebenarnya
if (!$stmt) {
    die("Prepare gagal: " . $mysqli->error);
}

// bind data
$stmt->bind_param("ssssss", 
    $nama_lengkap, 
    $email, 
    $password, 
    $alamat, 
    $no_telepon, 
    $foto_profil
);

// eksekusi
if ($stmt->execute()) {
    $pesan = "Anggota dengan nama $nama_lengkap berhasil ditambahkan.";
} else {
    $pesan_error = "Execute gagal: " . $stmt->error;
}

$stmt->close();

    }


?>
          

<div class="container-fluid px-4">
    <h1 class="mt-4">Anggota</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Tambah Anggota</li>
    </ol>

    <?php if (!empty($pesan)) : ?>
        <div class="alert alert-success" role="alert">
            <?= htmlspecialchars($pesan) ?>
        </div>
    <?php endif ?>

    <?php if (!empty($pesan_error)) : ?>
        <div class="alert alert-danger" role="alert">
            <?= htmlspecialchars($pesan_error) ?>
        </div>
    <?php endif ?>

    <div class="card mb-4">
        <div class="card-body">
            <form method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-control" id="nama_lengkap" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" id="alamat" rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <label for="no_telepon" class="form-label">No. Telepon</label>
                    <input type="text" name="no_telepon" class="form-control" id="no_telepon">
                </div>

                <div class="mb-3">
                    <label for="foto_profil" class="form-label">Foto Profil</label>
                    <input type="file" name="foto_profil" class="form-control" id="foto_profil">
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>