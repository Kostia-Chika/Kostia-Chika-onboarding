<?php

namespace Training5\Warranty\Model\Attribute\Frontend;

use Magento\Eav\Model\Entity\Attribute\Frontend\AbstractFrontend;
use Magento\Framework\DataObject;

class Warranty extends AbstractFrontend
{
    public function getValue(DataObject $object)
    {
        $this->getAttribute()->setData(\Magento\Catalog\Model\ResourceModel\Eav\Attribute::IS_HTML_ALLOWED_ON_FRONT, 1);

        $value = $object->getData($this->getAttribute()->getAttributeCode());
        return "<strong>$value</strong>";
    }
}
