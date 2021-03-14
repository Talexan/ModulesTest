<?php

namespace Talexan\UsersList\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\Result\JsonFactory;
use Talexan\UsersList\Model\UsersListingFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotSaveException;

/**
 * Class InlineEdit
 *
 * @package Talexan\UsersList\Controller\Adminhtml\Index
 */
class InlineEdit extends Action
{
    /**
     * @var JsonFactory
     */
    protected $jsonFactory;

    /**
     * @var UsersListingFactory
     */
    protected $usersListingFactory;

    /**
     * InlineEdit constructor.
     *
     * @param Action\Context $context
     * @param JsonFactory $jsonFactory
     * @param UsersListingFactory $usersListingFactory
     */
    public function __construct(
        Action\Context $context,
        JsonFactory $jsonFactory,
        UsersListingFactory $usersListingFactory) {
        $this->jsonFactory = $jsonFactory;
        $this->usersListingFactory = $usersListingFactory;
        
        parent::__construct($context);
    }

    public function execute()
    {
        $resultJson = $this->jsonFactory->create();
        $params = $this->getRequest()->getParam('items', []);

        if (!($this->getRequest()->getParam('isAjax') && count($params))) {
            return $resultJson->setData([
                'messages' => [__('Please correct the data sent.')],
                'error'    => true,
            ]);
        }
 
        foreach ($params as $item) {
            $model = $this->getUserById($item['id']);
            
            try {
                $model->setData($item)->save();
            } 
            catch (\Exception $exception) {
                throw new CouldNotSaveException(__($exception->getMessage()));
            }
        }

        return $resultJson->setData([
            'messages' => [__('Saved')],
            'error'    => false,
        ]);
    }

    /**
     * @param $userId
     * @return UsersListing|mixed
     * @throws NoSuchEntityException
     */
    public function getUserById($userId)
    {
        $user = $this->usersListingFactory->create();
        $user->load($userId);
        if (!$user->getId()) {
            throw new NoSuchEntityException(__('User with id "%1" does not exist.', $userId));
        }

        return $user;
    }
}