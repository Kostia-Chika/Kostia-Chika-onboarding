<?php

namespace Alva\Training2Review2\Plugin;

use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\InputException;

class ReviewPlugin
{
    public function beforeExecute(
        \Magento\Review\Controller\Product $subject,
    ) {
        $request = $subject->getRequest();
        if (str_contains($request->getParams()['nickname'], "-")) {
            throw new InputException(__('Nickname is incorrect. It must not contain "-"'));
        }
        return null;
    }
}
