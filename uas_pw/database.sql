CREATE DATABASE IF NOT EXISTS pw_uas;
USE pw_uas;

CREATE TABLE jurusan (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(30) NOT NULL
);

CREATE TABLE dosen (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(30) NOT NULL
);

CREATE TABLE mahasiswa (
    nim CHAR(10) PRIMARY KEY,
    nama VARCHAR(50) NOT NULL,
    email VARCHAR(50),
    jurusan_id INT,
    dosen_id INT,
    FOREIGN KEY (jurusan_id) REFERENCES jurusan(id),
    FOREIGN KEY (dosen_id) REFERENCES dosen(id)
);

INSERT INTO jurusan (nama) VALUES 
('Informatika'),
('Sistem Informasi'),
('Teknik Komputer');

INSERT INTO dosen (nama) VALUES 
('Dr. Moh. Ali Romli, M.Kom.'),
('Dr. Sutarman, Ph.D.'),
('Prof. Ahmad Fauzi, M.Sc.');