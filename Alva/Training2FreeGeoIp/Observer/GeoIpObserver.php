<?php

namespace Alva\Training2FreeGeoIp\Observer;

use Magento\Framework\Event\Observer;

class GeoIpObserver implements \Magento\Framework\Event\ObserverInterface
{

    public function __construct(\Alva\Training2FreeGeoIp\Service\GeoIpService $geoIpService)
    {
        $this->geoIpService = $geoIpService;
    }

    public function execute(Observer $observer)
    {
        $this->geoIpService->writeLog();
    }
}
