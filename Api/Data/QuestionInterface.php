<?php
namespace AHT\Question\Api\Data;

interface QuestionInterface
{
    public function getName();

    public function getEmail();

    public function getQuestion();

    public function getProductId();

    public function getAnswer();

    public function getCreatedAt();

    public function getUpdatedAt();

    public function getQuestionId();

    public function setName($name);

    public function setEmail($email);

    public function setQuestion($question);

    public function setAnswer($answer);

    public function setProductId($productId);
}
