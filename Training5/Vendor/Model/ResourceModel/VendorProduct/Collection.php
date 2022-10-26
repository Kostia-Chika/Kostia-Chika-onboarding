<?php

namespace Training5\Vendor\Model\ResourceModel\VendorProduct;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init(\Training5\Vendor\Model\VendorProduct::class, \Training5\Vendor\Model\ResourceModel\VendorProduct::class);
    }
}
