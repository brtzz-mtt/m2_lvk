<?php

/**
 * Copyright © 2021 Bertozzi Matteo
 *
 * PHP Version 5
 *
 * @category File
 * @package  Lvk_GoogleFonts
 * @author   Bertozzi Matteo <brtzz.mtt@gmail.com>
 * @license  The PHP License, Version 3.0 - PHP.net (http://php.net/license/3_0.txt)
 * @link     https://github.com/brtzz-mtt
 */

namespace Lvk\GoogleFonts\Model\Admin\Design\Config\Font;

/**
 * Copyright © 2021 Bertozzi Matteo
 *
 * PHP Version 5
 *
 * @category Class
 * @package  Lvk_GoogleFonts
 * @author   Bertozzi Matteo <brtzz.mtt@gmail.com>
 * @license  The PHP License, Version 3.0 - PHP.net (http://php.net/license/3_0.txt)
 * @link     https://github.com/brtzz-mtt
 */
class FamilyOptions extends \Lvk\Base\Model\Config\Source
{
    const FAMILY_DEFAULT = 'Open+Sans';
    const DEFAULT_LABEL = "Open Sans, Helvetica Neue, Helvetica, Arial, sans-serif";

    /**
     * Copyright © 2021 Bertozzi Matteo
     *
     * PHP Version 5
     *
     * @return array
     */
    public function toArray()
    {
        $data = [
            self::FAMILY_DEFAULT => __("default") . " (" . self::DEFAULT_LABEL . ")"
        ];

        $activeFonts = $this->baseHelper->getConfig('lvk_googlefonts/settings/active_fonts', $this->getStoreCode());

        foreach (explode(",", $activeFonts) as $label) {

            $value = preg_replace('/ /', "+", $label);

            $data[$value] = $label;
        }

        return $data;
    }
}
