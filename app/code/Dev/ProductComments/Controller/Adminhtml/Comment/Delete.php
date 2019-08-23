<?php
namespace Dev\ProductComments\Controller\Adminhtml\Comment;

use Dev\ProductComments\Model\Comment;
use Dev\ProductComments\Model\ResourceModel\Comment as ResourceComment;
use Dev\ProductComments\Model\CommentRepository;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;

class Delete extends Action
{
    private $commentModel;
    /**
     * @var CommentRepository
     */
    private $commentRepository;
    public function __construct(
        Context $context,
        Comment $commentModel,
        CommentRepository $commentRepository
    ) {
        parent::__construct($context);
        $this->commentModel = $commentModel;
        $this->commentRepository = $commentRepository;
    }
    public function execute()
    {
        $params = $this->getRequest()->getParams();
        $id = $params['id'];
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        $comment = $this->commentRepository->getById($id);
        try {
            if (!$comment) {
                $this->messageManager->addErrorMessage(__('Unable to proceed. Please, try again.'));
                return $resultRedirect->setUrl($this->_redirect->getRefererUrl());
            }
        } catch (NoSuchEntityException $e) {
            $e->getMessage();
        }
        try {
            $this->commentRepository->delete($comment);
            $this->messageManager->addSuccessMessage(__('Your comment has been deleted !'));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('Error while trying to delete comment: '));
            return $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        }
        return $resultRedirect->setUrl($this->_redirect->getRefererUrl());
    }
}
