<?php
require '../vendor/autoload.php';  
//session_start();
try {
    $redis = new Predis\Client();
    $redis->connect('redis-13641.c92.us-east-1-3.ec2.cloud.redislabs.com',13641);
    //$redis->auth(['redis', 'zbkbuY3f65W4lGZwsGdKWAvAwrkFNwyg']);
    $redis->set("test","redis testing");
    $red = $redis->get("test");
    print_r('redis test key' . $red);
      
      
} catch (Exception $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

?>