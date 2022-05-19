<?php
class Cmt
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }


    //get cmt
    public function getCmts($id)
    {
        $this->db->query('SELECT * FROM cmts WHERE post_id = :id');
        $this->db->bind(':id', $id);
        return  $this->db->resultSet();
    }
    
    // Get all cmts by post
    public function getAllCmts($id)
    {
        $this->db->query('SELECT * FROM cmts WHERE post_id = :id ORDER BY cmt_created DESC');
        $this->db->bind(':id', $id);
        return  $this->db->resultSet();
    }

    // Add cmt
    public function createCmt($data)
    {
        $this->db->query('INSERT INTO cmts (cmt_body, user_id,cmt_author,author_photo, post_id) VALUES (:cmt_body, :user_id,:cmt_author,:author_photo, :post_id)');
        $this->db->bind(':cmt_body', $data['body']);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':cmt_author', $data['author']);
        $this->db->bind(':author_photo', $data['author_photo']);
        $this->db->bind(':post_id', $data['post_id']);
        return $this->db->execute();
    }
    // Get getCmtByPostId
    public function getCmtByPostId($id)
    {
        $this->db->query('SELECT * FROM cmts WHERE post_id = :id');
        $this->db->bind(':id', $id);
        return  $this->db->resultSet();
    }

    // count cmt by post id
    public function countCmtByPostId($id)
    {
        $this->db->query('SELECT COUNT(*) FROM cmts WHERE post_id = :id');
        $this->db->bind(':id', $id);
        // count row in table
        return $this->db->execute();
    }



    //update cmt
    public function updateCmt($data)
    {
        $this->db->query('UPDATE cmts SET cmt_body = :cmt_body WHERE cmt_id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':cmt_body', $data['body']);
        return $this->db->execute();
    }

    // get user id
    public function getUserId($id)
    {
        $this->db->query('SELECT user_id FROM cmts WHERE cmt_id = :id');
        $this->db->bind(':id', $id);
        return  $this->db->single();
    }

    // Delete cmt
    public function deleteCmt($id)
    {
        $this->db->query('DELETE FROM cmts WHERE cmt_id = :id');
        $this->db->bind(':id', $id);

        return $this->db->execute();
    }
    // get cmt by id 
    public function getCmtById($id)
    {
        $this->db->query('SELECT * FROM cmts WHERE cmt_id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    // Get getCmtByUserId 
    public function getCmtByUserId($id)
    {
        $this->db->query('SELECT * FROM cmts WHERE user_id = :id');
        $this->db->bind(':id', $id);
        return $this->db->resultSet();
    }


   

}