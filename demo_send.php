<?php

require_once('vendor/autoload.php');
use FlowrouteMessagingLib\Controllers\MessagesController;
use FlowrouteMessagingLib\Models\Message;

// Demo script
// Please replace the variables with your information.
print "Demo SMS PHP script.\n";

$controller = new MessagesController('AccesKey','SecretKey');
print_r($controller);
 $message = new Message('TO_PHONE_NUMBER_E164', 'FROM_PHONE_NUMBER_E164', 'Your cool new SMS message here!');
 $response = $controller->createMessage($message);

//Example use of retrieving a MDR
//$response = $controller->getMessageLookup('mdr1-b334f89df8de4f8fa7ce377e06090a2e');

print_r($response);