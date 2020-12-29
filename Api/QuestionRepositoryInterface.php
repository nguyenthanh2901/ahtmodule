<?php

namespace AHT\Question\Api;

interface QuestionRepositoryInterface
{
    public function getList();
    public function getId($questionId);
    public function save(\AHT\Question\Api\Data\QuestionInterface $question);
}
