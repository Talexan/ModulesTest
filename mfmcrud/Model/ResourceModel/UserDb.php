<?php

namespace Talexan\MFMCrud\Model\ResourceModel;

    use \Magento\Framework\Model\ResourceModel\Db\AbstractDb;

    class UserDb extends AbstractDb
    {
        /* Resource models executes the SQL queries. 
           Define the resource model in the ResourceModel 
           directory in the Model folder.               */

        protected function _construct(/*Required - abstract protected Resource initialization @return void */ )
        {
            $this->_init(/* Standard resource model initialization
                          * @param string $mainTable
                          * @param string $idFieldName
                          * @return void     */
                          'talexan_mfmcrud_test', 'id');
        }
    }

?>