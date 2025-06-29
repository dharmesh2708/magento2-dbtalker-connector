<?php
namespace DBTalker\Connector\Block\Adminhtml\System\Config;

use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Framework\App\Config\ScopeConfigInterface;

class LastSync extends Field
{
    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        ScopeConfigInterface $scopeConfig,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->scopeConfig = $scopeConfig;
    }

    protected function _getElementHtml(AbstractElement $element)
    {
        // Get the saved last_sync value from system config
        $lastSyncValue = $this->scopeConfig->getValue('dbtalker/general/last_sync', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);

        if ($lastSyncValue) {
            // Format the timestamp if needed, or just display raw
            $lastSync = $lastSyncValue;
        } else {
            $lastSync = 'Never';
        }

        return '<div>' . $lastSync . '</div>';
    }
}
