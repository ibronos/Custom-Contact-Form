<?php
namespace Oke\ProductCustom\Model;

use Oke\ProductCustom\Api\Data\GridInterface;

class Grid extends \Magento\Framework\Model\AbstractModel implements GridInterface
{
    /**
     * CMS page cache tag.
     */
    const CACHE_TAG = 'oke_productcustom_grid';

    /**
     * @var string
     */
    protected $_cacheTag = 'oke_productcustom_grid';

    /**
     * Prefix of model events names.
     *
     * @var string
     */
    protected $_eventPrefix = 'oke_productcustom_grid';

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init('Oke\ProductCustom\Model\ResourceModel\Grid');
    }
    /**
     * Get EntityId.
     *
     * @return int
     */
    public function getArticleId()
    {
        return $this->getData(self::ARTICLE_ID);
    }

    /**
     * Set EntityId.
     */
    public function setArticleId($articleId)
    {
        return $this->setData(self::ARTICLE_ID, $articleId);
    }

    /**
     * Get Title.
     *
     * @return varchar
     */
    public function getTitle()
    {
        return $this->getData(self::TITLE);
    }

    /**
     * Set Title.
     */
    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }
}