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

namespace Lvk\GoogleFonts\Model\Config\Source;

use Lvk\GoogleFonts\Model\Api;

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
class FontOptions extends \Lvk\Base\Model\Config\Source
{

    /**
     * @var \Lvk\GoogleFonts\Helper\Data
     */
    protected $googleFontsHelper;

    /**
     * @var Api
     */
    protected $api;

    /**
     * FontOptions constructor.
     * @param \Lvk\GoogleFonts\Helper\Data $googleFontsHelper
     * @param Api $api
     */
    public function __construct(
        \Lvk\Base\Helper\Data $baseHelper,
        \Magento\Store\Model\StoreManagerInterface $storeManagerInterface,
        \Magento\Store\Model\StoreResolver $storeResolver,
        \Lvk\GoogleFonts\Helper\Data $googleFontsHelper,
        Api $api
    ) {
        $this->googleFontsHelper = $googleFontsHelper;

        $this->api = $api;

        parent::__construct($baseHelper, $storeManagerInterface, $storeResolver);
    }

    /**
     * Copyright © 2021 Bertozzi Matteo
     *
     * PHP Version 5
     *
     * @return array
     */
    public function toArray()
    {
        $data = [];

        if (($response = $this->api->call()) && isset($response->items)) {

            foreach ($response->items as $key => $item) {

                if ($item->family == 'Open Sans') { // excludes default family

                    continue;
                }

                $data[$item->family] = $item->family . " (" . $item->category . ") "
                                     . implode($item->variants, " | ");
            }
        }

        return $data;
    }
}
