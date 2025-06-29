<?php
namespace DBTalker\Connector\Model;

use DBTalker\Connector\Api\QueryManagementInterface;
use Magento\Framework\App\ResourceConnection;

use Psr\Log\LoggerInterface;

class DbTalker implements QueryManagementInterface
{
    protected $resource;
    protected $logger;

    public function __construct(
        ResourceConnection $resource,
        LoggerInterface $logger
    ) {
        $this->resource = $resource;
        $this->logger = $logger;
    }

    public function executeQuery(\DBTalker\Connector\Api\Data\QueryRequestInterface $queryRequest)
    {
        $api_key = $queryRequest->getApiKey();
        $query = $queryRequest->getQuery();

        $this->writeLog('API called ===============================');
        $this->writeLog('Full Request: ' . json_encode($queryRequest));


        $this->writeLog('DBTalker API Called - API Key: ' . $api_key . ' | Query: ' . $query);

        // Validate API Key
        if (!$this->validateApiKey($api_key)) {
            return ['success' => false, 'message' => 'Invalid API Key'];
        }

        // Block dangerous queries safely
        if (empty($query) || !preg_match('/^\s*SELECT/i', $query)) {
            return ['success' => false, 'message' => 'Only SELECT queries are allowed'];
        }

        try {
            $connection = $this->resource->getConnection();
            $results = $connection->fetchAll($query);
            $this->writeLog('SQL Query Response ===============================');
            $this->writeLog('DBTalker API Resule - Query: ' . json_encode($results));
            return ['success' => true, 'data' => $results];
        } catch (\Exception $e) {
            $this->logger->error('Query Execution Error', ['error' => $e->getMessage()]);
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    private function validateApiKey($api_key)
    {
        return true;
    }

    /**
     * Direct file logger
     */
    private function writeLog($message)
    {
        $logFile = BP . '/var/log/dbtalker.log'; // BP is Magento base path
        $date = date('Y-m-d H:i:s');
        file_put_contents($logFile, '[' . $date . '] ' . $message . PHP_EOL, FILE_APPEND);
    }
}
