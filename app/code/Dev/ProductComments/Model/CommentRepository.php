<?php
namespace Dev\ProductComments\Model;

use Dev\ProductComments\Api\CommentRepositoryInterface;
use Dev\ProductComments\Api\Data\CommentInterface;
use Dev\ProductComments\Model\ResourceModel\Comment\CollectionFactory;

class CommentRepository implements CommentRepositoryInterface
{
    private $collectionFactory;
    /**
     * @var CommentFactory
     */
    private $commentFactory;

    /**
     * CommentRepository constructor.
     * @param CollectionFactory $collectionFactory
     * @param CommentFactory $commentFactory
     */
    public function __construct(
        CollectionFactory $collectionFactory,
        \Dev\ProductComments\Model\CommentFactory $commentFactory
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->commentFactory = $commentFactory;
    }
    public function getList($productId)
    {
        $comment = $this->collectionFactory->create();
        $collection = $comment
            ->addFieldToFilter('product_id', $productId)
            ->getItems();
        return $collection;
    }
    /**
     * @param CommentInterface $comment
     * @return CommentInterface
     */
    public function save(CommentInterface $comment)
    {
        $comment->getResource()->save($comment);
        return $comment;
    }
    /**
     * @param CommentInterface $comment
     * @return void
     */
    public function delete(CommentInterface $comment)
    {
        $comment->getResource()->delete($comment);
    }

    public function getById($id)
    {
        $comment = $this->commentFactory->create();
        $comment->getResource()->load($comment, $id);
        return $comment;
    }
}
