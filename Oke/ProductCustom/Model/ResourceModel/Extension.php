<?php
namespace Oke\ProductCustom\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Extension extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('oke_productcustom_grid', 'id');
    }
}