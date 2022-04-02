<?php
    // CREATE AN INSTANCE OF SCHOOL
    class School {
        // DATABASE PRIVATE PARAMETERS
        private $connection;
        private $tableName = "schools";

        // SCHOOL PARAMETERS
        public $school_id;
        public $school_name;
        public $school_code;
        public $school_url;
        public $school_email;
        public $logoURL;
        public $school_telephone;
        public $school_alternate_telephone;
        public $addressLine1;
        public $addressLine2;
        public $addressLine3;
        public $is_active;
        public $update_log;
        public $created_at;
        public $updated_at;

        // CONSTRUCTOR METHOD
        public function __construct($database) {
            $this->connection =$database;
        }

        // CREATE SCHOOL METHOD
        public function createSchool() {
            // CREATE QUERY
            $query = "INSERT INTO $this->tableName SET school_name=:school_name, school_code=:school_code, school_url=:school_url, school_email=:school_email, logoURL=:logoURL, school_telephone=:school_telephone, school_alternate_telephone=:school_alternate_telephone, addressLine1=:addressLine1, addressLine2=:addressLine2, addressLine3=:addressLine3, is_active=:is_active /*,update_log=:update_log*/";
            // PREPARE STATEMENT
            $statement =$this->connection->prepare($query);
            // CLEAN DATA INPUT
            $this->school_name = htmlspecialchars(strip_tags($this->school_name));
            $this->school_code = htmlspecialchars(strip_tags($this->school_code));
            $this->school_url = htmlspecialchars(strip_tags($this->school_url));
            $this->school_email = htmlspecialchars(strip_tags($this->school_email));
            $this->logoURL = htmlspecialchars(strip_tags($this->logoURL));
            $this->school_telephone = htmlspecialchars(strip_tags($this->school_telephone));
            $this->school_alternate_telephone = htmlspecialchars(strip_tags($this->school_alternate_telephone));
            $this->addressLine1 = htmlspecialchars(strip_tags($this->addressLine1));
            $this->addressLine2 = htmlspecialchars(strip_tags($this->addressLine2));
            $this->addressLine3 = htmlspecialchars(strip_tags($this->addressLine3));
            $this->is_active = htmlspecialchars(strip_tags($this->is_active));
            // $this->update_log = htmlspecialchars(strip_tags($this->update_log));
            // BIND DATA PARAMETERS
            $statement->bindParam(':school_name', $this->school_name);
            $statement->bindParam(':school_code', $this->school_code);
            $statement->bindParam(':school_url', $this->school_url);
            $statement->bindParam(':school_email', $this->school_email);
            $statement->bindParam(':logoURL', $this->logoURL);
            $statement->bindParam(':school_telephone', $this->school_telephone);
            $statement->bindParam(':school_alternate_telephone', $this->school_alternate_telephone);
            $statement->bindParam(':addressLine1', $this->addressLine1);
            $statement->bindParam(':addressLine2', $this->addressLine2);
            $statement->bindParam(':addressLine3', $this->addressLine3);
            $statement->bindParam(':is_active', $this->is_active);
            // $statement->bindParam(':update_log', $this->update_log);
            // CONDITIONALLY EXECUTE QUERY
            if($statement->execute()) {
                return true;
            }
            // PRINT ERROR IF SOMETHING GOES WRONG
            printf("Error: %s. \n", $statement->error);
            return false;
        }

        // DELETE SCHOOL METHOD
        public function deleteSchool() {
            // DELETE QUERY
            $query = "DELETE FROM $this->tableName WHERE school_id=:school_id";
            // PREPARE STATEMENT
            $statement = $this->connection->prepare($query);
            // CLEAN DATA INPUT
            $this->school_id = htmlspecialchars(strip_tags($this->school_id));
            // BIND DATA INPUT
            $statement->bindParam(':school_id', $this->school_id);
            // CONDITIONALLY EXECUTE QUERY
            if($statement->execute()) {
                return true;
            }
            // PRINT ERROR IF SOMETHING GOES WRONG
            printf("Error: %s. \n", $statement->error);
            return false;

        }

        // GET SCHOOLS METHOD
        public function getSchools() {
            // SELECT QUERY
            $query = "SELECT school_id, school_name, school_code, school_url, school_email, logoURL, school_telephone, school_alternate_telephone, addressLine1, addressLine2, addressLine3, is_active, update_log, created_at, updated_at FROM $this->tableName ORDER BY school_id ASC";
            // PREPARE STATEMENT
            $statement = $this->connection->prepare($query);
            // EXECUTE QUERY
            $statement->execute();
            // RETURN STATEMENT
            return $statement;
        }

        // GET SCHOOL METHOD
        public function getSchool() {
            // SELECT QUERY
            $query = "SELECT school_id, school_name, school_code, school_url, school_email, logoURL, school_telephone, school_alternate_telephone, addressLine1, addressLine2, addressLine3, is_active, update_log, created_at, updated_at FROM $this->tableName WHERE school_id=:school_id";

            // PREPARE STATEMENT
            $statement = $this->connection->prepare($query);
            // CLEAN DATA INPUT
            $this->school_id = htmlspecialchars(strip_tags($this->school_id));
            // BIND DATA INPUT
            $statement->bindParam(':school_id', $this->school_id);
            
            // EXECUTE QUERY
            $statement->execute();
            // FETCH DATA
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            if($statement->rowCount() > 0){
                // SET SCHOOL PROPERTIES
                $this->school_name = $row['school_name'];
                $this->school_code = $row['school_code'];
                $this->school_url = $row['school_url'];
                $this->school_email = $row['school_email'];
                $this->logoURL = $row['logoURL'];
                $this->school_telephone = $row['school_telephone'];
                $this->school_alternate_telephone = $row['school_alternate_telephone'];
                $this->addressLine1 = $row['addressLine1'];
                $this->addressLine2 = $row['addressLine2'];
                $this->addressLine3 = $row['addressLine3'];
                $this->is_active = $row['is_active'];
                $this->update_log = $row['update_log'];
                return $this;
            }

            // return $this;
        }

        // UPDATE SCHOOL METHOD
        public function updateSchool() {
            // UPDATE QUERY
            $query = "UPDATE $this->tableName SET school_name=:school_name, school_code=:school_code, school_url=:school_url, school_email=:school_email, logoURL=:logoURL, school_telephone=:school_telephone, school_alternate_telephone=:school_alternate_telephone, addressLine1=:addressLine1, addressLine2=:addressLine2, addressLine3=:addressLine3, is_active=:is_active, update_log=:update_log WHERE school_id=:school_id";
            // PREPARE STATEMENT
            $statement = $this->connection->prepare($query);
            // CLEAN DATA INPUT
            $this->school_id = htmlspecialchars(strip_tags($this->school_id));
            $this->school_name = htmlspecialchars(strip_tags($this->school_name));
            $this->school_code = htmlspecialchars(strip_tags($this->school_code));
            $this->school_url = htmlspecialchars(strip_tags($this->school_url));
            $this->school_email = htmlspecialchars(strip_tags($this->school_email));
            $this->logoURL = htmlspecialchars(strip_tags($this->logoURL));
            $this->school_telephone = htmlspecialchars(strip_tags($this->school_telephone));
            $this->school_alternate_telephone = htmlspecialchars(strip_tags($this->school_alternate_telephone));
            $this->addressLine1 = htmlspecialchars(strip_tags($this->addressLine1));
            $this->addressLine2 = htmlspecialchars(strip_tags($this->addressLine2));
            $this->addressLine3 = htmlspecialchars(strip_tags($this->addressLine3));
            $this->is_active = htmlspecialchars(strip_tags($this->is_active));
            $this->update_log = htmlspecialchars(strip_tags($this->update_log));
            // BIND DATA PARAMETERS
            $statement->bindParam(':school_id', $this->school_id);
            $statement->bindParam(':school_name', $this->school_name);
            $statement->bindParam(':school_code', $this->school_code);
            $statement->bindParam(':school_url', $this->school_url);
            $statement->bindParam(':school_email', $this->school_email);
            $statement->bindParam(':logoURL', $this->logoURL);
            $statement->bindParam(':school_telephone', $this->school_telephone);
            $statement->bindParam(':school_alternate_telephone', $this->school_alternate_telephone);
            $statement->bindParam(':addressLine1', $this->addressLine1);
            $statement->bindParam(':addressLine2', $this->addressLine2);
            $statement->bindParam(':addressLine3', $this->addressLine3);
            $statement->bindParam(':is_active', $this->is_active);
            $statement->bindParam(':update_log', $this->update_log);
            
            // CONDITIONALLY EXECUTE QUERY
            if($statement->execute()) {
                return true;
            }
            // PRINT ERROR IF SOMETHING GOES WRONG
            printf("Error: %s. \n", $statement->error);
            return false;
        }
    }
?>