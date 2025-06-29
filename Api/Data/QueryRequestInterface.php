<?php
namespace DBTalker\Connector\Api\Data;

interface QueryRequestInterface
{
    /**
     * @return string
     */
    public function getApiKey();

    /**
     * @param string $apiKey
     * @return void
     */
    public function setApiKey($apiKey);

    /**
     * @return string
     */
    public function getQuery();

    /**
     * @param string $query
     * @return void
     */
    public function setQuery($query);
}
