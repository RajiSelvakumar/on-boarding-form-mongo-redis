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
        login($collection);
    }


function login($collection){
try{
    if(isset($_POST['email']) && isset($_POST['password'])){
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $qry = array("email" => $email, "password" => $password);
    $result = $collection->findOne($qry);
    $_SESSION['profileData'] = json_encode($result);
    //global $redis;
    //$redis->set('profileData',json_encode($result));
    if($result == null){
        echo json_encode(['status' => 'error']);
    }else{
        $pass = $result["password"];
        if($password === $pass){
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