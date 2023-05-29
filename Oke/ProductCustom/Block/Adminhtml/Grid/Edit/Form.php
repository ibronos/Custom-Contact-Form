<?php
namespace Oke\ProductCustom\Block\Adminhtml\Grid\Edit;

class Form extends \Magento\Backend\Block\Widget\Form\Generic
{

    protected $_systemStore;

    protected $_filesystem;

    protected $_mediaDirectory;

    protected $filesystem;
    

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Framework\App\Filesystem\DirectoryList $_filesystem,
        \Magento\Framework\Filesystem $filesystem,
        array $data = []
    ) 
    {
        $this->_filesystem = $_filesystem;
        $this->_mediaDirectory = $filesystem->getDirectoryWrite(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form.
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        $dateFormat = $this->_localeDate->getDateFormat(\IntlDateFormatter::SHORT);
        $model = $this->_coreRegistry->registry('row_data');
        $form = $this->_formFactory->create(
            ['data' => [
                            'id' => 'edit_form', 
                            'enctype' => 'multipart/form-data', 
                            'action' => $this->getData('action'), 
                            'method' => 'post'
                        ]
            ]
        );

        $form->setHtmlIdPrefix('productcustom_');
        if ($model->getArticleId()) {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Details Data'), 'class' => 'fieldset-wide']
            );
            $fieldset->addField('id', 'hidden', ['name' => 'id']);
        } else {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Add Article Data'), 'class' => 'fieldset-wide']
            );
        }

        $fieldset->addField(
            'firstname',
            'text',
            [
                'name' => 'firstname',
                'label' => __('Firstname'),
                'id' => 'firstname',
                'title' => __('firstname'),
                'class' => 'required-entry',
                'required' => true,
                'disabled' => true
            ]
        );

        $fieldset->addField(
            'lastname',
            'text',
            [
                'name' => 'lastname',
                'label' => __('Lastname'),
                'id' => 'lastname',
                'title' => __('lastname'),
                'class' => 'required-entry',
                'required' => true,
                'disabled' => true
            ]
        );

        $fieldset->addField(
            'email',
            'text',
            [
                'name' => 'email',
                'label' => __('Email'),
                'id' => 'email',
                'title' => __('email'),
                'class' => 'required-entry',
                'required' => true,
                'disabled' => true
            ]
        );

        $fieldset->addField(
            'phone',
            'text',
            [
                'name' => 'phone',
                'label' => __('Phone'),
                'id' => 'phone',
                'title' => __('phone'),
                'class' => 'required-entry',
                'required' => true,
                'disabled' => true
            ]
        );

        // $mediapath = $this->_filesystem->getPath('pub');
        $yourFolderName = 'product_custom/';
        $target = $this->_mediaDirectory->getAbsolutePath($yourFolderName); 

        $fieldset->addField(
            'file',
            'link',
            [
                'name' => 'file',
                'label' => __('File'),
                'id' => 'file',
                'title' => __('file'),
                'class' => 'required-entry',
                'href' => $target,
                'value'     => 'image'
            ]
        );

        $fieldset->addField(
            'message',
            'textarea',
            [
                'name' => 'message',
                'label' => __('Message'),
                'id' => 'message',
                'title' => __('message'),
                'class' => 'required-entry',
                'required' => true,
                'disabled' => true
            ]
        );
        
        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
