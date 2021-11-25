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

namespace Lvk\GoogleFonts\Controller\Font;

use Lvk\GoogleFonts\Model\Api;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;

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
class Get extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Lvk\GoogleFonts\Helper\Data
     */
    protected $googleFontsHelper;

    /**
     * @var JsonFactory
     */
    protected $jsonFactory;

    /**
     * @var Api
     */
    protected $api;

    /**
     * Get constructor.
     * @param Context $context
     * @param JsonFactory $jsonFactory
     * @param \Lvk\GoogleFonts\Helper\Data $googleFontsHelper
     * @param Api $api
     */
    public function __construct(
        Context $context,
        JsonFactory $jsonFactory,
        \Lvk\GoogleFonts\Helper\Data $googleFontsHelper,
        Api $api,
        \Magento\Store\Model\StoreManagerInterface $storeManagerInterface,
        \Magento\Store\Model\StoreResolver $storeResolver
    ) {
        $store = $storeManagerInterface->getStore($storeResolver->getCurrentStoreId());

        $this->jsonFactory = $jsonFactory;
        $this->googleFontsHelper = $googleFontsHelper;
        $this->api = $api;

        if ($apiKey = $googleFontsHelper->getConfig('lvk_googlefonts/credentials/api_key', $store->getCode())) {

            $this->api->setApiKey($apiKey);
        }

        parent::__construct($context);
    }

    /**
     * Copyright © 2021 Bertozzi Matteo
     *
     * PHP Version 5
     *
     * @return object
     */
    public function execute()
    {
        $json = $this->jsonFactory->create();

        $this->params = $this->getRequest()->getParams();

        $fontVariants = $this->api->getFontVariants($this->params['font_family']);

        return $json->setData($fontVariants);
    }
}
