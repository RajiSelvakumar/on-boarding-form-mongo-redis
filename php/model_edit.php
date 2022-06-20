<?php
// this header needs to set according to where your frontend is running
header("Access-Control-Allow-Methods: GET,POST,PUT,PATCH,DELETE");
header('Access-Control-Allow-Credentials: true');
header('Content-Type: plain/text');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods,Access-Control-Allow-Origin, Access-Control-Allow-Credentials, Authorization, X-Requested-With");

include_once("../php/db.php");
include_once("../php/redisdb.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        update($collection);
    }
function update($collection){
try{
    if(isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['email'])  && isset($_POST['date'])  && isset($_POST['contact']) && isset($_POST['password'])){
        $fname = trim($_POST['fname']);
        $lname = trim($_POST['lname']);
        $email = trim($_POST['email']);
        $date =trim($_POST['date']);
        $contact = trim($_POST['contact']);
        $password = trim($_POST['password']);    

        /*$update = $collection->updateOne(
            array("email"=>$email),
            array('$set'=>array(
                "fname"=>$fname,
                "lname" => $lname,
                "email" => $email,
                "contact" => $contact,
                "date" => $date, 
                "password" => $password
            ))
        );
        $_SESSION['update'] = $update;
        print_r($_SESSION['update']);
        $myObj = $_SESSION['update'];
        $myJSON = json_encode($myObj);
        $_SESSION['profileData'] = $myJSON;
          echo json_encode(['status' => 'success']);*/
    
        $updateCond = array("email"=>$email);
        $update = array('$set'=>array(
            "fname"=>$fname,
            "lname" => $lname,
            "email" => $email,
            "contact" => $contact,
            "date" => $date, 
            "password" => $password
        ));
        $options = array("multiple" => true);
        if($collection->updateOne($updateCond,$update,$options)){
            $qry = array("email" => $email);
            $result = $collection->findOne($qry);
            $myJSON = json_encode($result);
            //print_r($myJSON);
            $_SESSION['profileData'] = $myJSON;
            //global $redis;
            //$redis->set('profileData',$myJSON);
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