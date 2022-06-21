<?php
// this header needs to set according to where your frontend is running
header("Access-Control-Allow-Methods: GET,POST,PUT,PATCH,DELETE");
header('Access-Control-Allow-Credentials: true');
header('Content-Type: plain/text');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods,Access-Control-Allow-Origin, Access-Control-Allow-Credentials, Authorization, X-Requested-With");

require("../php/db.php");
require("../php/redisdb.php");
require("../php/encrypt.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        login($collection);
    }


function login($collection){
try{
    global $redis;

    if(isset($_POST['email']) && isset($_POST['password'])){
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $encrypted_email = encrypt($email);
    $qry = array("email" => $encrypted_email, "password" => $password);
    $result = $collection->findOne($qry);  
    $redis->set('profileData',json_encode($result));
    if($result == null){
        echo json_encode(['status' => 'error']);
    }else{
        $pass = $result["password"];
        $encrypted_email = $result["email"];
        if($password === $pass){
            $decrypt_email = decrypt($encrypted_email);
            //print_r("Decrypted email" . $decrypt_email);
            echo json_encode(['status' => 'success']);
        }        
        
    }
      
    }
}catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
}



?>