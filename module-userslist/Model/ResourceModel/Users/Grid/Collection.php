<?php

namespace Talexan\UsersList\Model\ResourceModel\Users\Grid;

use Talexan\UsersList\Model\ResourceModel\Users\Collection as UsersCollection;
//use Magento\Framework\Search\AggregationInterface;
use Magento\Framework\Api\Search\SearchResultInterface;
use Magento\Framework\View\Element\UiComponent\DataProvider\Document;
use Talexan\UsersList\Model\ResourceModel\Users as UsersResource;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Class Collection
 * Note that the collection must implement the 
 * Magento\Framework\Api\Search\SearchResultInterface interface
 * and extend your original collection (in fact, 
 * this makes working with the data easier and 
 * you don't have to implement many other methods). 
 * All methods and properties except for _construct 
 * can be copied from Magento\Cms\Model\ResourceModel\
 * Block\Grid\Collection, you won't need them anymore.
 * The _construct method is special. You must make 
 * the collection use the Magento\Framework\View\
 * Element\UiComponent\DataProvider\Document object 
 * as a model and your model resource as a model 
 * resource for communicating with the database.
 *
 * @package Talexan\UsersList\Model\ResourceModel\Users\Grid
 */
class Collection extends UsersCollection implements SearchResultInterface
{
    /**
     * @var $aggregations
     */
    protected $_aggregations;
    
    /**
     * Class construct.
     */
    protected function _construct()
    {
        $this->_init(Document::class, UsersResource::class);
    }
    
    /**
     * @return \Magento\Framework\Api\Search\AggregationInterface
     */
    public function getAggregations()
    {
        return $this->_aggregations;
    }

    /**
     * @param \Magento\Framework\Api\Search\AggregationInterface $aggregations
     * @return $this|void
     */
    public function setAggregations($aggregations)
    {
        $this->_aggregations = $aggregations;
    }

    /**
     * @param null $limit
     * @param null $offset
     * @return array
     */
    public function getAllIds($limit = null, $offset = null)
    {
        return $this->getConnection()->fetchCol($this->_getAllIdsSelect($limit, $offset), $this->_bindParams);
    }

    /**
     * @return \Magento\Framework\Api\Search\SearchCriteriaInterface|null
     */
    public function getSearchCriteria()
    {
        return null;
    }

    /**
     * @param SearchCriteriaInterface|null $searchCriteria
     * @return $this
     */
    public function setSearchCriteria(SearchCriteriaInterface $searchCriteria = null)
    {
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalCount()
    {
        return $this->getSize();
    }

    /**
     * @param int $totalCount
     * @return $this
     */
    public function setTotalCount($totalCount)
    {
        return $this;
    }

    /**
     * @param array|null $items
     * @return $this
     */
    public function setItems(array $items = null)
    {
        return $this;
    }
}