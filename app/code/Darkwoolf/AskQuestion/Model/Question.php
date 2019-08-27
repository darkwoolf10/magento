<?php

namespace Darkwoolf\AskQuestion\Model;

use Darkwoolf\AskQuestion\Model\ResourceModel\Question as QuestionResource;
use Magento\Framework\Model\Context;
use Magento\Framework\Registry;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Exception\NoSuchEntityException;


/**
 * Class Question
 * @package Darkwoolf\AskQuestion\Model
 *
 * @method int|string getQuestionId()
 * @method int|string getName()
 * @method Question setName(string $name)
 * @method string getEmail()
 * @method Question setEmail(string $email)
 * @method string getPhone()
 * @method Question setPhone(string $phone)
 * @method string getQuestion()
 * @method Question setQuestion(string $question)
 * @method string getSku()
 * @method Question setSku(string $sku)
 * @method string getCreatedAt()
 * @method string getStatus()
 * @method Question setStatus(string $status)
 * @method int|string getStoreId()
 * @method Question setStoreId(int $storeId)
 */
class Question extends \Magento\Framework\Model\AbstractModel
{
    /** @var string  */
    const STATUS_PENDING = 'Pending';

    /** @var string  */
    const STATUS_ANSWERED = 'Answered';

    /** @var string  */
    const STATUS_ERROR = 'Error';

    /** @var string  */
    const STATUS_SUCCESS = 'Success';

    /** @var StoreManagerInterface  */
    private $storeManager;

    /** @var string  */
    protected $_eventPrefix = 'darkwoolf_ask_question';

    /**
     * Question constructor.
     * @param Context $context
     * @param Registry $registry
     * @param StoreManagerInterface $storeManager
     * @param AbstractResource|null $resource
     * @param AbstractDb|null $resourceCollection
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        StoreManagerInterface $storeManager,
        AbstractResource $resource = null,
        AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
        $this->storeManager = $storeManager;
    }

    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(QuestionResource::class);
    }

    /**
     * @return array
     */
    public function getStatuses(): array
    {
        return [
            self::STATUS_PENDING,
            self::STATUS_ANSWERED,
        ];
    }

    /**
     * @return AbstractModel
     * @throws NoSuchEntityException
     */
    public function beforeSave()
    {
        if (!$this->getStatus()) {
            $this->setStatus(self::STATUS_PENDING);
        }

        if (!$this->getStoreId()) {
            $this->setStoreId($this->storeManager->getStore()->getId());
        }

        return parent::beforeSave();
    }
}
