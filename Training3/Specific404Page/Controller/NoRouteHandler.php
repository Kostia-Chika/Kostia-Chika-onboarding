<?php

namespace Training3\Specific404Page\Controller;

class NoRouteHandler implements \Magento\Framework\App\Router\NoRouteHandlerInterface
{
    public function process(\Magento\Framework\App\RequestInterface $request)
    {
        $pathInfo = $request->getPathInfo();
        $parts = explode('/', trim($pathInfo, '/'));

        $moduleName = $parts[0] ?? '';
        $actionPath = $parts[1] ?? '';
        $actionName = $parts[2] ?? '';
        $id = $parts[3] ?? '';

        if($moduleName == 'catalog' && $actionPath == 'product' && $actionName == 'view' && $id == 'id') {
            $request->setModuleName('notfoundpage')
                ->setControllerName('noroute')
                ->setActionName('product');
        } else if($moduleName == 'catalog' && $actionPath == 'category' && $actionName == 'view' && $id == 'id') {
            $request->setModuleName('notfoundpage')
                ->setControllerName('noroute')
                ->setActionName('category');
        }
        else {
            $request->setModuleName('notfoundpage')
                ->setControllerName('noroute')
                ->setActionName('other');
        }
        return false;
    }
}
