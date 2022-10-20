<?php

namespace Alva\Training2FreeGeoIp\Service;

class GeoIpService
{
    public function __construct(
        \Magento\Checkout\Model\Session        $customerSession,
        \Magento\Framework\HTTP\Client\Curl    $curl,
        \Alva\Training2FreeGeoIp\Logger\Logger $logger

    )
    {
        $this->customerSession = $customerSession;
        $this->curl = $curl;
        $this->logger = $logger;
    }

    /**
     * Returns the user's IP
     *
     * @return string The visitor's IP address
     */
    function getUserIpAddr()
    {
        //return '5.181.233.166';
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    /**
     * Returns the user's IP and country
     *
     * @return string IP and it`s country
     */
    function getCountryAndIp()
    {
        $ip = $this->getUserIpAddr();
        $this->curl->get("www.geoplugin.net/json.gp?ip=" . $ip);
        $collection = json_decode($this->curl->getBody(), true);
        return $ip . " : " . print_r($collection["geoplugin_countryName"], true);
    }

    /**
     * Writes information about the user to the log
     *
     * @return void
     */
    function writeLog()
    {
        $ip = $this->getUserIpAddr();
        if ($this->customerSession->getIpData() != $ip) {
            $this->customerSession->setIpData($ip);
            $this->logger->info($this->getCountryAndIp());
        }
    }
}
