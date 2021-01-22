<?php

namespace AHT\Question\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        $questionTable = $installer->getConnection()
            ->newTable($installer->getTable('aht_question'))
            ->addColumn(
                'question_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Question Id'
            )
            ->addColumn(
                'name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                 256,
                ['nullable' => false], 
                'Name'
            )
            ->addColumn(
                'email',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'EMAIL'
            )
            ->addColumn(
                'question',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                '64k',
                ['nullable' => false],
                'QUESTION'
            )
            ->addColumn(
                'answer',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                '64k',
                ['nullable' => false, 'default'=>''],
                'ANSWER'
            )
            ->addColumn(
                'customer_answers',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                '64k',
                ['nullable' => false, 'default'=>''],
                'ANSWER'
            )
            ->addColumn(
                'status',
                \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                null,
                ['nullable' => false, 'default' => '0'],
                'STATUS'
            )
            ->addColumn(
                'answer_status',
                \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                null,
                ['nullable' => false, 'default' => '1'],
                'Answer STATUS'
            )
            ->addColumn(
                'productname',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                '64k',
                ['nullable' => false, 'default'=>''],
                'productname'
            )
            ->addColumn(
                'product_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['nullable' =>false, 'default' => '-1'],
                'PRODUCT ID'
            )
            ->addColumn(
                'user_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['nullable' =>false, 'default' => '-1'],
                'USER ID'
            )
            ->addColumn(
                'store_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['nullable' =>false, 'default' => '-1'],
                'STORE ID'
            )
            ->addColumn(
                'created_at',
                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                null,
                ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
                'Created At'
            )->addColumn(
                'updated_at',
                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                null,
                ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
                'Updated At'
            );
        $installer->getConnection()->createTable($questionTable);


        $questionTable = $installer->getConnection()
            ->newTable($installer->getTable('aht_answer'))
            ->addColumn(
                'answer_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Answer Id'
            )
            ->addColumn(
                'question_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['nullable' => false, 'unsigned' => true,],
                'Question Id'
            )
           
            ->addColumn('answer_customer', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, '64k', ['nullable' => false], 'Customer Answer')
            ->addColumn('user_name', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, '64k', ['nullable' => false], 'User Answer')

            ->addIndex($installer->getIdxName('aht_answer', ['question_id']), ['question_id'])
            ->addForeignKey(
                $installer->getFkName('aht_answer', 'question_id', 'aht_question', 'question_id'),
                'question_id',
                $installer->getTable('aht_question'),
                'question_id',
                \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
            );

        $installer->getConnection()->createTable($questionTable);

        $installer->getConnection()->addIndex(
            $installer->getTable('aht_answer'),
            $installer->getIdxName(
                $installer->getTable('aht_answer'),
                ['answer_customer'],
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
            ),
            ['answer_customer'],
            \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
        );
        $installer->getConnection()->addIndex(
            $installer->getTable('aht_question'),
            $installer->getIdxName(
                $installer->getTable('aht_question'),
                ['name'],
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
            ),
            ['name'],
            \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
        );


        $installer->endSetup();
    }
}