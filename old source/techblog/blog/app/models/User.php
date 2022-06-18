<?php
class User {
    private $db;
    public function __construct() {
        $this->db = new Database;
    }

    // Get users
    public function getUsers() {
        $this->db->query('SELECT * FROM users');
        return $this->db->resultSet();
    }
    // Get user by ID
    public function getUserById($id) {
        $this->db->query('SELECT * FROM users WHERE user_id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
    // Get user by username
    public function getUserByName($username) {
        $this->db->query('SELECT * FROM users WHERE user_name = :username');
        $this->db->bind(':username', $username);
        return $this->db->single();
    }

    public function register($data) {
        $this->db->query('INSERT INTO users (user_name, user_email, password) VALUES(:username, :email, :password)');

        //Bind values
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function login($username, $password) {
        $this->db->query('SELECT * FROM users WHERE user_name = :username');

        //Bind value
        $this->db->bind(':username', $username);

        $row = $this->db->single();

        $hashedPassword = $row->password;
        // Sha256 password
        $password = hash('sha256', $password);
        // Check pass
        if ($hashedPassword === $password) {
            return $row;
        } else {
            return false;
        }

    }
    
    // Get all posts by user
    public function getPostsByUser($id) {
        $this->db->query('SELECT * FROM posts WHERE user_id = :id order by post_created DESC ');
        $this->db->bind(':id', $id);
        return $this->db->resultSet();
    }
    
    // Get all posts by user first page
    public function getPostsByUserFirstPage($id) {
        $this->db->query('SELECT * FROM posts WHERE user_id = :id order by post_created DESC LIMIT 8');
        $this->db->bind(':id', $id);
        return $this->db->resultSet();
    }

    // Get all posts by user per page
    public function getPostsByUserPerPage($id, $index_page, $posts_per_page) {
        $this->db->query('SELECT * FROM posts WHERE user_id = :id order by post_created DESC LIMIT :index_page, :posts_per_page');
        $this->db->bind(':id', $id);
        $this->db->bind(':index_page', $index_page);
        $this->db->bind(':posts_per_page', $posts_per_page);
        return  $this->db->resultSet();
    }

    //Find user by email. Email is passed in by the Controller.
    public function findUserByEmail($email) {
        //Prepared statement
        $this->db->query('SELECT * FROM users WHERE user_email = :email');

        //Email param will be binded with the email variable
        $this->db->bind(':email', $email);

        //Check if email is already registered
        if($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
        
    }

    //update avatar 
    public function update_avatar($avatarName) 
    {
        $this->db->query('UPDATE users SET user_photo = :avatarName WHERE user_id = :id');
        $this->db->bind(':avatarName', $avatarName);
        $this->db->bind(':id', $_SESSION['user_id']);
        $this->db->execute();
    }

    // update user profile
    public function update_profile($data)
    {   
        $this->db->query('UPDATE users SET user_fullname = :fullname, user_email = :email, user_birthday = :birthday, user_address = :address, user_phone = :phone, user_descript = :descript WHERE user_id = :id');
        //Bind values
        $this->db->bind(':id', $data['user_id']);
        $this->db->bind(':fullname', $data['fullname']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':birthday', $data['birthday']);
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':descript ', $data['descript ']);
        $this->db->execute();

    }
        
}