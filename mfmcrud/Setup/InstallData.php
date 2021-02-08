<?php
namespace Talexan\MFMCrud\Setup;

use \Magento\Framework\Setup\InstallDataInterface;
use \Magento\Framework\Setup\ModuleDataSetupInterface;
use \Magento\Framework\Setup\ModuleContextInterface;

class InstallData implements InstallDataInterface
{
     /**
     * Installs data for a module
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer=$setup;

        $installer->startSetup(); /*Prepares database before install/upgrade @return $this  */

        if ($installer->tableExists('talexan_mfmcrud_test')) /* Checks if table exists @param string $table @return bool */
        {
            $Db=$installer->getConnection(/* Gets connection object
                                              * @return \Magento\Framework\DB\Adapter\AdapterInterface */);
            
            $Db->insert(/* Inserts a table row with specified data.
                         * @param mixed $table The table to insert data into.
                         * @param array $bind Column-value pairs.
                         * @return int The number of affected rows. */
                        $installer->getTable('talexan_mfmcrud_test'), 
                                             array('fname' => 'Ivan',
                                                    'lname' => 'Ivanenko',
                                                    'email' => 'Ivan.Ivanenko@mail.com'));
            $Db->insert($installer->getTable('talexan_mfmcrud_test'), 
                        array('fname' => 'Petr', 'lname' => 'Petrenko', 'email' => 'Petr.Petrenko@mail.com'));
            $Db->insert($installer->getTable('talexan_mfmcrud_test'), 
                        array('fname' => 'Sidor', 'lname' => 'Sidorenko', 'email' => 'Sidor.Sidorenko@mail.com'));

        }
            $installer->endSetup(); /* Prepares database after install/upgrade @return $this  */
    }
}

?>