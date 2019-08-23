<?php
namespace Dev\ProductComments\Block;

use Dev\ProductComments\Model\CommentFactory;
use Dev\ProductComments\Model\ResourceModel\Comment\CollectionFactory;
use Magento\Framework\View\Element\Template;
use Magento\Framework\Registry;
use Dev\ProductComments\Model\CommentRepository;

class Comment extends Template
{
    private $context;
    private $data;
    private $registry;
    /**
     * @var CommentRepository
     */
    private $commentRepository;
    /**
     * @var CommentFactory
     */
    protected $commentFactory;
    /**
     * @param CommentRepository $commentRepository
     * Comment constructor.
     * @param Template\Context $context
     * @param CommentFactory $commentFactory
     * @param array $data
     */
    public function __construct(
        CommentRepository $commentRepository,
        Template\Context $context,
        CommentFactory $commentFactory,
        Registry $registry,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->commentRepository = $commentRepository;
        $this->context = $context;
        $this->data = $data;
        $this->commentFactory = $commentFactory;
        $this->registry = $registry;
    }
    public function getCommentCollection($productId)
    {
        return $this->commentRepository->getList($productId);
    }

    public function getCurrentProduct($productId)
    {
        return $this->productRepository->getById($productId)->getName();
    }
}
