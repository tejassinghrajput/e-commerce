<?php
/**
 * CFPaymentsEntity
 *
 * PHP version 7.3
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * New Payment Gateway APIs
 *
 * No description provided (generated by Openapi Generator https://github.com/openapitools/openapi-generator)
 *
 * The version of the OpenAPI document: 2022-01-01
 * Contact: nextgenapi@cashfree.com
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 5.4.0
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace OpenAPI\Client\Model;

use \ArrayAccess;
use \OpenAPI\Client\ObjectSerializer;

/**
 * CFPaymentsEntity Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class CFPaymentsEntity implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'CFPaymentsEntity';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'cf_payment_id' => 'int',
        'order_id' => 'string',
        'entity' => 'string',
        'is_captured' => 'bool',
        'order_amount' => 'float',
        'payment_group' => 'string',
        'payment_currency' => 'string',
        'payment_amount' => 'float',
        'payment_time' => 'string',
        'payment_status' => 'string',
        'payment_message' => 'string',
        'bank_reference' => 'string',
        'auth_id' => 'string',
        'authorization' => '\OpenAPI\Client\Model\CFAuthorizationInPaymentsEntity',
        'payment_method' => '\OpenAPI\Client\Model\CFPaymentsEntityPayment'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'cf_payment_id' => null,
        'order_id' => null,
        'entity' => null,
        'is_captured' => null,
        'order_amount' => null,
        'payment_group' => null,
        'payment_currency' => null,
        'payment_amount' => null,
        'payment_time' => null,
        'payment_status' => null,
        'payment_message' => null,
        'bank_reference' => null,
        'auth_id' => null,
        'authorization' => null,
        'payment_method' => null
    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'cf_payment_id' => 'cf_payment_id',
        'order_id' => 'order_id',
        'entity' => 'entity',
        'is_captured' => 'is_captured',
        'order_amount' => 'order_amount',
        'payment_group' => 'payment_group',
        'payment_currency' => 'payment_currency',
        'payment_amount' => 'payment_amount',
        'payment_time' => 'payment_time',
        'payment_status' => 'payment_status',
        'payment_message' => 'payment_message',
        'bank_reference' => 'bank_reference',
        'auth_id' => 'auth_id',
        'authorization' => 'authorization',
        'payment_method' => 'payment_method'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'cf_payment_id' => 'setCfPaymentId',
        'order_id' => 'setOrderId',
        'entity' => 'setEntity',
        'is_captured' => 'setIsCaptured',
        'order_amount' => 'setOrderAmount',
        'payment_group' => 'setPaymentGroup',
        'payment_currency' => 'setPaymentCurrency',
        'payment_amount' => 'setPaymentAmount',
        'payment_time' => 'setPaymentTime',
        'payment_status' => 'setPaymentStatus',
        'payment_message' => 'setPaymentMessage',
        'bank_reference' => 'setBankReference',
        'auth_id' => 'setAuthId',
        'authorization' => 'setAuthorization',
        'payment_method' => 'setPaymentMethod'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'cf_payment_id' => 'getCfPaymentId',
        'order_id' => 'getOrderId',
        'entity' => 'getEntity',
        'is_captured' => 'getIsCaptured',
        'order_amount' => 'getOrderAmount',
        'payment_group' => 'getPaymentGroup',
        'payment_currency' => 'getPaymentCurrency',
        'payment_amount' => 'getPaymentAmount',
        'payment_time' => 'getPaymentTime',
        'payment_status' => 'getPaymentStatus',
        'payment_message' => 'getPaymentMessage',
        'bank_reference' => 'getBankReference',
        'auth_id' => 'getAuthId',
        'authorization' => 'getAuthorization',
        'payment_method' => 'getPaymentMethod'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$openAPIModelName;
    }

    const PAYMENT_STATUS_SUCCESS = 'SUCCESS';
    const PAYMENT_STATUS_NOT_ATTEMPTED = 'NOT_ATTEMPTED';
    const PAYMENT_STATUS_FAILED = 'FAILED';
    const PAYMENT_STATUS_USER_DROPPED = 'USER_DROPPED';
    const PAYMENT_STATUS_VOID = 'VOID';
    const PAYMENT_STATUS_CANCELLED = 'CANCELLED';
    const PAYMENT_STATUS_PENDING = 'PENDING';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getPaymentStatusAllowableValues()
    {
        return [
            self::PAYMENT_STATUS_SUCCESS,
            self::PAYMENT_STATUS_NOT_ATTEMPTED,
            self::PAYMENT_STATUS_FAILED,
            self::PAYMENT_STATUS_USER_DROPPED,
            self::PAYMENT_STATUS_VOID,
            self::PAYMENT_STATUS_CANCELLED,
            self::PAYMENT_STATUS_PENDING,
        ];
    }

    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['cf_payment_id'] = $data['cf_payment_id'] ?? null;
        $this->container['order_id'] = $data['order_id'] ?? null;
        $this->container['entity'] = $data['entity'] ?? null;
        $this->container['is_captured'] = $data['is_captured'] ?? null;
        $this->container['order_amount'] = $data['order_amount'] ?? null;
        $this->container['payment_group'] = $data['payment_group'] ?? null;
        $this->container['payment_currency'] = $data['payment_currency'] ?? null;
        $this->container['payment_amount'] = $data['payment_amount'] ?? null;
        $this->container['payment_time'] = $data['payment_time'] ?? null;
        $this->container['payment_status'] = $data['payment_status'] ?? null;
        $this->container['payment_message'] = $data['payment_message'] ?? null;
        $this->container['bank_reference'] = $data['bank_reference'] ?? null;
        $this->container['auth_id'] = $data['auth_id'] ?? null;
        $this->container['authorization'] = $data['authorization'] ?? null;
        $this->container['payment_method'] = $data['payment_method'] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        $allowedValues = $this->getPaymentStatusAllowableValues();
        if (!is_null($this->container['payment_status']) && !in_array($this->container['payment_status'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'payment_status', must be one of '%s'",
                $this->container['payment_status'],
                implode("', '", $allowedValues)
            );
        }

        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets cf_payment_id
     *
     * @return int|null
     */
    public function getCfPaymentId()
    {
        return $this->container['cf_payment_id'];
    }

    /**
     * Sets cf_payment_id
     *
     * @param int|null $cf_payment_id cf_payment_id
     *
     * @return self
     */
    public function setCfPaymentId($cf_payment_id)
    {
        $this->container['cf_payment_id'] = $cf_payment_id;

        return $this;
    }

    /**
     * Gets order_id
     *
     * @return string|null
     */
    public function getOrderId()
    {
        return $this->container['order_id'];
    }

    /**
     * Sets order_id
     *
     * @param string|null $order_id order_id
     *
     * @return self
     */
    public function setOrderId($order_id)
    {
        $this->container['order_id'] = $order_id;

        return $this;
    }

    /**
     * Gets entity
     *
     * @return string|null
     */
    public function getEntity()
    {
        return $this->container['entity'];
    }

    /**
     * Sets entity
     *
     * @param string|null $entity entity
     *
     * @return self
     */
    public function setEntity($entity)
    {
        $this->container['entity'] = $entity;

        return $this;
    }

    /**
     * Gets is_captured
     *
     * @return bool|null
     */
    public function getIsCaptured()
    {
        return $this->container['is_captured'];
    }

    /**
     * Sets is_captured
     *
     * @param bool|null $is_captured is_captured
     *
     * @return self
     */
    public function setIsCaptured($is_captured)
    {
        $this->container['is_captured'] = $is_captured;

        return $this;
    }

    /**
     * Gets order_amount
     *
     * @return float|null
     */
    public function getOrderAmount()
    {
        return $this->container['order_amount'];
    }

    /**
     * Sets order_amount
     *
     * @param float|null $order_amount Order amount can be different from payment amount if you collect service fee from the customer
     *
     * @return self
     */
    public function setOrderAmount($order_amount)
    {
        $this->container['order_amount'] = $order_amount;

        return $this;
    }

    /**
     * Gets payment_group
     *
     * @return string|null
     */
    public function getPaymentGroup()
    {
        return $this->container['payment_group'];
    }

    /**
     * Sets payment_group
     *
     * @param string|null $payment_group Type of payment group. One of ['upi', 'card', 'app', 'netbanking', 'paylater', 'cardless_emi']
     *
     * @return self
     */
    public function setPaymentGroup($payment_group)
    {
        $this->container['payment_group'] = $payment_group;

        return $this;
    }

    /**
     * Gets payment_currency
     *
     * @return string|null
     */
    public function getPaymentCurrency()
    {
        return $this->container['payment_currency'];
    }

    /**
     * Sets payment_currency
     *
     * @param string|null $payment_currency payment_currency
     *
     * @return self
     */
    public function setPaymentCurrency($payment_currency)
    {
        $this->container['payment_currency'] = $payment_currency;

        return $this;
    }

    /**
     * Gets payment_amount
     *
     * @return float|null
     */
    public function getPaymentAmount()
    {
        return $this->container['payment_amount'];
    }

    /**
     * Sets payment_amount
     *
     * @param float|null $payment_amount payment_amount
     *
     * @return self
     */
    public function setPaymentAmount($payment_amount)
    {
        $this->container['payment_amount'] = $payment_amount;

        return $this;
    }

    /**
     * Gets payment_time
     *
     * @return string|null
     */
    public function getPaymentTime()
    {
        return $this->container['payment_time'];
    }

    /**
     * Sets payment_time
     *
     * @param string|null $payment_time payment_time
     *
     * @return self
     */
    public function setPaymentTime($payment_time)
    {
        $this->container['payment_time'] = $payment_time;

        return $this;
    }

    /**
     * Gets payment_status
     *
     * @return string|null
     */
    public function getPaymentStatus()
    {
        return $this->container['payment_status'];
    }

    /**
     * Sets payment_status
     *
     * @param string|null $payment_status The transaction status can be one of  [\"SUCCESS\", \"NOT_ATTEMPTED\", \"FAILED\", \"USER_DROPPED\", \"VOID\", \"CANCELLED\", \"PENDING\"]
     *
     * @return self
     */
    public function setPaymentStatus($payment_status)
    {
        $allowedValues = $this->getPaymentStatusAllowableValues();
        if (!is_null($payment_status) && !in_array($payment_status, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'payment_status', must be one of '%s'",
                    $payment_status,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['payment_status'] = $payment_status;

        return $this;
    }

    /**
     * Gets payment_message
     *
     * @return string|null
     */
    public function getPaymentMessage()
    {
        return $this->container['payment_message'];
    }

    /**
     * Sets payment_message
     *
     * @param string|null $payment_message payment_message
     *
     * @return self
     */
    public function setPaymentMessage($payment_message)
    {
        $this->container['payment_message'] = $payment_message;

        return $this;
    }

    /**
     * Gets bank_reference
     *
     * @return string|null
     */
    public function getBankReference()
    {
        return $this->container['bank_reference'];
    }

    /**
     * Sets bank_reference
     *
     * @param string|null $bank_reference bank_reference
     *
     * @return self
     */
    public function setBankReference($bank_reference)
    {
        $this->container['bank_reference'] = $bank_reference;

        return $this;
    }

    /**
     * Gets auth_id
     *
     * @return string|null
     */
    public function getAuthId()
    {
        return $this->container['auth_id'];
    }

    /**
     * Sets auth_id
     *
     * @param string|null $auth_id auth_id
     *
     * @return self
     */
    public function setAuthId($auth_id)
    {
        $this->container['auth_id'] = $auth_id;

        return $this;
    }

    /**
     * Gets authorization
     *
     * @return \OpenAPI\Client\Model\CFAuthorizationInPaymentsEntity|null
     */
    public function getAuthorization()
    {
        return $this->container['authorization'];
    }

    /**
     * Sets authorization
     *
     * @param \OpenAPI\Client\Model\CFAuthorizationInPaymentsEntity|null $authorization authorization
     *
     * @return self
     */
    public function setAuthorization($authorization)
    {
        $this->container['authorization'] = $authorization;

        return $this;
    }

    /**
     * Gets payment_method
     *
     * @return \OpenAPI\Client\Model\CFPaymentsEntityPayment|null
     */
    public function getPaymentMethod()
    {
        return $this->container['payment_method'];
    }

    /**
     * Sets payment_method
     *
     * @param \OpenAPI\Client\Model\CFPaymentsEntityPayment|null $payment_method payment_method
     *
     * @return self
     */
    public function setPaymentMethod($payment_method)
    {
        $this->container['payment_method'] = $payment_method;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed|null
     */
    public function offsetGet($offset)
    {
        return $this->container[$offset] ?? null;
    }

    /**
     * Sets value based on offset.
     *
     * @param int|null $offset Offset
     * @param mixed    $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Serializes the object to a value that can be serialized natively by json_encode().
     * @link https://www.php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed Returns data which can be serialized by json_encode(), which is a value
     * of any type other than a resource.
     */
    public function jsonSerialize()
    {
       return ObjectSerializer::sanitizeForSerialization($this);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT
        );
    }

    /**
     * Gets a header-safe presentation of the object
     *
     * @return string
     */
    public function toHeaderValue()
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}


