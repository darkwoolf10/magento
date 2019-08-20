<?php

namespace Darkwoolf\AskQuestion\Block;

use Darkwoolf\AskQuestion\Model\ResourceModel\Question\Collection;

class Question extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Darkwoolf\AskQuestion\Model\ResourceModel\Question\CollectionFactory
     */
    private $collectionFactory;
    /**
     * Requests constructor.
     * @param \Darkwoolf\AskQuestion\Model\ResourceModel\Question\CollectionFactory $collectionFactory
     * @param \Magento\Framework\View\Element\Template\Context $context
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
}
