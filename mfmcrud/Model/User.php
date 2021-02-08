<?php

    namespace Talexan\MFMCrud\Model;

    use \Magento\Framework\Model\AbstractModel;
    use \Magento\Framework\DataObject\IdentityInterface;

    class User extends AbstractModel implements IdentityInterface
    {
        // Model's class
        /* Also, iminterface for
            1. models which require cache refresh when it is created/updated/deleted - i. e. crud?
            2. blocks which render this information to front-end                    */

        const CACHE_TAG = 'talexan_mfmcrud_user';

        protected function _construct(/* Model construct that should be used for object initialization 
                                       @return void   */)
        {
            $this->_init(/* Standard model initialization
                            @param string $resourceModel
                            @return void   */
                            \Talexan\MFMCrud\Model\ResourceModel\UserDb::class);
        }

        public function getIdentities( /* Return unique ID(s) for each object in system
                                          @return string[]   */)
        {   // Implements IdentityInterface

            return [self::CACHE_TAG . '_' . $this->getId(/* get data id */)];
        }

        public function getDefaultValues(/* Why ??? */)
	    {
		    $values = [];

		    return $values;
	    }
    }
?>