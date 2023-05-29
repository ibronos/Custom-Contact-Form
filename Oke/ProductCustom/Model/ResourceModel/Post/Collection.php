<?php
namespace Oke\ProductCustom\Model\ResourceModel\Post;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'id';
	protected $_eventPrefix = 'oke_productcustom_post_collection';
	protected $_eventObject = 'post_collection';

    protected function _construct()
    {
        $this->_init('Oke\ProductCustom\Model\Post', 'Oke\ProductCustom\Model\ResourceModel\Post');
    }
}