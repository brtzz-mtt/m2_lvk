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
class AttachmentOptions extends \Lvk\Base\Model\Config\Source
{
    const ATTACHMENT_FIXED = 'fixed';
    const ATTACHMENT_INHERIT = 'inherit';
    const ATTACHMENT_INITIAL = 'initial';
    const ATTACHMENT_LOCAL = 'local';
    const ATTACHMENT_SCROLL = false;

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
            self::ATTACHMENT_FIXED => __("fixed"),
            self::ATTACHMENT_INHERIT => __("inherit"),
            self::ATTACHMENT_INITIAL => __("initial"),
            self::ATTACHMENT_LOCAL => __("local"),
            self::ATTACHMENT_SCROLL => __("scroll"),
        ];
    }
}
