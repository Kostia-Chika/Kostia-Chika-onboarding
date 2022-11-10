<?php

namespace Training6\VendorList\Controller\Vendors;

use Magento\Framework\Api\SearchCriteriaBuilderFactory;
use Magento\Framework\App\Action\HttpGetActionInterface;

class Table implements HttpGetActionInterface
{
    public function __construct(
        \Magento\Framework\App\RequestInterface                   $request,
        \Magento\Framework\Api\FilterBuilder                      $filterBuilder,
        \Magento\Framework\Api\SortOrderBuilder                   $sortOrderBuilder,
        \Training6\VendorRepository\Model\VendorRepositoryFactory $vendorRepositoryFactory,
        SearchCriteriaBuilderFactory                              $searchCriteriaBuilderFactory,
        \Magento\Framework\Controller\Result\RawFactory           $rawFactory,
    ) {
        $this->request = $request;
        $this->vendorRepositoryFactory = $vendorRepositoryFactory;
        $this->searchCriteriaBuilderFactory = $searchCriteriaBuilderFactory;
        $this->filterBuilder = $filterBuilder;
        $this->sortOrderBuilder = $sortOrderBuilder;
        $this->rawFactory = $rawFactory;
    }

    public function execute()
    {
        $raw = $this->rawFactory->create();
        $raw->setContents($this->createTable());
        return $raw;
    }

    /**
     * Creates a table of vendors in which the id, name and number of products are specified
     *
     * @return string table in the form of html
     */
    public function createTable()
    {
        $params = $this->request->getParams();
        $raws = '';
        $vendorRepository = $this->vendorRepositoryFactory->create();
        $search = $this->searchCriteriaBuilderFactory->create();
        $sortOrder = $this->sortOrderBuilder->setField('id')->setDirection($params["sort"] ?? "ASC")->create();
        if (isset($params["name"])) {
            $search->addFilter("name", "%" . $params["name"] . "%", "like");
        }
        $search->addSortOrder($sortOrder);
        $vendors = $vendorRepository->getList($search->create())->getItems();
        foreach ($vendors as $item) {
            $raw1 = '<td>' . $item->getId() . '</td>';
            $raw2 = '<td>' . $item->getName() . '</td>';
            $raw3 = '<td>' . $this->getProductCount($item->getId()) . '</td>';
            $rawTr = '<tr>' . $raw1 . $raw2 . $raw3 . '</tr>';
            $raws .= $rawTr;
        }
        return $raws;
    }

    /**
     * Get the quantity of the vendor's products
     *
     * @param int $id id of the vendor
     *
     * @return int|null product count
     */
    public function getProductCount($id)
    {
        $vendorRepository = $this->vendorRepositoryFactory->create();
        return count($vendorRepository->getAssociatedProductIds($id));
    }
}
