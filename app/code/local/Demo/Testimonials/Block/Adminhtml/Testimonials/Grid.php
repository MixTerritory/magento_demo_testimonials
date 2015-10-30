<?php

class Demo_Testimonials_Block_Adminhtml_Testimonials_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('main_grid');
        $this->setDefaultSort('testimonial_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);

    }

    /**
     * @return Mage_Adminhtml_Block_Widget_Grid
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('demo_testimonials/testimonial')->getCollection();

        //get owner of testimonial
        $fn = Mage::getModel('eav/entity_attribute')->loadByCode('1', 'firstname');
        $ln = Mage::getModel('eav/entity_attribute')->loadByCode('1', 'lastname');
        $collection->getSelect()
            ->join(array('ce1' => 'customer_entity_varchar'), 'ce1.entity_id=main_table.customer_id', array('firstname' => 'value'))
            ->where('ce1.attribute_id='.$fn->getAttributeId())
            ->join(array('ce2' => 'customer_entity_varchar'), 'ce2.entity_id=main_table.customer_id', array('lastname' => 'value'))
            ->where('ce2.attribute_id='.$ln->getAttributeId())
            ->columns(new Zend_Db_Expr("CONCAT(`ce1`.`value`, ' ',`ce2`.`value`) AS customer_name"));

        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    /**
     * @return $this
     */
    protected function _prepareColumns()
    {
        $this->addColumn('testimonial_id', array(
            'header'	=> Mage::helper('demo_testimonials')->__('ID'),
            'align'		=> 'right',
            'width'		=> '50px',
            'index'		=> 'testimonial_id',
            'type'		=> 'number',
        ));

        $this->addColumn('customer_name', array(
            'header'    => Mage::helper('demo_testimonials')->__('Customer Name'),
            'width'		=> '250px',
            'index' => 'customer_name',
            'filter_name' => 'customer_name'
        ));

        $this->addColumn('content', array(
            'header' => Mage::helper('demo_testimonials')->__('Content'),
            'index'  => 'content',
            'type'   => 'text',
            'escape' => true,
        ));
        $this->addColumn('created_at', array(
            'header' => Mage::helper('demo_testimonials')->__('Created At'),
            'index'  => 'created_at',
            'type'   => 'date',
        ));
    }

    /**
     * @return $this
     */
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('testimonial_id');
        $this->getMassactionBlock()->setFormFieldName('testimonial');
        $this->getMassactionBlock()->addItem('remove', array(
            'label'		=> Mage::helper('demo_testimonials')->__('Delete'),
            'url'		=> $this->getUrl('*/*/massDelete'),
            'confirm'	=> Mage::helper('demo_testimonials')->__('Are you sure?'),
        ));

        return $this;
    }

    /**
     * @param $model string
     * @return string
     */
    public function getRowUrl($model)
    {
        return $this->getUrl('*/*/edit', array('id' => $model->getId(),));
    }

    public function getGridUrl() {
        return $this->getUrl('*/*/grid', array('_current' => true));
    }
}