<?php

namespace DBTalker\Connector\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
    const XML_PATH_HEADER_COLOR = 'dbtalker/widget/header_color';
    const XML_PATH_THEME_COLOR  = 'dbtalker/widget/theme_color';
    const XML_PATH_STORE_LOGO   = 'dbtalker/widget/store_logo';
    const XML_PATH_FRONTEND_GREETING   = 'dbtalker/widget/greeting_message_frotnend';
    const XML_PATH_ADMIN_GREETING   = 'dbtalker/widget/greeting_message_admin';

    /**
     * Get Header Color
     */
    public function getHeaderColor($storeId = null)
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_HEADER_COLOR,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * Get Theme Color
     */
    public function getThemeColor($storeId = null)
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_THEME_COLOR,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * Get Store Logo URL
     */
    public function getStoreLogo($storeId = null)
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_STORE_LOGO,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * Get Frontend Greeting Message
     */
    public function getFrontendGreetingMessage($storeId = null)
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_FRONTEND_GREETING,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    /**
     * Get Admin Greeting Message
     */
    public function getAdminGreetingMessage($storeId = null)
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_ADMIN_GREETING,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }
}
