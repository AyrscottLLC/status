<?php

require 'vendor/autoload.php';

$client = null;

if(empty($_ENV['REDIS_TLS_URL'])) {
    $client = new Predis\Client();
} else {
    $client = new Predis\Client(getenv('REDIS_URL') . "?ssl[verify_peer_name]=0&ssl[verify_peer]=0");
} 

if(isset($_REQUEST['id']) && isset($_REQUEST['key']) && isset($_REQUEST['body'])) {



}
