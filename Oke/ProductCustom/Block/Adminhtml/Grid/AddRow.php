<?php
namespace Oke\ProductCustom\Block\Adminhtml\Grid;

class AddRow extends \Magento\Backend\Block\Widget\Form\Container
{

    protected $_coreRegistry = null;

    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) 
    {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    protected function _construct()
    {
        $this->_objectId = 'row_id';
        $this->_blockGroup = 'Oke_ProductCustom';
        $this->_controller = 'adminhtml_grid';
        parent::_construct();

        $this->buttonList->remove('save');
        $this->buttonList->remove('reset');
    }


    public function getHeaderText()
    {
        return __('Add Article Data');
    }

    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }

    public function getFormActionUrl()
    {
        if ($this->hasFormActionUrl()) {
            return $this->getData('form_action_url');
        }

        return $this->getUrl('*/*/save');
    }
}