<?php

namespace Training7\Adminhtml\Controller\Adminhtml\Vendor;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\RedirectFactory;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\View\Result\Page;
use Magento\Framework\Reflection\DataObjectProcessor;
use Training6\VendorRepository\Api\Data\VendorInterface;
use Training6\VendorRepository\Api\VendorRepositoryInterface;

class Save extends Action
{
    /**
     * @var DataObjectProcessor
     */
    protected $dataObjectProcessor;

    /**
     * @var VendorRepositoryInterface
     */
    protected $vendorRepository;

    /**
     * @param DataObjectProcessor $dataObjectProcessor
     * @param VendorRepositoryInterface $vendorRepository
     * @param Context $context
     */
    public function __construct(
        DataObjectProcessor       $dataObjectProcessor,
        VendorRepositoryInterface $vendorRepository,
        Context                   $context
    ) {
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->vendorRepository = $vendorRepository;
        parent::__construct($context);
    }

    /**
     * @return ResponseInterface|Redirect|ResultInterface
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $data = $this->getRequest()->getParam('vendor_fieldset');
        $resultRedirect = $this->resultRedirectFactory->create();
        try {
            $vendor = $this->vendorRepository->load((int)$id);

            if (!empty($data['name'])) {
                $vendor->setName($data['name']);
            }
            $this->vendorRepository->save($vendor);
            $this->messageManager->addSuccessMessage(__('You update the vendor'));
            if ($this->getRequest()->getParam('back')) {
                $resultRedirect->setPath('*/*/edit', ['id' => $vendor->getId()]);
            } else {
                $resultRedirect->setPath('*/*/');
            }
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('There was a problem saving the vendor'));
            if (isset($vendor) && $vendor != null) {
                $this->_getSession()->setVendor(
                    $this->dataObjectProcessor->buildOutputDataArray(
                        $vendor,
                        VendorInterface::class
                    )
                );
            }
            $resultRedirect->setPath('training7_adminhtml/vendor/edit', ['id' => $id]);
        }
        return $resultRedirect;
    }
}
