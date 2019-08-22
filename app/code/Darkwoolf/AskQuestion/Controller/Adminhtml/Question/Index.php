<?php

namespace Darkwoolf\AskQuestion\Controller\Adminhtml\Question;

use \Magento\Framework\View\Result\Page;
use Magento\Framework\Controller\ResultFactory;

/**
 * Class Index
 * @package Darkwoolf\AskQuestion\Controller\Adminhtml\Question
 */
class Index extends \Magento\Backend\App\Action
{
    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Framework\View\Result\Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->prepend(__('Customers questions'));

        return $resultPage;
    }
}
