<?php
// Includes and required files
require_once('vendor/apimatic/unirest-php/src/Unirest.php');
foreach (glob('vendor/apimatic/unirest-php/src/Unirest/*.php') as $filename){require_once $filename;}
foreach (glob('src/*.php') as $filename){require_once $filename;}
foreach (glob('src/Controllers/*.php') as $filename){require_once $filename;}
foreach (glob('src/Models/*.php') as $filename){require_once $filename;}

use FlowrouteMessagingLib\Controllers\MessagesController;
use FlowrouteMessagingLib\Models\Message;

// Demo script
// Please replace the variables with your information.
print "Demo SMS PHP script.\n";

$controller = new MessagesController('YOUR_API_KEY','YOUR_API_SECRET_KEY');
$message = new Message('TO_PHONE_NUMBER_E164', 'FROM_PHONE_NUMBER_E164', 'Your cool new SMS message here!');
$response = $controller->createMessage($message);

print_r($response);