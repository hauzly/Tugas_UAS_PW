<?php
require_once 'koneksi.php';

// Ambil data untuk dropdown
$stmt_jurusan = $pdo->query("SELECT * FROM jurusan ORDER BY nama");
$stmt_dosen = $pdo->query("SELECT * FROM dosen ORDER BY nama");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1> Tambah Data Mahasiswa</h1>
        
        <form action="proses-tambah.php" method="POST">
            <div class="form-group">
                <label>NIM *</label>
                <input type="text" name="nim" required maxlength="10" placeholder="10 digit">
            </div>
            
            <div class="form-group">
                <label>Nama Lengkap *</label>
                <input type="text" name="nama" required placeholder="Nama mahasiswa">
            </div>
            
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="email@contoh.com">
            </div>
            
            <div class="form-group">
                <label>Jurusan *</label>
                <select name="jurusan_id" required>
                    <option value="">-- Pilih Jurusan --</option>
                    <?php while($row = $stmt_jurusan->fetch()): ?>
                    <option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            
            <div class="form-group">
                <label>Dosen Wali *</label>
                <select name="dosen_id" required>
                    <option value="">-- Pilih Dosen --</option>
                    <?php 
                    $stmt_dosen->execute();
                    while($row = $stmt_dosen->fetch()): 
                    ?>
                    <option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            
            <div class="button-group">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="index.php" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</body>
</html>