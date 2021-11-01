<?php

require 'vendor/autoload.php';

$client = null;


if(empty($_ENV['REDIS_TLS_URL'])) {
    
    // localhost
    // port: 6379
    // auth ???
    $client = new Predis\Client();
} else {
    $client = new Predis\Client(getenv('REDIS_URL') . "?ssl[verify_peer_name]=0&ssl[verify_peer]=0");
} 

// $_ENV['REDIS_TLS_URL'] = 'localhost';
// echo $_ENV['REDIS_TLS_URL'];

if(isset($_REQUEST['id']) && isset($_REQUEST['key']) && isset($_REQUEST['body'])) {



}
