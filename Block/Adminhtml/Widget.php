<?php
namespace DBTalker\Connector\Block\Adminhtml;

use Magento\Backend\Block\Template\Context;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Backend\Block\Template;
use Magento\Framework\Encryption\EncryptorInterface;
use Magento\Backend\Model\Auth\Session as AdminSession;

class Widget extends Template
{
    const XML_PATH_ENABLED = 'dbtalker/widget/enabled_widget';
    const XML_PATH_API_KEY = 'dbtalker/general/api_key';
    const XML_PATH_POSITION = 'dbtalker/widget/position';

    protected $scopeConfig;
    protected $encryptor;
    protected $adminSession;

    public function __construct(
        Context $context,
        ScopeConfigInterface $scopeConfig,
        EncryptorInterface $encryptor,
        AdminSession $adminSession,
        array $data = []
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->encryptor = $encryptor;
        $this->adminSession = $adminSession;
        parent::__construct($context, $data);
    }

    public function isEnabled()
    {
        return $this->isAdminLoggedIn() && $this->scopeConfig->isSetFlag(self::XML_PATH_ENABLED);
    }

    public function isAdminLoggedIn()
    {
        return $this->adminSession->isLoggedIn();
    }

    public function getApiKey()
    {
        $encryptedToken = $this->scopeConfig->getValue(self::XML_PATH_API_KEY);
        return $encryptedToken ? $this->encryptor->decrypt($encryptedToken) : null;
    }

    public function getPosition()
    {
        return $this->scopeConfig->getValue(self::XML_PATH_POSITION) ?: 'right';
    }
}
