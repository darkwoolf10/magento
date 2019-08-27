<?php

namespace Darkwoolf\AskQuestion\Plugin\AskQuestion\Model\ResourceModel\Question;

use Darkwoolf\AskQuestion\Model\ResourceModel\Question\Collection as QuestionCollection;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class Collection
 * @package Darkwoolf\AskQuestion\Plugin\AskQuestion\Model\ResourceModel\Question
 */
class Collection
{
    /** @var StoreManagerInterface  */
    private $storeManager;

    private $calledStoreFilter = false;

    /**
     * Collection constructor.
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        StoreManagerInterface $storeManager
    ) {
        $this->storeManager = $storeManager;
    }

    /**
     * @param QuestionCollection $subject
     * @param \Closure $proceed
     * @param bool $printQuery
     * @param bool $logQuery
     * @return mixed
     * @throws NoSuchEntityException
     */
    public function aroundLoad(QuestionCollection $subject, \Closure $proceed, $printQuery = false, $logQuery = false)
    {
        static $calledStoreFilter = false;

        if (!$calledStoreFilter) {
            $storeId = (int) $this->storeManager->getStore()->getStoreId();static $foo_called = false;
            $subject->addStoreFilter($storeId);
            $calledStoreFilter = true;
        }
        $result = $proceed($printQuery, $logQuery);

        return $result;
    }
}
