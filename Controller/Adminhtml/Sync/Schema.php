<?php
namespace DBTalker\Connector\Controller\Adminhtml\Sync;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Config\Storage\WriterInterface;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\HTTP\Client\Curl;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\Encryption\EncryptorInterface;

class Schema extends Action
{
    protected $resultRedirectFactory;
    protected $messageManager;
    protected $resourceConnection;
    protected $curl;
    protected $scopeConfig;
    protected $encryptor;
    protected $configWriter;

    protected $nodeApiUrl = 'http://localhost:3000/api/sync-schema';

    public function __construct(
        Context $context,
        ResourceConnection $resourceConnection,
        Curl $curl,
        ScopeConfigInterface $scopeConfig,
        WriterInterface $configWriter,
        EncryptorInterface $encryptor
    ) {
        parent::__construct($context);
        $this->resultRedirectFactory = $context->getResultRedirectFactory();
        $this->messageManager = $context->getMessageManager();
        $this->resourceConnection = $resourceConnection;
        $this->curl = $curl;
        $this->scopeConfig = $scopeConfig;
        $this->configWriter = $configWriter;
        $this->encryptor = $encryptor;
    }

    public function execute()
    {
        try {
            $encryptedToken = $this->scopeConfig->getValue('dbtalker/general/api_key', ScopeInterface::SCOPE_STORE);
            $authToken = $this->encryptor->decrypt($encryptedToken);
            
            if (empty($authToken)) {
                $this->messageManager->addErrorMessage(__('Authorization token is missing in configuration.'));
                return $this->resultRedirectFactory->create()->setPath('adminhtml/system_config/edit/section/dbtalker');
            }

            $connection = $this->resourceConnection->getConnection();
            $tables = $connection->getTables();

            $schemaData = [];

            foreach ($tables as $table) {
                $describe = $connection->describeTable($table);
                $columns = array_keys($describe);

                $schemaData[] = [
                    'table' => $table,
                    'columns' => $columns
                ];
            }

            $this->curl->addHeader("Content-Type", "application/json");
            $this->curl->addHeader("Authorization", "Bearer " . $authToken);

            $this->curl->post($this->nodeApiUrl, json_encode([
                'schema' => $schemaData,
                'platformApiKey' => $authToken
            ]));

            $response = $this->curl->getBody();
            $httpStatus = $this->curl->getStatus();

            if ($httpStatus == 200) {
                // 🔥 Update last sync timestamp in system config
                $currentTime = date('Y-m-d H:i:s'); // You can use gmdate if you prefer UTC
                $this->configWriter->save('dbtalker/general/last_sync', $currentTime);

                $this->messageManager->addSuccessMessage(__('Schema synchronized successfully with DBTalker platform. Last sync: %1', $currentTime));
            } else {
                $this->messageManager->addErrorMessage(__('Schema sync failed. Node.js API returned HTTP %1.', $httpStatus));
            }

        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('An error occurred during schema sync: %1', $e->getMessage()));
        }

        return $this->resultRedirectFactory->create()->setPath('adminhtml/system_config/edit/section/dbtalker');
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('DBTalker_Connector::config');
    }
}
