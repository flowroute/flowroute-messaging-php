# flowroute-messaging-php
## What is it?

Flowroute-messaging-php is a PHP SDK that provides methods for sending outbound SMSs with [Flowroute's](https://www.flowroute.com) API v2. These methods can be used to accomplish the following:

* Send outbound SMS
* Retrieve MDRs (message detail records)

## Documentation 
The full documentation for Flowroute's v2 API is available at [flowroute.readme.io](https://flowroute.readme.io/).

## How To Install 

We are using composer to manage the dependencies for the SDK and have already included a composer.json file for you. If you do not already have composer setup, please look at [Composer's Getting Started](https://getcomposer.org/doc/00-intro.md) article. Once you have composer setup, run the following command:

	cd flowroute-messaging-php/
	composer.phar install

> Note: You will need to be connected to the internet in order to install the required packages
  
## How To Get Setup

The following shows how to import the SDK and setup your API credentials.

1) Import the SDK module:

	require_once('vendor/autoload.php');
	use FlowrouteMessagingLib\Controllers\MessagesController;

2) Import the Models

	use FlowrouteMessagingLib\Models\Message;
   
3) Configure your API Username and Password from [Flowroute Manager](https://manage.flowroute.com/accounts/preferences/api/).
 > If you do not have an API Key contact support@flowroute.com:

	$controller = new MessagesController('YOUR_API_KEY','YOUR_API_SECRET_KEY');		

## List of Methods and Example Uses

### MessagesController

The MessagesController contains the methods neccesary to both send outbuond SMSs and to retrieve MDRs.

#### createMessage ($message)

The createMessage method is used to send outbound messages from SMS enabled Flowroute numbers.

| Parameter | Required | Usage                                                                                |
|-----------|----------|--------------------------------------------------------------------------------------|
| message   | True     | The message parameter that includes your To Number, From Number, and Message Content |

##### Example Usage

	$message = new Message('19513237981', '1206425708', 'What do you do for recreation?');
	$response = $controller->createMessage($message);

> The Messages model uses ordered parameters for the To phone number(0), From phone number(1), and Message content(2) 
	
#### getMessageLookup ($recordId)

The getMessageLookup method is used to retrieve a MDR (message detail record).

| Parameter | Required | Usage                                                 |
|-----------|----------|-------------------------------------------------------|
| recordId  | True     | The ID for the record that you would like to retrieve |

##### Example Usage

	$controller->getMessageLookup('mdr1-b334f89df8de4f8fa7ce377e06090a88');