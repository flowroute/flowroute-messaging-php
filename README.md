# flowroute-messaging-php
## About flowroute-messaging-php

**flowroute-messaging-python** is a PHP SDK that provides methods to create and send an outbound SMS from a Flowroute phone number and to retrieve a Message Detail Record (MDR). These methods use **v2** (version 2) of the [Flowroute](https://www.flowroute.com) API.

**Note:** This SDK does not cover searching for a set of MDRs based on a date range. For searching on a date range, see [Look up a Set of Messages](https://developer.flowroute.com/docs/lookup-a-set-of-messages) on the Flowroute Developer Portal.

### Documentation 
The full documentation for v2 of the Flowroute API is available [here](https://developer.flowroute.com/v2.0/docs).

##Before you begin

The following are required before you can import the SDK.

###1. Install Composer
Before importing the SDK you should have **Composer** installed. Composer is used to manage the dependencies for the PHP SDK.This SDK does not discuss setting up Composer. For those instructions, see the [Composer's Getting Started](https://getcomposer.org/doc/00-intro.md) article at the Composer web site. 

After setting up Composer:

1. Change to the **flowroute-messaging-php** directory:

		cd flowroute-messaging-php

2.	Next, run the following:

		composer.phar install
 
>**Note:** You must be connected to the Internet in order to install the required packages.

###2. Have your API credentials

You will need your Flowroute API credentials (Access Key and Secret Key). These can be found on the **Preferences > API Control** page of the [Flowroute](https://manage.flowroute.com/accounts/preferences/api/) portal. If you do not have API credentials, contact <mailto:support@flowroute.com>.

###3. Have your Flowroute phone number

In order to use the create message method a message, you will need your Flowroute phone number, enabled for SMS. If you do not know your phone number, you can find it on the [DIDs](https://manage.flowroute.com/accounts/dids/) page of the Flowroute portal.

## Import the SDK and set up your credentials

The following shows how to import the SDK and set up your API credentials. Importing the SDK allows you to instantiate the MessageController, which contains the methods used to create and send messages, and to look up an MDR.  A **composer.json** file is included in the imported SDK to help manage dependencies.

1.	Run the following two lines to import the SDK module:

		require_once('vendor/autoload.php');
		
		use FlowrouteMessagingLib\Controllers\MessagesController;

2. Import the Models:

		use FlowrouteMessagingLib\Models\Message;
   
3.	Configure the MessageController to use your Access Key and Secret Key. Replace the *`Access Key`* and *`Secret Key`* variables within the quotes (`''`) with your own Access Key and Secret Key:

		$controller = new MessagesController('Access Key','Secret Key');


## MessagesController

The MessagesController contains the methods needed to both send outbound SMS texts and to retrieve MDRs. It uses two endpoints: `createMessage` and `getMessageLookup`.

#### `createMessage ($message)`

The createMessage method is used to send outbound messages from an SMS-enabled Flowroute phone number.
#####Usage

The request is formatted is passed as follows:

	$message = new Message('To', 'From', 'Message content.');

It is composed of the following:

| Parameter | Required | Usage                                                                                |
|-----------|----------|-----------------------------------------------------------------|
| `$message` | True   | The message variable. The variable can have any name, and there is no limit on the length. For this method, `message` is used. The variable is further composed of the following:|
| | |<li>*`To`* — The recipient's phone number, which must be an E.164 11-digit number formatted as 1XXXXXXXXXX. </li> <li>*`From`* — Your Flowroute phone number, which must be an E.164 11-digit number formatted as 1XXXXXXXXXX.</l><li>*`Message content`*—The message itself. An unlimited number of characters can be used, but message length rules and encoding apply. See [Message Length & Concatenation](https://developer.flowroute.com/docs/message-length-concatenation) for more information.|


##### Example Usage

1.	Run the following to generate the message, replacing the `messgage`, `to`, `from`, and `Message content` variables with your own values:

		$message = new Message('15305557784', '18444205700', 'This is message content.');

2.	Next, run the following to send the message, replacing the `message` variable with your own value:

		$response = $controller->createMessage($message);

>**Note:** The Messages model uses ordered parameters for the To phone number(0), From phone number(1), and Message content(2).

#####Message response

	
#### `getMessageLookup ($recordId)`

The `getMessageLookup` method is used to retrieve an MDR by passing the record identifier of a previously sent message.

| Parameter | Required | Usage                                                 |
|-----------|----------|-------------------------------------------------------|
| `id`      | True     | The identifier of an existing record to retrieve. The value should include the`mdr1-`prefix. |
##### Example Usage

	$controller->getMessageLookup('mdr1-b334f89df8de4f8fa7ce377e06090a88');