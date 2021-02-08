<?php

    namespace Talexan\MFMCrud\Controller\Index;


    class Save extends \Magento\Framework\App\Action\Action
    {
        /*Extend from this class to create actions controllers 
          in frontend area of your application. It contains 
          standard action behavior (event dispatching, flag
          checks) Action classes that do not extend from this
          class will lose this behavior and might not function
          correctly                                             */
          
          const NAME_EDIT_ACTION = 'testcrud/index/edit';
          const NAME_INSERT_ACTION = 'testcrud/index/insert';
          const NAME_INDEX_ACTION = 'testcrud/index/index';

        protected $_userFactory;
        protected $_dataTransfer;
        protected $_query;
        
        public function __construct(\Magento\Framework\App\Action\Context $context, 
                                    \Talexan\MFMCrud\Model\UserFactory $userFactory,
                                    \Magento\Framework\Registry $dataTransfer,
                                    \Magento\Framework\App\Request\Http $query)
        {
            $this->_context=$context;
            $this->_userFactory=$userFactory; // result controller?
            $this->_dataTransfer=$dataTransfer; //registry?
            $this->_query=$query;

            parent::__construct($context);
        }

        public function execute() 
        {             
               
               $refererUrl=$this->_redirect->getRefererUrl(/*Identify referer url via all accepted methods 
                                                            (HTTP_REFERER, regular or base64-encoded request 
                                                            param) @return string */);

               if (!empty($refererUrl))
               {
                     //$input = $this->_query->getParams();
                     $input = $this->getRequest()->getParams();
                     $user = $this->_userFactory->create();

                     if (stristr($refererUrl, self::NAME_EDIT_ACTION))
                     {
                         // redirect from edit controller
                           $user->setData($input)->save();
                     }
                     elseif (stristr($refererUrl, self::NAME_INSERT_ACTION)){
                         // redirect from insert controller
                        $user->addData($input)->save();
                     }
               }
                                                 
               return $this->_redirect(self::NAME_INDEX_ACTION);
        }

    }

?>