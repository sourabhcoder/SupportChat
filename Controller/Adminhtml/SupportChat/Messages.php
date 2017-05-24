<?php

namespace Sourabh\SupportChat\Controller\Adminhtml\SupportChat;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Messages extends \Magento\Backend\App\Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    protected $messagesFactory;
    
    protected $authSession;
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        \Sourabh\SupportChat\Model\MessagesFactory $messagesFactory,
        \Magento\Backend\Model\Auth\Session $authSession
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->messagesFactory   = $messagesFactory;
        $this->authSession = $authSession;
    }

    public function execute()
    {
        $message = $this->messagesFactory->create();
        $message->setMessage($this->_request->getParam('message'));
        if ($this->_request->getParam('customerid'))
        $message->setCustomerId($this->_request->getParam('customerid'));
        if ($this->_request->getParam('visitorid'))
        $message->setVisitorId($this->_request->getParam('visitorid'));
        $message->setAdminId($this->authSession->getUser()->getUserId());
        $message->save();
    }
}
