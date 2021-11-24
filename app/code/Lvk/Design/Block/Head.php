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

namespace Lvk\Design\Block;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Template\Context;
use Lvk\Design\Observer\Admin\System\Config\Changed\Section\Design;

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
class Head extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Lvk\Design\Helper\Data
     */
    protected $designHelper;

    /**
     * Head constructor.
     * @param Context $context
     * @param \Lvk\Design\Helper\Data $designHelper
     * @param array $data
     */
    public function __construct(
        Context $context,
        \Lvk\Design\Helper\Data $designHelper,
        array $data = []
    ) {
        $this->store = $context->getStoreManager()->getStore();

        $this->designHelper = $designHelper;

        parent::__construct($context, $data);

        $this->setData('helper', $this->designHelper);
    }

    /**
     * Copyright © 2021 Bertozzi Matteo
     *
     * PHP Version 5
     *
     * @param string $type ATM [link|script]
     * @param array  $data associative array of tag attributes
     *
     * @return string
     */
    public function addTag($type, array $data = [])
    {
        $attributes = '';

        foreach ($data as $id => $value) {

            $attributes .= ' ' . $id . '="' . $value . '"';
        }

        $data = '<' . $type . $attributes;

        if ($type == 'script') {

            return $data . '></' . $type . '>';
        }

        return $data . ' />';
    }

    /**
     * Copyright © 2021 Bertozzi Matteo
     *
     * PHP Version 5
     *
     * @return string
     */
    public function getStoreCode() {

        return $this->store->getCode();
    }

    /**
     * Copyright © 2021 Bertozzi Matteo
     *
     * PHP Version 5
     *
     * @return string
     */
    public function getStylesUrl() {

        return $this->store->getBaseUrl(UrlInterface::URL_TYPE_MEDIA)
             . Design::STYLES_DIR
             . '/' . $this->store->getWebsiteId()
             . '/' . $this->store->getGroupId()
             . '/' . $this->store->getId()
             . '/' . Design::STYLES_FILE;
    }
}
