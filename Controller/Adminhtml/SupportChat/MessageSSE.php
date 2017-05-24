<?php

namespace Sourabh\SupportChat\Controller\Adminhtml\SupportChat;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class MessageSSE extends \Magento\Backend\App\Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    protected $messages;
    
    protected $session; 
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        \Sourabh\SupportChat\Model\ResourceModel\Messages $messages,
            \Magento\Backend\Model\Session $session
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->messages          = $messages;
        $this->session          = $session;
    }

    /**
     * Index action
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {

        header('Content-Type: text/event-stream');
        header('Cache-Control: no-cache');
        $messagesArr = array();
        $messagesData = array();
        if ($this->session->getCustomerId() != '')
        {
            $i = 0;
            $messagesArr = $this->messages->getMessages(NULL,$this->session->getCustomerId(),NULL);
            $messagesData = array();
            foreach($messagesArr as $message)
            {
                $messagesData[$i]['id']          = $message['id'];
                $messagesData[$i]['message']     = $message['message'];
                $messagesData[$i]['customer_id'] = $message['customer_id'];
                $messagesData[$i]['visitor_id']  = $message['visitor_id'];
                $messagesData[$i]['admin_id']    = $message['admin_id'];
                $i++;
            }
        }
        if ($this->session->getVisitorId())
        {
            $i = 0;
            $messagesArr = $this->messages->getMessages(NULL,NULL,$this->session->getVisitorId());
            $messagesData = array();
            foreach($messagesArr as $message)
            {
                $messagesData[$i]['id']          = $message['id'];
                $messagesData[$i]['message']     = $message['message'];
                $messagesData[$i]['customer_id'] = $message['customer_id'];
                $messagesData[$i]['visitor_id']  = $message['visitor_id'];
                $messagesData[$i]['admin_id']    = $message['admin_id'];
                $i++;
            }
        }
        $notificationjson = json_encode($messagesData);
        echo "data:{$notificationjson}\n\n";
        flush();

    }
}
