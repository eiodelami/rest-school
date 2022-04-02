<?php
    // INCLUDE REQUIRED LIBRARIES
    include_once '../../config/Database.php';
    include_once '../../config/Utility.php';
    include_once '../../models/School.php';

    // INSTANTIATE DATABASE & DATABASE CONNECTION
    $db = new Database();
    $database = $db->getConnection();

    // INSTANTIATE UTILITY
    $utility = new Utility($database);

    // INSTANTIATE SCHOOL
    $school = new School($database);

    // GET REQUEST METHOD
    $method = $_SERVER['REQUEST_METHOD'];

    // SET REQUEST HEADERS
    $utility->setRequestHeader();

    $data = json_decode(file_get_contents("php://input"));
    // GET SCHOOL ID
    $schoolID = isset($_REQUEST['school_id']) ? $_REQUEST['school_id']  : null;

    // FETCH SCHOOLS FUNCTION
    function fetchSchools($school) {
        // GET SCHOOLS
        $result = $school->getSchools();
        // GET SCHOOL COUNT
        $count = $result->rowCount();
        // CHECK IF ANY SCHOOL
        if($count > 0) {
            // CREATE SCHOOL ARRAY
            $school_array = array();
            $school_array['data'] =array();

            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                // CREATE SCHOOL ITEM
                $school_item = array(
                    'school_id' => $school_id,
                    'school_name' => $school_name,
                    'school_code' => $school_code,
                    'school_url' => $school_url,
                    'school_email' => $school_email,
                    'logoURL' => $logoURL,
                    'school_telephone' => $school_telephone,
                    'school_alternate_telephone' => $school_alternate_telephone,
                    'addressLine1' => $addressLine1,
                    'addressLine2' => $addressLine2,
                    'addressLine3' => $addressLine3,
                    'is_active' => $is_active,
                    'update_log' => $update_log,
                    'created_at' => $created_at,
                    'updated_at' => $updated_at
                );

                // PUSH ITEM INTO $school_array['data']
                array_push($school_array['data'], $school_item);
            }
        } else {
            // NO SCHOOL RECORD FOUND
            $school_array = array( 'message' => 'No School Record Found');
        }
        echo json_encode($school_array);
    }
    // FETCH SCHOOL FUNCTION
    function fetchSchool($school, $schoolID) {

        // SET SCHOOL ID
        $school->school_id = $schoolID;

        
        // CHECK IF SCHOOL RECORD EXIST
        if($result = $school->getSchool()) {
            // CREATE SCHOOL ARRAY
            $school_array = array(
                'school_id' => $school->school_id,
                'school_name' => $school->school_name,
                'school_code' => $school->school_code,
                'school_url' => $school->school_url,
                'school_email' => $school->school_email,
                'logoURL' => $school->logoURL,
                'school_telephone' => $school->school_telephone,
                'school_alternate_telephone' => $school->school_alternate_telephone,
                'addressLine1' => $school->addressLine1,
                'addressLine2' => $school->addressLine2,
                'addressLine3' => $school->addressLine3,
                'is_active' => $school->is_active,
                'update_log' => $school->update_log,
                'created_at' => $school->created_at,
                'updated_at' => $school->updated_at
            );
            // MAKE JSON OUTPUT
            echo json_encode($school_array);
        } else {
            echo json_encode(array('message'=>'School Record Not Found'));
        }
    }

    switch($method){
        case 'POST':
            // UPDATE SCHOOL PARAMETERS
            $school->school_name = isset($data->school_name) ? $data->school_name : $utility->requestParameter("School Name");
            $school->school_code = isset($data->school_code) ? ($data->school_code) : null;
            $school->school_url = isset($data->school_url) ? $data->school_url : null;
            $school->school_email = isset($data->school_email) ? $data->school_email : null;
            $school->logoURL = isset($data->logoURL) ? $data->logoURL : null;
            $school->school_telephone = isset($data->school_telephone) ? $data->school_telephone : null;
            $school->school_alternate_telephone = isset($data->school_alternate_telephone) ? $data->school_alternate_telephone : null;
            $school->addressLine1 = isset($data->addressLine1) ? $data->addressLine1 : null;
            $school->addressLine2 = isset($data->addressLine2) ? $data->addressLine2 : null;
            $school->addressLine3 = isset($data->addressLine3) ? $data->addressLine3 : null;
            $school->is_active = isset($data->is_active) ? $data->is_active : 1;
            $school->update_log = isset($data->school_url) ? $data->update_log : null;

            // CREATE SCHOOL RECORD
            if($school->createSchool()){
                echo json_encode(array('message' => 'School Record Created Successfully!'));
            } else {
                echo json_encode(array('message' => 'School Record Not Created!'));
            }
            // CLOSE DATABASE CONNECTION
            $db->closeConnection();
            break;
        case 'PUT':
            if(!$schoolID){
                echo 'Please Provide School ID';
                return false;
            }
            
            // SET REQUIRED PARAMETERS
            $utility->requiredParameters = "school_name, school_code, school_url, school_email, logoURL, school_telephone, school_alternate_telephone, addressLine1, addressLine2, addressLine3, is_active, update_log";
            // SET SCHOOL ID TO UPDATE
            $school->school_id = $schoolID;
            // UPDATE SCHOOL PARAMETERS
            $school->school_name = isset($data->school_name) ? $data->school_name : $utility->requestParameter();
            $school->school_code = isset($data->school_code) ? $data->school_code : $utility->requestParameter();
            $school->school_url = isset($data->school_url) ? $data->school_url : $utility->requestParameter();
            $school->school_email = isset($data->school_email) ? $data->school_email : $utility->requestParameter();
            $school->logoURL = isset($data->logoURL) ? $data->logoURL : $utility->requestParameter();
            $school->school_telephone = isset($data->school_telephone) ? $data->school_telephone : $utility->requestParameter();
            $school->school_alternate_telephone = isset($data->school_alternate_telephone) ? $data->school_alternate_telephone : $utility->requestParameter();
            $school->addressLine1 = isset($data->addressLine1) ? $data->addressLine1 : $utility->requestParameter();
            $school->addressLine2 = isset($data->addressLine2) ? $data->addressLine2 : $utility->requestParameter();
            $school->addressLine3 = isset($data->addressLine3) ? $data->addressLine3 : $utility->requestParameter();
            $school->is_active = isset($data->is_active) ? $data->is_active : $utility->requestParameter();
            // $school->update_log = isset($data->update_log) ? $data->update_log : $utility->requestParameter('update_log',': update_log can not be null');
            $school->updated_at = `CURRENT_TIMESTAMP`;

            // UPDATE SCHOOL
            if($school->updateSchool()) {
                echo json_encode( array('message' => 'School Record Updated') );
            } else {
                echo json_encode( array('message' => 'School Record Updated') );
            }

            // CLOSE DATABASE CONNECTION
            $db->closeConnection();
            break;
        case 'DELETE':
            if(!$schoolID){
                echo 'Please Provide School ID';
                return false;
            }
            // SET SCHOOL ID TO DELETE
            $school->school_id = $schoolID;

            // DELETE SCHOOL
            if($school->deleteSchool()) {
                echo json_encode(array('message' => 'School Record Deleted'));
            } else {
                echo json_encode(array('message' => 'School Record Not Deleted'));

            }
            // CLOSE DATABASE CONNECTION
            $db->closeConnection();
            break;
        default:
            // IF SCHOOL ID PROVIDED FETCH SCHOOL BY ID OTHERWISE FETCH SCHOOLS
            isset($schoolID) ? fetchSchool($school, $schoolID) : fetchSchools($school);
            // CLOSE DATABASE CONNECTION
            $db->closeConnection();
            break;
    }
    
?>