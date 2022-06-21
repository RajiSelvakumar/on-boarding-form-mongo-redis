<?php
require '../vendor/autoload.php';  
try {
    $conn = new MongoDB\Client('mongodb+srv://rajeswari:HtKkAf7vSagwdmLW@cluster0.czx0a5q.mongodb.net/mydb');
    $db = $conn->mydb;	
     $collection = $db->mycol;
      
} catch (Exception $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>