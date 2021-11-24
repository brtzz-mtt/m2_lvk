<?php

/**
 * Copyright © 2021 Bertozzi Matteo
 *
 * PHP Version 5
 *
 * @category File
 * @package  Lvk_Design
 * @author   Bertozzi Matteo <brtzz.mtt@gmail.com>
 * @license  The PHP License, Version 3.0 - PHP.net (http://php.net/license/3_0.txt)
 * @link     https://github.com/brtzz-mtt
 */

namespace Lvk\Design\Observer\Lvk\DeveloperToolBox\Block;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface as implemented;

/**
 * Copyright © 2021 Bertozzi Matteo
 *
 * PHP Version 5
 *
 * @category Class
 * @package  Lvk_Design
 * @author   Bertozzi Matteo <brtzz.mtt@gmail.com>
 * @license  The PHP License, Version 3.0 - PHP.net (http://php.net/license/3_0.txt)
 * @link     https://github.com/brtzz-mtt
 */
class Toolbar implements implemented
{
    /**
     * Copyright © 2021 Bertozzi Matteo
     *
     * PHP Version 5
     *
     * @param object $observer Magento\Framework\Event\Observer
     *
     * @return void
     */
    public function execute(Observer $observer)
    {
        $items = $observer->getItems();

        $items[] = [
            'label' => __("Styleguide"),
            'link' => "lvk_design/styleguide/index/",
        ];

        $items[] = [
            'label' => __("Responsivity"),
            'link' => "lvk_design/responsivity/index/",
        ];

        $observer->setItems($items);
    }
}
