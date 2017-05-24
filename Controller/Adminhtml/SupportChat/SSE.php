<?php

namespace Sourabh\SupportChat\Controller\Adminhtml\SupportChat;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class SSE extends \Magento\Backend\App\Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    protected $notifications;
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        \Sourabh\SupportChat\Model\ResourceModel\Notifications $notifications
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->notifications     = $notifications;
    }

    /**
     * Index action
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {

        header('Content-Type: text/event-stream');
        header('Cache-Control: no-cache');
        $notificationsArr = array();
        $notificationsArr = $this->notifications->getNotifications();
        $i = 0;
        $notificationsData = array();
        foreach ($notificationsArr as $key => $value) {
          $notificationsData[$i]['customer_email_id'] = $value['customer_email_id'];
          $notificationsData[$i]['customer_id']       = $value['customer_id'];
          $notificationsData[$i]['visitor_id']        = $value['visitor_id'];
          $notificationsData[$i]['id']                = $value['id'];
          $i++;
        }
        $time = date('r');
        $notificationjson = json_encode($notificationsData);
        echo "data:{$notificationjson}\n\n";
        flush();

    }
}
