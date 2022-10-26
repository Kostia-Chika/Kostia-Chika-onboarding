<?php

namespace Training5\Vendor\Model\ResourceModel\Vendor;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init(\Training5\Vendor\Model\Vendor::class, \Training5\Vendor\Model\ResourceModel\Vendor::class);
    }
}
