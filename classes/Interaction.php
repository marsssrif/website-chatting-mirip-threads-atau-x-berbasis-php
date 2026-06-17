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

    public function toggleLike($user_id, $post_id)
    {
        $user_id = $this->db->real_escape_string($user_id);
        $post_id = $this->db->real_escape_string($post_id);

        $check = $this->db->query("SELECT id FROM likes WHERE user_id='$user_id' AND post_id='$post_id'");

        if ($check->num_rows > 0) {
            $this->db->query("DELETE FROM likes WHERE user_id='$user_id' AND post_id='$post_id'");
        } else {
            $this->db->query("INSERT INTO likes (user_id, post_id) VALUES ('$user_id', '$post_id')");
        }
    }

    public function getLikeCount($post_id)
    {
        $post_id = $this->db->real_escape_string($post_id);
        $result = $this->db->query("SELECT COUNT(id) as total FROM likes WHERE post_id='$post_id'");
        $row = $result->fetch_assoc();
        return $row['total'];
    }

    public function isLikedByUser($user_id, $post_id)
    {
        if (!$user_id)
            return false; 
        $user_id = $this->db->real_escape_string($user_id);
        $post_id = $this->db->real_escape_string($post_id);

        $result = $this->db->query("SELECT id FROM likes WHERE user_id='$user_id' AND post_id='$post_id'");
        return $result->num_rows > 0;
    }

    public function toggleSave($user_id, $post_id)
    {
        $user_id = $this->db->real_escape_string($user_id);
        $post_id = $this->db->real_escape_string($post_id);

        $check = $this->db->query("SELECT id FROM saved_posts WHERE user_id='$user_id' AND post_id='$post_id'");

        if ($check->num_rows > 0) {
            $this->db->query("DELETE FROM saved_posts WHERE user_id='$user_id' AND post_id='$post_id'");
            return false;
        } else {
            $this->db->query("INSERT INTO saved_posts (user_id, post_id) VALUES ('$user_id', '$post_id')");
            return true;
        }
    }

    public function isSavedByUser($user_id, $post_id)
    {
        if (!$user_id)
            return false;
        $user_id = $this->db->real_escape_string($user_id);
        $post_id = $this->db->real_escape_string($post_id);

        $result = $this->db->query("SELECT id FROM saved_posts WHERE user_id='$user_id' AND post_id='$post_id'");
        return $result->num_rows > 0;
    }

    public function getSavedPostsByUser($user_id)
    {
        $user_id = $this->db->real_escape_string($user_id);
        $query = "SELECT posts.*, users.name, users.username, users.profile_pic 
                  FROM saved_posts
                  JOIN posts ON saved_posts.post_id = posts.id
                  JOIN users ON posts.user_id = users.id
                  WHERE saved_posts.user_id = '$user_id' AND posts.parent_id IS NULL
                  ORDER BY saved_posts.created_at DESC";
        $result = $this->db->query($query);

        $posts = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $posts[] = $row;
            }
        }
        return $posts;
    }
}
