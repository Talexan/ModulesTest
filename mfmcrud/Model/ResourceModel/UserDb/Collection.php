<?php
    namespace Talexan\MFMCrud\Model\ResourceModel\UserDb;

    use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
    
    class Collection extends AbstractCollection
    {
        /* It allows to filter and fetches the data from 
           the table in collection format.                 */

        protected function _construct(/* Initialization here @return void */)
        {
            $this->_init(/* Standard resource collection initialization
                          * @param string $model
                          * @param string $resourceModel
                          * @return $this */
                          \Talexan\MFMCrud\Model\User::class, \Talexan\MFMCrud\Model\ResourceModel\UserDb::class);
        }
    }
?>