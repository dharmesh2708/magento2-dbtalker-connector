<?php
namespace DBTalker\Connector\Model;

use DBTalker\Connector\Api\Data\QueryResponseInterface;

class QueryResponse implements QueryResponseInterface
{
    private $success;
    private $results = [];
    private $executionTime;
    private $errorMessage;

    public function setResults(array $results)
    {
        $this->results = $results;
        return $this;
    }

    public function getResults()
    {
        return $this->results;
    }

    public function setExecutionTime($time)
    {
        $this->executionTime = $time;
        return $this;
    }

    public function getExecutionTime()
    {
        return $this->executionTime;
    }

    public function setSuccess($success)
    {
        $this->success = $success;
        return $this;
    }

    public function getSuccess()
    {
        return $this->success;
    }

    public function setErrorMessage($message)
    {
        $this->errorMessage = $message;
        return $this;
    }

    public function getErrorMessage()
    {
        return $this->errorMessage;
    }
}