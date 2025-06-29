<?php
/**
 * DBTalker Magento 2 Extension
 *
 * @category   DBTalker
 * @package    DBTalker_Connector
 */
namespace DBTalker\Connector\Api\Data;

/**
 * Interface for query response data
 * @api
 */
interface QueryResponseInterface
{
    /**
     * Set results
     *
     * @param \DBTalker\Connector\Api\Data\QueryResultItemInterface[] $results
     * @return $this
     */
    public function setResults(array $results);

    /**
     * Get results
     *
     * @return \DBTalker\Connector\Api\Data\QueryResultItemInterface[]
     */
    public function getResults();

    /**
     * Set execution time
     *
     * @param float $time
     * @return $this
     */
    public function setExecutionTime($time);

    /**
     * Get execution time
     *
     * @return float
     */
    public function getExecutionTime();

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