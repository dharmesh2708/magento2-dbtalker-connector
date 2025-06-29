<?php
namespace DBTalker\Connector\Block\Adminhtml;

use Magento\Backend\Block\Template\Context;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Backend\Block\Template;
use Magento\Framework\Encryption\EncryptorInterface;

class Widget extends Template
{
    const XML_PATH_ENABLED = 'dbtalker/widget/enabled_widget';
    const XML_PATH_API_KEY = 'dbtalker/general/api_key';
    const XML_PATH_POSITION = 'dbtalker/widget/position';

    protected $scopeConfig;

    protected $encryptor;

    public function __construct(
        Context $context,
        ScopeConfigInterface $scopeConfig,
        EncryptorInterface $encryptor,
        array $data = []
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->encryptor = $encryptor;
        parent::__construct($context, $data);
    }

    public function isEnabled()
    {
        return $this->scopeConfig->isSetFlag(self::XML_PATH_ENABLED);
    }

    public function getApiKey()
    {
        $encryptedToken = $this->scopeConfig->getValue(self::XML_PATH_API_KEY);
        $authToken = $this->encryptor->decrypt($encryptedToken);
        return $authToken;
    }

    public function getPosition()
    {
        return $this->scopeConfig->getValue(self::XML_PATH_POSITION) ?: 'right';
    }
}
