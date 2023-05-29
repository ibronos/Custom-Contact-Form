<?php
namespace Oke\ProductCustom\Model\ResourceModel\Extension;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Oke\ProductCustom\Model\Extension', 'Oke\ProductCustom\Model\ResourceModel\Extension');
    }
}