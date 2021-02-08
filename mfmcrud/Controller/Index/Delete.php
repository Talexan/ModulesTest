<?php

    namespace Talexan\Mfmcrud\Controller\Index;


    class Delete extends \Magento\Framework\App\Action\Action
    {
        /*Extend from this class to create actions controllers 
          in frontend area of your application. It contains 
          standard action behavior (event dispatching, flag
          checks) Action classes that do not extend from this
          class will lose this behavior and might not function
          correctly                                             */
          
        public function __construct(\Magento\Framework\App\Action\Context $context, 
                                    \Talexan\MFMCrud\Model\UserFactory $userFactory)
        {
            $this->_context=$context;
            $this->_userFactory=$userFactory; // result controller?

            parent::__construct($context);
        }

        public function execute() 
        {               
               $id= $this->getRequest()->getParam(/* Retrieve param by key
                                                    * @param string $key
                                                    * @param mixed $defaultValue
                                                    * @return mixed          */
                                                    'id');
               $user = $this->_userFactory->create();

               $result = $user->setId($id); // __call(method, args)
               $result = $result->delete();
          
               return $this->_redirect('testcrud/index/index');
        }

    }

?>