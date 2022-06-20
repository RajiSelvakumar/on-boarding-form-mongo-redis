<?php
// this header needs to set according to where your frontend is running
header("Access-Control-Allow-Methods: GET,POST,PUT,PATCH,DELETE");
header('Access-Control-Allow-Credentials: true');
header('Content-Type: plain/text');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods,Access-Control-Allow-Origin, Access-Control-Allow-Credentials, Authorization, X-Requested-With");

include_once("../php/db.php");
//include_once("../php/redisdb.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        registerUser($collection);
    }
function registerUser($collection){
    try{
      if(isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['email']) && isset($_POST['contact']) && isset($_POST['date']) && isset($_POST['password'])){
        $fname = trim($_POST['fname']);
        $lname = trim($_POST['lname']);
        $email = trim($_POST['email']);
        $contact = trim($_POST['contact']);
        $date = trim($_POST['date']);
        $password = trim($_POST['password']);  
        
        
            $Query = $collection->insertOne([
                "fname" => $fname,
                "lname" => $lname,
                "email" => $email,
                "contact" => $contact,
                "date" => $date, 
                "password" => $password
             ]);
             echo json_encode(['status'=>'success']);
                   
            
            
        
     }
     }catch (Exception $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
        
}



?>