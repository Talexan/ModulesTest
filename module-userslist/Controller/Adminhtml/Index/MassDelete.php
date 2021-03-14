<?php

namespace Talexan\UsersList\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Ui\Component\MassAction\Filter;
use Talexan\UsersList\Model\ResourceModel\Users\CollectionFactory;
use Talexan\UsersList\Model\UsersListingFactory;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class MassDelete
 *
 * @package Talexan\UsersList\Controller\Adminhtml\Index
 */
class MassDelete extends Action
{
    /**
     * @var Filter
     */
    private $filter;

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * @var UsersListing
     */
    private $usersListing;

    /**
     * MassDelete constructor.
     *
     * @param Action\Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     * @param UsersListing $usersListing
     */
    public function __construct(
        Action\Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        UsersListingFactory $usersListingFactory
    ) {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->usersListing=$usersListingFactory->create();
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     * @throws LocalizedException
     */
    public function execute()
    {
        $collection = $this->filter->getCollection(/* Adds filters to collection using DataProvider filter results
                                                                      AbstractDb $collection*/$this->collectionFactory->create());
        $collectionSize = $collection->getSize();
        
        try {
            $this->massDeleteByUserIds($collection->getAllIds());
            $this->messageManager->addSuccessMessage(__('A total of %1 element(s) have been deleted.', (int)$collectionSize));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('Error while trying to delete item(s).'));
        }
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        return $resultRedirect->setPath('*/*/index');
    }

    /**
     * @param array $userIds
     * @return mixed|void
     * @throws CouldNotDeleteException
     */
    protected function massDeleteByUserIds(array $userIds)
    {
        foreach ($userIds as $userId) {
            try {
                $this->deleteByUserId($userId);
            } catch (NoSuchEntityException $e) {
                continue; 
            }
        }
    }

     /**
     * @param $userId
     * @return bool|mixed
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    protected function deleteByUserId($userId)
    {
        return $this->delete($this->hasUserId($userId));   
    }

    /**
     * @param $userId
     * @return UserList|mixed
     * @throws NoSuchEntityException
     */
    protected function hasUserId($userId)
    {
        $this->usersListing->load($userId);
        if (!$this->usersListing->getId()) {
            throw new NoSuchEntityException(__('User with id "%1" does not exist.', $userId));
        }

        return $userId;
    }

    /**
     * @param $userId
     * @return bool|mixed
     * @throws CouldNotDeleteException
     */
    protected function delete($userId)
    {
        $result=false;
        try {
            $this->usersListing->setId($userId)->delete();
            $result=true;    
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }

        return $result;
    }
}