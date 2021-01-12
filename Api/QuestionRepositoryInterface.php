<?php

namespace AHT\Question\Api;

interface QuestionRepositoryInterface
{
    /**
     * function get all data
     *
     * @return \AHT\Question\Api\Data\QuestionInterface
     */
    public function getList();

    /**
     * function delete data
     *
     * @return \AHT\Question\Api\Data\QuestionInterface
     */
    public function deleteById($question_id);

    /**
     * function delete data
     *
     * @return \AHT\Question\Api\Data\QuestionInterface
     */

    public function delete($question);

    // public function getId($questionId);

    /**
     * Undocumented function
     *
     * @param \AHT\Question\Api\Data\QuestionInterface $Post
     * @return \AHT\Question\Api\Data\QuestionInterface
     */
    public function save(\AHT\Question\Api\Data\QuestionInterface $question);
}
