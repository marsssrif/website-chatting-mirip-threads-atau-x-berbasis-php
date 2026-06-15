<?php
require_once 'Database.php';

class Post
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    // Fungsi membuat Meow baru (Insert)
    public function createPost($user_id, $content)
    {
        $content = $this->db->real_escape_string($content);
        $query = "INSERT INTO posts (user_id, content) VALUES ('$user_id', '$content')";

        return $this->db->query($query);
    }

    // Fungsi mengambil semua Meow untuk Timeline (Select + Join)
    public function getAllPosts()
    {
        $query = "SELECT posts.*, users.name, users.username, users.profile_pic 
                  FROM posts 
                  JOIN users ON posts.user_id = users.id 
                  ORDER BY posts.created_at DESC";
        $result = $this->db->query($query);

        $posts = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $posts[] = $row;
            }
        }
        return $posts;
    }

    // Fungsi Mengambil Meow khusus milik satu user saja
    public function getPostsByUserId($user_id)
    {
        $query = "SELECT posts.*, users.name, users.username, users.profile_pic 
                  FROM posts 
                  JOIN users ON posts.user_id = users.id 
                  WHERE posts.user_id = '$user_id'
                  ORDER BY posts.created_at DESC";
        $result = $this->db->query($query);

        $posts = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $posts[] = $row;
            }
        }
        return $posts;
    }

    // Fungsi Menghapus Meow (Hanya jika ID post dan ID User cocok)
    public function deletePost($post_id, $user_id)
    {
        $post_id = $this->db->real_escape_string($post_id);
        $user_id = $this->db->real_escape_string($user_id);

        // Query DELETE sesuai materi PHP MySQL dasar
        $query = "DELETE FROM posts WHERE id = '$post_id' AND user_id = '$user_id'";
        return $this->db->query($query);
    }
}
