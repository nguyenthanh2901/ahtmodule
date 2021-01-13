<?php
namespace AHT\Question\Model\ResourceModel\Answer;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'answer_id';
    protected $_eventPrefix = 'aht_question_answer_collection';
    protected $_eventObject = 'answer_collection';

    /**
     * Define the resource model & the model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('AHT\Question\Model\Answer', 'AHT\Question\Model\ResourceModel\Answer');
    }
}
