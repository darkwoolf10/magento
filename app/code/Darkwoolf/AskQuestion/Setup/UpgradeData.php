<?php

namespace Darkwoolf\AskQuestion\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Store\Model\Store;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Darkwoolf\AskQuestion\Model\Question;
use Magento\Framework\Exception\LocalizedException;

class UpgradeData implements UpgradeDataInterface
{
    /** @var QuestionFactory  */
    private $questionFactory;

    /** @var Question  */
    private $questionModel;

    /** @var EavSetupFactory  */
    private $eavSetupFactory;

    /**
     * UpgradeData constructor.
     * @param \Darkwoolf\AskQuestion\Model\QuestionFactory $questionFactory
     * @param Question $questionModel
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(
        \Darkwoolf\AskQuestion\Model\QuestionFactory $questionFactory,
        Question $questionModel,
        EavSetupFactory $eavSetupFactory
    )
    {
        $this->questionFactory = $questionFactory;
        $this->questionModel = $questionModel;
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @throws LocalizedException
     * @throws \Zend_Validate_Exception
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

        if (version_compare($context->getVersion(), '1.0.6', '<')) {
            /** @var EavSetup $eavSetup */
            $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

            /**
             * Add attribute to the eav/attribute
             */
            $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'allow_ask_questions');

            $eavSetup->addAttribute(
                \Magento\Catalog\Model\Product::ENTITY,
                'allow_to_ask_questions',
                [
                    'group' => 'General',
                    'type' => 'int',
                    'backend' => '',
                    'frontend' => '',
                    'label' => 'Allow to ask questions',
                    'input' => 'boolean',
                    'class' => '',
                    'source' => \Magento\Eav\Model\Entity\Attribute\Source\Boolean::class,
                    'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                    'visible' => true,
                    'required' => false,
                    'user_defined' => false,
                    'default' => 1,
                    'searchable' => false,
                    'filterable' => false,
                    'comparable' => false,
                    'visible_on_front' => false,
                    'used_in_product_listing' => false,
                    'unique' => false,
                    'apply_to' => 'simple,configurable,virtual,bundle,downloadable'
                ]
            );
        }
    }
}
