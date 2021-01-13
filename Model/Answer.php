<?php
namespace AHT\Question\Model;

class Answer extends \Magento\Framework\Model\AbstractModel implements \AHT\Question\Api\Data\AnswerInterface
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
        $this->_init('AHT\Question\Model\ResourceModel\Answer');
    }

    public function getAnswerId()
    {
        return $this->getData("answer_id");
    }

    public function setAnswerId($answerId)
    {
        return $this->setData("answer_id", $answerId);
    }

    public function getQuestionId()
    {
        return $this->getData("question_id");
    }

    public function setQuestionId($questionId)
    {
        return $this->setData("question_id", $questionId);
    }

    public function getAnswer()
    {
        return $this->getData("answer_customer");
    }

    public function setAnswer($answer)
    {
        return $this->setData("answer_customer", $answer);
    }

    public function getUserName()
    {
        return $this->getData("user_name");
    }

    public function setUserName($userName)
    {
        return $this->setData("user_name", $userName);
    }
}
