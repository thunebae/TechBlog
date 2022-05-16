<?php
class Post
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Get posts
    public function getPosts()
    {
        $this->db->query('SELECT * FROM posts');
        return  $this->db->resultSet();
    }

    //Get all posts
    public function getAllPosts()
    {
        $this->db->query('SELECT * FROM posts ORDER BY post_created DESC');
        return  $this->db->resultSet();
        
    }

    //Get posts first page
    public function getFistPage()
    {
        $this->db->query('SELECT * FROM posts ORDER BY post_created DESC LIMIT 6');
        return  $this->db->resultSet();
        
    }

    //Get posts per page
    public function getPostsPerPage($index_page, $posts_per_page)
    {
        $this->db->query('SELECT * FROM posts, users WHERE users.user_id = posts.user_id ORDER BY post_created DESC LIMIT :index_page, :posts_per_page');
        $this->db->bind(':index_page', $index_page);
        $this->db->bind(':posts_per_page', $posts_per_page);
        return  $this->db->resultSet();
        
    }

    // Add post
    public function addPost($data)
    {
        $this->db->query('INSERT INTO posts (user_id, post_title, post_category, post_descript, post_body) VALUES(:user_id, :title, :post_category, :post_descript, :body)');
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':post_category', $data['category']);
        $this->db->bind(':post_descript', $data['descript']);
        $this->db->bind(':body', $data['body']);

        return $this->db->execute();
    }

    // Update post
    public function updatePost($data)
    {
        $this->db->query('UPDATE posts SET post_title = :title, post_category = :post_category, post_descript = :post_descript, post_body = :body WHERE post_id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':post_category', $data['category']);
        $this->db->bind(':post_descript', $data['descript']);
        $this->db->bind(':body', $data['body']);

        return $this->db->execute();
    }

    // Delete post
    public function deletePost($id)
    {
        $this->db->query('DELETE FROM posts WHERE post_id = :id');
        $this->db->bind(':id', $id);

        return $this->db->execute();
    }

    // Find post by id
    public function findPostById($id)
    {
        $this->db->query('SELECT * FROM posts WHERE post_id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
  
    }

    // Get post id
    public function getPostId()
    {
        $this->db->query('SELECT post_id FROM posts ORDER BY post_id DESC LIMIT 1');
        return $this->db->single();
    }


}