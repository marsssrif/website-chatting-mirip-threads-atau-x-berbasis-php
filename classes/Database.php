<?php
// File: classes/Database.php

class Database
{
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db_name = "tugasakhirppw";
    public $conn;

    // Konstruktor akan otomatis dipanggil saat class ini diinisialisasi (Materi OOP)
    public function __construct()
    {
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db_name);

        // Cek jika koneksi gagal
        if ($this->conn->connect_error) {
            die("Koneksi Database Gagal: " . $this->conn->connect_error);
        }
    }

    // Fungsi untuk memanggil koneksi
    public function getConnection()
    {
        return $this->conn;
    }
}
