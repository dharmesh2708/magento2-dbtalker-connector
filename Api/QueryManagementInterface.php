<?php
/**
 * DBTalker Magento 2 Extension
 *
 * @category   DBTalker
 * @package    DBTalker_Connector
 */
namespace DBTalker\Connector\Api;

/**
 * Interface for query execution operations
 * @api
 */
interface QueryManagementInterface
{
    /**
     * @param \DBTalker\Connector\Api\Data\QueryRequestInterface $queryRequest
     * @return array
     */
    public function executeQuery(\DBTalker\Connector\Api\Data\QueryRequestInterface $queryRequest);

}