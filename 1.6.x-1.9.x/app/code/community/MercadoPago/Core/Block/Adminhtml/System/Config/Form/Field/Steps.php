<?php

/**
 * Class MercadoPago_Core_Block_Adminhtml_System_Config_Form_Field_Steps
 */
class MercadoPago_Core_Block_Adminhtml_System_Config_Form_Field_Steps extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    /**
     * @param Varien_Data_Form_Element_Abstract $element
     * @return string
     */
    public function render(Varien_Data_Form_Element_Abstract $element)
    {
        $this->assign('helper', Mage::helper('mercadopago'));
        $this->assign('logo', $this->getSkinUrl('mercadopago/images/logo.png'));
        $this->setTemplate('mercadopago/adminhtml/geral_steps.phtml');
        return $this->_toHtml();
    }

}