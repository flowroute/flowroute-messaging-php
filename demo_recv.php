<?php
/*
 * Copyright Flowroute Inc. 2016
 *
 * Capture incoming SMS messages
 */


// Get our incoming string
$incoming_post = file_get_contents("php://input");
if(count($incoming_post)) {

    // Decode the JSON
    $json = json_decode($incoming_post);

    $body = $json->body;
    $to = $json->to;
    $from = $json->from;
    $id = $json->id;

    error_log("To   : " . $to, 0);
    error_log("From : " . $from, 0);
    error_log("Id   : " . $id, 0);
    error_log("Body : " . $body, 0);

    // To get the full detail, see the call to getMessageLookup in the 'demo_send.php' SDK file
}

// Always return a 200 code
http_response_code(200);