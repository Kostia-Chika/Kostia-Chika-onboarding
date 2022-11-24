<?php

namespace Training5\Warranty\Setup\Patch\Data;

use Magento\Customer\Api\CustomerMetadataInterface;
use Magento\Eav\Model\ResourceModel\Entity\Attribute\Group\CollectionFactory as GroupCollectionFactory;
use Magento\Eav\Model\ResourceModel\Entity\Attribute\Set\CollectionFactory as AttributeCollectionFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;
use Psr\Log\LoggerInterface;

class Warranty implements DataPatchInterface, PatchRevertableInterface
{
    /**
     * Construct
     *
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param CustomerSetupFactory $customerSetupFactory
     * @param LoggerInterface $logger
     * @param AttributeCollectionFactory $attributeSetCollection
     * @param GroupCollectionFactory $groupCollection
     */
    public function __construct(
        ModuleDataSetupInterface   $moduleDataSetup,
        CustomerSetupFactory       $customerSetupFactory,
        LoggerInterface            $logger,
        AttributeCollectionFactory $attributeSetCollection,
        GroupCollectionFactory     $groupCollection
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->customerSetup = $customerSetupFactory->create(['setup' => $moduleDataSetup]);
        $this->logger = $logger;
        $this->attributeSetCollection = $attributeSetCollection;
        $this->groupCollection = $groupCollection;
    }

    public function apply()
    {
        try {
            $this->moduleDataSetup->getConnection()->startSetup();

            $this->customerSetup->addAttribute(
                \Magento\Catalog\Model\Product::ENTITY,
                'warranty3',
                [
                    'label' => 'warranty 3',
                    'required' => 0,
                    'position' => 200,
                    'system' => 0,
                    'user_defined' => 1,
                    'is_used_in_grid' => 1,
                    'is_visible_in_grid' => 1,
                    'is_filterable_in_grid' => 1,
                    'is_searchable_in_grid' => 1,
                    'visible_on_front' => 1,
                    'is_html_allowed_on_front' => 1,
                    'backend' => \Training5\Warranty\Model\Attribute\Backend\Warranty::class,
                    'frontend' => \Training5\Warranty\Model\Attribute\Frontend\Warranty::class
                ]
            );

            $entityTypeId = $this->customerSetup->getEntityTypeId(\Magento\Catalog\Model\Product::ENTITY);
            $attributeSetId = $this->getAttrSetId('Gear');
            $groupId = $this->customerSetup->getAttributeGroupId($entityTypeId, $attributeSetId, "Product Details");
            $this->customerSetup->addAttributeToSet(
                $entityTypeId,
                $attributeSetId,
                $groupId,
                'warranty3'
            );

            $this->moduleDataSetup->getConnection()->endSetup();
        } catch (Exception $exception) {
            $this->logger->error($exception->getMessage());
        }
    }

    public function getAliases()
    {
        return [];
    }

    public static function getDependencies(): array
    {
        return [];
    }

    public function revert()
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        $this->customerSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'warranty3');
        $this->moduleDataSetup->getConnection()->endSetup();
    }

    /**
     * Get attribute set id by name
     *
     * @param string $attrSetName attribute set name
     *
     * @return mixed attribute set id
     */
    public function getAttrSetId($attrSetName)
    {
        $attributeSet = $this->attributeSetCollection->create()->addFieldToSelect(
            '*'
        )->addFieldToFilter(
            'attribute_set_name',
            $attrSetName
        )->load()->getFirstItem();
        return $attributeSet->getAttributeSetId();
    }

    /**
     * Get group id by name
     *
     * @param int $attrSetId attribute set id
     * @param string $groupName group name
     *
     * @return array|mixed|null group id
     */
    public function getGroupId($attrSetId, $groupName)
    {
        return $this->groupCollection->create()
            ->setAttributeSetFilter($attrSetId)
            ->addFilter('attribute_group_name', $groupName)
            ->getFirstItem()->getData("attribute_group_id");
    }
}
