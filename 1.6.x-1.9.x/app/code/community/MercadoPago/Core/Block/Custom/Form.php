<?php

class MercadoPago_Core_Block_Custom_Form extends MercadoPago_Core_Block_AbstractForm
{
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('mercadopago/custom/form.phtml');
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

    public function getCustomerAndCards()
    {
        $customer = Mage::getModel('mercadopago/custom_payment')->getCustomerAndCards();

        return $customer;
    }
}
