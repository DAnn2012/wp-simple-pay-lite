<?php

// File generated from our OpenAPI spec

namespace SimplePay\Vendor\Stripe\Tax;

/**
 * A Tax <code>Transaction</code> records the tax collected from or refunded to
 * your customer.
 *
 * @property string $id Unique identifier for the transaction.
 * @property string $object String representing the object's type. Objects of the same type share the same value.
 * @property int $created Time at which the object was created. Measured in seconds since the Unix epoch.
 * @property string $currency Three-letter <a href="https://www.iso.org/iso-4217-currency-codes.html">ISO currency code</a>, in lowercase. Must be a <a href="https://stripe.com/docs/currencies">supported currency</a>.
 * @property null|string $customer The ID of an existing <a href="https://stripe.com/docs/api/customers/object">Customer</a> used for the resource.
 * @property \SimplePay\Vendor\Stripe\StripeObject $customer_details
 * @property null|\SimplePay\Vendor\Stripe\Collection<\SimplePay\Vendor\Stripe\LineItem> $line_items The tax collected or refunded, by line item.
 * @property bool $livemode Has the value <code>true</code> if the object exists in live mode or the value <code>false</code> if the object exists in test mode.
 * @property null|\SimplePay\Vendor\Stripe\StripeObject $metadata Set of <a href="https://stripe.com/docs/api/metadata">key-value pairs</a> that you can attach to an object. This can be useful for storing additional information about the object in a structured format.
 * @property string $reference A custom unique identifier, such as 'myOrder_123'.
 * @property null|\SimplePay\Vendor\Stripe\StripeObject $reversal If <code>type=reversal</code>, contains information about what was reversed.
 * @property int $tax_date Timestamp of date at which the tax rules and rates in effect applies for the calculation.
 * @property string $type If <code>reversal</code>, this transaction reverses an earlier transaction.
 */
class Transaction extends \SimplePay\Vendor\Stripe\ApiResource
{
    const OBJECT_NAME = 'tax.transaction';

    use \SimplePay\Vendor\Stripe\ApiOperations\Create;
    use \SimplePay\Vendor\Stripe\ApiOperations\Retrieve;

    const TYPE_REVERSAL = 'reversal';
    const TYPE_TRANSACTION = 'transaction';

    /**
     * @param null|array $params
     * @param null|array|string $opts
     *
     * @throws \SimplePay\Vendor\Stripe\Exception\ApiErrorException if the request fails
     *
     * @return \SimplePay\Vendor\Stripe\Tax\Transaction the created transaction
     */
    public static function createReversal($params = null, $opts = null)
    {
        $url = static::classUrl() . '/create_reversal';
        list($response, $opts) = static::_staticRequest('post', $url, $params, $opts);
        $obj = \SimplePay\Vendor\Stripe\Util\Util::convertToStripeObject($response->json, $opts);
        $obj->setLastResponse($response);

        return $obj;
    }

    /**
     * @param string $id
     * @param null|array $params
     * @param null|array|string $opts
     *
     * @throws \SimplePay\Vendor\Stripe\Exception\ApiErrorException if the request fails
     *
     * @return \SimplePay\Vendor\Stripe\Collection<\SimplePay\Vendor\Stripe\LineItem> list of TaxProductResourceTaxTransactionLineItems
     */
    public static function allLineItems($id, $params = null, $opts = null)
    {
        $url = static::resourceUrl($id) . '/line_items';
        list($response, $opts) = static::_staticRequest('get', $url, $params, $opts);
        $obj = \SimplePay\Vendor\Stripe\Util\Util::convertToStripeObject($response->json, $opts);
        $obj->setLastResponse($response);

        return $obj;
    }

    /**
     * @param null|array $params
     * @param null|array|string $opts
     *
     * @throws \SimplePay\Vendor\Stripe\Exception\ApiErrorException if the request fails
     *
     * @return \SimplePay\Vendor\Stripe\Collection<\SimplePay\Vendor\Stripe\Tax\Transaction> list of TaxProductResourceTaxTransactions
     */
    public static function allTransactions($params = null, $opts = null)
    {
        $url = static::classUrl();
        list($response, $opts) = static::_staticRequest('get', $url, $params, $opts);
        $obj = \SimplePay\Vendor\Stripe\Util\Util::convertToStripeObject($response->json, $opts);
        $obj->setLastResponse($response);

        return $obj;
    }
}