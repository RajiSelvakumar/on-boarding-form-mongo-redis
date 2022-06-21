<?php
header("Access-Control-Allow-Methods: GET,POST,PUT,PATCH,DELETE");
header('Access-Control-Allow-Credentials: true');
header('Content-Type: plain/text');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods,Access-Control-Allow-Origin, Access-Control-Allow-Credentials, Authorization, X-Requested-With");

require("../php/db.php");
require("../php/redisdb.php");
require("../php/encrypt.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        update($collection);
    }
function update($collection){
try{
    global $redis;
    if(isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['email'])  && isset($_POST['date'])  && isset($_POST['contact']) && isset($_POST['password'])){
        $fname = trim($_POST['fname']);
        $lname = trim($_POST['lname']);
        $email = trim($_POST['email']);
        $date =trim($_POST['date']);
        $contact = trim($_POST['contact']);
        $password = trim($_POST['password']);
    
        $encrypted_email = encrypt($email);
        $updateCond = array("email"=>$encrypted_email);
        $update = array('$set'=>array(
            "fname"=>$fname,
            "lname" => $lname,
            "email" => $encrypted_email,
            "contact" => $contact,
            "date" => $date, 
            "password" => $password
        ));
        $options = array("multiple" => true);
        if($collection->updateOne($updateCond,$update,$options)){
            $qry = array("email" => $encrypted_email);
            $result = $collection->findOne($qry);            
            $redis->set('profileData',json_encode($result));
              echo json_encode(['status' => 'success']);
        }else{
            echo 'update failure';
        }
        
    }    
}catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
}
?>