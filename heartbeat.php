<?php

require 'vendor/autoload.php';

$client = null;

if(empty($_ENV['REDIS_TLS_URL'])) {
    
    echo "Connecting to local Redis database...<br>\n";
    // localhost
    // port: 6379
    // auth ???
    $client = new Predis\Client();
    

} else {
    echo "Connecting to Heroku Redis database...<br>\n";
    $client = new Predis\Client(getenv('REDIS_URL') . "?ssl[verify_peer_name]=0&ssl[verify_peer]=0");
} 
echo 'Connected<br>';

$client->set('foo', 'bar');
$value = $client->get('foo');

echo "value of foo = $value\n";

// $_ENV['REDIS_TLS_URL'] = 'localhost';
// echo $_ENV['REDIS_TLS_URL'];

if(isset($_REQUEST['id']) && isset($_REQUEST['key']) && isset($_REQUEST['body'])) {



}
