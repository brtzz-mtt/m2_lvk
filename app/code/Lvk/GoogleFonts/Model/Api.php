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

namespace Lvk\GoogleFonts\Model;

use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\HTTP\Client\Curl;
use Magento\Framework\Model\Context;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Registry;

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
class Api extends \Magento\Framework\Model\AbstractModel
{
    const API_URL = 'https://www.googleapis.com/webfonts/v1/webfonts';
    const CSS_URL = 'https://fonts.googleapis.com/css?family=';
    const IWAYS_CACHE_CALL = 'lvk_googlefonts_api_call_response';

    /**
     * @var string
     */
    protected $apiUrl;

    /**
     * @var Curl
     */
    protected $curl;

    /**
     * @var \Lvk\Base\Model\Cache
     */
    protected $lvkCache;

    /**
     * Api constructor.
     * @param Context $context
     * @param Registry $registry
     * @param Curl $curl
     * @param \Lvk\Base\Model\Cache $lvkCache
     * @param AbstractResource|null $abstractResource
     * @param AbstractDb|null $abstractDb
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        Curl $curl,
        \Lvk\Base\Model\Cache $lvkCache,
        AbstractResource $abstractResource = null,
        AbstractDb $abstractDb = null,
        array $data = []
    ) {
        $this->apiUrl = self::API_URL;

        $this->curl = $curl;

        $this->lvkCache = $lvkCache;

        parent::__construct(
            $context,
            $registry,
            $abstractResource,
            $abstractDb,
            $data
        );
    }

    /**
     * Copyright © 2021 Bertozzi Matteo
     *
     * PHP Version 5
     *
     * @return mixed
     */
    public function call()
    {
        $cachedCall = $this->lvkCache->load(self::IWAYS_CACHE_CALL);

        if (!$response = unserialize($cachedCall)) {

            $this->curl->get($this->apiUrl);
            $response = $this->curl->getBody();

            $response = json_decode($response);

            if (($this->curl->getStatus() != 200) && isset($response->error)) {

                return '<font color="red">ERROR ' . $response->error->code . ': '
                     . $response->error->message . '</font>';
            }

            $this->lvkCache->save(
                serialize($response),
                self::IWAYS_CACHE_CALL,
                [\Lvk\Base\Model\Cache::CACHE_TAG],
                86400
            );
        }

        return $response;
    }

    /**
     * Copyright © 2021 Bertozzi Matteo
     *
     * PHP Version 5
     *
     * @param string $fontFamily a googlefonts valid font family
     *
     * @return bool
     */
    public function getFontByFamily($fontFamily)
    {
        foreach ($this->call()->items as $item) {

            if ($item->family == $fontFamily) {

                return $item;
            }
        }

        return false;
    }

    /**
     * Copyright © 2021 Bertozzi Matteo
     *
     * PHP Version 5
     *
     * @param string $fontFamily   a googlefonts valid font family
     * @param array  $fontVariants an array with valid googlefonts variant items
     *
     * @return string
     */
    public function getFontCss($fontFamily, $fontVariants = [])
    {
        $cssUrl = SELF::CSS_URL . $fontFamily;

        if ($fontVariants) {

            $cssUrl .= ':' . implode($fontVariants, ',');
        }

        $this->curl->get($cssUrl);
        $response = $this->curl->getBody();

        if ($this->curl->getStatus() != 200) {

            return false;
        }

        return $response;
    }

    /**
     * Copyright © 2021 Bertozzi Matteo
     *
     * PHP Version 5
     *
     * @param string $fontFamily a googlefonts valid font family
     *
     * @return array
     */
    public function getFontVariants($fontFamily)
    {
        $output = [];

        foreach ($this->getFontByFamily($fontFamily)->variants as $variant) {

            if ($variant == 'regular') {

                $variant = '400';

            } elseif ($variant == 'italic') {

                $variant = '400italic';
            }

            $key = str_replace('italic', 'i', $variant);

            $output[$key] = str_replace('italic', ' italic', $variant);
        }

        return $output;
    }

    /**
     * Copyright © 2021 Bertozzi Matteo
     *
     * PHP Version 5
     *
     * @param string $apiKey a googlefonts valid API key
     *
     * @return $this
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;

        if ($this->apiKey) {

            $this->apiUrl .= '?key=' . $this->apiKey;
        }

        return $this;
    }

    /**
     * Copyright © 2021 Bertozzi Matteo
     *
     * PHP Version 5
     *
     * @return string
     */
    public function test()
    {
        $data = $this->call();

        return is_string($data)
               ? $data
               : $data->kind . " " . __("is working") . ": "
             . count($data->items) . " " . __("different fonts found") . ".";
    }
}
