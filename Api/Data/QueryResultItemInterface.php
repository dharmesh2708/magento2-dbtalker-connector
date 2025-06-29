<?php
namespace DBTalker\Connector\Api\Data;

interface QueryResultItemInterface
{
    /**
     * Get data as key-value array
     *
     * @return array
     */
    public function getData();

    /**
     * Set data as key-value array
     *
     * @param array $data
     * @return $this
     */
    public function setData(array $data);
}
