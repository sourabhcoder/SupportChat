<?php

namespace Sourabh\SupportChat\Controller\Adminhtml\SupportChat;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Notifications extends \Magento\Backend\App\Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    protected $resModNotification;
    
    protected $authSession;
    
    protected $session;
    
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        \Sourabh\SupportChat\Model\ResourceModel\Notifications $resModNotification,
        \Magento\Backend\Model\Auth\Session $authSession,
        \Magento\Backend\Model\Session $session
    )
    {
        parent::__construct($context);
        $this->resultPageFactory  = $resultPageFactory;
        $this->resModNotification = $resModNotification;
        $this->authSession        = $authSession;
        $this->session            = $session;
    }

    public function execute()
    {
        if ($this->_request->getParam('action') == 'readnoti')
        {
            $this->resModNotification->readNotification($this->_request->getParam('id'));
        }
        $this->session->start();
        $this->session->setVisitorId($this->_request->getParam('visitorid'));
        $this->session->setCustomerId($this->_request->getParam('customerid'));
        
                
    }
}
