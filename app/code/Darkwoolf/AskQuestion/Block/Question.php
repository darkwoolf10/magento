<?php

namespace Darkwoolf\AskQuestion\Block;

use Darkwoolf\AskQuestion\Model\ResourceModel\Question\Collection;
use Darkwoolf\AskQuestion\Model\ResourceModel\Question\CollectionFactory;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class Question
 * @package Darkwoolf\AskQuestion\Block
 */
class Question extends Template
{
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * Requests constructor.
     * @param CollectionFactory $collectionFactory
     * @param Context $context
     * @param array $data
     */
    public function __construct(
    \Darkwoolf\AskQuestion\Model\ResourceModel\Question\CollectionFactory $collectionFactory,
    \Magento\Framework\View\Element\Template\Context $context,
    array $data = []
    ) {
        parent::__construct($context, $data);
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @return Collection
     * @throws NoSuchEntityException
     */
    public function getQuestions(): Collection
    {
        /** @var Collection $collection */
        $collection = $this->collectionFactory->create();
        $collection->addStoreFilter()
            ->getSelect()
            ->orderRand();

        if ($limit = $this->getData('limit')) {
            $collection->setPageSize($limit);
        }

        return $collection;
    }

    /**
     * @return mixed
     */
    public function getCurrentProduct()
    {
        return $this->_registry->registry('current_product');
    }
}
