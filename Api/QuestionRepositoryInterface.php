<?php

namespace AHT\Question\Api;

interface QuestionRepositoryInterface
{
    public function getList();
    public function get($QuestionId);
    public function save(\AHT\Question\Api\Data\QuestionInterface $Question);
}
