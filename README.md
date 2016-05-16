# flowroute-messaging-php
## About flowroute-messaging-php

**flowroute-messaging-python** is a PHP SDK that provides methods to create and send an outbound SMS from a Flowroute phone number and to retrieve a Message Detail Record (MDR). These methods use **v2** (version 2) of the [Flowroute](https://www.flowroute.com) API.

**Note:** This SDK does not cover searching for a set of MDRs based on a date range. For searching on a date range, see [Look up a Set of Messages](https://developer.flowroute.com/docs/lookup-a-set-of-messages) on the Flowroute Developer Portal.

## Documentation 
The full documentation for v2 of the Flowroute API is available [here](https://developer.flowroute.com/v2.0/docs).

##Before you begin

###Composer
Before importing the SDK you should have **Composer** installed. Composer is used to manage the dependencies for the PHP SDK.This SDK does not discuss setting up Composer. For those instructions, see the [Composer's Getting Started](https://getcomposer.org/doc/00-intro.md) article.  A **composer.json** file is included in the imported SDK to help manage dependencies.

After setting up Composer:

1. Change to the **flowroute-messaging-php** directory:

		cd flowroute-messaging-php

2.	Next, run the following:

		composer.phar install
 
>**Note:** You must be connected to the Internet in order to install the required packages.

###API Credentials

You will need your Flowroute API credentials (Access Key and Secret Key). These can be found on the **Preferences > API Control** page of the [Flowroute](https://manage.flowroute.com/accounts/preferences/api/) portal. If you do not have API credentials, contact <mailto:support@flowroute.com>.

###Flowroute Phone Number

In order to use the create message method a message, you will need your Flowroute phone number, enabled for SMS. If you do not know your phone number, you can find it on the [DIDs](https://manage.flowroute.com/accounts/dids/) page of the Flowroute portal.

## Import the SDK and set up your credentials

The following shows how to import the SDK and setup your API credentials. Importing the SDK allows you to instantiate the MessageController, which contains the methods used to create and send messages, and to look up an MDR.

>**Note:** Before you start, you should have your API credentials (Access Key and Secret Key). These can be found on the **Preferences > API Control** page of the [Flowroute](https://manage.flowroute.com/accounts/preferences/api/) portal. If you do not have API credentials, contact <mailto:support@flowroute.com>.


1.	Run the following two lines to import the SDK module:

		require_once('vendor/autoload.php');
		
		use FlowrouteMessagingLib\Controllers\MessagesController;

2. Import the Models:

		use FlowrouteMessagingLib\Models\Message;
   
3.	Configure the MessageController to use your Access Key and Secret Key. Replace the *`Access Key`* and *`Secret Key`* variables within the quotes (`''`) with your own Access Key and Secret Key:

		$controller = new MessagesController('Access Key','Secret Key');		

## MessagesController

The MessagesController contains the methods neccesary to both send outbound SMSs and to retrieve MDRs. It uses two endpoints: `createMessage` and `getMessageLookup`.

#### `createMessage ($message)`

The createMessage method is used to send outbound messages from SMS enabled Flowroute numbers.

| Parameter | Required | Usage                                                                                |
|-----------|----------|--------------------------------------------------------------------------------------|
| message   | True     | The message parameter that includes your To Number, From Number, and Message Content |

##### Example Usage

	$message = new Message('19513237981', '1206425708', 'What do you do for recreation?');
	$response = $controller->createMessage($message);

> The Messages model uses ordered parameters for the To phone number(0), From phone number(1), and Message content(2) 
	
#### `getMessageLookup ($recordId)`

The getMessageLookup method is used to retrieve a MDR (message detail record).

| Parameter | Required | Usage                                                 |
|-----------|----------|-------------------------------------------------------|
| recordId  | True     | The ID for the record that you would like to retrieve |

##### Example Usage

	$controller->getMessageLookup('mdr1-b334f89df8de4f8fa7ce377e06090a88');