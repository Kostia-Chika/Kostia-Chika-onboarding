<?php

namespace Training5\Vendor\Model;

class VendorProduct extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {
        $this->_init(\Training5\Vendor\Model\ResourceModel\VendorProduct::class);
    }
}
