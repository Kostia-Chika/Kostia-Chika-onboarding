<?php

namespace Training6\VendorRepository\Model;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Training6\VendorRepository\Api\Data\VendorInterface;
use Training6\VendorRepository\Api\Data\VendorSearchResultInterfaceFactory;
use Training6\VendorRepository\Api\VendorRepositoryInterface;
use Training6\VendorRepository\Model\ResourceModel\Vendor;

class VendorRepository implements VendorRepositoryInterface
{
    /**
     * @var VendorFactory
     */
    private $vendorFactory;

    /**
     * @var Vendor
     */
    private $vendorResource;

    /**
     * @var VendorCollectionFactory
     */
    private $vendorCollectionFactory;

    /**
     * @var VendorSearchResultInterfaceFactory
     */
    private $searchResultFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @var VendorProductCollectionFactory
     */
    private $vendorProductCollectionFactory;

    public function __construct(
        VendorFactory                                                            $vendorFactory,
        Vendor                                                                   $vendorResource,
        \Training6\VendorRepository\Model\ResourceModel\Vendor\CollectionFactory $vendorCollectionFactory,
        VendorSearchResultInterfaceFactory                                       $vendorSearchResultInterfaceFactory,
        CollectionProcessorInterface                                             $collectionProcessor,
        \Training5\Vendor\Model\ResourceModel\VendorProduct\CollectionFactory    $vendorProductCollectionFactory,

    ) {
        $this->vendorFactory = $vendorFactory;
        $this->vendorResource = $vendorResource;
        $this->vendorCollectionFactory = $vendorCollectionFactory;
        $this->searchResultFactory = $vendorSearchResultInterfaceFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->vendorProductCollectionFactory = $vendorProductCollectionFactory;
    }

    /**
     * @param $id
     *
     * @return VendorInterface
     * @throws NoSuchEntityException
     */
    public function load($id)
    {
        $vendor = $this->vendorFactory->create();
        $this->vendorResource->load($vendor, $id);
        if (!$vendor->getId()) {
            throw new NoSuchEntityException(__('Unable to find Vendor with ID "%1"', $id));
        }
        return $vendor;
    }

    /**
     * @param VendorInterface $vendor
     *
     * @return VendorInterface
     * @throws \Magento\Framework\Exception\AlreadyExistsException
     */
    public function save(VendorInterface $vendor)
    {
        $this->vendorResource->save($vendor);
        return $vendor;
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     *
     * @return \Training6\VendorRepository\Api\Data\VendorSearchResultInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->vendorCollectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);
        $searchResults = $this->searchResultFactory->create();

        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());

        return $searchResults;
    }

    /**
     * @param int $id
     *
     * @return int[]
     */
    public function getAssociatedProductIds($id)
    {
        $vendorProductCollection = $this->vendorProductCollectionFactory->create();
        return array_map(fn($el) => (int)$el->getData('product_id'), $vendorProductCollection->addFieldToSelect('product_id')
            ->addFieldToFilter('vendor_id', ['eq' => $id])
            ->getItems());
    }
}
