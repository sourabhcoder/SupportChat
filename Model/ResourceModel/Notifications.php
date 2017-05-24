<?php

namespace Sourabh\SupportChat\Model\ResourceModel;



class Notifications extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    public function __construct(\Magento\Framework\Model\ResourceModel\Db\Context $context,
                                \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfigInterface
    )
    {
        $this->scopeConfigInterface = $scopeConfigInterface;
        $this->resource = $context->getResources();
        parent::__construct($context);
    }

    public function _construct()
    {

    }

    public function getNotifications()
    {
        $result = $this->resource->getConnection()->query("SELECT * FROM ".$this->getTable("sourabh_support_chat_notifications")." WHERE notification_sent = 0 ");
        $result = $result->fetchAll();
        return $result;
    }
    
    public function readNotification($id)
    {
        $result = $this->resource->getConnection()->query("UPDATE ".$this->getTable("sourabh_support_chat_notifications")." SET notification_sent = 1 WHERE id = $id ");
    }

}
