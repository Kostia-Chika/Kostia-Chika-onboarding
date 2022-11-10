<?php

namespace Training6\VendorRepository\Api;

interface VendorRepositoryInterface
{
    /**
     * @param int $id
     *
     * @return \Training6\VendorRepository\Api\Data\VendorInterface
     */
    public function load($id);

    /**
     * @param \Training6\VendorRepository\Api\Data\VendorInterface $vendor
     *
     * @return \Training6\VendorRepository\Api\Data\VendorInterface
     */
    public function save(\Training6\VendorRepository\Api\Data\VendorInterface $vendor);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     *
     * @return \Training6\VendorRepository\Api\Data\VendorSearchResultInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * @param int $id
     *
     * @return int[]
     */
    public function getAssociatedProductIds($id);
}
