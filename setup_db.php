<?php

$host = "localhost";
$user = "root";
$pass = "";

$conn = new mysqli($host, $user, $pass, "", 2007);

if ($conn->connect_error) {
    die("Koneksi gagal ke MySQL: " . $conn->connect_error);
}

$sql_db = "CREATE DATABASE IF NOT EXISTS tugasakhirppw";
if ($conn->query($sql_db) === TRUE) {
    echo "Database 'tugasakhirppw' berhasil dibuat atau sudah ada.\n";
} else {
    die("Gagal membuat database: " . $conn->error);
}

$conn->select_db("tugasakhirppw");

$sql_users = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    bio TEXT DEFAULT NULL,
    profile_pic VARCHAR(255) DEFAULT NULL,
    header_pic VARCHAR(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

if ($conn->query($sql_users) === TRUE) {
    echo "Tabel 'users' berhasil dibuat.\n";
} else {
    echo "Gagal membuat tabel users: " . $conn->error . "\n";
}

$sql_posts = "CREATE TABLE IF NOT EXISTS posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    content TEXT NOT NULL,
    post_image VARCHAR(255) DEFAULT NULL,
    parent_id INT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (parent_id) REFERENCES posts(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

if ($conn->query($sql_posts) === TRUE) {
    echo "Tabel 'posts' berhasil dibuat.\n";
} else {
    echo "Gagal membuat tabel posts: " . $conn->error . "\n";
}

$sql_likes = "CREATE TABLE IF NOT EXISTS likes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    post_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE,
    UNIQUE KEY unique_user_post (user_id, post_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

if ($conn->query($sql_likes) === TRUE) {
    echo "Tabel 'likes' berhasil dibuat.\n";
} else {
    echo "Gagal membuat tabel likes: " . $conn->error . "\n";
}

$conn->close();
echo "Setup database selesai!\n";
?>