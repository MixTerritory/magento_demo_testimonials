<?php

class Demo_Testimonials_Model_Testimonial extends Mage_Core_Model_Abstract
{

    /**
     * Initialize resource model
     */
    protected function _construct()
    {
        parent::_construct();
        $this->_init('demo_testimonials/testimonial');
    }

    /**
     * Get customer name
     * @return string
     */
    public function getCustomerName(){
        $customer  = Mage::getModel('customer/customer')->load($this->getCustomerId());
        return "{$customer->getFirstname()} {$customer->getLastname()}";
    }
}