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
    public function setMerchantInfo(array $options);

    /**
     * Set Customer Information
     * @param array $options
     * @return mixed
     * for more info check (https://www.tap.company/developers/)
     */
    public function setCustomerInfo(array $options);

    /**
     * Set Customer Information
     * @param array $options
     * @return mixed
     * for more info check (https://www.tap.company/developers/)
     */
    public function setProductInfo(array $options);

    /**
     * Set Gateway Information
     * @param array $options
     * @return mixed
     * for more info check (https://www.tap.company/developers/)
     */
    public function setGatewayInfo(array $options);

    /**
     * Perform Payment
     * for more info check (https://www.tap.company/developers/)
     */
    public function requestPayment();


    public function getCustomerInfo();
}