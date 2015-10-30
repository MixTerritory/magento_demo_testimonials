<?php

class Demo_Testimonials_Block_Adminhtml_Testimonials extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function _construct()
    {
        parent::_construct();
        $this->_controller = 'adminhtml_testimonials';
        $this->_blockGroup = 'demo_testimonials';
        $this->_headerText = Mage::helper('demo_testimonials')->__('Testimonials List');
    }

    protected function _prepareLayout()
    {
        parent::_prepareLayout();

        //remove default "Add New" button
        $this->_removeButton('add');
    }
}