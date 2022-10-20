<?php

namespace Training4\ExchangeRate\Service;

class ExchangeRateServise
{
    public function __construct(\Magento\Framework\HTTP\Client\Curl    $curl)
    {
        $this->curl = $curl;
    }

    /**
     * Makes a get method on api.apilayer.com and returns the USD to EUR exchange rate
     *
     * @return string
     */
    public function getEchangeRate(){
        $this->curl->addHeader('apikey', 'jSFQsQN9pLWPvb1eXyh8f8PqJzJsIW18');
        $this->curl->get('https://api.apilayer.com/fixer/latest?base=USD&symbols=EUR');
        $collection = json_decode($this->curl->getBody(), true);
        return print_r($collection['rates']['EUR'],true);
    }
}
