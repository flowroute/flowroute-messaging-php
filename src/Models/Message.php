<?php 
/*
 * FlowrouteMessagingLib
 *
 * Copyright Flowroute, Inc. 2016
 */

namespace FlowrouteMessagingLib\Models;

use FlowrouteMessagingLib\APIException;
use JsonSerializable;

class Message implements JsonSerializable {
    /**
     * Phone number in E.164 format to send a message to.
     * @param string $to public property
     */
    protected $to;

    /**
     * Phone number in E.164 format where the message is sent from.
     * @param string $from public property
     */
    protected $from;

    /**
     * The content of the message.
     * @param string $content public property
     */
    protected $content;

    /**
     * Constructor to set initial or default values of member properties
	 * @param   string            $to        Initialization value for the property $this->to     
	 * @param   string            $from      Initialization value for the property $this->from   
	 * @param   string            $content   Initialization value for the property $this->content
     */
    public function __construct($to=null, $from=null, $content=null)
    {
        $this->to      = $to;
        $this->from    = $from;
        $this->content = $content;
    }

    /**
     * Return a property of the response if it exists.
     * Possibilities include: code, raw_body, headers, body (if the response is json-decodable)
     * @param   string              $property   value of property to return
     * @return mixed or null if property not found
     */
    public function __get($property)
    {
        $value = null;
        if (property_exists($this, $property)) {
            //UTF-8 is recommended for correct JSON serialization
            $value = $this->$property;
            if (is_string($value) && mb_detect_encoding($value, "UTF-8", TRUE) != "UTF-8") {
                $value = utf8_encode($value);
            }
        }
        return $value;
    }
    
    /**
     * Set the properties of this object
     * @param string $property the property name
     * @param mixed $value the property value
     * @return  Message instance that has been updated with the new property
     * @throws APIException
     */
    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            //UTF-8 is recommended for correct JSON serialization
            if (is_string($value) && mb_detect_encoding($value, "UTF-8", TRUE) != "UTF-8") {
                $this->$property = utf8_encode($value);
            }
            else {
                $this->$property = $value;
            }
        } else {
            throw new APIException('Invalid Property', 500, $property);
        }

        return $this;
    }

    /**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        $json = array();
        $json['to']      = $this->to;
        $json['from']    = $this->from;
        $json['content'] = $this->content;
        return $json;
    }
}