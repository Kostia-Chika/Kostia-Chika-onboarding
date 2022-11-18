<?php

namespace Training7\Adminhtml\Block\Adminhtml\Vendor\Edit;

use Magento\Backend\Block\Widget\Context;

class Generic
{
    /**
     * @var Context
     */
    protected $context;

    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
    ) {
        $this->context = $context;
    }

    /**
     * @param string $route route for Url
     * @param array $params parameters for Url
     *
     * @return string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }

}
