<?php

namespace Training5\Vendor\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{

    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        //Create a new table
        if (version_compare($context->getVersion(), '1.0.1') < 0) {
            $tableName = $setup->getTable('vendor_product');
            //Check for the existence of the table
            if ($setup->getConnection()->isTableExists($tableName) != true) {
                $tableRelation = $setup->getConnection()
                    ->newTable($tableName)
                    ->addColumn(
                        'id',
                        Table::TYPE_INTEGER,
                        null,
                        [
                            'identity' => true,
                            'unsigned' => true,
                            'nullable' => false,
                            'primary' => true
                        ],
                        'ID'
                    )
                    ->addColumn(
                        'product_id',
                        Table::TYPE_INTEGER,
                        null,
                        ['nullable' => false, 'unsigned' => true],
                    )
                    ->addColumn(
                        'vendor_id',
                        Table::TYPE_INTEGER,
                        null,
                        ['nullable' => false, 'unsigned' => true],
                    )
                    ->addForeignKey(
                        'vendor_product',
                        'product_id',
                        'catalog_product_entity',
                        'entity_id',
                        Table::ACTION_CASCADE
                    )
                    ->addForeignKey(
                        'vendor_product',
                        'vendor_id',
                        'training4_vendor',
                        'id',
                        Table::ACTION_CASCADE
                    )
                    ->setOption('charset', 'utf8');
                $setup->getConnection()->createTable($tableRelation);
            }
        }
        $setup->endSetup();
    }
}
