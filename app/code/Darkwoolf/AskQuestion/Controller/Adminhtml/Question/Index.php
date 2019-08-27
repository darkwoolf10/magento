<?php

namespace Darkwoolf\AskQuestion\Controller\Adminhtml\Question;

use Magento\Framework\View\Result\Page;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Backend\App\Action;

/**
 * Class Index
 * @package Darkwoolf\AskQuestion\Controller\Adminhtml\Question
 */
class Index extends Action
{
    /**
     * @return ResponseInterface|ResultInterface|Page
     */
    public function execute()
    {
        /** @var Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->prepend(__('Customers questions'));

        return $resultPage;
    }
}
