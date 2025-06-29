<?php
namespace DBTalker\Connector\Model;

use DBTalker\Connector\Api\Data\QueryResultItemInterface;

class QueryResultItem implements QueryResultItemInterface
{
    protected $data = [];

    public function getData()
    {
        return $this->data;
    }

    public function setData(array $data)
    {
        $this->data = $data;
        return $this;
    }
}
