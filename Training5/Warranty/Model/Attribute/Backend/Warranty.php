<?php

namespace Training5\Warranty\Model\Attribute\Backend;

use Magento\Eav\Model\Entity\Attribute\Backend\AbstractBackend;

class Warranty extends AbstractBackend
{
    public function beforeSave($object)
    {
        $attribute_code = $this->getAttribute()->getAttributeCode();
        $value = $object->getData($attribute_code);
        if ($value !== null && preg_match('/^[0-9]*$/', $value)) {
            $year = $value == 1 ? ' year' : ' years';
            $object->setData($attribute_code, $value . $year);
        }
        return $object;
    }
}
