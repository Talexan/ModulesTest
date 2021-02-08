<?php

    namespace Talexan\Mfmcrud\Controller\Index;


    class Insert extends \Magento\Framework\App\Action\Action
    {
        /*Extend from this class to create actions controllers 
          in frontend area of your application. It contains 
          standard action behavior (event dispatching, flag
          checks) Action classes that do not extend from this
          class will lose this behavior and might not function
          correctly                                             */
        public function __construct(\Magento\Framework\App\Action\Context $context, 
                                    \Magento\Framework\View\Result\PageFactory $pageFactory)
        {
            $this->_context=$context;
            $this->_pageFactory=$pageFactory; // result controller?

            parent::__construct($context);
        }

        public function execute() 
        {   // Create object view

            /* A factory that knows how to create a "page" result Requires an 
               instance of controller action in order to impose page type, 
               which is by convention is determined from the controller action class */
            
            return $this->_pageFactory->create(/*Create new page regarding its type
            * TODO: As argument has to be controller action interface, temporary solution until controller output models
            * TODO: are not implemented */);
        }

    }

?>