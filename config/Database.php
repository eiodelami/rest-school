<?php
    // CREATE AN INSTANCE OF DATABASE
    class Database {
        // DATABASE PRIVATE PARAMETERS
        private $connection;
        private $hostname = 'localhost';
        private $database = 'rest_school';
        private $username = 'root';
        private $password = '';

        // GET CONNECTION DATABASE METHOD
        public function getConnection() {
            // ESTABLISH SERVER CONNECTION WITH TRY AND CATCH
            try {
                // INTIIALIZE CONNECTION TO NULL
                $this->connection = null;
                // ESTABLISH CONNECTION
                $this->connection = new PDO("mysql:host=$this->hostname;dbname=$this->database",$this->username,$this->password);
                // SET DATABASE ATTRIBUTES
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $error) {
                die('Error Connecting: %s. \n'. $error->getMessage());
            }
            // RETURN CONNECTION
            return $this->connection;
        }

        // CLOSE CONNECTION DATABASE METHOD
        public function closeConnection() {
            $this->connection = null;
        }
    }
?>
