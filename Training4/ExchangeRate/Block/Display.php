<?php

namespace Training4\ExchangeRate\Block;

use Magento\Framework\View\Element\Template;

class Display extends Template
{
    private \Training4\ExchangeRate\Service\ExchangeRateServise $service;

    public function __construct(Template\Context                                    $context,
                                \Training4\ExchangeRate\Service\ExchangeRateServise $service,
                                array                                               $data = [])
    {
        $this->service = $service;
        parent::__construct($context, $data);
    }

    /**
     * Returns the USD to EUR exchange rate
     *
     * @return string
     */
    public function showExchangeRate(): string
    {
        return $this->service->getEchangeRate();
    }
}
