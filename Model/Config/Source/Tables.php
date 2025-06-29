<?php
namespace DBTalker\Connector\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;
use Magento\Framework\App\ResourceConnection;

class Tables implements ArrayInterface
{
    protected $resource;

    public function __construct(ResourceConnection $resource)
    {
        $this->resource = $resource;
    }

    public function toOptionArray()
    {
        $connection = $this->resource->getConnection();
        $tables = $connection->fetchCol('SHOW TABLES');
        $options = [];

        foreach ($tables as $table) {
            $options[] = ['value' => $table, 'label' => $table];
        }

        return $options;
    }
}
