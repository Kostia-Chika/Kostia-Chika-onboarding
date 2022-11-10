<?php

namespace Training6\VendorList\Block;

use Magento\Framework\Api\SearchCriteriaBuilderFactory;
use Magento\Framework\View\Element\Template;

class VendorBlock extends Template
{
    public function __construct(
        Template\Context                                          $context,
        \Training6\VendorRepository\Model\VendorRepositoryFactory $vendorRepositoryFactory,
        \Magento\Catalog\Model\ProductRepository                  $productRepository,
        SearchCriteriaBuilderFactory                              $searchCriteriaBuilderFactory,
        \Magento\Framework\App\RequestInterface                   $request,
        array                                                     $data = []
    ) {
        $this->productRepository = $productRepository;
        $this->vendorRepositoryFactory = $vendorRepositoryFactory;
        $this->searchCriteriaBuilderFactory = $searchCriteriaBuilderFactory;
        $this->request = $request;
        parent::__construct($context, $data);
    }

    /**
     * Get list of products from this vendor
     *
     * @return \Magento\Catalog\Api\Data\ProductInterface[] Products
     */
    public function getProducts()
    {
        $vendorRepository = $this->vendorRepositoryFactory->create();
        $ids = $vendorRepository->getAssociatedProductIds($this->request->getParam('id'));
        $searchCriteriaBuilder = $this->searchCriteriaBuilderFactory->create();
        $searchCriteria = $searchCriteriaBuilder->addFilter('entity_id', $ids, 'in')->create();
        return $this->productRepository->getList($searchCriteria)->getItems();
    }

    /**
     * Get the vendor name
     *
     * @return string Vendor name
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getVendorName()
    {
        $id = $this->request->getParam('id');
        return $this->vendorRepositoryFactory->create()->load($id)->getName();
    }
}
