<?php

/**
 * Copyright © 2021 Bertozzi Matteo
 *
 * PHP Version 5
 *
 * @category File
 * @package  Lvk_Mobile
 * @author   Bertozzi Matteo <brtzz.mtt@gmail.com>
 * @license  The PHP License, Version 3.0 - PHP.net (http://php.net/license/3_0.txt)
 * @link     https://github.com/brtzz-mtt
 */

namespace Lvk\Mobile\Model\Admin\Design\Config\Mobile\Navigation;

/**
 * Copyright © 2021 Bertozzi Matteo
 *
 * PHP Version 5
 *
 * @category Class
 * @package  Lvk_Mobile
 * @author   Bertozzi Matteo <brtzz.mtt@gmail.com>
 * @license  The PHP License, Version 3.0 - PHP.net (http://php.net/license/3_0.txt)
 * @link     https://github.com/brtzz-mtt
 */
class DirectionOptions extends \Lvk\Base\Model\Config\Source
{
    const DIRECTION_LR = false;
    const DIRECTION_RL = true;

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
            self::DIRECTION_LR => __("from left to right") . " ⇉",
            self::DIRECTION_RL => __("from right to left") . " ⇇",
        ];
    }
}
