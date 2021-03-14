<?php

namespace Talexan\UsersList\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Users
 *
 * @package Talexan\UsersList\Model\ResourceModel
 */
class Users extends AbstractDb
{
    /**
     * Class construct.
     */
    protected function _construct()
    {
        $this->_init(/*string $mainTable*/  'talexan_userslist_table', 
                     /*string $idFieldName*/'id');
    }
}