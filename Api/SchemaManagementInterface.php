<?php
/**
 * DBTalker Magento 2 Extension
 *
 * @category   DBTalker
 * @package    DBTalker_Connector
 */
namespace DBTalker\Connector\Api;

/**
 * Interface for schema management operations
 * @api
 */
interface SchemaManagementInterface
{
    /**
     * Get database schema
     *
     * @return \DBTalker\Connector\Api\Data\SchemaResponseInterface
     */
    public function getSchema();
    
    /**
     * Sync database schema with DBTalker
     *
     * @return bool
     */
    public function syncSchema();
}