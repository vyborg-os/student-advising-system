<?php
    class Database {
        private $host = 'localhost';
        private $user = 'root';
        private $pass = '';
        private $dbname = 'advise';
        private $conn;

        public function connect() {
            $this->conn = null;
            try {
                $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
                if ($this->conn->connect_error) {
                    throw new Exception("Connection failed: " . $this->conn->connect_error);
                }
            } catch (Exception $e) {
                echo "Connection error: " . $e->getMessage();
            }
            return $this->conn;
        }

        public function close() {
            if ($this->conn) {
                $this->conn->close();
            }
        }
    }