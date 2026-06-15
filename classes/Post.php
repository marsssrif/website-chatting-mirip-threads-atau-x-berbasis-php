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
}
