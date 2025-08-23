<?php
namespace DBTalker\Connector\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Encryption\EncryptorInterface;
use Magento\Customer\Model\Session as CustomerSession;
use DBTalker\Connector\Helper\Data as HelperData;

class Widget extends Template
{
    const XML_PATH_ENABLED   = 'dbtalker/widget/enabled_widget';
    const XML_PATH_API_KEY   = 'dbtalker/general/api_key';
    const XML_PATH_POSITION  = 'dbtalker/widget/position';

    protected $scopeConfig;
    protected $encryptor;
    protected $customerSession;
    protected $helper;

    public function __construct(
        Template\Context $context,
        ScopeConfigInterface $scopeConfig,
        EncryptorInterface $encryptor,
        CustomerSession $customerSession,
        HelperData $helper,
        array $data = []
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->encryptor = $encryptor;
        $this->customerSession = $customerSession;
        $this->helper = $helper;
        parent::__construct($context, $data);
    }

    public function isEnabled()
    {
        return $this->scopeConfig->isSetFlag(self::XML_PATH_ENABLED);
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

    public function getUserInfo()
    {
        if ($this->customerSession->isLoggedIn()) {
            $customer = $this->customerSession->getCustomer();
            return [
                'isLoggedIn' => true,
                'role' => 'customer',
                'email' => $customer->getEmail()
            ];
        }
        return ['isLoggedIn' => false, 'role' => 'guest'];
    }

    public function getHeaderColor()
    {
        $color = $this->helper->getHeaderColor();
        return $color ? ltrim($color, '#') : '';
    }

    public function getThemeColor()
    {
        $color = $this->helper->getThemeColor();
        return $color ? ltrim($color, '#') : '';
    }

    public function getStoreLogo()
    {
        return $this->helper->getStoreLogo();
    }

    public function getFrontendGreetingMessage()
    {
        return $this->helper->getFrontendGreetingMessage();
    }
}
