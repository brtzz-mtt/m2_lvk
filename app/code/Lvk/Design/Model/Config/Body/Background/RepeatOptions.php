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

namespace Lvk\Design\Model\Config\Body\Background;

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
class RepeatOptions extends \Lvk\Base\Model\Config\Source
{
    const REPEAT_AUTO = false;
    const REPEAT_X = 'repeat-x';
    const REPEAT_Y = 'repeat-y';
    const REPEAT_NO = 'no-repeat';
    const REPEAT_INHERIT = 'inherit';
    const REPEAT_INITIAL = 'initial';

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
            self::REPEAT_AUTO => __("auto"),
            self::REPEAT_X => __("repeat horizontally"),
            self::REPEAT_Y => __("repeat vertically"),
            self::REPEAT_NO => __("don't repeat"),
            self::REPEAT_INHERIT => __("inherit"),
            self::REPEAT_INITIAL => __("initial"),
        ];
    }
}
