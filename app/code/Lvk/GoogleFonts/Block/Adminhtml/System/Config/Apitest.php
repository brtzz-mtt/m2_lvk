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

namespace Lvk\GoogleFonts\Block\Adminhtml\System\Config;

use Lvk\GoogleFonts\Model\Api;
use Magento\Framework\Data\Form\Element\AbstractElement;

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
class Apitest extends \Magento\Config\Block\System\Config\Form\Field
{

    /**
     * @var \Lvk\GoogleFonts\Helper\Data
     */
    protected $googleFontsHelper;

    /**
     * @var Api|object
     */
    protected $api;

    /**
     * Apitest constructor.
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Lvk\GoogleFonts\Helper\Data $googleFontsHelper
     * @param Api $api
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Lvk\GoogleFonts\Helper\Data $googleFontsHelper,
        Api $api,
        \Magento\Store\Model\StoreManagerInterface $storeManagerInterface,
        \Magento\Store\Model\StoreResolver $storeResolver,
        array $data = []
    ) {
        $store = $storeManagerInterface->getStore($storeResolver->getCurrentStoreId());

        $this->googleFontsHelper = $googleFontsHelper;

        $this->api = $api;

        if ($apiKey = $this->googleFontsHelper->getConfig('lvk_googlefonts/credentials/api_key', $store->getCode())) {

            $this->api->setApiKey($apiKey);
        }

        parent::__construct($context, $data);
    }

    /**
     * Get Element Html
     * @param AbstractElement $element
     * @return string
     */
    protected function _getElementHtml(AbstractElement $element)
    {
        $this->addData(['test' => $this->api->test()]);

        $element->setValue($this->api->test());

        return $this->toHtml();
    }

    /**
     * @return $this
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();

        if (!$this->getTemplate()) {

            $this->setTemplate('system/config/apitest.phtml');
        }

        return $this;
    }


}
