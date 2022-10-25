<?php

namespace Training3\OrderController\Block;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Element\Template;

class Block extends Template
{
    public function __construct(
        Template\Context                            $context,
        \Training3\OrderController\Model\OrderModel $orderModel,
        \Magento\Framework\App\RequestInterface     $request,
        array                                       $data = []
    ) {
        $this->orderModel = $orderModel;
        $this->request = $request;
        parent::__construct($context, $data);
    }

    /**
     * Get an order with a status, total, invoice and without item
     *
     * @return array
     */
    public function getOrderWithoutItem()
    {
        $orders = $this->orderModel->getOrder($this->request->getParam('orderID'));
        return $orders;
    }
}
