<?php

class Demo_Testimonials_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    /**
     * Save new testimonial
     */
    public function saveAction()
    {
        // check if user logged in
        if (Mage::getSingleton('customer/session')->isLoggedIn()) {
            $customerData = Mage::getSingleton('customer/session')->getCustomer();
            $customerId   = $customerData->getId();
        }
        else{
            Mage::getSingleton('core/session')->addError('You must be logged in');
        }

        // prepare data and save testimonial
        if ($data = $this->getRequest()->getPost()) {
            try {
                $model = Mage::getModel('demo_testimonials/testimonial');
                $model->setData($data);
                $model->setCustomerId($customerId);
                $model->setCreatedAt(now());
                $model->save();
                Mage::getSingleton('core/session')->addSuccess('Testimonial has been saved successfully');
            } catch (Exception $e) {
                Mage::getSingleton('core/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/');
    }
}