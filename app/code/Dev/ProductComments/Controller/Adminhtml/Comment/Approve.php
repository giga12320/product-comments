<?php
namespace Dev\ProductComments\Controller\Adminhtml\Comment;

use Dev\ProductComments\Model\ResourceModel\Comment\CollectionFactory;
use Dev\ProductComments\Model\CommentRepository;
use Dev\ProductComments\Model\Comment;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter;

class Approve extends Action
{
    protected $filter;
    protected $collectionFactory;
    /**
     * @var CommentRepository
     */
    private $commentRepository;
    /**
     * @var Context
     */
    private $context;
    /**
     * @var Comment
     */
    private $commentModel;
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        CommentRepository $commentRepository,
        Comment $commentModel
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
            /**
             * @var $item Comment
             */
            $item->setStatus('approved');
            $this->commentRepository->save($item);
        }
        $this->messageManager->addSuccessMessage(__('Elements have been approved.'));
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
    }
}
