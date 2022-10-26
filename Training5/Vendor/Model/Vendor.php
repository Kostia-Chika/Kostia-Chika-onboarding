<?php

namespace Training5\Vendor\Model;

class Vendor extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {
        $this->_init(\Training5\Vendor\Model\ResourceModel\Vendor::class);
    }
}
