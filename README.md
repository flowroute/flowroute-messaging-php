# flowroute-messaging-php

**flowroute-messaging-python** is a PHP SDK that provides methods to create and send an outbound SMS from a Flowroute phone number and to retrieve a Message Detail Record (MDR). These methods use **v2** (version 2) of the [Flowroute](https://www.flowroute.com) API.

**Note:** This SDK does not cover searching for a set of MDRs based on a date range. For searching on a date range, see [Look up a Set of Messages](https://developer.flowroute.com/docs/lookup-a-set-of-messages) on the Flowroute Developer Portal.

### Documentation 
The full documentation for the v2 Flowroute API is available [here](https://developer.flowroute.com/v2.0/docs).

##Before you begin

The following are required before you can deploy the SDK.

###1. Install Composer
Before importing the SDK you should have **Composer** installed, which is used to manage the dependencies for the PHP SDK. This SDK does not discuss setting up Composer. See Composer's [Getting Started](https://getcomposer.org/doc/00-intro.md) guide at the Composer web site for those steps.  

After setting up Composer:

1. Change to the **flowroute-messaging-php** directory:

		cd flowroute-messaging-php

2.	Next, run the following:

		php composer.phar install
 
>**Note:** You must be connected to the Internet in order to install the required packages.

###2. Have your API credentials

You will need your Flowroute API credentials (Access Key and Secret Key). These can be found on the **Preferences > API Control** page of the [Flowroute](https://manage.flowroute.com/accounts/preferences/api/) portal. If you do not have API credentials, contact <mailto:support@flowroute.com>.

###3. Have your Flowroute phone number

In order to use the create message method a message, you will need your Flowroute phone number, enabled for SMS. If you do not know your phone number, you can find it on the [DIDs](https://manage.flowroute.com/accounts/dids/) page of the Flowroute portal.

## Install the required libraries


> **Note:** You must be connected to the Internet in order to install the required libraries.

1. Open a terminal session. 

2. If needed, create a parent directory folder where you want to install the SDK.
 
3. Go to the newly created folder, and run the following:

 	`https://github.com/flowroute/flowroute-numbers-php.git`
 	
 	The `git clone` command clones the **flowroute-messaging-php** respository as a sub directory within the parent folder.
 	
4.	Change directories to the newly created **flowroute-messaging-php** directory.

## Create a PHP file to set up the MessagesController

The following shows how to import the SDK and set up your API credentials. Importing the SDK allows you to instantiate the MessageController, which contains the methods used to create and send messages, and to look up an MDR.  A **composer.json** file is included in the imported SDK to help manage dependencies.

1.	Using a code text editor — for example, *Sublime Text* — create a new file and add the following lines:

	>**Note:** See [Set parameters and variables](#setparams) below for details about the information required in the file.

		<?php
		
			require_once('vendor/autoload.php');

			use FlowrouteMessagingLib\Controllers\MessagesController;

			use FlowrouteMessagingLib\Models\Message;

			$controller_name = new MessagesController('Access Key','Secret Key');
			
			$message_name = new Message('To', 'From', 'Message content.');
			
			$response_name = $controller_name->createMessage($message_name);

			# print_r($response_name);

		?>

2.	Save the file with a PHP extension in your **flowroute-messaging-php** directory. For this example, the file is named ***createmsg.php***.

>**Note:** In the example above, the `print_r($response);` is commented out. This line is not needed if you do not need to retrieve an MDR ID for the `getMessageLookup` method. Remove the comment character if you will need this information.

###Set parameters and variables<a name="setparams"></a>

The MessagesController uses the following variables:

**`$controller = new MessagesController('Access Key','Secret Key');`**


| Parameter | Required | Usage                                                           |
|-----------|----------|-----------------------------------------------------------------|
| `$controller_name` | True   | The variable name assigned to the controller. The variable can have any name, and there is no limit on the length. For this method, `controller` is used.|
|`Access Key`|True|Your Flowroute Access Key.|
|`Secret Key`|True|Your Flowroute Secret Key.

**`$message = new Message('To', 'From', 'Message content.');`**

| Parameter | Required | Usage                                                           |
|-----------|----------|-----------------------------------------------------------------|
| `$message_name` | True   | The message variable. The variable can have any name, and there is no limit on the length. For this method, `message` is used. The variable is further composed of the following:|
| | |<li>*`To`* — The recipient's phone number, which must be an E.164 11-digit number formatted as *`1XXXXXXXXXX`*. </li> <li>*`From`* — Your Flowroute phone number, which must be an E.164 11-digit number formatted as *`1XXXXXXXXXX`*.</l><li>*`Message content`*—The message itself. An unlimited number of characters can be used, but message length rules and encoding apply. See [Message Length & Concatenation](https://developer.flowroute.com/docs/message-length-concatenation) for more information.|

####`$response = $controller->createMessage($message);`

| Parameter | Required | Usage                                                           |
|-----------|----------|-----------------------------------------------------------------|
| `$response_name` | True   | The message variable. The variable can have any name, and there is no limit on the length. For this method, `response` is used. |
| `$controller_name` | True   | The name of the variable created above. |
| `$message` | True   | The name of the variable created above. |


####`print_r($response);`
| Parameter | Required | Usage                                                           |
|-----------|----------|-----------------------------------------------------------------|
| `$response` | True   | The name of the variable created above.                         |


##### Example Usage

Using the variable names assigned above, the example ***createmsg.php*** file would then resemble the following:

			<?php
			
			require_once('vendor/autoload.php');

			use FlowrouteMessagingLib\Controllers\MessagesController;

			use FlowrouteMessagingLib\Models\Message;

			$controller = new MessagesController('1234567,'m8axLA45yds7kmiC8257c7BshaADg6vr');
			
			$message = new Message('15305557784', '18444205700', 'This is message content.');
			
			$response_name = $controller->createMessage($message);

			# print_r($response);

		?>


>**Note:** The Messages model uses ordered parameters for the `To` phone number(0), `From` phone number(1), and `Message content`(2).

###Run the PHP file

In a terminal session, 

1.	Change to your **flowroute-messaging-php** directory if you are not already in it.

2. At the prompt run the following:

	`run` *`<PHP file>`*
	
	For example, `run createmsg.php`.

#####Message response

Depending on whether or not you commented out the `print_r` response line one of two things will happen:

1.	If the `print_r` line was commented out, the message is sent to the recipient, but no other confirmation is returned is returned.

2.	If the `print_r` line was not commented out, a response message is returned containing the record ID. For example:

		(
    	[data] => stdClass Object
     	   (
     	       [id] => mdr1-6bdb954473d249308d43debd4735b493
     	   )

		)
	
#### `getMessageLookup ($recordId)`

The `getMessageLookup` method is used to retrieve an MDR by passing the record identifier of a previously sent message. The request uses the following format:

	$controller_name->getMessageLookup('recordID)');

and is composed of the following:

| Parameter | Required | Usage                                                 |
|-----------|----------|-------------------------------------------------------|
| `controller`  | True     | The `controller_name` created in your PHP file. |
| `recordId`      | True     | The identifier of an existing record to retrieve. The value should include the`mdr1-`prefix. |

##### Example Usage

	$controller->getMessageLookup('mdr1-b334f89df8de4f8fa7ce377e06090a88');
	
#####Example response