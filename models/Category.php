<?php
    Class Category {
        //DB Stuff
        private $conn;
        private $table = 'categories';

        //Properties
        public $id;
        public $name;
        public $created;

        //Constructor with DB
        public function __construct($db) {
            $this->conn = $db;
        }

        //Get categories
        public function read() {
            //Create query
            $query = 'SELECT
                id,
                name,
                created
                FROM 
                ' . $this->table . '
                ORDER BY
                created DESC';

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Execute query
            $stmt->execute();

            return $stmt;
        }
    }