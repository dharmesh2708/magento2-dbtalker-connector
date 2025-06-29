<?php
/**
 * DBTalker Magento 2 Extension
 *
 * @category   DBTalker
 * @package    DBTalker_Connector
 */
namespace DBTalker\Connector\Api\Data;

/**
 * Interface for schema response data
 * @api
 */
interface SchemaResponseInterface
{
    /**
     * Set tables
     *
     * @param array $tables
     * @return $this
     */
    public function setTables(array $tables);

    /**
     * Get tables
     *
     * @return array
     */
    public function getTables();

    /**
     * Set success status
     *
     * @param bool $success
     * @return $this
     */
    public function setSuccess($success);

    /**
     * Get success status
     *
     * @return bool
     */
    public function getSuccess();

    /**
     * Set error message
     *
     * @param string|null $message
     * @return $this
     */
    public function setErrorMessage($message);

    /**
     * Get error message
     *
     * @return string|null
     */
    public function getErrorMessage();
}