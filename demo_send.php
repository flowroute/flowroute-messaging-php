<?php
/*
 * Copyright Flowroute Inc. 2016
 */

require_once('vendor/autoload.php');
include_once('src/Controllers/MessagesController.php');
include_once('src/Configuration.php');
include_once('src/Models/Message.php');
include_once('src/APIHelper.php');
include_once('src/APIException.php');

use FlowrouteMessagingLib\Controllers\MessagesController;
use FlowrouteMessagingLib\Models\Message;

// Demo script
// Please replace the variables in the Configuration.php with your information.
print "Flowroute, Inc - Demo SMS PHP script.\n";

// Create a controller
$controller = new MessagesController();
print_r($controller);

// Build our message
$from_number = 'One of your DIDs';
$to_number = 'Target Number';
$message = new Message($to_number, $from_number, 'Flowroute Rocks!');

// Send the message
$response = $controller->createMessage($message);
print_r($response);

// get the mdr id from the response
$mdr_id =  strval($response->data->id);

// Retrieve the MDR record
try {
    $mdr_record = $controller->getMessageLookup($mdr_id); // 'mdr1-b334f89df8de4f8fa7ce377e06090a2e'
    print_r($mdr_record);
} catch(\FlowrouteMessagingLib\APIException $e) {
    print("Error - " . strval($e->getResponseCode()) . ' ' . $e->getMessage());
}

