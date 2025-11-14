<?php
// proteksi agar file tidak dapat diakses langsung
if (!defined('MY_APP')) {
    die('Akses langsung tidak diperbolehkan!');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Ambil data dari form (nama harus sesuai dengan "name" di input HTML)
    $judul_buku   = $_POST['judul_buku'];
    $penulis      = $_POST['Penulis'];
    $penerbit     = $_POST['Penerbit'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $stok         = $_POST['stok'];

    // Siapkan variabel untuk nama file cover
    $cover_name = null;

    // Proses upload cover (jika ada file diupload)
    if (!empty($_FILES['cover']['name'])) {
        $target_dir = "uploads/buku/"; // pastikan folder ini ada
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $file_name = time() . "_" . basename($_FILES['cover']['name']);
        $target_file = $target_dir . $file_name;

        // Pindahkan file ke folder tujuan
        if (move_uploaded_file($_FILES['cover']['tmp_name'], $target_file)) {
            $cover_name = $file_name; // simpan nama file untuk database
        } else {
            $pesan_error = "Gagal mengunggah file cover!";
        }
    }

    // Simpan ke database (pastikan kolom di tabel sesuai)
    $sql = "INSERT INTO buku (judul, penulis, penerbit, tahun_terbit, stok, cover_buku) 
            VALUES (?, ?, ?, ?, ?, ?)";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("sssiis", $judul_buku, $penulis, $penerbit, $tahun_terbit, $stok, $cover_name);
        if ($stmt->execute()) {
            // ✅ perbaikan: gunakan $mysqli->insert_id, bukan $stmt->$insert_id
            $id_buku = $mysqli->insert_id;
            
            if (!empty($_POST['kategori'])) {
                foreach ($_POST['kategori'] as $id_kategori) {
                    // ✅ perbaikan: tambahkan fungsi query() yang benar
                    $mysqli->query("INSERT INTO buku_kategori (id_buku, id_kategori) VALUES ($id_buku, $id_kategori)");
                }
            }
            $pesan = "Buku berhasil di Tambahkan";
        } else {
            $stmt->close();
        }
    }

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("ssssss", $judul_buku, $penulis, $penerbit, $tahun_terbit, $stok, $cover_name);
        if ($stmt->execute()) {
            $pesan = "Data buku berhasil disimpan.";
        } else {
            $pesan_error = "Terjadi kesalahan saat menyimpan data ke database.";
        }
        $stmt->close();
    }
}
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Buku</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Tambah Buku</li>
    </ol>

    <?php if (!empty($pesan)) : ?>
        <div class="alert alert-success" role="alert">
            <?php echo $pesan; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($pesan_error)) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $pesan_error; ?>
        </div>
    <?php endif; ?>

    <div class="card mb-4">
        <div class="card-body">
            <form method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="judul_buku" class="form-label">Judul Buku</label>
                    <input type="text" name="judul_buku" class="form-control" id="judul_buku" required>
                </div>

                <div class="mb-3">
                    <label for="kategori" class="form-label">Pilih Kategori</label><br>
                    <?php
                    $sql_kategori = "SELECT * FROM kategori ORDER BY nama_kategori ASC";
                    $result_kategori = $mysqli->query($sql_kategori);
                    while ($kat = $result_kategori->fetch_assoc()) :
                    ?>
                        <label class="me-3">
                            <input type="checkbox" name="kategori[]" value="<?php echo $kat['id_kategori']; ?>">
                            <?php echo $kat['nama_kategori']; ?>
                        </label>
                    <?php endwhile; $mysqli->close();?>
                </div>

                <div class="mb-3">
                    <label for="Penulis" class="form-label">Penulis</label>
                    <input type="text" name="Penulis" class="form-control" id="Penulis" required>
                </div>

                <div class="mb-3">
                    <label for="Penerbit" class="form-label">Penerbit</label>
                    <input type="text" name="Penerbit" class="form-control" id="Penerbit" required>
                </div>

                <div class="mb-3">
                    <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                    <input type="text" name="tahun_terbit" class="form-control" id="tahun_terbit" required>
                </div>

                <div class="mb-3">
                    <label for="stok" class="form-label">Stok</label>
                    <input type="text" name="stok" class="form-control" id="stok" required>
                </div>

                <div class="mb-3">
                    <label for="cover" class="form-label">Upload Cover</label>
                    <input type="file" name="cover" class="form-control" id="cover" required>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="index.php?hal=daftar_buku" class="btn btn-danger">Kembali</a>
            </form>
        </div>
    </div>
</div>
