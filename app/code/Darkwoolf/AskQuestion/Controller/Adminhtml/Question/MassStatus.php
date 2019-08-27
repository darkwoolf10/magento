<?php

namespace Darkwoolf\AskQuestion\Controller\Adminhtml\Question;

use \Magento\Backend\Block\Template\Context;
use Darkwoolf\AskQuestion\Model\ResourceModel\Question\CollectionFactory;
use \Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Framework\Controller\ResultFactory;
use Darkwoolf\AskQuestion\Model\ResourceModel\Question\Collection;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class MassStatus
 * @package Darkwoolf\AskQuestion\Controller\Adminhtml\Question
 */
class MassStatus extends Action
{
    /** @var Filter  */
    protected $filter;

    /** @var CollectionFactory  */
    protected $collectionFactory;
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
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    /**
     * @param Collection $collection
     * @return ResultInterface
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
     * @return ResponseInterface|ResultInterface
     * @throws LocalizedException
     */
    public function execute()
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        //mass action
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
}
