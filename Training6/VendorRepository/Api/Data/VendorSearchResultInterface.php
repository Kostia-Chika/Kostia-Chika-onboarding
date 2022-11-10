<?php

namespace Training6\VendorRepository\Api\Data;

interface VendorSearchResultInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * @return \Training6\VendorRepository\Api\Data\VendorInterface[]
     */
    public function getItems();

    /**
     * @param \Training6\VendorRepository\Api\Data\VendorInterface[] $items
     *
     * @return void
     */
    public function setItems(array $items);
}
