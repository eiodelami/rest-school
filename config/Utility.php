<?php
    // CREATE AN INSTANCE OF UTILITY
    class Utility {
        // DATABASE PRIVATE PARAMETERS
        private $connection;

        // UTILITY PARAMETERS
        public $requiredParameters;

        // CONSTRUCTOR METHOD
        public function __construct($database) {
            $this->connection = $database;
        }

        /* --- UTILITY METHODS --- */
        // REQUEST PARAMETER METHOD
        public function requestParameter($parameter=null,$info=null) {
            $defaultMessage = "Please Provide Required Parameter(s) $this->requiredParameters";
            $errorMessage = "Please Provide $parameter Parameter$info";
            echo json_encode(array('message' => $parameter ? $errorMessage : $defaultMessage));
            die();
        }

        // SET REQUEST HEADER METHOD
        public function setRequestHeader() {
            // GET REQUEST METHOD
            $method=$_SERVER['REQUEST_METHOD'];

            // SET GENERIC ACCESS CONTROL HEADERS
            header('Access-Control-Allow-Origin: *');
            header('Content-Type: application/json');
            header('Access-Contol-Allow-Headers: Access-Control-Allow-Headers, Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

            switch($method){
                case 'POST':
                    # SET POST HEADER
                    header('Access-Control-Allow-Methods: POST');
                    break;
                case 'PUT':
                    header('Access-Control-Allow-Methods: PUT');
                    break;
                case 'DELETE':
                    header('Access-Control-Allow-Methods: DELETE');
                    break;
                default:
                    // header('Access-Control-Allow-Methods: POST, PUT, GET, DELETE, PATCH, PUT, HEAD, OPTION');
                    break;
            }
            return null;
        }

        // SET GET AUTHORIZATION METHOD
        public function getAuthorization($bearerToken=null) {
            // CHECK IF USER ACCESS KEY IS AUTHORIZED, RETURN TRUE OR FALSE
        }
    }
?>