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
class SizeOptions extends \Lvk\Base\Model\Config\Source
{
    const SIZE_AUTO = false;
    const SIZE_CONTAIN = 'contain';
    const SIZE_COVER = 'cover';
    const SIZE_INHERIT = 'inherit';
    const SIZE_INITIAL = 'initial';
    const SIZE_CUSTOM = true;

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
            self::SIZE_AUTO => __("auto"),
            self::SIZE_CONTAIN => __("contain"),
            self::SIZE_COVER => __("cover"),
            self::SIZE_INHERIT => __("inherit"),
            self::SIZE_INITIAL => __("initial"),
            self::SIZE_CUSTOM => __("custom.."),
        ];
    }
}
