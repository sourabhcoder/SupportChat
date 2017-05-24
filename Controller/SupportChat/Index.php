<?php
namespace Sourabh\SupportChat\Controller\SupportChat;

class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;
    
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Index action
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        echo "<pre>";
        die(print_r($this->_request->getParams()));
        $resultPage = $this->resultPageFactory->create();
        $resultPage->addBreadcrumb(__('Sourabh Support Chat'), __('Sourabh Support Chat'));
        $resultPage->getConfig()->getTitle()->prepend(__('Sourabh Support Chat'));
        return $resultPage;
    }
}
