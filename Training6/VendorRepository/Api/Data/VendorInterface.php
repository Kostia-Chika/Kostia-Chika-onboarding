<?php

namespace Training6\VendorRepository\Api\Data;

interface VendorInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{
    const ENTITY_ID = 'id';
    const NAME = 'name';

    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     *
     * @return void
     */
    public function setId($id);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     *
     * @return void
     */
    public function setName($name);

    /**
     * @return \Training6\VendorRepository\Api\Data\VendorExtensionInterface
     */
    public function getExtensionAttributes();

    /**
     * @param \Training6\VendorRepository\Api\Data\VendorExtensionInterface $extensionAttributes
     *
     * @return mixed
     */
    public function setExtensionAttributes(VendorExtensionInterface $extensionAttributes);

}
