<?php

namespace Training6\VendorRepository\Model\ResourceModel\Vendor;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init(\Training6\VendorRepository\Model\Vendor::class,
            \Training6\VendorRepository\Model\ResourceModel\Vendor::class);
    }
}
