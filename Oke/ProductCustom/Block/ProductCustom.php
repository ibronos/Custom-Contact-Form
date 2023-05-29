<?php
namespace Oke\ProductCustom\Block;

class ProductCustom extends \Magento\Framework\View\Element\Template
{
    public function __construct(\Magento\Framework\View\Element\Template\Context $context)
	{
		parent::__construct($context);
	}

    public function getFormAction()
    {
        return '/productcustomform/Index/Form';
    }

}