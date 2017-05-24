<?php

namespace Sourabh\SupportChat\Block\Adminhtml\SupportChat;

class SupportChat extends \Magento\Framework\View\Element\Template
{

    /**
     *
     * @var type
     */
    protected $backendUrlInterface;


    protected $authSession;
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Backend\Model\UrlInterface $backendUrlInterface,
        \Magento\Backend\Model\Auth\Session $authSession,
        $data = []
    ) {
        $this->backendUrlInterface = $backendUrlInterface;
        $this->authSession = $authSession;
        parent::__construct($context, $data = []);
    }

    public function getAdminUrl($path)
    {
        return $this->backendUrlInterface->getUrl($path);
    }

    public function getAminUserName()
    {
        //die('userid:'.$this->authSession->getUser()->getUserId());
        return $this->authSession->getUser()->getUserName();
    }
}
