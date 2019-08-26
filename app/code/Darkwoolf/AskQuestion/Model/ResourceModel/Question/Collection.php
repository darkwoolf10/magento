<?php

namespace Darkwoolf\AskQuestion\Model\ResourceModel\Question;

use Magento\Framework\Data\Collection\EntityFactoryInterface;
use Psr\Log\LoggerInterface;
use Magento\Framework\Data\Collection\Db\FetchStrategyInterface;
use Magento\Framework\Event\ManagerInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Exception\NoSuchEntityException;
use Darkwoolf\AskQuestion\Model\Question as ModelQuestion;
use Darkwoolf\AskQuestion\Model\ResourceModel\Question as ResourceModelQuestion;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 * @package Darkwoolf\AskQuestion\Model\ResourceModel\Question
 */
class Collection extends AbstractCollection
{
    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /** @var string  */
    protected $_eventPrefix = 'darkwoolf_ask_question_collection';

    /** @var string  */
    protected $_eventObject = 'askquestion_collection';

    /** @var string  */
    protected $_idFieldName = 'question_id';

    /**
     * Collection constructor.
     * @param EntityFactoryInterface $entityFactory
     * @param LoggerInterface $logger
     * @param FetchStrategyInterface $fetchStrategy
     * @param ManagerInterface $eventManager
     * @param StoreManagerInterface $storeManager
     * @param AdapterInterface|null $connection
     * @param AbstractDb|null $resource
     */
    public function __construct(
        EntityFactoryInterface $entityFactory,
        LoggerInterface $logger,
        FetchStrategyInterface $fetchStrategy,
        ManagerInterface $eventManager,
        StoreManagerInterface $storeManager,
        AdapterInterface $connection = null,
        AbstractDb $resource = null
    ) {
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $connection, $resource);
        $this->storeManager = $storeManager;
    }


    protected function _construct()
    {
        $this->_init(
            ModelQuestion::class,
            ResourceModelQuestion::class
        );
    }

    /**
     * @param int $storeId
     * @return Collection
     * @throws NoSuchEntityException
     */
    public function addStoreFilter(int $storeId = 0): self
    {
        if (!$storeId) {
            $storeId = (int) $this->storeManager->getStore()->getId();
        }

        $this->addFieldToFilter('store_id', $storeId);

        return $this;
    }
}
