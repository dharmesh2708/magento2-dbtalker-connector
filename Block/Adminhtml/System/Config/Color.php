<?php
namespace DBTalker\Connector\Block\Adminhtml\System\Config;

use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;

class Color extends Field
{
    /**
     * Render color picker input
     */
    protected function _getElementHtml(AbstractElement $element)
    {
        $html = '<input type="color" ';
        $html .= 'id="' . $element->getHtmlId() . '" ';
        $html .= 'name="' . $element->getName() . '" ';
        $html .= 'value="' . $element->getEscapedValue() . '" ';
        $html .= 'class="input-text" style="width:80px;" />';
        return $html;
    }
}
