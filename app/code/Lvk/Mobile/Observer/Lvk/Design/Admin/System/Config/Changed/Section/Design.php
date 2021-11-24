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

namespace Lvk\Mobile\Observer\Lvk\Design\Admin\System\Config\Changed\Section;

use Magento\Framework\Event\Observer;

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
class Design extends \Lvk\Design\Observer\Admin\System\Config\Changed\Section\Design
{
    /**
     * Copyright © 2021 Bertozzi Matteo
     *
     * PHP Version 5
     *
     * @param Observer $observer
     *
     * @return void
     */
    public function execute(Observer $observer)
    {
        $data = '';

        if ($this->designHelper->getConfig('design/mobile/navigation_direction',
                                           $observer->getStoreCode())) {

            $data .= '.nav-open .page-wrapper {' . self::EOL
                   . '    left: 0 !important;' . self::EOL
                   . '    right: 80%;' . self::EOL
                   . '    right: calc(100% - 54px);' . self::EOL
                   . '}' . self::EOL
                   . '.nav-sections {' . self::EOL
                   . '    -webkit-transition: right .3s !important;' . self::EOL
                   . '    -moz-transition: right .3s !important;' . self::EOL
                   . '    -ms-transition: right .3s !important;' . self::EOL
                   . '    transition: right .3s !important;' . self::EOL
                   . '    right: -80% !important;' . self::EOL
                   . '    right: calc(-1 * (100% - 54px)) !important;' . self::EOL
                   . '}' . self::EOL
                   . '.nav-open .nav-sections {' . self::EOL
                   . '    left: auto !important;' . self::EOL
                   . '    right: 0 !important;' . self::EOL
                   . '}' . self::EOL;
        }

        if ($this->designHelper->getConfig('design/mobile/modal_sidebars',
                                           $observer->getStoreCode())) {

            $data .= '@media only screen and (max-width: 768px) {' . self::EOL
                   . '    .sidebar.title {' . self::EOL
                   . '        cursor: pointer;' . self::EOL
                   . '    }' . self::EOL
                   . '    .sidebar.title + .sidebar {' . self::EOL
                   . '        display: none;' . self::EOL
                   . '    }' . self::EOL
                   . '}' . self::EOL;
        }

        $this->stylesFile = $observer->getStylesFile();

        $this->write($data);
    }
}
