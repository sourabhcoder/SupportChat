<?php

namespace Sourabh\SupportChat\Controller\SupportChat;



class MessageSSE extends \Magento\Framework\App\Action\Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    protected $messages;
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Sourabh\SupportChat\Model\ResourceModel\Messages $messages
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->messages          = $messages;
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
        if ($this->_request->getParam('customerid'))
        {
            $i = 0;
            $messagesArr = $this->messages->getMessages(NULL,$this->_request->getParam('customerid'),NULL);
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
        if ($this->_request->getParam('visitorid'))
        {
            $i = 0;
            $messagesArr = $this->messages->getMessages(NULL,NULL,$this->_request->getParam('visitorid'));
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
