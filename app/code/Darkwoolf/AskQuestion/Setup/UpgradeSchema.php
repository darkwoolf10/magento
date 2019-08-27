<?php

namespace Darkwoolf\AskQuestion\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Darkwoolf\AskQuestion\Model\Question;

class UpgradeSchema implements UpgradeSchemaInterface
{

    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @throws \Zend_Db_Exception
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        if (version_compare($context->getVersion(), '1.0.1', '<')) {

            /**
             * Create table 'darkwoolf_ask_question'
             */
            $table = $installer->getConnection()->newTable(
                $installer->getTable('darkwoolf_ask_question')
            )->addColumn(
                'question_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'nullable' => false, 'primary' => true],
                'Question_id ID'
            )->addColumn(
                'name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Customer Name'
            )->addColumn(
                'email',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Customer Email'
            )->addColumn(
                'phone',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                63,
                [],
                'Phone'
            )->addColumn(
                'question',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                null,
                ['nullable' => false],
                'Question for product'
            )->addColumn(
                'sku',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                63,
                ['nullable' => false],
                'Sku'
            )->addColumn(
                'created_at',
                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                null,
                ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
                'Creation Time'
            )->addColumn(
                'status',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                15,
                ['nullable' => false, 'default' => Question::STATUS_PENDING],
                'Status'
            )->addColumn(
                'store_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                5,
                ['unsigned' => true, 'nullable' => false, 'default' => '0'],
                'Store ID'
            )->addForeignKey(
                $installer->getFkName(
                    $installer->getTable('darkwoolf_ask_question'),
                    'store_id',
                    'store',
                    'store_id'
                ),
                'store_id',
                $installer->getTable('store'),
                'store_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE,
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            )->setComment(
                'Ask question for product'
            );
            $installer->getConnection()->createTable($table);
        }
        $installer->endSetup();
    }
}
