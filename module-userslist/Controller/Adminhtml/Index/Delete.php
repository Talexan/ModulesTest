<?php

namespace Talexan\UsersList\Controller\Adminhtml\Index;

use Talexan\UsersList\Model\UsersListingFactory;
use Magento\Backend\App\Action;

/**
 * Class Delete
 *
 * @package Talexan\UsersList\Controller\Adminhtml\Index
 */
class Delete extends Action
{
    /**
     * @var UsersListingFactory
     */
    private $usersListingFactory;

    /**
     * Delete constructor.
     *
     * @param Action\Context $context
     * @param UsersListingFactory $usersListingFactory
     */
    public function __construct(
        Action\Context $context,
        UsersListingFactory $usersListingFactory
    ) {
        $this->usersListingFactory = $usersListingFactory;
        parent::__construct($context);
    }

    /**
     * @return $this|\Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $id = (int)$this->getRequest()->getParam('id', 0);
        $resultRedirect = $this->resultRedirectFactory->create();
        $model = $this->usersListingFactory->create();
        if ($id) {
            $model->setData($id);
            try {
                $model->delete();
                $this->messageManager->addSuccessMessage(__('Removed successfully.'));
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('Error while trying to delete item.'));
            }
        } else {
            $this->messageManager->addErrorMessage(__('Error while trying to delete item.'));
        }

        return $resultRedirect->setPath('*/*/index');
    }
}