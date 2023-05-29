<?php
namespace  Oke\ProductCustom\Model;

class Post extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
	const CACHE_TAG = 'oke_productcustom_grid';

	protected $_cacheTag = 'oke_productcustom_grid';

	protected $_eventPrefix = 'oke_productcustom_grid';

	protected function _construct()
	{
		$this->_init('Oke\ProductCustom\Model\ResourceModel\Post');
	}

	public function getIdentities()
	{
		return [self::CACHE_TAG . '_' . $this->getId()];
	}

	public function getDefaultValues()
	{
		$values = [];

		return $values;
	}
}