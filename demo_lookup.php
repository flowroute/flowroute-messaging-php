<?php
/*Copyright Flowroute Inc. 2016
 */

require_once('vendor/autoload.php');


use FlowrouteMessagingLib\Controllers\MessagesController;
use FlowrouteMessagingLib\Models\Message;

/* Demo script */

// Create a controller
$controller = new MessagesController('29039577','f1e6e84e4599636158c49d76b6b71c00');
print_r($controller);

// Retrieve the MDR record
try {
    $mdr_record = $controller->getMessageLookup('mdr1-2036860b25ed410884a405e0859bf25c'); // 'mdr1-b334f89df8de4f8fa7ce377e06090a2e'
    print_r($mdr_record);
} catch(\FlowrouteMessagingLib\APIException $e) {
    print("Error - " . strval($e->getResponseCode()) . ' ' . $e->getMessage());
}
