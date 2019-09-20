<?php
/**
 * Class MercadoPago_Core_Block_Custom_Info
 */
class MercadoPago_Core_Block_Custom_Info extends Mage_Payment_Block_Info_Cc
{
    /**
     * Construct
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('mercadopago/custom/info.phtml');
    }

    /**
     * @return Mage_Payment_Model_Info
     */
    public function getOrder()
    {
        return $this->getInfo();
    }

    /**
     * @return array
     */
    public function getInfoPayment()
    {
        $order_id = $this->getInfo()->getOrder()->getIncrementId();
        $info_payments = Mage::getModel('mercadopago/core')->getInfoPaymentByOrder($order_id);
        return $info_payments;
    }
}
