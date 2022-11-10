<?php

namespace Training6\VendorList\Controller\Vendors;

use Magento\Framework\App\Action\HttpGetActionInterface;

class View implements HttpGetActionInterface
{
    public function __construct(
        \Magento\Framework\View\Result\PageFactory $pageFactory,
    ) {
        $this->pageFactory = $pageFactory;
    }

    public function execute()
    {
        return $this->pageFactory->create();
    }
}
