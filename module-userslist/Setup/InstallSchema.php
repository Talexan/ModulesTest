<?php
namespace Talexan\UsersList\Setup;

use \Magento\Framework\Setup\InstallSchemaInterface;
use \Magento\Framework\Setup\SchemaSetupInterface;
use \Magento\Framework\Setup\ModuleContextInterface;

class InstallSchema implements InstallSchemaInterface
{
     /**
     * Installs DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(SchemaSetupInterface $setup, 
                            ModuleContextInterface $context)
    {
        $installer=$setup;
        $installer->startSetup();
        if (!$installer->tableExists('talexan_userslist_table'))
        {
            $table=$installer->getConnection()->newTable($installer->getTable(/*string|array $tableName*/
                                                                  'talexan_userslist_table')
                                                                  )->addColumn(
                                                'id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null,
                                                ['unsigned'=> FALSE,
                                                'nullable' => false,
                                                'primary' => true,
                                                'identity' => true], ' Id users')->addColumn(
                                                'fname', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                                                60,
                                                ['nullable' => false],
                                                'First name users')->addColumn('lname',
                                                 \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                                                 60,
                                                 [],
                                                 'Last name users'
                                                 )->addColumn(
                                                'email', 
                                                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                                                255,
                                                ['nullable' => false],
                                                'E-mail users'
                                                )->addColumn(
                                                'cdate',
                                                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                                                 null,
                                                 ['nullable' => false,
                                                 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
                                                 'Date create users'
                                                 )->addColumn(
                                                'udate',
                                                 \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                                                 null,
                                                 ['nullable' => false, 
                                                'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
                                                 'Date update users'
                                                 )->setComment('Users table');
            $installer->getConnection()->createTable($table);
            $installer->getConnection()->addIndex($installer->getTable('talexan_userslist_table'),
                                                $setup->getIdxName($installer->getTable('talexan_userslist_table'),
                                                                                        ['fname', 'lname', 'email'],
                                                                                        \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT),
                                                                                        ['fname', 'lname', 'email'],
                                                                                        \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT);                                           
        }
        $installer->endSetup();
    }
}

?>