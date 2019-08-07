<?php

class MercadoPago_Core_Model_Notification_Custom extends MercadoPago_Core_Model_Notification_Abstract
{
    const LOG_FILE = 'mercadopago-notification-custom.log';

    /**
     * MercadoPago_Core_Model_Notification_Custom constructor.
     * @param $request
     */
    public function __construct($request)
    {
        parent::__construct($request);
    }

    /**
     * @return array
     */
    public function process()
    {
        $dataId = $this->request->getParam('data_id');
        $type = $this->request->getParam('type');
        if (!empty($dataId) && $type == 'payment') {
            $response = $this->getCore()->getPaymentV1($dataId);
            $this->helper->log('Return payment', self::LOG_FILE, $response);

            if ($this->isValidResponse($response)) {
                $payment = $response['response'];
                $payment = $this->helper->setPayerInfo($payment);

                $this->order = Mage::getModel('sales/order')->loadByIncrementId($payment['external_reference']);
                if (!$this->orderExists()) {
                    return $this->returnResponse(MercadoPago_Core_Helper_Response::INFO_EXTERNAL_REFERENCE_NOT_FOUND, MercadoPago_Core_Helper_Response::HTTP_INTERNAL_ERROR);
                }
                if($this->order->getStatus() == 'canceled'){
                    return $this->returnResponse(MercadoPago_Core_Helper_Response::INFO_ORDER_CANCELED, MercadoPago_Core_Helper_Response::HTTP_INTERNAL_ERROR);
                }

                $this->helper->log('Update Order', self::LOG_FILE);
                $this->statusHelper->setStatusUpdated($payment, $this->order);
                $data = $this->statusHelper->formatArrayPayment($data = array(), $payment, self::LOG_FILE);
                $this->getCore()->updateOrder($this->order, $data);
                $setStatusResponse = $this->statusHelper->setStatusOrder($payment);

                return $this->returnResponse($setStatusResponse['body'], $setStatusResponse['code']);
            }
        }

        return $this->returnResponse(MercadoPago_Core_Helper_Response::INFO_BAD_REQUEST, MercadoPago_Core_Helper_Response::HTTP_BAD_REQUEST);
    }

    /**
     * @return bool
     */
    public function orderExists()
    {
        if (!parent::orderExists()) {
            $this->helper->log(MercadoPago_Core_Helper_Response::INFO_EXTERNAL_REFERENCE_NOT_FOUND, self::LOG_FILE, $this->request);
            return false;
        }
        return true;
    }
}