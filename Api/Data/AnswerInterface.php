<?php
namespace AHT\Question\Api\Data;

interface AnswerInterface
{
     /**
    * Get post name
    *
    * @return string|null
    */

    public function getAnswerId();

    public function setAnswerId($answerId);

    public function getQuestionId();

    public function setQuestionId($questionId);

    public function getAnswer();

    public function setAnswer($answer);

    public function getUserName();

    public function setUserName($userName);
}
