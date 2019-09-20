<?php

/**
 * Class MercadoPago_Core_Block_Custom_Form
 */
class MercadoPago_Core_Block_Custom_Form extends MercadoPago_Core_Block_AbstractForm
{
    /**
     *
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('mercadopago/custom/form.phtml');
    }

    /**
     * @return Mage_Core_Block_Abstract
     */
    protected function _prepareLayout()
    {
//        $block = Mage::app()->getLayout()->createBlock('core/text', 'js_mercadopago');
//        $block->setText(
//            sprintf(
//                '<script src="https://secure.mlstatic.com/sdk/javascript/v1/mercadopago.js"></script>
//                        <link rel="stylesheet" href="%s"/><link rel="stylesheet" href="%s"/>',
//                $this->getSkinUrl('mercadopago/css/custom_checkout_mercadopago.css') . "?nocache=" . rand(),
//                $this->getSkinUrl('mercadopago/css/MPv1.css') . "?nocache=" . rand()
//            )
//        );
//        $head = Mage::app()->getLayout()->getBlock('after_body_start');
//
//        if ($head) {
//            $head->append($block);
//        }

        return parent::_prepareLayout();
    }

    /*
     *
     * Only used in Mexico
     *
     */
    public function getCardsPaymentMethods()
    {
        $payment_methods = Mage::getModel('mercadopago/core')->getPaymentMethods();
        $payment_methods_types = array("credit_card", "debit_card", "prepaid_card");
        $types = array();

        //percorre todos os payments methods
        foreach ($payment_methods['response'] as $pm) {

            //filtra por payment_methods
            if (in_array($pm['payment_type_id'], $payment_methods_types)) {
                $types[] = $pm;
            }
        }

        return $types;
    }

    /**
     * @return bool
     */
    public function getCustomerAndCards()
    {
        $customer = Mage::getModel('mercadopago/custom_payment')->getCustomerAndCards();
        return $customer;
    }
}
