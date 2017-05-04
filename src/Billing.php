<?php

namespace IZaL\Tap;

interface Billing
{
    /**
     * Set Merchant Information
     * @param array $options
     * @return mixed
     * for more info check (https://www.tap.company/developers/)
     */
    public function setMerchantInfo($options);

    /**
     * Set Customer Information
     * @param array $options
     * @return mixed
     * for more info check (https://www.tap.company/developers/)
     */
    public function setCustomerInfo($options);

    /**
     * Set Customer Information
     * @param array $options
     * @return mixed
     * for more info check (https://www.tap.company/developers/)
     */
    public function setProductInfo($options);

    /**
     * Set Gateway Information
     * @param array $options
     * @return mixed
     * for more info check (https://www.tap.company/developers/)
     */
    public function setGatewayInfo($options);

    /**
     * Perform Payment
     * for more info check (https://www.tap.company/developers/)
     */
    public function requestPayment();


    public function getCustomerInfo();
}