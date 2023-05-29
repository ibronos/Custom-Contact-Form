<?php
namespace Oke\ProductCustom\Controller\Index;

use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\LocalizedException;
use Oke\ProductCustom\Model\ExtensionFactory;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Filesystem\DirectoryList;

class Form extends \Magento\Framework\App\Action\Action
{

    protected $extensionFactory;
    protected $_mediaDirectory;
    protected $_fileUploaderFactory;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        ExtensionFactory $extensionFactory,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\MediaStorage\Model\File\UploaderFactory $fileUploaderFactory
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->extensionFactory = $extensionFactory;
        $this->_mediaDirectory = $filesystem->getDirectoryWrite(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
        $this->_fileUploaderFactory = $fileUploaderFactory;
        parent::__construct($context);
    }
 

    public function execute()
    {
        $data = (array) $this->getRequest()->getPost();

        if (!empty($data)) {
            try {
                if ($this->validatedParams()) {
                    $data['file'] = $this->uploadFile();
                    $model = $this->extensionFactory->create();
                    $model->setData($data)->save();
                    $this->messageManager->addSuccessMessage(__("Thank you for your request!"));
                }
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            }

            $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            $resultRedirect->setUrl('/maatwerk-producten');

            return $resultRedirect;
        }
     
        $this->_view->loadLayout();
        $this->_view->renderLayout();
    }

    private function validatedParams()
    {
        $request = $this->getRequest();

        if (trim($request->getParam('firstname')) === '') {
            throw new LocalizedException(__('Enter the first name and try again.'));
        }

        if (trim($request->getParam('lastname')) === '') {
            throw new LocalizedException(__('Enter the last name and try again.'));
        }

        if (trim($request->getParam('phone')) === '') {
            throw new LocalizedException(__('Enter the phone and try again.'));
        }

        if (false === \strpos($request->getParam('email'), '@')) {
            throw new LocalizedException(__('The email address is invalid. Verify the email address and try again.'));
        }

        if (trim($request->getParam('message')) === '') {
            throw new LocalizedException(__('Enter the message and try again.'));
        }

        if (!$request->getParam('agreement')) {
            throw new LocalizedException(__('Mark the agreement and try again.'));
        }

        return $request->getParams();
    }

    public function uploadFile()
    {
        // this folder will be created inside "pub/media" folder
        $yourFolderName = 'product_custom/';
        
        // "upload_custom_file" is the HTML input file name
        $yourInputFileName = 'file';
        
        try {
            $file = $this->getRequest()->getFiles($yourInputFileName);
            $fileName = ($file && array_key_exists('name', $file)) ? $file['name'] : null;
            
            if ($file && $fileName) {
                $target = $this->_mediaDirectory->getAbsolutePath($yourFolderName); 
                
                /** @var $uploader \Magento\MediaStorage\Model\File\Uploader */
                $uploader = $this->_fileUploaderFactory->create(['fileId' => $yourInputFileName]);
                
                // set allowed file extensions
                $uploader->setAllowedExtensions(['jpg', 'jpeg', 'pdf', 'doc', 'png', 'xls']);
                
                // allow folder creation
                $uploader->setAllowCreateFolders(true);
                
                // rename file name if already exists 
                $uploader->setAllowRenameFiles(true); 
                
                // upload file in the specified folder
                $result = $uploader->save($target);
                
                // if ($result['file']) {
                //     $this->messageManager->addSuccess(__('File has been successfully uploaded.')); 
                // }
                // return $target . $uploader->getUploadedFileName();

                return $uploader->getUploadedFileName();
            }
        } 
        catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }
        
        // return false;
        return null;
    }


}