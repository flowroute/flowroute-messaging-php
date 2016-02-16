<?php

require_once('vendor/autoload.php');
use FlowrouteMessagingLib\Controllers\MessagesController;
use FlowrouteMessagingLib\Models\Message;

// Demo script
// Please replace the variables with your information.
print "Demo SMS PHP script.\n";

$controller = new MessagesController('11656133','zJxOC2VNO7BIHiYTs6InrMnmluYy2dks');
// $message = new Message('TO_PHONE_NUMBER_E164', 'FROM_PHONE_NUMBER_E164', 'Your cool new SMS message here!');
// $response = $controller->createMessage($message);
$response = $controller->getMessageLookup('mdr1-b334f89df8de4f8fa7ce377e06090a2e');

print_r($response);