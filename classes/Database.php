<?php

class Database
{
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db_name = "tugasakhirppw";
    public $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db_name, 2007);

        if ($this->conn->connect_error) {
            die("Koneksi Database Gagal: " . $this->conn->connect_error);
        }
    }
    public function getConnection()
    {
        return $this->conn;
    }
}
