<?php

namespace Training5\Warranty\Observer;

use Magento\Framework\Event\Observer;

class ProductUpdateObserver implements \Magento\Framework\Event\ObserverInterface
{
    public function execute(Observer $observer)
    {
        $product = $observer->getProduct();
        $warranty = $product->getData('warranty');
        if ($warranty !== null) {
            $warrantyParams = explode(" ", $warranty);
            if (preg_match('/^[0-9]*$/', $warrantyParams[0])) {
                if (!isset($warranty[1]) ||
                    ($warranty[1] != 'year'
                        && $warranty[1] != 'years')) {
                    $year = $warrantyParams[0] == 1 ? ' year' : ' years';
                    $product->setData('warranty', $warrantyParams[0] . $year);
                }
            }
        }
    }
}
