<?php
/*
 * Copyright Flowroute Inc. 2016
 */
#Require this file
require_once('vendor/autoload.php');

#Import Message controller and model
use FlowrouteMessagingLib\Controllers\MessagesController;
use FlowrouteMessagingLib\Models\Message;

/* Demo script*/

#Instantiate the Controller and pass your API credentials
$controller = new MessagesController('API_ACCESS_KEY','API_SECRET_KEY');
print_r($controller);

#Create and Send a message
$from_number = 'FROM_PHONE_NUMBER';
$to_number = 'TO_PHONE_NUMBER';
$message = new Message($to_number, $from_number, 'Message content');

#Print the response
$response = $controller->createMessage($message);
print_r($response);

#Get  the MDR ID from the response
$mdr_id =  strval($response->data->id);

#Retrieve the MDR record
try {
    $mdr_record = $controller->getMessageLookup($mdr_id); // 'mdr1-b334f89df8de4f8fa7ce377e06090a2e'
    print_r($mdr_record);
} catch(\FlowrouteMessagingLib\APIException $e) {
    print("Error - " . strval($e->getResponseCode()) . ' ' . $e->getMessage());
}


