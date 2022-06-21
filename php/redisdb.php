<?php
require '../vendor/autoload.php';  
//session_start();
try {
    $redis = new Predis\Client(array(
        'host' => ('redis-13641.c92.us-east-1-3.ec2.cloud.redislabs.com'),
        'port' => (13641),
        'password' => ('zbkbuY3f65W4lGZwsGdKWAvAwrkFNwyg'),
    ));
    //$redis = new Predis\Client();
    //$redis->connect('redis-13641.c92.us-east-1-3.ec2.cloud.redislabs.com',13641);
    //$redis->auth(['redis', 'zbkbuY3f65W4lGZwsGdKWAvAwrkFNwyg']);
    echo "redis connection success";  
      
} catch (Exception $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

?>