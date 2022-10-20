<?php

namespace Training3\Specific404Page\Controller;

use Magento\Framework\App\Action\HttpGetActionInterface;

class NoRoute implements HttpGetActionInterface
{
    public function __construct(\Magento\Framework\View\Result\PageFactory $resultPageFactory)
    {
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $resultLayout = $this->resultPageFactory->create();
        $resultLayout->setStatusHeader(404, '1.1', 'Not Found');
        $resultLayout->setHeader('Status', '404 File not found');
        return $resultLayout;
    }
}
