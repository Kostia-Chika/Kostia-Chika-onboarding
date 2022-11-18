<?php

namespace Training7\Adminhtml\Controller\Adminhtml\Vendor;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Training6\VendorRepository\Api\VendorRepositoryInterface;
use Training6\VendorRepository\Model\VendorRepository;

class InlineEdit extends Action
{
    /**
     * @var JsonFactory
     */
    protected $jsonFactory;

    /**
     * @var VendorRepository
     */
    protected $vendorRepository;

    /**
     * @param Context $context
     * @param VendorRepositoryInterface $vendorRepository
     * @param JsonFactory $jsonFactory
     */
    public function __construct(
        Context                   $context,
        VendorRepositoryInterface $vendorRepository,
        JsonFactory               $jsonFactory
    ) {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
        $this->vendorRepository = $vendorRepository;
    }

    /**
     * @return ResultInterface
     * @throws NoSuchEntityException
     */
    public function execute()
    {
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];
        $postData = $this->getRequest()->getParam('items', []);
        if (!($this->getRequest()->getParam('isAjax') && count($postData))) {
            return $resultJson->setData(
                [
                    'messages' => [__('Please correct the data which you send.')],
                    'error' => true,
                ]
            );
        }
        foreach (array_keys($postData) as $id) {
            $vendor = $this->vendorRepository->load($id);
            try {
                $vendor->setName($postData[$id]['name']);
                $this->vendorRepository->save($vendor);
            } catch (\Exception $e) {
                $messages[] = "[Error : {$id}]  {$e->getMessage()}";
                $error = true;
            }
        }

        return $resultJson->setData(
            [
                'messages' => $messages,
                'error' => $error,
            ]
        );
    }
}
