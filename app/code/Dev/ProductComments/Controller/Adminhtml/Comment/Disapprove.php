<?php
namespace Dev\ProductComments\Controller\Adminhtml\Comment;

use Dev\ProductComments\Model\ResourceModel\Comment\CollectionFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter;
use Dev\ProductComments\Model\CommentRepository;

class Disapprove extends Action
{
    protected $filter;
    protected $collectionFactory;
    /**
     * @var CommentRepository
     */
    private $commentRepository;

    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        CommentRepository $commentRepository
    ) {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->commentRepository = $commentRepository;
        parent::__construct($context);
    }
    public function execute()
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        foreach ($collection as $item) {
            $item->setStatus('not approved');
            $this->commentRepository->save($item);
        }
        $this->messageManager->addSuccessMessage(__('Elements have been disapproved.'));
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
    }
}
