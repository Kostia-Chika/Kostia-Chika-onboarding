<?php

namespace Training6\VendorRepository\Model;

use Training6\VendorRepository\Api\Data\VendorInterface;
use Training6\VendorRepository\Api\Data\VendorExtensionInterface;

class Vendor extends \Magento\Framework\Model\AbstractExtensibleModel implements VendorInterface
{
    protected function _construct()
    {
        $this->_init(\Training6\VendorRepository\Model\ResourceModel\Vendor::class);
    }

    /**
     * @inheritDoc
     */
    public function getId()
    {
        return parent::getData(self::ENTITY_ID);
    }

    /**
     * @inheritDoc
     */
    public function setId($entityId)
    {
        return $this->setData(self::ENTITY_ID, $entityId);
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return parent::getData(self::NAME);
    }

    /**
     * @inheritDoc
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * @inheritDoc
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * @inheritDoc
     */
    public function setExtensionAttributes(
        VendorExtensionInterface $extensionAttributes
    ) {
        $this->_setExtensionAttributes($extensionAttributes);
    }

}
