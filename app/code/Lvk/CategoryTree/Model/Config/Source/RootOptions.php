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

namespace Lvk\CategoryTree\Model\Config\Source;

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
class RootOptions extends \Lvk\Base\Model\Config\Source
{
    const ROOT_USE_STORE_ROOT = 0;
    const ROOT_USE_CURRENT_CATEGORY = 1;
    const ROOT_USE_PRODUCT_CATEGORY = 2;
    const ROOT_USE_CUSTOM_CATEGORY = 3;

    /**
     * Copyright © 2021 Bertozzi Matteo
     *
     * PHP Version 5
     *
     * @return array
     */
    public function toArray()
    {
        return [
            self::ROOT_USE_STORE_ROOT => __("use store root"),
            self::ROOT_USE_CURRENT_CATEGORY => __("use current category")
                                             . " (" . __("if available") . ")",
            self::ROOT_USE_PRODUCT_CATEGORY => __("use current product's category")
                                             . " (" . __("if available") . ")",
            self::ROOT_USE_CUSTOM_CATEGORY => __("custom category"),
        ];
    }
}
