<?php

    namespace Talexan\Mfmcrud\Controller\Index;


    class Edit extends \Magento\Framework\App\Action\Action
    {
        /*Extend from this class to create actions controllers 
          in frontend area of your application. It contains 
          standard action behavior (event dispatching, flag
          checks) Action classes that do not extend from this
          class will lose this behavior and might not function
          correctly                                             */
          
        public function __construct(\Magento\Framework\App\Action\Context $context, 
                                    \Magento\Framework\View\Result\PageFactory $pageFactory,
                                    \Magento\Framework\Registry $dataTransfer)
        {
            $this->_context=$context;
            $this->_pageFactory=$pageFactory; // result controller?
            $this->_dataTransfer=$dataTransfer;


            parent::__construct($context);
        }

        public function execute() 
        {   // Create object view

            /* A factory that knows how to create a "page" result Requires an 
               instance of controller action in order to impose page type, 
               which is by convention is determined from the controller action class */
            
               $id=$this->getRequest()->getParam('id');
               $this->_dataTransfer->register('idEditRecord', $id);

               $block=$this->_view->getLayout(/* Retrieve current layout object
                                                * @return \Magento\Framework\View\LayoutInterface
                                                */)->getBlock(/* Get block object by name
                                                            * @param string $name
                                                            * @return Element\BlockInterface|bool */
                                                            'testcrud_index_edit');

            return $this->_pageFactory->create(/*Create new page regarding its type
            * TODO: As argument has to be controller action interface, temporary solution until controller output models
            * TODO: are not implemented */);
        }

    }

?>