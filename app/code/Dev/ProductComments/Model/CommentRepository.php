<?php
namespace Dev\ProductComments\Model;
use Dev\ProductComments\Api\CommentRepositoryInterface;
use Dev\ProductComments\Api\Data\CommentInterface;
use Dev\ProductComments\Model\ResourceModel\Comment\CollectionFactory;
class CommentRepository implements CommentRepositoryInterface
{
    private $collectionFactory;
    public function __construct(CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
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
        return NULL;
    }
}