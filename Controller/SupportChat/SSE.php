<?php

namespace Sourabh\SupportChat\Controller\SupportChat;

class SSE extends \Magento\Framework\App\Action\Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    protected $notifications;
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
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
          $notificationsData[$i]['customer_id'] = $value['customer_id'];
          $notificationsData[$i]['visitor_id'] = $value['visitor_id'];
          $i++;
        }
        $time = date('r');
        $notificationjson = json_encode($notificationsData);
        echo "data:{$notificationjson}\n\n";
        flush();

    }
}
