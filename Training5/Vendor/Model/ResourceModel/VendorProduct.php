<?php

namespace Training5\Vendor\Model\ResourceModel;

class VendorProduct extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('vendor_product', 'id');
    }
}
