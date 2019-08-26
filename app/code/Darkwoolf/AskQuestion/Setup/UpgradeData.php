<?php

namespace Darkwoolf\AskQuestion\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Store\Model\Store;
use Darkwoolf\AskQuestion\Model\Question;

/**
 * Class UpgradeData
 * @package Darkwoolf\AskQuestion\Setup
 */
class UpgradeData implements UpgradeDataInterface
{
    /** @var QuestionFactory  */
    private $questionFactory;

    /** @var Question  */
    private $questionModel;

    /**
     * UpgradeData constructor.
     * @param \Darkwoolf\AskQuestion\Model\QuestionFactory $questionFactory
     * @param Question $questionModel
     */
    public function __construct(
        \Darkwoolf\AskQuestion\Model\QuestionFactory $questionFactory,
        Question $questionModel
    )
    {
        $this->questionFactory = $questionFactory;
        $this->questionModel = $questionModel;
    }

    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @throws \Exception
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), '1.0.2', '<')) {
            $statuses = $this->questionModel->getStatuses();

            for ($i = 1; $i <= 5; $i++) {
                /** @var Question $question */
                $requestSample = $this->questionFactory->create();
                $requestSample->setName("Customer #$i")
                    ->setEmail("test-mail-$i@gmail.com")
                    ->setPhone("+38093$i$i$i$i$i$i$i")
                    ->setQuestion("Lorem ipsum dolor sit amet, consectetur adipisicing elit.")
                    ->setSku("product_sku_$i")
                    ->setStatus($statuses[array_rand($this->questionModel->getStatuses())])
                    ->setStoreId(Store::DISTRO_STORE_ID);
                $requestSample->save();
            }
        }
    }
}
