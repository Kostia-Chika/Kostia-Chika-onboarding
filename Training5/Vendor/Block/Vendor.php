<?php

namespace Training5\Vendor\Block;

use Magento\Framework\View\Element\Template;

class Vendor extends \Magento\Framework\View\Element\Template
{
    public function __construct(
        Template\Context                                                      $context,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory        $productCollectionFactory,
        \Training5\Vendor\Model\ResourceModel\Vendor\CollectionFactory        $vendorCollectionFactory,
        \Training5\Vendor\Model\ResourceModel\VendorProduct\CollectionFactory $vendorProductCollectionFactory,
        \Magento\Catalog\Helper\Data                                          $helperData,
        array                                                                 $data = []
    ) {
        $this->productCollectionFactory = $productCollectionFactory;
        $this->vendorCollectionFactory = $vendorCollectionFactory;
        $this->vendorProductCollectionFactory = $vendorProductCollectionFactory;
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
        $vendorProductCollection = $this->vendorProductCollectionFactory->create();
        $vendorProduct = $vendorProductCollection->addFieldToSelect('vendor_id')->addFieldToFilter('product_id', ['eq' => $product_id]);
        $vendors = [];
        $vendorCollection = $this->vendorCollectionFactory->create();
        foreach ($vendorProduct->getItems() as $item) {
            $vendors[] = $vendorCollection->getItemById($item->toString());
        }
        return $vendors;
    }
}
