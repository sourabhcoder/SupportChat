<?php

namespace Sourabh\SupportChat\Model\ResourceModel\Messages;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Sourabh\SupportChat\Model\Messages', 'Sourabh\SupportChat\Model\ResourceModel\Messages');
    }
}
?>