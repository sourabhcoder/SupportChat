<?php

namespace Sourabh\SupportChat\Block\SupportChat;

class SupportChat extends \Magento\Framework\View\Element\Template
{

    /**
     *
     * @var type
     */
    protected $urlInterface;


    protected $visitorSession;
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\UrlInterface $urlInterface,
        \Magento\Customer\Model\Visitor $visitorSession,
        $data = []
    ) {
        $this->urlInterface = $urlInterface;
        $this->visitorSession = $visitorSession;
        parent::__construct($context, $data = []);
    }

    public function getUrlPath($path)
    {
        return $this->urlInterface->getUrl($path);
    }

    public function isCustomerLoggedIn()
    {
        echo "<pre>";
        die(print_r($this->visitorSession->getData()));
    }
    
    public function getVisitorId()
    {
        $visitorData = array();
        $visitorData = $this->visitorSession->getData();
        return $visitorData['visitor_id'];
    }
}
