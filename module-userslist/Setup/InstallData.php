<?php
namespace Talexan\UsersList\Setup;

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
        $installer->startSetup();
        if ($installer->tableExists('talexan_userslist_table')) 
        {
            $Db=$installer->getConnection();            
            $Db->insert($installer->getTable('talexan_userslist_table'), 
                                    array(  'fname' => 'Ivan',
                                            'lname' => 'Ivanenko',
                                            'email' => 'Ivan.Ivanenko@mail.com'));
            $Db->insert($installer->getTable('talexan_userlist'), 
                                       array('fname' => 'Petr', 
                                             'lname' => 'Petrenko',
                                             'email' => 'Petr.Petrenko@mail.com'));
            $Db->insert($installer->getTable('talexan_userlist'), 
                                       array('fname' => 'Sidor',
                                             'lname' => 'Sidorenko',
                                             'email' => 'Sidor.Sidorenko@mail.com'));
        }
            $installer->endSetup();
    }
}

?>