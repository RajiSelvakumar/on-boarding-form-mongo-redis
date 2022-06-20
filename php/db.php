<?php
require '../vendor/autoload.php';  
session_start();
try {
    //$conn = new MongoDB\Client("mongodb://localhost:27017"); 
    $conn = new MongoDB\Client('mongodb+srv://rajeswari:HtKkAf7vSagwdmLW@cluster0.czx0a5q.mongodb.net/mydb');
      //echo "Connection to database successfully";
    $db = $conn->mydb;	
      //echo "Database mydb selected";
     $collection = $db->mycol;
      //echo "Collection created succsessfully";      
      
} catch (Exception $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>