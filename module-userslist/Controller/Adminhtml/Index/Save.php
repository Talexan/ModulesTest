<?php

namespace Talexan\UsersList\Controller\Adminhtml\Index;

use Talexan\UsersList\Model\UsersListingFactory;
use Magento\Backend\App\Action;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class Save
 *
 * @package Talexan\UsersList\Controller\Adminhtml\Index
 */
class Save extends Action
{
    /**
     * @var UsersListingFactory
     */
    private $usersListingFactory;

    /**
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * Save constructor.
     *
     * @param Action\Context $context
     * @param UserslistingFactory $usersListingFactory
     * @param DataPersistorInterface $dataPersistor
     */

    public function __construct(
        Action\Context $context,
        UsersListingFactory $usersListingFactory,
        DataPersistorInterface $dataPersistor
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->usersListingFactory = $usersListingFactory;
        parent::__construct($context);
    }

    /**
     * @return $this|\Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $params = $this->getRequest()->getPostValue();
        if (!empty($params)) {
            $id = (int)$this->getRequest()->getParam('id', 0);
            if (!$id) {
                unset($params['id']);
            }
            $model = $this->usersListingFactory->create();
            $model->setData($params);
            try {
                $model->save();
                $this->messageManager->addSuccessMessage(__('Saved successfully.'));
                $this->dataPersistor->clear('user_persist');
                $param = $this->getRequest()->getParam('back');
                if (!$param) {
                    return $resultRedirect->setPath('*/*/');
                }
            } catch (LocalizedException $localizedException) {
                $this->messageManager->addErrorMessage($localizedException->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something wrong'));
            }
            $this->dataPersistor->set('user_persist', $params);
            $redirectParams = ($id) ? ['id' => $id] : [];

            return $resultRedirect->setPath('*/*/edit', $redirectParams);
        }

        return $resultRedirect->setPath('*/*/index');
    }
}