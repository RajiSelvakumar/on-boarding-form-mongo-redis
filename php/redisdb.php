<?php
require '../vendor/autoload.php';  
//session_start();
try {
    $redis = new Predis\Client();
    $redis->connect('redis-18861.c263.us-east-1-2.ec2.cloud.redislabs.com:18861');
    $redis->auth(['redisUser', '3FAKExSW6Rez9Xw0admB']);
    //$redis->connect('tls://redis-9f6095f3-of5ff6e31.database.cloud.ovh.net', 20185);

    
      
      //$redis = new Redis();
      //$redis->connect('127.0.0.1', 6379);
      //echo "redis connected successfully";
      
      
} catch (Exception $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

?>