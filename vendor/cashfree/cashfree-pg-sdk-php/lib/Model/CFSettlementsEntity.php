<?php
/**
 * CFSettlementsEntity
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
 * CFSettlementsEntity Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class CFSettlementsEntity implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'CFSettlementsEntity';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'cf_payment_id' => 'string',
        'cf_settlement_id' => 'string',
        'settlement_currency' => 'string',
        'order_id' => 'string',
        'entity' => 'string',
        'order_amount' => 'float',
        'payment_time' => 'string',
        'service_charge' => 'float',
        'service_tax' => 'float',
        'settlement_amount' => 'float',
        'settlement_id' => 'int',
        'transfer_id' => 'int',
        'transfer_time' => 'string',
        'transfer_utr' => 'string'
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
        'cf_settlement_id' => null,
        'settlement_currency' => null,
        'order_id' => null,
        'entity' => null,
        'order_amount' => null,
        'payment_time' => null,
        'service_charge' => null,
        'service_tax' => null,
        'settlement_amount' => null,
        'settlement_id' => null,
        'transfer_id' => null,
        'transfer_time' => null,
        'transfer_utr' => null
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
        'cf_settlement_id' => 'cf_settlement_id',
        'settlement_currency' => 'settlement_currency',
        'order_id' => 'order_id',
        'entity' => 'entity',
        'order_amount' => 'order_amount',
        'payment_time' => 'payment_time',
        'service_charge' => 'service_charge',
        'service_tax' => 'service_tax',
        'settlement_amount' => 'settlement_amount',
        'settlement_id' => 'settlement_id',
        'transfer_id' => 'transfer_id',
        'transfer_time' => 'transfer_time',
        'transfer_utr' => 'transfer_utr'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'cf_payment_id' => 'setCfPaymentId',
        'cf_settlement_id' => 'setCfSettlementId',
        'settlement_currency' => 'setSettlementCurrency',
        'order_id' => 'setOrderId',
        'entity' => 'setEntity',
        'order_amount' => 'setOrderAmount',
        'payment_time' => 'setPaymentTime',
        'service_charge' => 'setServiceCharge',
        'service_tax' => 'setServiceTax',
        'settlement_amount' => 'setSettlementAmount',
        'settlement_id' => 'setSettlementId',
        'transfer_id' => 'setTransferId',
        'transfer_time' => 'setTransferTime',
        'transfer_utr' => 'setTransferUtr'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'cf_payment_id' => 'getCfPaymentId',
        'cf_settlement_id' => 'getCfSettlementId',
        'settlement_currency' => 'getSettlementCurrency',
        'order_id' => 'getOrderId',
        'entity' => 'getEntity',
        'order_amount' => 'getOrderAmount',
        'payment_time' => 'getPaymentTime',
        'service_charge' => 'getServiceCharge',
        'service_tax' => 'getServiceTax',
        'settlement_amount' => 'getSettlementAmount',
        'settlement_id' => 'getSettlementId',
        'transfer_id' => 'getTransferId',
        'transfer_time' => 'getTransferTime',
        'transfer_utr' => 'getTransferUtr'
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
        $this->container['cf_settlement_id'] = $data['cf_settlement_id'] ?? null;
        $this->container['settlement_currency'] = $data['settlement_currency'] ?? null;
        $this->container['order_id'] = $data['order_id'] ?? null;
        $this->container['entity'] = $data['entity'] ?? null;
        $this->container['order_amount'] = $data['order_amount'] ?? null;
        $this->container['payment_time'] = $data['payment_time'] ?? null;
        $this->container['service_charge'] = $data['service_charge'] ?? null;
        $this->container['service_tax'] = $data['service_tax'] ?? null;
        $this->container['settlement_amount'] = $data['settlement_amount'] ?? null;
        $this->container['settlement_id'] = $data['settlement_id'] ?? null;
        $this->container['transfer_id'] = $data['transfer_id'] ?? null;
        $this->container['transfer_time'] = $data['transfer_time'] ?? null;
        $this->container['transfer_utr'] = $data['transfer_utr'] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

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
     * @return string|null
     */
    public function getCfPaymentId()
    {
        return $this->container['cf_payment_id'];
    }

    /**
     * Sets cf_payment_id
     *
     * @param string|null $cf_payment_id cf_payment_id
     *
     * @return self
     */
    public function setCfPaymentId($cf_payment_id)
    {
        $this->container['cf_payment_id'] = $cf_payment_id;

        return $this;
    }

    /**
     * Gets cf_settlement_id
     *
     * @return string|null
     */
    public function getCfSettlementId()
    {
        return $this->container['cf_settlement_id'];
    }

    /**
     * Sets cf_settlement_id
     *
     * @param string|null $cf_settlement_id cf_settlement_id
     *
     * @return self
     */
    public function setCfSettlementId($cf_settlement_id)
    {
        $this->container['cf_settlement_id'] = $cf_settlement_id;

        return $this;
    }

    /**
     * Gets settlement_currency
     *
     * @return string|null
     */
    public function getSettlementCurrency()
    {
        return $this->container['settlement_currency'];
    }

    /**
     * Sets settlement_currency
     *
     * @param string|null $settlement_currency settlement_currency
     *
     * @return self
     */
    public function setSettlementCurrency($settlement_currency)
    {
        $this->container['settlement_currency'] = $settlement_currency;

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
     * @param float|null $order_amount order_amount
     *
     * @return self
     */
    public function setOrderAmount($order_amount)
    {
        $this->container['order_amount'] = $order_amount;

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
     * Gets service_charge
     *
     * @return float|null
     */
    public function getServiceCharge()
    {
        return $this->container['service_charge'];
    }

    /**
     * Sets service_charge
     *
     * @param float|null $service_charge service_charge
     *
     * @return self
     */
    public function setServiceCharge($service_charge)
    {
        $this->container['service_charge'] = $service_charge;

        return $this;
    }

    /**
     * Gets service_tax
     *
     * @return float|null
     */
    public function getServiceTax()
    {
        return $this->container['service_tax'];
    }

    /**
     * Sets service_tax
     *
     * @param float|null $service_tax service_tax
     *
     * @return self
     */
    public function setServiceTax($service_tax)
    {
        $this->container['service_tax'] = $service_tax;

        return $this;
    }

    /**
     * Gets settlement_amount
     *
     * @return float|null
     */
    public function getSettlementAmount()
    {
        return $this->container['settlement_amount'];
    }

    /**
     * Sets settlement_amount
     *
     * @param float|null $settlement_amount settlement_amount
     *
     * @return self
     */
    public function setSettlementAmount($settlement_amount)
    {
        $this->container['settlement_amount'] = $settlement_amount;

        return $this;
    }

    /**
     * Gets settlement_id
     *
     * @return int|null
     */
    public function getSettlementId()
    {
        return $this->container['settlement_id'];
    }

    /**
     * Sets settlement_id
     *
     * @param int|null $settlement_id settlement_id
     *
     * @return self
     */
    public function setSettlementId($settlement_id)
    {
        $this->container['settlement_id'] = $settlement_id;

        return $this;
    }

    /**
     * Gets transfer_id
     *
     * @return int|null
     */
    public function getTransferId()
    {
        return $this->container['transfer_id'];
    }

    /**
     * Sets transfer_id
     *
     * @param int|null $transfer_id transfer_id
     *
     * @return self
     */
    public function setTransferId($transfer_id)
    {
        $this->container['transfer_id'] = $transfer_id;

        return $this;
    }

    /**
     * Gets transfer_time
     *
     * @return string|null
     */
    public function getTransferTime()
    {
        return $this->container['transfer_time'];
    }

    /**
     * Sets transfer_time
     *
     * @param string|null $transfer_time transfer_time
     *
     * @return self
     */
    public function setTransferTime($transfer_time)
    {
        $this->container['transfer_time'] = $transfer_time;

        return $this;
    }

    /**
     * Gets transfer_utr
     *
     * @return string|null
     */
    public function getTransferUtr()
    {
        return $this->container['transfer_utr'];
    }

    /**
     * Sets transfer_utr
     *
     * @param string|null $transfer_utr transfer_utr
     *
     * @return self
     */
    public function setTransferUtr($transfer_utr)
    {
        $this->container['transfer_utr'] = $transfer_utr;

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


