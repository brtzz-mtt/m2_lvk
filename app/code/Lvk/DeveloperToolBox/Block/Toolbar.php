<?php

/**
 * Copyright © 2021 Bertozzi Matteo
 *
 * PHP Version 5
 *
 * @category File
 * @package  Lvk_DeveloperToolBox
 * @author   Bertozzi Matteo <brtzz.mtt@gmail.com>
 * @license  The PHP License, Version 3.0 - PHP.net (http://php.net/license/3_0.txt)
 * @link     https://github.com/brtzz-mtt
 */

namespace Lvk\DeveloperToolBox\Block;

use Lvk\DeveloperToolBox\Helper\Session as sessionHelper;
use Magento\Backend\Helper\Data as magentoBackendHelper;
use Magento\Framework\View\Element\Template as extended;
use Magento\Framework\View\Element\Template\Context;

/**
 * Copyright © 2021 Bertozzi Matteo
 *
 * PHP Version 5
 *
 * @category Class
 * @package  Lvk_DeveloperToolBox
 * @author   Bertozzi Matteo <brtzz.mtt@gmail.com>
 * @license  The PHP License, Version 3.0 - PHP.net (http://php.net/license/3_0.txt)
 * @link     https://github.com/brtzz-mtt
 */
class Toolbar extends extended
{
    public static $items = [
        [
            'label' => "Homepage",
            'link' => '',
        ],
    ];

    /**
     * Copyright © 2021 Bertozzi Matteo
     *
     * PHP Version 5
     *
     * @param object $context              Magento\Framework\View\Element\Template\Context
     * @param object $sessionHelper        Lvk\DeveloperToolBox\Helper\Session
     * $param object $magentoBackendHelper Magento\Backend\Helper\Data
     * @param array  $data                 object attributes
     */
    public function __construct(
        Context $context,
        sessionHelper $sessionHelper,
        magentoBackendHelper $magentoBackendHelper,
        array $data = []
    ) {
        $this->eventManager = $context->getEventManager();

        $this->eventManager->dispatch(
            'lvk_developertoolbox_block_toolbar',
            ['items' => &self::$items]
        );

        $this->sessionHelper = $sessionHelper;
        $this->magentoBackendHelper = $magentoBackendHelper;
        $this->urlInterface = $context->getUrlBuilder();

        parent::__construct($context, $data);

        $this->setData('sessionHelper', $this->sessionHelper);
    }

    /**
     * Copyright © 2021 Bertozzi Matteo
     *
     * PHP Version 5
     *
     * @return string
     */
    public function getAdminUri()
    {
        return $this->magentoBackendHelper->getHomePageUrl();
    }

    /**
     * Copyright © 2021 Bertozzi Matteo
     *
     * PHP Version 5
     *
     * @return string
     */
    public function getItemsHtml()
    {
        $data = '';

        $this->currentUrl = $this->urlInterface->getCurrentUrl();

        foreach (self::$items as $item) {

            $linkUrl = $this->urlInterface->getUrl() . $item['link'] ?: '';

            if ($linkUrl != $this->currentUrl) {
                $data .= '<span>'
                       . (isset($item['link'])
                         ? '<a href="' . $linkUrl . '">' . $item['label'] . '</a>'
                         : $item['label'])
                       . '</span>';
            }
        }

        return $data;
    }
}
