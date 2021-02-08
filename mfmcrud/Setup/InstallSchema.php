<?php
namespace Talexan\MFMCrud\Setup;

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

        $installer->startSetup(); /*Prepares database before install/upgrade @return $this  */

        if (!$installer->tableExists('talexan_mfmcrud_test')) /* Checks if table exists @param string $table @return bool */
        {
            $table=$installer->getConnection(/*
                * Gets connection object
                * @return \Magento\Framework\DB\Adapter\AdapterInterface
                */)->newTable(/* Retrieve DDL object for new table
                            @param string $tableName the table name
                            @return Table*/
                            $installer->getTable(/* Gets table name (validated by db adapter) by table placeholder
                                                  * @param string|array $tableName
                                                  * @return string  */
                                                  'talexan_mfmcrud_test'))->addColumn(
                                /* Adds column to table.
                                @param string $name the column name
                                @param string $type the column data type
                                @param string|int|array $size the column length:
                                @param array $options array of additional options
                                * - 'unsigned', Default: FALSE.
                                 * - 'precision',Default: taken from $size, if not set there then 0.
                                 * - 'scale', Default: taken from $size, if not set there then 10.
                                * - 'default'. Default: not set.
                                * - 'nullable'. Default: TRUE.
                                * - 'primary' Default: do not add.
                                * - 'primary_position'. Default: count of primary columns + 1.
                                * - 'identity' or 'auto_increment'. Default: FALSE.
                                @param string $comment column description
                                @return $this*/
                            'id', \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER, null,
                            ['unsigned'=> FALSE,
                             'nullable' => false,
                             'primary' => true,
                             'identity' => true], ' Id users')->addColumn(
                                'fname', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 60,
                                ['nullable' => false], 'First name users')->addColumn(
                                    'lname', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 60,
                                    [], 'Last name users')->addColumn(
                                        'email', \Magento\Framework\DB\Ddl\Table::TYPE_TEXT, 255,
                                        ['nullable' => false], 'E-mail users')->addColumn(
                                            'cdate', \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP, null,
                                            ['nullable' => false, 
                                            'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
                                             'Date create users')->addColumn(
                                                'udate', \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP, null,
                                                ['nullable' => false, 
                                                'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
                                                 'Date update users')->setComment(/* Set comment for table
                                                                                   * @param string $comment
                                                                                    * @return $this */
                                                                                    'Users table');
            $installer->getConnection()->createTable(/* Create table from DDL object
                                                      * @param Table $table
                                                      * @throws \Zend_Db_Exception
                                                      * @return \Zend_Db_Statement_Interface */
                                                        $table);

            $installer->getConnection()->addIndex(  /* Add new index to table name
                                                        * @param string $tableName
                                                        * @param string $indexName
                                                        * @param string|array $fields the table column name or array of ones
                                                        * @param string $indexType the index type
                                                        * @param string $schemaName
                                                        * @return \Zend_Db_Statement_Interface */
                                                    $installer->getTable('talexan_mfmcrud_test'),
                                                    $setup->getIdxName(/* Retrieves 32bit UNIQUE HASH for a Table index
                                                                        * @param string $tableName
                                                                        * @param array|string $fields
                                                                        * @param string $indexType
                                                                        * @return string     */
                                                                        $installer->getTable('talexan_mfmcrud_test'), 
                                                                        ['fname', 'lname', 'email'],
                                                                        \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT),
                                                                        ['fname', 'lname', 'email'], \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT);
                                                    
        }
        
        $installer->endSetup(); /* Prepares database after install/upgrade @return $this  */
    }
}

?>