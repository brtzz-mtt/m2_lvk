<?php

/**
 * Copyright © 2021 Bertozzi Matteo
 *
 * PHP Version 5
 *
 * @category File
 * @package  Lvk_Scaffold
 * @author   Bertozzi Matteo <brtzz.mtt@gmail.com>
 * @license  The PHP License, Version 3.0 - PHP.net (http://php.net/license/3_0.txt)
 * @link     https://github.com/brtzz-mtt
 */

namespace Lvk\Scaffold\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface as implemented;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * Copyright © 2021 Bertozzi Matteo
 *
 * PHP Version 5
 *
 * @category Class
 * @package  Lvk_Scaffold
 * @author   Bertozzi Matteo <brtzz.mtt@gmail.com>
 * @license  The PHP License, Version 3.0 - PHP.net (http://php.net/license/3_0.txt)
 * @link     https://github.com/brtzz-mtt
 */
class InstallSchema implements implemented
{
    const SCAFFOLD_TABLE = 'lvk_scaffold_scaffold';

    /**
     * Copyright © 2021 Bertozzi Matteo
     *
     * PHP Version 5
     *
     * @param object $schemaSetupInterface   Magento\Framework\Setup\SchemaSetupInterface
     * @param object $moduleContextInterface Magento\Framework\Setup\ModuleContextInterface
     *
     * @return void
     */
    public function install(
        SchemaSetupInterface $schemaSetupInterface,
        ModuleContextInterface $moduleContextInterface
    ) {
        $this->schemaSetupInterface = $schemaSetupInterface;

        $this->schemaSetupInterface->startSetup();

        $moduleContextInterface;

        $this->schemaSetupInterface->endSetup();
    }
}
