<?php

namespace Dev\ProductComments\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\Registry;
use Dev\ProductComments\Model\CommentRepository;

class Comment extends Template
{
    private $registry;
    private $commentRepository;
    public function __construct(
        Context $context,
        Registry $registry,
        CommentRepository $commentRepository,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->registry = $registry;
        $this->commentRepository = $commentRepository;
    }
    public function getCurrentProduct()
    {
        return $this->registry->registry('current_product');
    }
    public function getCommentCollection($productId) : array
    {
        return $this->commentRepository->getList($productId);
    }
}
