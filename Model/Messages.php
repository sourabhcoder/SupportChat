<?php

namespace Sourabh\SupportChat\Model;

class Messages extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {
        parent::_construct();
        $this->_init('Sourabh\SupportChat\Model\ResourceModel\Messages');
    }
}
?>