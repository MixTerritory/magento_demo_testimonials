<?php
class Demo_Testimonials_Adminhtml_TestimonialsController extends Mage_Adminhtml_Controller_Action
{
    /**
     * Show testimonials list
     */
    public function indexAction()
    {
        $this->loadLayout();
        $this->_setActiveMenu('demo_testimonials');

        $contentBlock = $this->getLayout()->createBlock('demo_testimonials/adminhtml_testimonials');
        $this->_addContent($contentBlock);
        $this->renderLayout();
    }

    /**
     * Edit testimonial
     */
    public function editAction()
    {
        //get current testimonial id from url
        $id = (int)$this->getRequest()->getParam('id');
        //store testimonial in registry scope
        Mage::register('current_testimonial', Mage::getModel('demo_testimonials/testimonial')->load($id));
        $this->loadLayout()->_setActiveMenu('demo_testimonials');
        $this->_addContent($this->getLayout()->createBlock('demo_testimonials/adminhtml_testimonials_edit'));
        $this->renderLayout();
    }

    /**
     * Update testimonial
     */
    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost()) {
            try {
                $model = Mage::getModel('demo_testimonials/testimonial');
                $model->setData($data)->setId($this->getRequest()->getParam('id'));
                //add current time if not exist
                if (!$model->getCreatedAt()) {
                    $model->setCreated(now());
                }

                //set customer by default
                if (!$model->getCustomerId()) {
                    $model->setCustomerId(1);
                }
                //save testimonial entry
                $model->save();
                //successfully
                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Testimonial has been updated successfully'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                //Error
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array(
                    'id' => $this->getRequest()->getParam('id')
                ));
            }
            return;
        }
        Mage::getSingleton('adminhtml/session')->addError($this->__('Something wrong: can not update the testimonial!'));
        $this->_redirect('*/*/');
    }

    /**
     * Remove testimonial
     */
    public function deleteAction()
    {
        if ($id = $this->getRequest()->getParam('id')) {
            try {
                Mage::getModel('demo_testimonials/testimonial')->setId($id)->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('Testimonial has been deleted successfully'));
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $id));
            }
        }
        $this->_redirect('*/*/');
    }

    /**
     * Bulk remove testimonials
     */
    public function massDeleteAction()
    {
        $testimonials = $this->getRequest()->getParam('testimonial', null);
        if (is_array($testimonials) && sizeof($testimonials) > 0) {
            try {
                foreach ($testimonials as $id) {
                    Mage::getModel('demo_testimonials/testimonial')->setId($id)->delete();
                }
                $this->_getSession()->addSuccess($this->__('Total of %d testimonials have been deleted', sizeof($testimonials)));
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        } else {
            $this->_getSession()->addError($this->__('Please select testimonial'));
        }
        $this->_redirect('*/*');
    }

    public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('demo_testimonials/adminhtml_testimonials_grid')->toHtml()
        );
    }
}