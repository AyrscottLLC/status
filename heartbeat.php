<?php
/*

https://github.com/predis/predis

Predis example code:

$client->set('foo', 'bar');
$value = $client->get('foo');

*/
require 'vendor/autoload.php';

// where we will store our redis client...
$client = null;

function validate_key() {
    // check that an id and key were provided
    if(isset($_REQUEST['id']) && isset($_REQUEST['key'])) {

        // check if we have a local private key provided by heroku
        if(empty($_ENV['PRIVATE_KEY'])) {
            return true;
        } else {
            return ($_ENV['PRIVATE_KEY'] === $_REQUEST['key']);
        }
    }
}

// check if we are in heroku or on our local dev station
if(empty($_ENV['REDIS_TLS_URL'])) {
    $client = new Predis\Client();
} else {
    $client = new Predis\Client(getenv('REDIS_URL') . "?ssl[verify_peer_name]=0&ssl[verify_peer]=0");
} 

if(validate_key()) {
    $client->set($_REQUEST['id'], microtime(true));
    http_response_code(202);
} else {
    http_response_code(400);
}