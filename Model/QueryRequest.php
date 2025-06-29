<?php
namespace DBTalker\Connector\Model;

use DBTalker\Connector\Api\Data\QueryRequestInterface;

class QueryRequest implements QueryRequestInterface
{
    protected $apiKey;
    protected $query;

    public function getApiKey()
    {
        return $this->apiKey;
    }

    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
        return $this;
    }

    public function getQuery()
    {
        return $this->query;
    }

    public function setQuery($query)
    {
        $this->query = $query;
        return $this;
    }
}
