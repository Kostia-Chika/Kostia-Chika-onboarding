<?php

namespace Training3\OrderController\Controller\Json;

use Magento\Framework\App\Action\HttpGetActionInterface;

class Order implements HttpGetActionInterface
{

    public function __construct(
        \Magento\Framework\App\RequestInterface          $request,
        \Magento\Framework\Controller\Result\JsonFactory $jsonFactory,
        \Magento\Framework\View\Result\PageFactory       $pageFactory,
        \Training3\OrderController\Model\OrderModel      $model
    )
    {
        $this->request = $request;
        $this->jsonFactory = $jsonFactory;
        $this->pageFactory = $pageFactory;
        $this->model = $model;
    }

    /**
     * Creates a json or a page depending on the query parameters
     *
     * @return \Magento\Framework\Controller\Result\Json|\Magento\Framework\View\Result\Page
     */
    public function getResult(){
        $param = $this->request->getParams();
        $json = $this->jsonFactory->create();
        if (isset($param['orderID'])){
            if(isset($param['json']) && $param['json'] == 1){

                return $json->setData($this->model->getOrder($param['orderID']));
            }
            else{
                return $this->pageFactory->create();
            }
        }

        return $this->pageFactory->create();
    }

    public function execute()
    {
        return $this->getResult();
    }
}
