<?php
namespace DBTalker\Connector\Block\Adminhtml\System\Config;

use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;

class SyncSchema extends Field
{
    protected function _getElementHtml(AbstractElement $element)
    {
        $url = $this->getUrl('dbtalker/sync/schema'); // You need to create this controller
        return '<button onclick="setLocation(\'' . $url . '\')" type="button" class="action-default scalable"><span>Sync Schema</span></button>';
    }
}
