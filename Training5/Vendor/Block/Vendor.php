<?php

namespace Training5\Vendor\Block;

use Magento\Framework\View\Element\Template;

class Vendor extends \Magento\Framework\View\Element\Template
{
    public function __construct(
        Template\Context                                               $context,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Training5\Vendor\Model\ResourceModel\Vendor\Collection        $vendorCollection,
        \Training5\Vendor\Model\ResourceModel\VendorProduct\Collection $vendorProductCollection,
        \Magento\Catalog\Helper\Data                                   $helperData,
        array                                                          $data = []
    ) {
        $this->productCollectionFactory = $productCollectionFactory;
        $this->vendorCollection = $vendorCollection;
        $this->vendorProductCollection = $vendorProductCollection;
        $this->helper = $helperData;
        parent::__construct($context, $data);
    }

    /**
     * Get all vendors of this product
     *
     * @return array vendors
     */
    public function getVendors()
    {
        $product = $this->helper->getProduct();
        $product_id = $product->getId();
        $vendorProduct = $this->vendorProductCollection->addFieldToSelect('vendor_id')->addFieldToFilter('product_id', ['eq' => $product_id]);
        $vendors = [];
        foreach ($vendorProduct->getItems() as $item) {
            $vendors[] = $this->vendorCollection->getItemById($item->toString());
        }
        return $vendors;
    }
}
