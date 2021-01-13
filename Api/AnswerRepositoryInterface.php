<?php
namespace AHT\Question\Api;

interface AnswerRepositoryInterface
{

    public function getList();

    // public function getId($questionId);

 
    public function save(\AHT\Question\Api\Data\AnswerInterface $answer);
}