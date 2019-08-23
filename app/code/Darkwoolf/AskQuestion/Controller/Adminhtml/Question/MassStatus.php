<?php

namespace Darkwoolf\AskQuestion\Controller\Adminhtml\Question;

use \Magento\Backend\Block\Template\Context;
use Darkwoolf\AskQuestion\Model\ResourceModel\Question\CollectionFactory;
use \Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Framework\Controller\ResultFactory;
use Darkwoolf\AskQuestion\Model\ResourceModel\Question\Collection;

/**
 * Class MassStatus
 * @package Darkwoolf\AskQuestion\Controller\Adminhtml\Question
 */
class MassStatus extends Action
{
    /**
     * MassStatus constructor.
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory
    ) {
        parent::__construct($context);
    }

    /**
     * @param Collection $collection
     * @return \Magento\Framework\Controller\ResultInterface
     * @throws \Exception
     */
    protected function massAction(Collection $collection)
    {
        /** @var \Darkwoolf\AskQuestion\Model\Question $rate */
        foreach ($collection as $rate) {
            $rate->setStatus('Answered');
        }

        $collection->save();

        if (count($collection)) {
            $this->messageManager->addSuccess(__('A total of %1 record(s) were updated.', count($collection)));
        }

        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setPath($this->getComponentRefererUrl());

        return $resultRedirect;
    }

    /**
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        /** @var \Magento\Framework\View\Result\Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->prepend(__('Customers questions'));

        return $resultPage;
    }
}