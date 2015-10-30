<?php

class Demo_Testimonials_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * Get testimonials url
     *
     * @return string
     */
    public function getTestimonialsUrl()
    {
        return $this->_getUrl('demo_testimonials');
    }
}