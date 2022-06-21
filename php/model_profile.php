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
        dashboard($collection);
    }
function dashboard($collection){
try{
    global $redis;
    $profileJson = $redis->get('profileData');
    $profileObj = json_decode($profileJson);
    
    
    $myObj = new stdClass();
    $myObj->fname = $profileObj->fname;
    $myObj->lname = $profileObj->lname;
    $decrypted_email = decrypt($profileObj->email);
    $myObj->email = $decrypted_email;
    $myObj->date = $profileObj->date;
    $myObj->contact = $profileObj->contact;
    $myObj->password = $profileObj->password;
    $myJSON = json_encode($myObj);
    echo $myJSON;
}catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
}
?>