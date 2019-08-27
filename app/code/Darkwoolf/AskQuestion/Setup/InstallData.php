<?php

namespace Darkwoolf\AskQuestion\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\InstallDataInterface;

class InstallData implements InstallDataInterface
{
    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        // The code in install and upgrade scripts is the same
        // Though, right now this file  will not work because first version of this module did not have any models
    }
}
