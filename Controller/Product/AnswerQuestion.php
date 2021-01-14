<?php
namespace AHT\Question\Controller\Product;
use Magento\Framework\Controller\Result\JsonFactory;

class AnswerQuestion extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;
    protected $_answerFactory;
    protected $_answerResource;
    protected $_coreRegistry;
    protected $resultRedirect;
    protected $urlInterface;
    protected $_redirect;
    protected $_customerSession;
    protected $_storeManager;
    protected $messageManager;
    protected $resultJsonFactory; 


    private $_cacheTypeList;
    private $_cacheFrontendPool;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \AHT\Question\Model\AnswerFactory $answerFactory,
        \AHT\Question\Model\ResourceModel\Answer $answerResource,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\Controller\ResultFactory $result,
        \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList,
        \Magento\Framework\App\Cache\Frontend\Pool $cacheFrontendPool,
        \Magento\Framework\App\Response\RedirectInterface $resultRedirect,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        JsonFactory $resultJsonFactory
        
    ) {
        $this->resultJsonFactory = $resultJsonFactory; 
        $this->_customerSession = $customerSession;
        $this->_storeManager = $storeManager;
        $this->_pageFactory = $pageFactory;
        $this->_answerFactory = $answerFactory;
        $this->_answerResource = $answerResource;
        $this->_coreRegistry = $coreRegistry;
        $this->resultRedirect = $result;
        $this->_cacheTypeList = $cacheTypeList;
        $this->_cacheFrontendPool = $cacheFrontendPool;
        $this->_redirect = $resultRedirect;
        $this->messageManager = $context->getMessageManager();

        return parent::__construct($context);
    }

    public function execute()
    {
        $answer = $this->_answerFactory->create();
        try {
            if (isset($_POST['question_id'])) {
             
                $answer->setQuestionId($this->getRequest()->getParam("question_id"));
                $answer->setAnswer($this->getRequest()->getParam("answer"));
                $answer->setUserName($this->getRequest()->getParam("user_name"));
            }
            // echo 'test';die;
            $this->_answerResource->save($answer);
            $this->messageManager->addSuccessMessage("Your answer has been saved");
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage("Something went wrong.");
        }

        $types = ['config','layout','block_html','collections','reflection','db_ddl','compiled_config','eav','config_integration','config_integration_api','full_page','translate','config_webservice','vertex'];
        foreach ($types as $type) {
            $this->_cacheTypeList->cleanType($type);
        }
        foreach ($this->_cacheFrontendPool as $cacheFrontend) {
            $cacheFrontend->getBackend()->clean();
        }

        $result = $this->resultJsonFactory->create();
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath($this->_redirect->getRefererUrl());
        return $resultRedirect;
    }
}
