<?php
require_once 'Database.php';

class Interaction
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    // Fungsi Saklar Like / Unlike
    public function toggleLike($user_id, $post_id)
    {
        $user_id = $this->db->real_escape_string($user_id);
        $post_id = $this->db->real_escape_string($post_id);

        // Cek apakah user ini sudah menyukai post ini?
        $check = $this->db->query("SELECT id FROM likes WHERE user_id='$user_id' AND post_id='$post_id'");

        if ($check->num_rows > 0) {
            // Jika sudah ada datanya, berarti user bermaksud UNLIKE (Hapus)
            $this->db->query("DELETE FROM likes WHERE user_id='$user_id' AND post_id='$post_id'");
        } else {
            // Jika belum ada datanya, berarti user bermaksud LIKE (Insert)
            $this->db->query("INSERT INTO likes (user_id, post_id) VALUES ('$user_id', '$post_id')");
        }
    }

    // Fungsi untuk menghitung total angka Like pada suatu post
    public function getLikeCount($post_id)
    {
        $post_id = $this->db->real_escape_string($post_id);
        $result = $this->db->query("SELECT COUNT(id) as total FROM likes WHERE post_id='$post_id'");
        $row = $result->fetch_assoc();
        return $row['total'];
    }

    // Fungsi untuk mengecek status ikon (Hati Merah atau Hati Kosong)
    public function isLikedByUser($user_id, $post_id)
    {
        if (!$user_id) return false; // Jika belum login, otomatis false
        $user_id = $this->db->real_escape_string($user_id);
        $post_id = $this->db->real_escape_string($post_id);

        $result = $this->db->query("SELECT id FROM likes WHERE user_id='$user_id' AND post_id='$post_id'");
        return $result->num_rows > 0;
    }
}
