<?php

namespace Dev\ProductComments\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;

class EmailObserver implements ObserverInterface
{

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $email = $observer->getData('sentEmail');
        $comment = $observer->getData('sentComment');

        mail("g_todadze2@cu.edu.ge", 'Someone commented below product', $comment, $email);
    }
}
