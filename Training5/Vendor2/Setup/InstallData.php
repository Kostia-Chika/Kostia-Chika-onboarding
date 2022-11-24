<?php

namespace Training5\Vendor2\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    public function __construct(
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
    ) {
        $this->productCollectionFactory = $productCollectionFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $tableName = $setup->getTable('training4_vendor2');
        if ($setup->getConnection()->isTableExists($tableName)) {
            $data = [
                [
                    'name' => 'vendor1'
                ],
                [
                    'name' => 'vendor2'
                ],
                [
                    'name' => 'vendor3'
                ],
                [
                    'name' => 'vendor4'
                ],
                [
                    'name' => 'vendor5'
                ],
                [
                    'name' => 'vendor6'
                ],
                [
                    'name' => 'vendor7'
                ],
                [
                    'name' => 'vendor8'
                ],
            ];
            foreach ($data as $item) {
                $setup->getConnection()->insert($tableName, $item);
            }
        }
        $setup->endSetup();
    }
}
