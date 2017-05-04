<?php

use IZaL\Tap\TapBilling;

class TapBillingTest  extends PHPUnit_Framework_TestCase
{

    public function createBilling($args = [])
    {
        $defaultArgs = array_merge([
            'ApiKey' => '1tap7',
            'UserName' => 'test',
            'Password' => 'test',
            'MerchantID' => '1014'
        ],$args);

        $billing =  new TapBilling($defaultArgs);

        return $billing;
    }

    public function createCustomer($args = [])
    {
        $default = array_merge([
            'Email' => 'z4ls@live.com',
            'Name' => 'test',
            'Mobile' => '97978803',
        ],$args);

        return $default;
    }

    public function createProduct($args = [])
    {
        $default = array_merge([
            'Quantity' => '1',
            'TotalPrice' => '500',
            'UnitDesc' => 'Subscription Title',
            'UnitName' => 'Subscription Title',
            'UnitPrice' => '500',

        ],$args);

        return $default;
    }

    public function createMerchant($args = [])
    {

        $default = array_merge([
            'ReturnURL' => 'http://test.com/payment/returnurl',
            'ReferenceID' => uniqid(),
        ],$args);

        return $default;
    }


    /**
     * @test
     * @expectedException \IZaL\Tap\Exceptions\KeyMissingException
     */
    public function it_throws_exception_when_required_keys_are_not_set()
    {
        $paymentClass = new TapBilling();
    }

    /**
     * @test
     */
    public function it_constructs_when_required_keys_are_provided()
    {
        $this->createBilling();
    }

    /**
     * @test
     */
    public function it_sets_payment_url_by_default()
    {
        $billing = $this->createBilling();

        $this->assertAttributeNotEmpty('PaymentURL',$billing);
    }

    /**
     * @test
     */
    public function it_sets_payment_url()
    {
        $billing = $this->createBilling(['PaymentURL'=>'http://test.com/payment']);

        $this->assertAttributeEquals('http://test.com/payment','PaymentURL',$billing);
    }

    /**
     * @test
     */
    public function it_sets_customer_info()
    {

        $billing = $this->createBilling();

        $customer = $this->createCustomer();

        $billing->setCustomerInfo($customer);

        $this->assertEquals($customer,$billing->getCustomerInfo());

    }


    /**
     * @test
     */
    public function it_sets_product_info()
    {

        $billing = $this->createBilling();

        $product = $this->createProduct();

        $billing->setProductInfo([$product]);

        $this->assertEquals([$product],$billing->getProductInfo());

    }

    /**
     * @test
     */
    public function it_sets_merchant_info()
    {

        $billing = $this->createBilling();

        $product = $this->createMerchant();

        $billing->setMerchantInfo($product);

        $this->assertEquals($product,$billing->getMerchantInfo());

    }

    /**
     * @test
     */
    public function it_calculates_total_price()
    {

        $billing = $this->createBilling();
        $product1 = $this->createProduct(['TotalPrice'=>'300']);
        $product2 = $this->createProduct(['TotalPrice'=>'100']);
        $product3 = $this->createProduct(['TotalPrice'=>'400']);

        $billing->setProductInfo([$product1,$product2,$product3]);

        $sum = $billing->getTotalAmount();

        $this->assertEquals('800',$sum);

    }

    /**
     * @test
     * @expectedException \IZaL\Tap\Exceptions\KeyMissingException
     */
    public function it_throws_on_invalid_argument()
    {
        $billing = $this->createBilling();
        $product = [
            'Quantity' => '1',
            'UnitDesc' => 'Subscription Title',
            'UnitName' => 'Subscription Title',
            'UnitPrice' => '500',
        ];
        $billing->setProductInfo([$product]);
    }


    /**
     * @test
     */
    public function it_successfully_gets_payment_url()
    {

        $billing = $this->createBilling();
        $product = $this->createProduct();
        $merchant = $this->createMerchant();
        $customer = $this->createCustomer();

        $billing->setProductInfo([$product]);
        $billing->setMerchantInfo($merchant);
        $billing->setCustomerInfo($customer);

        $payment = $billing->requestPayment();

        $response = $payment->response->getRawResponse();

        $this->assertEquals('Success',$response->ResponseMessage);
        $this->assertObjectHasAttribute('PaymentURL',$response);
        $this->assertObjectHasAttribute('ReferenceID',$response);
        $this->assertNotEmpty($response->ReferenceID);
        $this->assertNotEmpty($response->PaymentURL);
    }


}