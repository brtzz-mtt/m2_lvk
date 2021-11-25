<?php

/**
 * Copyright © 2021 Bertozzi Matteo
 *
 * PHP Version 5
 *
 * @category File
 * @package  Lvk_CategoryTree
 * @author   Bertozzi Matteo <brtzz.mtt@gmail.com>
 * @license  The PHP License, Version 3.0 - PHP.net (http://php.net/license/3_0.txt)
 * @link     https://github.com/brtzz-mtt
 */

namespace Lvk\CategoryTree\Block\Frontend;

use Lvk\CategoryTree\Model\Config\Source\RootOptions;

/**
 * Copyright © 2021 Bertozzi Matteo
 *
 * PHP Version 5
 *
 * @category Class
 * @package  Lvk_CategoryTree
 * @author   Bertozzi Matteo <brtzz.mtt@gmail.com>
 * @license  The PHP License, Version 3.0 - PHP.net (http://php.net/license/3_0.txt)
 * @link     https://github.com/brtzz-mtt
 */
class Widget
    extends \Lvk\CategoryTree\Block\Frontend
    implements \Magento\Widget\Block\BlockInterface
{
    /**
     * Internal constructor, that is called from real constructor
     * @return void
     */
    protected function _construct()
    {
        $this->blockTitle = $this->getBlockTitle();

        $this->treeRoot = $this->getTreeRoot();
        if ($this->treeRoot == RootOptions::ROOT_USE_CUSTOM_CATEGORY) {
            $this->customRoot = $this->getCustomRoot();
        }

        $this->treeDepth = $this->getTreeDepth();

        $this->showEmpty = $this->getShowEmpty();
    }
}
