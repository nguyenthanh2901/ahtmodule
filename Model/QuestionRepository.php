<?php
namespace AHT\Question\Model;

use AHT\Question\Api\Data\QuestionInterface;
use AHT\Question\Model\ResourceModel\Question;

class QuestionRepository implements \AHT\Question\Api\QuestionRepositoryInterface
{
    protected $_questionFactory;
    protected $_questionResource;
    protected $_request;
    public function __construct(
        QuestionFactory $questionFactory,
        Question $questionResource,
        \Magento\Framework\App\RequestInterface $request
    ) {
        $this->_questionFactory = $questionFactory;
        $this->_questionResource = $questionResource;
        $this->_request = $request;
    }

    public function getId($questionId)
    {
        $id = (int) $questionId;
        $model = $this->_questionFactory->create();
        $this->_questionResource->load($model, $id);
        return $model->getData();
    }

    public function getList()
    {
        $collection = $this->_questionFactory->create()->getCollection();
        return $collection->getData();
    }

    public function save(QuestionInterface $question)
    {
        $this->_questionResource->save($question);
        return $question->getData();
    }
}
