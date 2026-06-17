<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Meow-af, silakan login terlebih dahulu untuk mengunduh gambar!'); window.location.href='login.php';</script>";
    exit;
}

if (isset($_GET['file']) && !empty($_GET['file'])) {
    $filename = basename($_GET['file']);
    $filepath = "uploads/posts/" . $filename;

    if (file_exists($filepath)) {

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));

        flush();

        readfile($filepath);
        exit;
    } else {
        echo "<h2>Meow-af, File tidak ditemukan di server!</h2><a href='home.php'>Kembali</a>";
    }
} else {
    header("Location: home.php");
    exit;
}
