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

    /**
     * function get all data
     *
     * @return \AHT\Question\Api\Data\QuestionInterface
     */
    public function getList()
    {
        $collection = $this->_questionFactory->create()->getCollection();
        return $collection->getData();
    }

    /**
     * function delete data
     *
     * @return \AHT\Question\Api\Data\QuestionInterface
     */
    // public function delete(QuestionInterface $question)
    // {
    //     $questionFactory = $this->_questionFactory->create()->setData($question);
    //     try {
    //         return $this->_questionResource->delete($questionFactory);
    //     } catch (\Exception $e) {
    //         return "Failure: " . $e->getMessage();
    //     }
    // }


    /**
     * function delete data
     *
     * @return \AHT\Question\Api\Data\QuestionInterface
     */
    public function deleteById($question_id)
    {
        try {
            echo 'hi';
            $question = $this->getId($question_id);
            if (!empty($question)) {
                $this->_questionResource->delete($question);
                return ['success' => true, 'message' => 'Success deleted question.'];
            } else throw new \Exception("Unable to delete question with id: $question_id.");
        } catch (\Exception $e) {
            return "Failure: " . $e->getMessage();
        }
    }

    /**
     * Undocumented function
     *
     * @param \AHT\Question\Api\Data\QuestionInterface $Post
     * @return \AHT\Question\Api\Data\QuestionInterface
     */

    public function save(QuestionInterface $question)
    {
        try {
            $this->_questionResource->save($question);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __('Could not save the Post: %1', $exception->getMessage()),
                $exception
            );
        }
        return $question->getData();
    }

    // public function getId($questionId)
    // {
    //     $id = (int) $questionId;
    //     $model = $this->_questionFactory->create();
    //     $this->_questionResource->load($model, $id);
    //     return $model->getData();
    // }
}
