<?php
    class Database
    {
        private $dbhost = DB_HOST;
        private $dbuser = DB_USER;
        private $dbpass = DB_PASS;
        private $dbname = DB_NAME;
        private $dbhandler;
        private $statement;
        private $error;

        public function __construct()
        {
            $conn = 'mysql:host=' . $this->dbhost . ';dbname=' . $this->dbname;
            $options = array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );

            try {
                $this->dbhandler = new PDO($conn, $this->dbuser, $this->dbpass, $options);
            } catch (PDOException $e) {
                $this->error = $e->getMessage();
                echo $this->error;
            }


           

        }

        // Query function
        public function query($query)
        {
            $this->statement = $this->dbhandler->prepare($query);
        }

        // Bind function
        public function bind($param, $value, $type = null)
        {
            if (is_null($type)) {
                switch (true) {
                    case is_int($value):
                        $type = PDO::PARAM_INT;
                        break;
                    case is_bool($value):
                        $type = PDO::PARAM_BOOL;
                        break;
                    case is_null($value):
                        $type = PDO::PARAM_NULL;
                        break;
                    default:
                        $type = PDO::PARAM_STR;
                }
            }

            $this->statement->bindValue($param, $value, $type);
        }

        // Execute function
        public function execute()
        {
            return $this->statement->execute();
        }

        // Return an array of objects
        public function resultSet()
        {
            $this->execute();
            return $this->statement->fetchAll(PDO::FETCH_OBJ);
        }

        // Return a specific object
        public function single()
        {
            $this->execute();
            return $this->statement->fetch(PDO::FETCH_OBJ);
        }

        // Return the row count
        public function rowCount()
        {
            return $this->statement->rowCount();
        }
       
    }