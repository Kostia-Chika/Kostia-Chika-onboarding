<?php

namespace Training3\OrderController\Model;

class OrderModel
{
    /**
     * Get an order with a status, total, invoice and item
     *
     * @param $id integer orders id
     * @return array
     * @throws \Magento\Framework\Exception\InputException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getOrder($id){
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $order = $objectManager->create('\Magento\Sales\Model\OrderRepository')->get($id);
        $orderRes = [];
        $orderRes['Status'] = $order->getStatus();
        $orderRes['total'] = $order->getGrandTotal();
        $items = [];
        foreach ($order->getAllItems() as $item){
            $itemParams = [];
            array_push($itemParams, $item->getSku(), $item->getProductId(),$item->getBasePrice());
            $items[] =  $itemParams;
        }
        $orderRes['items'] = $items;
        $orderRes['invoice'] = $order->getSubtotalInvoiced();
        return $orderRes;
    }
}
