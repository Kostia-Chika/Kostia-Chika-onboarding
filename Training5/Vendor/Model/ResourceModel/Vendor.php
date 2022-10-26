<?php

namespace Training5\Vendor\Model\ResourceModel;

class Vendor extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    protected function _construct()
    {
        $this->_init('training4_vendor', 'id');
    }
}
