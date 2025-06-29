<?php
namespace DBTalker\Connector\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class Position implements ArrayInterface
{
    public function toOptionArray()
    {
        return [
            ['value' => 'bottom_right', 'label' => __('Bottom Right')],
            ['value' => 'bottom_left', 'label' => __('Bottom Left')],
            ['value' => 'top_right', 'label' => __('Top Right')],
            ['value' => 'top_left', 'label' => __('Top Left')],
        ];
    }
}
