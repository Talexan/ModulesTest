<?php
    namespace Talexan\MFMCrud\Block;

    use \Magento\Framework\View\Element\Template;
    use \Magento\Framework\View\Element\Template\Context;

    class Edit extends Template
    {
        /* Standard Magento block.
         * Should be used when you declare a block in frontend area layout handle.
         * Avoid extending this class.
         * If you need custom presentation logic in your blocks, use this class as block, and declare
         * custom view models in block arguments in layout handle file.
         * Example:
         * <block name="my.block" class="Magento\Backend\Block\Template" template="My_Module::template.phtml" >
         *      <arguments>
         *          <argument name="viewModel" xsi:type="object">My\Module\ViewModel\Custom</argument>
         *      </arguments>
         * </block>         */

         protected $_userFactory;

        public function __construct(Context $context, \Talexan\MFMCrud\Model\UserFactory $userFactory,
                                    \Magento\Framework\Registry $dataTransfer)
        {
            $this->_userFactory=$userFactory;
            $this->_dataTransferFromAction=$dataTransfer;
            parent::__construct($context);
        }

        public function getCollection()
        {
            return $this->_userFactory->create()->getCollection();
        }

        public function getEditRecord()
        {
            $id=$this->_dataTransferFromAction->registry('idEditRecord');
            
            $user=$this->_userFactory->create();
            $user->load(/* Load object data
                         * @param integer $modelId
                         * @param null|string $field
                         * @return $this
                         * @deprecated 100.1.0 because entities must not be responsible for their own loading.
                         * Service contracts should persist entities. Use resource model "load" or collections to implement
                         * service contract model loading operations.
                         */
                        $id);
           
            return $user->getData(/* Object data getter
                                     If $key is not defined will return all the data as an array.   */);                
        }
        
    }

?>