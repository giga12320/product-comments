<?php
namespace Dev\ProductComments\Controller\Index;

use Magento\Framework\Controller\ResultFactory;
use Dev\ProductComments\Controller\Adminhtml\Comment\Add;

class Index extends \Magento\Framework\App\Action\Action
{

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Framework\View\Result\Page $page */
        $page = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $this->_eventManager->dispatch('send_email',[$this->getRequest()]);
        return $page;
    }
}
