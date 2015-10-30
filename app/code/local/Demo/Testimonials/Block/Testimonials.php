<?php

class Demo_Testimonials_Block_Testimonials extends Mage_Core_Block_Template
{
    /**
     * @var $current_page int
     */
    public $current_page = 1;

    /**
     * @var $page_limit int
     */
    public $page_limit = 10;

    public function __construct()
    {
        parent::__construct();
        $collection = Mage::getModel('demo_testimonials/testimonial')->getCollection()->setOrder('created_at', 'DESC');
        $this->setCollection($collection);
    }

    /**
     * @return string
     */
    public function getFormAction()
    {
        return $this->getUrl('demo_testimonials/index/save');
    }

    /**
     * @return $this
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        $pager = $this->getLayout()->createBlock('page/html_pager', 'custom.pager');
        $pager->setCollection($this->getCollection());
        $this->setChild('pager', $pager);
        $this->getCollection()->load();
        return $this;
    }

    /**
     * @return string
     */
    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }

    /**
     * @return mixed
     */
    public function getCollection()
    {
        if (Mage::app()->getRequest()->getParam('p')) {
            $this->current_page = Mage::app()->getRequest()->getParam('p');
        }

        $offset = ($this->current_page - 1) * $this->page_limit;
        $collection = Mage::getModel('demo_testimonials/testimonial')->getCollection()->setOrder('created_at', 'DESC');
        $collection->getSelect()->limit($this->page_limit, $offset);
        return $collection;
    }
}