# flowroute-messaging-php

**flowroute-messaging-python** is a PHP SDK that provides methods to create and send an outbound SMS from a Flowroute phone number and to retrieve a Message Detail Record (MDR) using he MessageController. These methods use **v2** (version 2) of the [Flowroute](https://www.flowroute.com) API.

**Note:** This SDK does not cover searching for a set of MDRs based on a date range. For searching on a date range, see [Look up a Set of Messages](https://developer.flowroute.com/docs/lookup-a-set-of-messages) on the Flowroute Developer Portal.

### Documentation 
The full documentation for the v2 Flowroute API is available [here](https://developer.flowroute.com/v2.0/docs).

##Before you begin

The following are required before you can deploy the SDK.

### Have your API credentials

You will need your Flowroute API credentials (Access Key and Secret Key). These can be found on the **Preferences > API Control** page of the [Flowroute](https://manage.flowroute.com/accounts/preferences/api/) portal. If you do not have API credentials, contact <mailto:support@flowroute.com>.

### Know your Flowroute phone number

To create and send a message, you will need your Flowroute phone number, which should be enabled for SMS. If you do not know your phone number, or if you need to verify whether or not it is enabled for SMS, you can find it on the [DIDs](https://manage.flowroute.com/accounts/dids/) page of the Flowroute portal.

### Get a code text editor

Steps in this SDK describe creating one or more script files that allow you to execute the methods. Script files can be created either using a terminal window shell or through using a code text editor. For example, *Sublime Text*. 

###Download Composer

Composer is used to manage the dependencies for the PHP SDK. The Composer installation file, **composer.phar**, can be downloaded from Composer's web site [here](https://getcomposer.org/download). Download, but do not install it; only after first installing the libraries will you install Composer.

## Install the libraries

> **Note:** You must be connected to the Internet in order to install the required libraries.

1. Open a terminal session. 

2. If needed, create a parent directory folder where you want to install the SDK.
 
3. Go to the newly created directory, and run the following:

 		https://github.com/flowroute/flowroute-messaging-php.git
 	
 	The `git clone` command clones the **flowroute-messaging-php** repository as a sub directory within the parent folder.
 	
4.	Change directories to the newly created **flowroute-messaging-php** directory.

##Install Composer

1.	Move the downloaded **composer.phar**  file to the **flowroute-messaging-php** directory.

	>**Note:** **composer.phar** must be in the **flowroute-messaging-php** directory in order to install correctly. Composer requires a **composer.json** file, which is included in the imported SDK to help manage dependencies.

2. 	From a terminal window, run the following:

		php composer.phar install

 	Composer sets up the required file structure.
 
## Create a PHP file to set up MessagesController

The following shows how to import the SDK and set up your API credentials. Importing the SDK allows you to instantiate the MessageController, which contains the methods used to create and send messages, and to look up an MDR. 

1.	Using a code text editor  create a new file and add the following lines to the top of the file to instantiate the Controller and import the Models:

		<?php
		
			require_once('vendor/autoload.php');

			use FlowrouteMessagingLib\Controllers\MessagesController;

			use FlowrouteMessagingLib\Models\Message;

2.	Next add the following lines to authorize your API credentials to work with the Controller:

		$controller_name = new MessagesController('Access Key','Secret Key');

3.	Replace the `Access Key` and `Secret Key` variables with your Flowroute API credentials.

4.	Optionally, add a print response line to the end of the file. By adding this line, when a method is invoked, the print response displays the response on screen:

		print_r($response); 

	>**Important:** Throughout this SDK, `response` is used in method examples. `response` is a variable name that can be changed to a name of your own choosing. It can support an unlimited number of characters. If you choose to rename `response`, make sure that any method that references that variable name is also changed to use the new name. In the following example, `response` is changed to `blob` wherever `response` is used:
>
>`#List NPA and NXX`<br>
>`blob = pnc.list_available_np_as(limit:nil)`<br>
>'print_r($blob))

5.	Save the file with a PHP extension in your **flowroute-messaging-php** directory. For this example, the file is named ***createmsg.php***.

6.	Add the Controller methods. See [MessagesController](#controller) below.
>**Note:** In the example above, the `print_r($response);` and `$response = $controller->getMessageLookup('recordID')`
 are commented out. These lines are not needed if you do not need to retrieve an MDR ID for the `getMessageLookup` method. See [getMessageLookup](#getmessage) if you need this information.
 
##### Example PHP file

The following shows an example PHP file with all methods are added. Comment out methods with `#` as needed. For example, you might want to comment out the [createMessage](#createmsg) method lines when invoking the [getMessageLookup](#getmsg) method, or vice versa.

		<?php
		
			require_once('vendor/autoload.php');

			use FlowrouteMessagingLib\Controllers\MessagesController;

			use FlowrouteMessagingLib\Models\Message;
			
			$controller = new MessagesController('Access Key','Secret Key');
			
			$message_name = new Message('To', 'From', 'Message content');
			
			$response = $controller->createMessage($message_name);
			
			$response = $controller->getMessageLookup('recordID');
	
			print_r($response); 			

Run the file from the **flowroute-messaging-php** directory in a terminal window using the following command:

		php <PHP file name>.php
	
## MessagesController<a name="controller"></a>

This section describes the methods contained within the MessagesController. Methods are added to your PHP file between `$controller_name = new MessagesController('Access Key','Secret Key');` and `print_r($response)`. These two methods are:

*	[createMessage](#createmsg)

*	[getMessageLookup](#getmsg)

### Create and send a message<a name=createmsg></a>

The create and send message method is a two-step process. First you create the message content, and then you invoke the Controller to send the message. 

#### Usage

Add the following two lines to your PHP file:

	$message_name = new Message('To', 'From', 'Message content');
	$response = $controller->createMessage($message_name);

The method takes the following parameters:

| Parameter | Required | Type | Descriptions                                                           |
|-----------|----------|-------|----------------------------------------------------------|
| `$message_name` | True |string  | The variable name identifying the message parameters. The variable can have any name, and there is no limit on the length. The name assigned here will then be passed in the `createMessage` response in the second line. The variable is further composed of the following:|
| || |<li>*`To`* — The recipient's phone number as a string, which must be an E.164 11-digit number formatted as *`1XXXXXXXXXX`*. Required. </li> <li>*`From`* — Your Flowroute phone number, which must be an E.164 11-digit number formatted as *`1XXXXXXXXXX`*. Required.</l><li>*`Message content`*—The message itself as a string. An unlimited number of characters can be used, but message length rules and encoding apply. See [Message Length & Concatenation](https://developer.flowroute.com/docs/message-length-concatenation) for more information.  Required.|

##### Example usage

In this example, a message variable named `mymessage` is created. `To`, `From`, and `Message content` are added, then `mymessage` passed in `$response`.

	$mymessage = new Message('19515557918', '12062092844', 'Get some exercise!');
	$response = $controller->createMessage($mymessage);

##### Example response

Depending on whether or not you commented out the `print_r` response line one of two things will happen:

1.	If `print_r($response);` *was* commented out or not added, the message is sent to the recipient, but no other confirmation is returned, or

2.	If `print_r($response);` *was not* commented out, a response message is returned containing the record ID:

		(
    	[data] => stdClass Object
     	   (
     	       [id] => mdr1-6bdb954473d249308d43debd4735b493
     	   )

		)

The `id` can then be passed in the [`getMessageLookup`](#getmsg) method to return details about the message.

##### Error response

| Error code | Message  | Description                                                 |
|------------|----------|-------------------------------------------------------|
|401| UNAUTHORIZED|The API `Access Key` and/or `Secret Key` are incorrect. |
|403| FORBIDDEN   |The `From` number is incorrect.            |
|No error code | HTTP Response Not OK | Typically this error might occur when the `To` number is not formatted as an 11-digit E.164 number.|
	
### `getMessageLookup ($recordId)`<a name="getmessage"></a>

The `getMessageLookup` method is used to retrieve an MDR by passing the record identifier of a sent message. To get the message details, you must first modify the PHP file you created above.

####Usage

Add the following line to your PHP file:

		$response = $controller->getMessageLookup('recordID');
		
Comment out the `createMessage` lines as follows:

	# $mymessage = new Message('19515557918', '12062092844', 'Get some exercise!');
	# $response = $controller->createMessage($mymessage);

>**Important!** If you do not comment out these lines, a new SMS will be sent, creating a new record ID.

The method is composed of the following parameter:

| Parameter | Required | Type | Descriptions                                                           |
|-----------|----------|-------|----------------------------------------------------------|
| `recordID` | True |string  | The record identifier retrieved from the `createMessage` print response.|

##### Example Usage

		$response = $controller->getMessageLookup('mdr1-6bdb954473d249308d43debd4735b493');
	
##### Example response

	(
  	  [data] => stdClass Object
   	     (
   	         [attributes] => stdClass Object
                (
                    [body] => Get some exercise!
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
|No code number  |Response Not OK|This error is most commonly returned when the `ID` passed in the method is incorrect, or an incorrect `Access Key` or `Secret Key` were used.|
	