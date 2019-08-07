<?php

/**
 * Class MercadoPago_Core_Model_Notification_Abstract
 */
abstract class MercadoPago_Core_Model_Notification_Abstract
{
    public $helper;
    public $statusHelper;
    public $request;
    public $core;
    public $order;

    /**
     * MercadoPago_Core_Model_Notification_Abstract constructor.
     * @param $request
     */
    public function __construct($request)
    {
        $this->request = $request;
        $this->helper = Mage::helper('mercadopago');
        $this->statusHelper = Mage::helper('mercadopago/statusUpdate');
    }

    /**
     * @return false|Mage_Core_Model_Abstract|MercadoPago_Core_Model_Core
     */
    public function getCore()
    {
        if (empty($this->core)) {
            $this->core = Mage::getModel('mercadopago/core');
        }
        return $this->core;
    }

    /**
     * @param $response
     * @return bool
     */
    public function isValidResponse($response)
    {
        return ($response['status'] == 200 || $response['status'] == 201);
    }

    /**
     * @return bool
     */
    public function orderExists()
    {
        if ($this->order->getId()) {
            return true;
        }

        return false;
    }

    /**
     * @param $body
     * @param $code
     * @return array
     */
    public function returnResponse($body, $code)
    {
        return ['body' => $body, 'code' => $code];
    }
}