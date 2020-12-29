<?php
namespace AHT\Question\Model;

class Question extends \Magento\Framework\Model\AbstractModel implements \AHT\Question\Api\Data\QuestionInterface
{

    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource=null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection=null,
        array $data = []
    ) {
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }
    /**
     * @return void
     */
    
	public function _construct()
	{
		$this->_init('AHT\Question\Model\ResourceModel\Question');
    }
    /**
     * Undocumented function
     *
     * @return string
     */
    public function getName() {
        return $this->getData("name");
    }
    /**
     * Undocumented function
     *
     * @return string
     */
    public function getEmail() {
        return $this->getData("email");
    }
    /**
     * Undocumented function
     *
     * @return string
     */
    public function getQuestion() {
        return $this->getData("question");
    }
    
    public function getAnswer() {
        return $this->getData("answer");
    }
   
    public function getCreatedAt() {
        return $this->getData("created_at");
    }
    
    public function getUpdatedAt() {
        return $this->getData("updated_at");
    }
    
 
    public function getQuestionId() {
        return $this->getData("question_id");

    }
   
    public function getStoreId() {
        return $this->getData("store_id");

    }
   
    public function getProductId() {
        return $this->getData("product_id");
    }
   
    public function getUserId() {
        return $this->getData("user_id");
    }
    
    public function setName($name) {
        return $this->setData("name", $name);
    }
    
    public function setEmail($email) {
        return $this->setData("email", $email);
    }

    public function setProductId($productId) {
        return $this->setData("product_id", $productId);
    }  
    
    public function setQuestion($question) {
        return $this->setData("question", $question);

    }
   
    public function setAnswer($answer) {
        return $this->setData("answer", $answer);
    }
}