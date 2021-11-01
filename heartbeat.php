<?php
/*

https://github.com/predis/predis

Predis example code:

$client->set('foo', 'bar');
$value = $client->get('foo');

*/

require 'vendor/autoload.php';

function validate_key() {
    $return_value = false;

    // check that an id and key were provided
    if(isset($_REQUEST['id']) && isset($_REQUEST['key'])) {

        // check if we have a local private key provided by heroku
        if(empty($_ENV['PRIVATE_KEY'])) {
            // key always passes locally
            $return_value = true;
        } else {
            // return if the key matches
            $return_value = ($_ENV['PRIVATE_KEY'] === $_REQUEST['key']);
        }
    }

    return $return_value;
}


// where we will store our redis client...
$client = null;
$request_start = microtime(true);

// check if we are in heroku or on our local dev station
if(empty($_ENV['REDIS_TLS_URL'])) {
    $client = new Predis\Client();
} else {
    $client = new Predis\Client(getenv('REDIS_URL') . "?ssl[verify_peer_name]=0&ssl[verify_peer]=0");
} 

// check if were provided a valid key for our environment 
if(validate_key()) {
    // if the key validates store the time the requested started
    $client->set($_REQUEST['id'], $request_start);
    http_response_code(202);    // 202 - accepted
} else {
    http_response_code(400);    // 400 - bad request
}