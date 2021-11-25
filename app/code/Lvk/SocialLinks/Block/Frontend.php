<?php

/**
 * Copyright © 2021 Bertozzi Matteo
 *
 * PHP Version 5
 *
 * @category File
 * @package  Lvk_SocialLinks
 * @author   Bertozzi Matteo <brtzz.mtt@gmail.com>
 * @license  The PHP License, Version 3.0 - PHP.net (http://php.net/license/3_0.txt)
 * @link     https://github.com/brtzz-mtt
 */

namespace Lvk\SocialLinks\Block;

use Magento\Framework\View\Element\Template\Context;

/**
 * Copyright © 2021 Bertozzi Matteo
 *
 * PHP Version 5
 *
 * @category Class
 * @package  Lvk_SocialLinks
 * @author   Bertozzi Matteo <brtzz.mtt@gmail.com>
 * @license  The PHP License, Version 3.0 - PHP.net (http://php.net/license/3_0.txt)
 * @link     https://github.com/brtzz-mtt
 */
class Frontend extends \Magento\Framework\View\Element\Template
{
    protected $activeSocialNetworks;
    protected $blockTitle;
    protected $linkAspect;

    /**
     * @var \Lvk\SocialLinks\Helper\Data
     */
    protected $socialLinksHelper;

    /**
     * Frontend constructor.
     * @param Context $context
     * @param \Lvk\SocialLinks\Helper\Data $socialLinksHelper
     * @param array $data
     */
    public function __construct(
        Context $context,
        \Lvk\SocialLinks\Helper\Data $socialLinksHelper,
        array $data = []
    ) {
        $this->store = $context->getStoreManager()->getStore();

        $this->socialLinksHelper = $socialLinksHelper;

        if ($this->linkAspect === null) {

            $this->linkAspect = $this->socialLinksHelper->getConfig('lvk_sociallinks/frontend/link_aspect', $this->store->getCode());
        }

        if ($this->blockTitle === null) {

            $this->blockTitle = $this->socialLinksHelper->getConfig('lvk_sociallinks/frontend/block_title', $this->store->getCode());
        }

        if ($this->activeSocialNetworks === null) {

            $config = $this->socialLinksHelper->getConfig('lvk_sociallinks/social_networks/active_links', $this->store->getCode());

            $this->activeSocialNetworks = explode(",", $config);
        }

        parent::__construct($context, $data);
    }

    /**
     * Copyright © 2021 Bertozzi Matteo
     *
     * PHP Version 5
     *
     * @return string
     */
    public function getBlockTitle()
    {
        return $this->blockTitle;
    }

    /**
     * Copyright © 2021 Bertozzi Matteo
     *
     * PHP Version 5
     *
     * @return array
     */
    public function getSocialLinks() // assumes active font-awesome support on frontend
    {
        $data = [];

        foreach ($this->activeSocialNetworks as $key) {

            if ($url = $this->socialLinksHelper->getConfig('lvk_sociallinks/social_networks/' . $key . '_url', $this->store->getCode())) {

                $name = \Lvk\SocialLinks\Helper\Data::$socialNetworks[$key];

                $label = $this->linkAspect == 'icons'
                         ? '<i class="fa fa-' . $key . '" title="' . $name . '"></i>'
                         : $name;

                $data[$key] = [
                    'label' => $label,
                    'url' => $url,
                ];
            }
        }

        return $data;
    }
}
