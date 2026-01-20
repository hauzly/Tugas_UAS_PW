<?php
require_once 'koneksi.php';

// Query JOIN untuk ambil data
$sql = "SELECT m.nim, m.nama, m.email, j.nama as jurusan, d.nama as dosen
        FROM mahasiswa m
        JOIN jurusan j ON m.jurusan_id = j.id
        JOIN dosen d ON m.dosen_id = d.id
        ORDER BY m.nim";
$stmt = $pdo->query($sql);
$mahasiswa = $stmt->fetchAll();

// Cek status sukses
$status = $_GET['status'] ?? '';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1> Data Mahasiswa</h1>
        
        <?php if ($status === 'sukses'): ?>
        <div class="alert success">Data berhasil disimpan!</div>
        <?php endif; ?>
        
        <div class="header-actions">
            <a href="tambah.php" class="btn btn-primary"> Tambah Baru</a>
            <a href="index.php" class="btn btn-secondary"> Home</a>
        </div>
        
        <?php if (empty($mahasiswa)): ?>
            <p class="empty-state">Belum ada data mahasiswa.</p>
        <?php else: ?>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Jurusan</th>
                        <th>Dosen Wali</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($mahasiswa as $mhs): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($mhs['nim']) ?></td>
                        <td><?= htmlspecialchars($mhs['nama']) ?></td>
                        <td>
                            <?php if (!empty($mhs['email'])): ?>
                                <?= htmlspecialchars($mhs['email']) ?>
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </td>
                        <td><span class="badge"><?= htmlspecialchars($mhs['jurusan']) ?></span></td>
                        <td><?= htmlspecialchars($mhs['dosen']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <!-- <div class="info-query">
                <h4>Query JOIN yang digunakan:</h4>
                <code>
                    SELECT m.nim, m.nama, m.email, j.nama as jurusan, d.nama as dosen<br>
                    FROM mahasiswa m<br>
                    JOIN jurusan j ON m.jurusan_id = j.id<br>
                    JOIN dosen d ON m.dosen_id = d.id
                </code>
            </div> -->
        <?php endif; ?>
    </div>
</body>
</html>