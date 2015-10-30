<?php

$installer = $this;
/* @var $installer Mage_Core_Model_Resource_Setup */

$installer->startSetup();

/**
 * Create table 'demo_testimonials_entities'
 */
$table = $installer->getConnection()
    ->newTable($installer->getTable('demo_testimonials/table_demo_testimonials'))
    ->addColumn('testimonial_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
    ), 'Testimonial Id')
    ->addColumn('customer_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned'  => true,
        'nullable'  => true,
        'default'   => '0',
    ), 'Customer Id')
    ->addColumn('content', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable'  => false,
    ), 'Content')
    ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
    ), 'Created At')
    ->addIndex($installer->getIdxName('demo_testimonials/table_demo_testimonials', 'customer_id'), 'customer_id')
    ->addForeignKey($installer->getFkName('demo_testimonials/table_demo_testimonials', 'customer_id', 'customer/entity', 'entity_id'),
        'customer_id', $installer->getTable('customer/entity'), 'entity_id',
        Varien_Db_Ddl_Table::ACTION_SET_NULL, Varien_Db_Ddl_Table::ACTION_CASCADE)
    ->setComment('Demo Testimonials');
$installer->getConnection()->createTable($table);

$installer->endSetup();