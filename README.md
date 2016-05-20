# flowroute-messaging-php

**flowroute-messaging-python** is a PHP SDK that provides methods to create and send an outbound SMS from a Flowroute phone number and to retrieve a Message Detail Record (MDR). These methods use **v2** (version 2) of the [Flowroute](https://www.flowroute.com) API.

**Note:** This SDK does not cover searching for a set of MDRs based on a date range. For searching on a date range, see [Look up a Set of Messages](https://developer.flowroute.com/docs/lookup-a-set-of-messages) on the Flowroute Developer Portal.

### Documentation 
The full documentation for the v2 Flowroute API is available [here](https://developer.flowroute.com/v2.0/docs).

##Before you begin

The following are required before you can deploy the SDK.

### Have your API credentials

You will need your Flowroute API credentials (Access Key and Secret Key). These can be found on the **Preferences > API Control** page of the [Flowroute](https://manage.flowroute.com/accounts/preferences/api/) portal. If you do not have API credentials, contact <mailto:support@flowroute.com>.

### Know your Flowroute phone number

To create and send a message, you will need your Flowroute phone number, which should be enabled for SMS. If you do not know your phone number, or if you need to verify whether or not it is enabled for SMS, you can find it on the [DIDs](https://manage.flowroute.com/accounts/dids/) page of the Flowroute portal.

###Download Composer

Composer is used to manage the dependencies for the PHP SDK. This SDK does not cover those steps. See Composer's [Getting Started](https://getcomposer.org/doc/00-intro.md) guide at the Composer web site for the steps to download the setup file. After installing the libraries you'll install Composer.

## Install the libraries

> **Note:** You must be connected to the Internet in order to install the required libraries.

1. Open a terminal session. 

2. If needed, create a parent directory folder where you want to install the SDK.
 
3. Go to the newly created folder, and run the following:

 	`https://github.com/flowroute/flowroute-messaging-php.git`
 	
 	The `git clone` command clones the **flowroute-messaging-php** respository as a sub directory within the parent folder.
 	
4.	Change directories to the newly created **flowroute-messaging-php** directory.

##Install Composer

1.	Move the downloaded **composer.phar** and **composer-setup.php** files to the **flowroute-messaging-php** directory.

	>**Note:** **composer.phar** must be in the **flowroute-messaging-php** directory in order to install correctly. Composer requires a **composer.json** file, which is included in the imported SDK to help manage dependencies.

2. 	From a terminal window, run the following:

		php composer.phar install

 	Composer sets up the required file structure.
 
## Create a PHP file to set up the MessagesController

The following shows how to import the SDK and set up your API credentials. Importing the SDK allows you to instantiate the MessageController, which contains the methods used to create and send messages, and to look up an MDR. 

1.	Using a code text editor — for example, *Sublime Text* — create a new file and add the following lines:

	>**Note:** See [Set parameters and variables](#setparams) below for details about the information required in the file.

		<?php
		
			require_once('vendor/autoload.php');

			use FlowrouteMessagingLib\Controllers\MessagesController;

			use FlowrouteMessagingLib\Models\Message;

			$controller_name = new MessagesController('Access Key','Secret Key');
			
			$message_name = new Message('To', 'From', 'Message content.');
			
			$response_name = $controller_name->createMessage($message_name);
			
			# $response_name = $controller->getMessageLookup('recordID')

			# print_r($response_name);

		?>

2.	Save the file with a PHP extension in your **flowroute-messaging-php** directory. For this example, the file is named ***createmsg.php***.

>**Note:** In the example above, the `print_r($response);` and `$response = $controller->getMessageLookup('recordID')`
 are commented out. These lines are not needed if you do not need to retrieve an MDR ID for the `getMessageLookup` method. See [getMessageLookup](#getmessage) if you need this information.

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

#### $response = $controller->getMessageLookup('recordID')

| Parameter | Required | Usage                                                 |
|-----------|----------|-------------------------------------------------------|
| `$response_name` | True   | The `response_name` created above. |
| `controller`  | True   | The `controller_name` created above. |
| `recordId`      | True | The identifier of an existing record to retrieve. The value should include the`mdr1-`prefix. |


####`print_r($response);`
| Parameter | Required | Usage                                                           |
|-----------|----------|-----------------------------------------------------------------|
| `$response_name` | True   | The name of the variable created above.                         |


##### Example Usage

Using the variable names assigned above, the example ***createmsg.php*** file would then resemble the following:

			<?php
			
			require_once('vendor/autoload.php');

			use FlowrouteMessagingLib\Controllers\MessagesController;

			use FlowrouteMessagingLib\Models\Message;

			$controller = new MessagesController('1234567,'m8axLA45yds7kmiC8257c7BshaADg6vr');
			
			$message = new Message('15305557784', '18444205700', 'Your message goes here!');
			
			$response = $controller->createMessage($message);
				
			# $response = $controller->getMessageLookup('recordID')
			
			# print_r($response);

		?>


>**Note:** The Messages model uses ordered parameters for the `To` phone number(0), `From` phone number(1), and `Message content`(2).

###Run the PHP file

In a terminal session, 

1.	Change to the **flowroute-messaging-php** directory if you are not already in it.

2. At the prompt run the following:

	`php` *`<PHP file>`*
	
	For example, `php createmsg.php`.

#####Message response

Depending on whether or not you commented out the `print_r` response line one of two things will happen:

1.	If the `print_r` line was commented out, the message is sent to the recipient, but no other confirmation is returned.

2.	If the `print_r` line was not commented out, a response message is returned containing the record ID. For example:

		(
    	[data] => stdClass Object
     	   (
     	       [id] => mdr1-6bdb954473d249308d43debd4735b493
     	   )

		)
	The record ID can then be passed in the getMessageLookup method to return details about the message.
	
#### `getMessageLookup ($recordId)`<a name="getmessage"></a>

The `getMessageLookup` method is used to retrieve an MDR by passing the record identifier of a previously sent message. 

**To retrieve message details:**

In your PHP file, 

1.	Uncomment the following two lines:

		$response = $controller->getMessageLookup('recordID');
			
		print_r($response);

2. Comment out the following two lines:

	`# $message = new Message('To', 'From', 'Message content.');`
	
	`# $response = $controller->createMessage($message);`
	
	>**Important!** If you do not comment out these lines, a new SMS will be sent, creating a new record ID.

3. Replace the `recordID` on the following line with the record ID of the record for which you want to retrieve details. For example, 

		$response = $controller->getMessageLookup('mdr1-6bdb954473d249308d43debd4735b493'); 

##### Example Usage

	$response = controller->getMessageLookup('mdr1-6bdb954473d249308d43debd4735b493');
	
#####Example response
	(
  	  [data] => stdClass Object
   	     (
   	         [attributes] => stdClass Object
                (
                    [body] => Your message goes here!
                    [direction] => outbound
                    [timestamp] => 2016-05-20T17:07:46.322587+00:00
                    [amount_nanodollars] => 4000000
                    [from] => 12062092844
                    [message_encoding] => 0
                    [has_mms] =>
                    [to] => 18444205700
                    [amount_display] => $0.0040
                    [callback_url] =>
                    [message_type] => long-code
                )

            [type] => message
            [id] => mdr1-6bdb954473d249308d43debd4735b493
        )
	)
	
######Response message field descriptions

The following information is returned in the response message:

|Parameter | Description                                                 |
|-----------|----------|-------------------------------------------------------|
| `data`  | Object composed of `attributes`, `type`, and `id`. |
|`attributes`    |Object composed of the following:
|  |<ul> <li>`body`: The content of the message.
|  |<ul><li>`direction`:  The direction of the message. For a sent message, this is `outbound`. For a received message this is`inbound`.
|  | <ul><li>`timestamp`: Date and time, to the second, on which the message was sent. This field displays UTC time using an ISO 8601 format.
|  |<ul><li>`amount_nanodollars`: The cost of the message in nanodollars. Because Flowroute uses eight decimal points of precision, the amount in nanodollars is the USD`amount_display` value multiplied by 100,000,000 (one hundred million) for a corresponding whole number.  
|  |<ul><li>`from`: The Flowroute SMS-enabled number from which the message was sent.
|  |<ul><li>`message_encoding`: Indicates the encoding type, which will be either `0` (UTF-8) or `8` (UCS-2). See [Message Length & Concatenation](https://developer.flowroute.com/docs/message-length-concatenation) for more information. 
|  |<ul><li>`has_mms`: Boolean indicating whether or not the message includes a multimedia file. `true` indicates yes, while `false` indicates no. Currently, MMS is not supported; therefore, the default value for this field will always be `false`. 
|  |<ul><li>`to`: The phone number to which the message was sent.
|  |<ul><li>`amount_display`: The total cost of the message in USD. If a message was broken into multiple pieces due to concatenation, this amount will be the total amount for all message pieces. This field does _not_ display out to eight decimal points. See _Message cost_ in [Message Length & Concatenation](https://developer.flowroute.com/docs/message-length-concatenation) for more information.
|  |<ul><li>`callback_URL`The callback URL defined for the Flowroute number on the [Preferences > API Control](https://manage.flowroute.com/accounts/preferences/api/) page, the URL appears in this field; otherwise, the value is `null`.|  
|  |<ul><li>`message_type`: Indicates the type of message, either `long-code` or `toll-free`. If the message was sent to or received from another phone number, this field displays `long-code`; if sent to or received from a toll-free number, this field displays `toll-free`. </li></ul>| 
|`type`| Defines what the object is. Because SMS is the only supported object type, this field will always display `message`.|
|`id` | The unique record identifier of a sent message, generated from a successful message creation.|
                        
#####Error response
The following error can be returned:

| Error code | Message | Description                                                 |
|-------|----------|-------------------------------------------------------|
|No code number  |Response Not OK|This error is most commonly returned when the `ID` passed in the method is incorrect or an incorrect `Access Key` or `Secret Key` were used.|
	