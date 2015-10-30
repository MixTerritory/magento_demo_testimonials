<?php

class Demo_Testimonials_Model_Resource_Testimonial_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('demo_testimonials/testimonial');
    }
}