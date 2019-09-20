<?php

/**
 * Class MercadoPago_Core_Block_Adminhtml_Version
 */
class MercadoPago_Core_Block_Adminhtml_Version extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    /**
     * @param Varien_Data_Form_Element_Abstract $element
     * @return string
     */
    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
        return (string) Mage::helper('mercadopago/data')->getVersionModule();
    }
}
