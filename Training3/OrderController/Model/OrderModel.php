<?php

namespace Training3\OrderController\Model;

class OrderModel
{
    public function __construct(
        \Magento\Sales\Model\OrderRepository $orderRepository
    ) {
        $this->orderRepository = $orderRepository;
    }

    /**
     * Get an order with a status, total, invoice and item
     *
     * @param $id integer orders id
     *
     * @return array
     * @throws \Magento\Framework\Exception\InputException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getOrder($id)
    {
        $order = $this->orderRepository->get($id);
        $orderRes = [];
        $orderRes['status'] = $order->getStatus();
        $orderRes['total'] = $order->getGrandTotal();
        $items = [];
        foreach ($order->getAllItems() as $item) {
            $itemParams = [];
            $itemParams['sku'] = $item->getSku();
            $itemParams['id'] = $item->getProductId();
            $itemParams['price'] = $item->getBasePrice();
            $items[] = $itemParams;
        }
        $orderRes['items'] = $items;
        $orderRes['invoice'] = $order->getSubtotalInvoiced() ?? "0.0";
        return $orderRes;
    }
}
