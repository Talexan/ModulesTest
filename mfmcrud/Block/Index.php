<?php
    namespace Talexan\MFMCrud\Block;

    use \Magento\Framework\View\Element\Template;
    use \Magento\Framework\View\Element\Template\Context;

    class Index extends Template
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

        public function __construct(Context $context, \Talexan\MFMCrud\Model\UserFactory $userFactory)
        {
            $this->_userFactory=$userFactory;
            parent::__construct($context);
        }

        public function getCollection()
        {
            return $this->_userFactory->create()->getCollection();
        }
    }

?>