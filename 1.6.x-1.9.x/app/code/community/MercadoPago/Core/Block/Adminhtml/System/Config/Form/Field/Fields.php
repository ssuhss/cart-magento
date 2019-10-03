<?php

/**
 * Class MercadoPago_Core_Block_Adminhtml_System_Config_Form_Field_Fields
 */
class MercadoPago_Core_Block_Adminhtml_System_Config_Form_Field_Fields extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    public $html_element;
    public $is_render = false;

    /**
     * @param Varien_Data_Form_Element_Abstract $element
     * @return string
     */
    public function render(Varien_Data_Form_Element_Abstract $element)
    {
        $phtmlArray = $this->getPhtmlArray();
        if (array_key_exists($element->getId(), $phtmlArray) && !$this->is_render) {
            return $this->getAdminTemplate($element, $phtmlArray[$element->getId()]);
        }

        if (!$this->is_render) {
            $this->setTemplate(null);
        }

        $this->is_render = false;
        return parent::render($element);
    }

    /**
     * @param Varien_Data_Form_Element_Abstract $element
     * @param $template
     * @return string
     */
    private function getAdminTemplate(Varien_Data_Form_Element_Abstract $element, $template)
    {
        $this->is_render = true;
        $this->assign('helper', Mage::helper('mercadopago'));
        $template = $this->setTemplate($template);
        $this->html_element = $element->getHtml();
        $this->is_render = false;

        return $template->_toHtml();
    }

    /**
     * @return array
     */
    private function getPhtmlArray()
    {
        $phtmlArray = array(
            //Advanced
            'payment_mercadopago_steps' => 'mercadopago/adminhtml/geral_steps.phtml',
            'payment_mercadopago_country' => 'mercadopago/adminhtml/geral_country.phtml',
            'payment_mercadopago_test_mode' => 'mercadopago/adminhtml/geral_testmode.phtml',
            'payment_mercadopago_public_key_test' => 'mercadopago/adminhtml/geral_credentials_test.phtml',
            'payment_mercadopago_public_key_prod' => 'mercadopago/adminhtml/geral_credentials_prod.phtml',
            'payment_mercadopago_account_homolog' => 'mercadopago/adminhtml/geral_account_homolog.phtml',
            'payment_mercadopago_store_name' => 'mercadopago/adminhtml/geral_store_name.phtml',
            'payment_mercadopago_category_id' => 'mercadopago/adminhtml/field_margin.phtml',
            'payment_mercadopago_consider_discount' => 'mercadopago/adminhtml/field_margin.phtml',
            'payment_mercadopago_refund_available' => 'mercadopago/adminhtml/field_margin.phtml',
            'payment_mercadopago_refund_manager' => 'mercadopago/adminhtml/field_margin.phtml',
            'payment_mercadopago_use_successpage_mp' => 'mercadopago/adminhtml/field_margin.phtml',
            'payment_mercadopago_logs' => 'mercadopago/adminhtml/field_margin.phtml',
            'payment_mercadopago_debug_mode' => 'mercadopago/adminhtml/field_margin.phtml',
            'payment_mercadopago_version' => 'mercadopago/adminhtml/field_margin.phtml',
            'payment_mercadopago_financing_cost' => 'mercadopago/adminhtml/field_margin.phtml',
            //Basic
            'payment_mercadopago_standard_head' => 'mercadopago/adminhtml/basic_head.phtml',
            'payment_mercadopago_standard_head_advanced' => 'mercadopago/adminhtml/basic_head_advanced.phtml',
            'payment_mercadopago_standard_active' => 'mercadopago/adminhtml/field_margin.phtml',
            'payment_mercadopago_standard_excluded_payment_methods_on' => 'mercadopago/adminhtml/field_margin.phtml',
            'payment_mercadopago_standard_excluded_payment_methods_off' => 'mercadopago/adminhtml/field_margin.phtml',
            'payment_mercadopago_standard_installments' => 'mercadopago/adminhtml/field_margin.phtml',
            'payment_mercadopago_standard_show_installment_value' => 'mercadopago/adminhtml/field_margin.phtml',
            'payment_mercadopago_standard_type_checkout' => 'mercadopago/adminhtml/field_margin.phtml',
            'payment_mercadopago_standard_auto_return' => 'mercadopago/adminhtml/field_margin.phtml',
            'payment_mercadopago_standard_binary_mode' => 'mercadopago/adminhtml/field_margin.phtml',
            'payment_mercadopago_standard_sort_order' => 'mercadopago/adminhtml/field_margin.phtml',
            //Custom
            'payment_mercadopago_custom_head' => 'mercadopago/adminhtml/custom_head.phtml',
            'payment_mercadopago_custom_active' => 'mercadopago/adminhtml/field_margin.phtml',
            'payment_mercadopago_custom_payment_methods' => 'mercadopago/adminhtml/field_margin.phtml',
            'payment_mercadopago_custom_installments' => 'mercadopago/adminhtml/field_margin.phtml',
            'payment_mercadopago_custom_show_installment_value' => 'mercadopago/adminhtml/field_margin.phtml',
            'payment_mercadopago_custom_head_advanced' => 'mercadopago/adminhtml/custom_head_advanced.phtml',
            'payment_mercadopago_custom_binary_mode' => 'mercadopago/adminhtml/field_margin.phtml',
            'payment_mercadopago_custom_enable_gateway' => 'mercadopago/adminhtml/field_margin.phtml',
            'payment_mercadopago_custom_sort_order' => 'mercadopago/adminhtml/field_margin.phtml',
            //Ticket
            'payment_mercadopago_customticket_head' => 'mercadopago/adminhtml/ticket_head.phtml',
            'payment_mercadopago_customticket_head_advanced' => 'mercadopago/adminhtml/ticket_head_advanced.phtml',
            'payment_mercadopago_customticket_information' => 'mercadopago/adminhtml/ticket_information.phtml',
            'payment_mercadopago_customticket_active' => 'mercadopago/adminhtml/field_margin.phtml',
            'payment_mercadopago_customticket_excluded_payment_methods_ticket' => 'mercadopago/adminhtml/field_margin.phtml',
            'payment_mercadopago_customticket_date_of_expiration' => 'mercadopago/adminhtml/field_margin.phtml',
            'payment_mercadopago_customticket_sort_order' => 'mercadopago/adminhtml/field_margin.phtml',
            'payment_mercadopago_customticket_tax_vat' => 'mercadopago/adminhtml/field_margin.phtml',
            'payment_mercadopago_customticket_street_number_address' => 'mercadopago/adminhtml/field_margin.phtml',
            'payment_mercadopago_customticket_street_number_address_number' => 'mercadopago/adminhtml/field_margin.phtml',
            'payment_mercadopago_customticket_auto_state' => 'mercadopago/adminhtml/field_margin.phtml',
            //Pse
            'payment_mercadopago_banktransfer_head' => 'mercadopago/adminhtml/pse_head.phtml',
            'payment_mercadopago_banktransfer_head_advanced' => 'mercadopago/adminhtml/pse_head_advanced.phtml',
            'payment_mercadopago_banktransfer_active' => 'mercadopago/adminhtml/field_margin.phtml',
            'payment_mercadopago_banktransfer_sort_order' => 'mercadopago/adminhtml/field_margin.phtml'
        );

        return $phtmlArray;
    }

}