<?php

namespace Darkwoolf\AskQuestion\Controller\Adminhtml\Question;

use \Magento\Backend\Block\Template\Context;
use Darkwoolf\AskQuestion\Model\ResourceModel\Question\CollectionFactory;
use Magento\Eav\Model\Entity\Collection\AbstractCollection;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Framework\Controller\ResultFactory;
use Darkwoolf\AskQuestion\Model\ResourceModel\Question\Collection;

/**
 * Class MassStatus
 * @package Darkwoolf\AskQuestion\Controller\Adminhtml\Question
 */
class MassStatus extends AbstractMassAction
{
    /**
     * MassStatus constructor.
     * @param Context $context
     * @param Filter $filter
     * @param \Darkwoolf\AskQuestion\Model\ResourceModel\Question\CollectionFactory $collectionFactory
     */
    public function __construct(Context $context, Filter $filter, CollectionFactory $collectionFactory) {
        parent::__construct($context);
    }

    /**
     * @param AbstractCollection $collection
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    protected function massAction(Collection $collection)
    {
        $questionChangeStatus = 0;

        foreach ($collection as $rate) {
            $rate->setStatus('Answered')->save();
            $questionChangeStatus++;
        }

        if ($questionChangeStatus) {
            $this->messageManager->addSuccess(__('A total of %1 record(s) were updated.', $questionChangeStatus));
        }

        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setPath($this->getComponentRefererUrl());

        return $resultRedirect;
    }
}