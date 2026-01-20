<?php
require_once 'koneksi.php';

// Cek apakah form dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nim = $_POST['nim'] ?? '';
    $nama = $_POST['nama'] ?? '';
    $email = $_POST['email'] ?? '';
    $jurusan_id = $_POST['jurusan_id'] ?? '';
    $dosen_id = $_POST['dosen_id'] ?? '';
    
    // Validasi sederhana
    $errors = [];
    
    if (empty($nim)) $errors[] = "NIM harus diisi";
    if (empty($nama)) $errors[] = "Nama harus diisi";
    if (empty($jurusan_id)) $errors[] = "Jurusan harus dipilih";
    if (empty($dosen_id)) $errors[] = "Dosen wali harus dipilih";
    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid";
    }
    
    // Jika ada error, tampilkan dan berhenti
    if (!empty($errors)) {
        echo "<div style='color: red; padding: 10px;'>";
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
        echo "<a href='tambah.php'>Kembali ke form</a>";
        echo "</div>";
        exit;
    }
    
    try {
        // Cek apakah NIM sudah ada
        $check = $pdo->prepare("SELECT nim FROM mahasiswa WHERE nim = ?");
        $check->execute([$nim]);
        
        if ($check->rowCount() > 0) {
            echo "<div style='color: orange; padding: 10px;'>
                  NIM sudah terdaftar! 
                  <a href='tambah.php'>Coba lagi</a>
                  </div>";
            exit;
        }
        
        // Simpan ke database
        $sql = "INSERT INTO mahasiswa (nim, nama, email, jurusan_id, dosen_id) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nim, $nama, $email, $jurusan_id, $dosen_id]);
        
        // Redirect ke halaman data
        header("Location: data.php?status=sukses");
        exit;
        
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    // Jika bukan POST, redirect
    header("Location: tambah.php");
    exit;
}
?>