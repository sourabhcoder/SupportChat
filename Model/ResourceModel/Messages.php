<?php

namespace Sourabh\SupportChat\Model\ResourceModel;



class Messages extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * 
     * @param \Magento\Framework\Model\ResourceModel\Db\Context $context
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfigInterface
     */
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
        $this->_init('sourabh_support_chat_messages', 'id');
    }

    /**
     * 
     * @param type $adminId
     * @param type $customerId
     * @param type $visitorId
     * @return type
     */
    public function getMessages($adminId,$customerId,$visitorId=NULL)
    {
        $result = array();
        
        if(isset($customerId))
        {
            $query = $this->resource->getConnection()->query("SELECT * FROM ".$this->getTable("sourabh_support_chat_messages")." WHERE customer_id = $customerId ");
            $result = $query->fetchAll();            
        }
        if(isset($visitorId))
        {
            $query = $this->resource->getConnection()->query("SELECT * FROM ".$this->getTable("sourabh_support_chat_messages")." WHERE visitor_id = $visitorId ");
            $result = $query->fetchAll();
        }
        return $result;
    }
    
    public function insertMessage($message = array())
    {
        $query = $this->resource->getConnection()->query("SELECT * FROM ".$this->getTable("sourabh_support_chat_messages")." WHERE customer_id = $customerId ");
        $result = $query->fetchAll();            
    }
    
    public function insertNotification($data = array())
    {
        $customerid    = '';
        $visitorid     = '';
        $customeremail = '';
        if ($data['customer_id'] != NULL)
        {
            $customerid = $data['customer_id'];
        }
        if ($data['visitor_id'] != NULL)
        {
            $visitorid = $data['visitor_id'];
        }
        if ($data['customer_email_id'] != NULL)
        {
            $customeremailid = $data['customer_email_id'];
        }
        
        //die("SELECT * FROM ".$this->getTable("sourabh_support_chat_notifications")." WHERE customer_id = '".$customerid."' AND visitor_id = '".$visitorid."' AND customer_email_id = '".$customeremailid."'");
        $query = $this->resource->getConnection()->query("SELECT * FROM ".$this->getTable("sourabh_support_chat_notifications")." WHERE customer_id = '".$customerid."' AND visitor_id = '".$visitorid."' AND customer_email_id = '".$customeremailid."'");
        $result = $query->fetchAll();
        if(empty($result))
            $query = $this->resource->getConnection()->query("INSERT INTO ".$this->getTable("sourabh_support_chat_notifications")." (customer_id,visitor_id,customer_email_id,no_of_messages,notification_sent) VALUES ('".$data['customer_id']."','".$data['visitor_id']."','".$data['customer_email_id']."','".$data['no_of_messages']."','".$data['notification_sent']."') ");
        else
            $query = $this->resource->getConnection()->query("UPDATE ".$this->getTable("sourabh_support_chat_notifications")." SET notification_sent = 0 WHERE customer_id = '".$data['customer_id']."' AND visitor_id = '".$data['visitor_id']."' AND customer_email_id = '".$data['customer_email_id']."' ");
    }
}
