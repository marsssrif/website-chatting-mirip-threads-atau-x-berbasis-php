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

    public function createPost($user_id, $content, $image = null, $is_ghost = 0)
    {
        $content = $this->db->real_escape_string($content);
        $image = $image ? "'" . $this->db->real_escape_string($image) . "'" : "NULL";
        $is_ghost = (int) $is_ghost;

        $query = "INSERT INTO posts (user_id, content, post_image, parent_id, is_ghost) VALUES ('$user_id', '$content', $image, NULL, $is_ghost)";
        return $this->db->query($query);
    }

    public function getAllPosts()
    {
        $query = "SELECT posts.*, users.name, users.username, users.profile_pic 
                  FROM posts 
                  JOIN users ON posts.user_id = users.id 
                  WHERE posts.parent_id IS NULL
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

    public function getPostsByUserId($user_id)
    {
        $query = "SELECT posts.*, users.name, users.username, users.profile_pic 
                  FROM posts 
                  JOIN users ON posts.user_id = users.id 
                  WHERE posts.user_id = '$user_id' AND posts.parent_id IS NULL AND posts.is_ghost = 0
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

    public function deletePost($post_id, $user_id)
    {
        $post_id = $this->db->real_escape_string($post_id);
        $user_id = $this->db->real_escape_string($user_id);

        $imageQuery = "SELECT post_image FROM posts WHERE id = '$post_id' AND user_id = '$user_id'";
        $result = $this->db->query($imageQuery);
        if ($result && $result->num_rows > 0) {
            $post = $result->fetch_assoc();
            if (!empty($post['post_image'])) {
                $image_path = "uploads/posts/" . $post['post_image'];
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }
        }

        $query = "DELETE FROM posts WHERE id = '$post_id' AND user_id = '$user_id'";
        return $this->db->query($query);
    }


    public function getPostById($post_id)
    {
        $post_id = $this->db->real_escape_string($post_id);
        $query = "SELECT posts.*, users.name, users.username, users.profile_pic 
                  FROM posts 
                  JOIN users ON posts.user_id = users.id 
                  WHERE posts.id = '$post_id'";
        $result = $this->db->query($query);
        return $result->fetch_assoc();
    }

    public function getRepliesByPostId($parent_id)
    {
        $parent_id = $this->db->real_escape_string($parent_id);
        $query = "SELECT posts.*, users.name, users.username, users.profile_pic 
                  FROM posts 
                  JOIN users ON posts.user_id = users.id 
                  WHERE posts.parent_id = '$parent_id'
                  ORDER BY posts.created_at ASC";
        $result = $this->db->query($query);

        $replies = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $replies[] = $row;
            }
        }
        return $replies;
    }

    public function createReply($user_id, $content, $parent_id)
    {
        $content = $this->db->real_escape_string($content);
        $parent_id = $this->db->real_escape_string($parent_id);
        $query = "INSERT INTO posts (user_id, content, parent_id) VALUES ('$user_id', '$content', '$parent_id')";
        return $this->db->query($query);
    }

    public function searchPosts($keyword)
    {
        $keyword = $this->db->real_escape_string($keyword);

        $query = "SELECT posts.*, users.name, users.username, users.profile_pic 
                  FROM posts 
                  JOIN users ON posts.user_id = users.id 
                  WHERE posts.parent_id IS NULL AND posts.content LIKE '%$keyword%'
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

    public function getGhostPosts()
    {
        $query = "SELECT posts.*, users.name, users.username, users.profile_pic 
                  FROM posts 
                  JOIN users ON posts.user_id = users.id 
                  WHERE posts.parent_id IS NULL AND posts.is_ghost = 1
                  ORDER BY posts.created_at DESC";
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
