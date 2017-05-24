<?php

namespace Sourabh\SupportChat\Controller\SupportChat;

class Messages extends \Magento\Framework\App\Action\Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    protected $messagesFactory;
    
    protected $authSession;
    
    protected $messageResModel;
    
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Backend\Model\Auth\Session $authSession,
        \Sourabh\SupportChat\Model\MessagesFactory $messagesFactory,
        \Sourabh\SupportChat\Model\ResourceModel\Messages $messageResModel    
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->messagesFactory   = $messagesFactory;
        $this->authSession = $authSession;
        $this->messageResModel = $messageResModel;
    }

    public function execute()
    {
        $message = $this->messagesFactory->create();
        $message->setMessage($this->_request->getParam('message'));
        if ($this->_request->getParam('customerid'))
        $message->setCustomerId($this->_request->getParam('customerid'));
        if ($this->_request->getParam('visitorid'))
        $message->setVisitorId($this->_request->getParam('visitorid'));
        //$message->setAdminId($this->authSession->getUserId());
        $message->save();
        $notificationData = array();
        $notificationData['customer_id'] = '';
        $notificationData['visitor_id'] = '';
        $notificationData['customer_email_id'] = '';
        if ($this->_request->getParam('customerid'))
        {
            $notificationData['customer_id'] = $this->_request->getParam('customerid');
            $notificationData['customer_email_id'] = "Customer Id:".$this->_request->getParam('customerid');
        }
            
        if ($this->_request->getParam('visitorid'))
        {
            $notificationData['visitor_id'] = $this->_request->getParam('visitorid');
            $notificationData['customer_email_id'] = "Visitor Id:".$this->_request->getParam('visitorid');
        }
            
        $notificationData['no_of_messages'] = 1;
        $notificationData['notification_sent'] = 0;
        $this->messageResModel->insertNotification($notificationData);
    }
}
