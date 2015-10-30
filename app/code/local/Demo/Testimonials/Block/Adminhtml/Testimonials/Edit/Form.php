<?php

class Demo_Testimonials_Block_Adminhtml_Testimonials_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * @return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        //retrieve data from registry
        $model = Mage::registry('current_testimonial');
        //create from object
        $form = new Varien_Data_Form(array(
            'id'      => 'edit_form',
            'action'  => $this->getUrl('*/*/save', array(
                'id' => $this->getRequest()->getParam('id')
            )),
            'method'  => 'post',
            'enctype' => 'multipart/form-data'
        ));
        $this->setForm($form);
        $fieldset = $form->addFieldset('testimonials_form', array('legend' => Mage::helper('demo_testimonials')->__('Detailed Information')));
        //add field 'Content' for edit
        $fieldset->addField('content', 'editor', array(
            'label'    => Mage::helper('demo_testimonials')->__('Content'),
            'required' => true,
            'width'    => '100%',
            'name'     => 'content',
        ));
        $form->setUseContainer(true);
        if ($data = Mage::getSingleton('adminhtml/session')->getFormData()) {
            $form->setValues($data);
        } else {
            $form->setValues($model->getData());
        }
        return parent::_prepareForm();
    }
}