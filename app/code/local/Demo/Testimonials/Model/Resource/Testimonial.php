<?php

class Demo_Testimonials_Model_Resource_Testimonial extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {
        $this->_init('demo_testimonials/table_demo_testimonials', 'testimonial_id');
    }
}