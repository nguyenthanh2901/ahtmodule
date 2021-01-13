<?php
namespace AHT\Question\Model;

use AHT\Question\Api\Data\AnswerInterface;
use AHT\Question\Model\ResourceModel\Answer;

class AnswerRepository implements \AHT\Question\Api\AnswerRepositoryInterface
{
    protected $_answerFactory;
    protected $_answerResource;
    protected $_request;
    public function __construct(
        AnswerFactory $answerFactory,
        Answer $answerResource,
        \Magento\Framework\App\RequestInterface $request
    ) {
        $this->_answerFactory = $answerFactory;
        $this->_answerResource = $answerResource;
        $this->_request = $request;
    }

    /**
     * function get all data
     *
     * @return \AHT\Question\Api\Data\QuestionInterface
     */
    public function getList()
    {
        $collection = $this->_answerFactory->create()->getCollection();
        return $collection->getData();
    }

    /**
     * Undocumented function
     *
     * @param \AHT\Question\Api\Data\QuestionInterface $Post
     * @return \AHT\Question\Api\Data\QuestionInterface
     */

    public function save(AnswerInterface $answer)
    {
        try {
            $this->_answerResource->save($answer);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __('Could not save the Post: %1', $exception->getMessage()),
                $exception
            );
        }
        return $answer->getData();
    }
}
