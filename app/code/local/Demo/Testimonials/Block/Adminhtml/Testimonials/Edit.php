<?php

class Demo_Testimonials_Block_Adminhtml_Testimonials_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{

    protected function _construct()
    {
        $this->_blockGroup = 'demo_testimonials';
        $this->_controller = 'adminhtml_testimonials';
    }

    /**
     * Return header text for Edit Testimonial page
     *
     * @return string
     */
    public function getHeaderText()
    {
        return Mage::helper('demo_testimonials')->__("Edit Testimonial:");
    }
}