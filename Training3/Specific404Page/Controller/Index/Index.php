<?php

namespace Training3\Specific404Page\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;

class Index implements HttpGetActionInterface
{
    public function execute(){
        echo '1122 good';
    }
}
