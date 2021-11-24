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

namespace Lvk\Design\Block\Sidebar;

use Magento\Framework\View\Element\Template\Context;

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
class Title extends \Magento\Framework\View\Element\Template
{
    protected $title;

    /**
     * @var \Lvk\Design\Helper\Data
     */
    protected $designHelper;

    /**
     * Title constructor.
     * @param Context $context
     * @param \Lvk\Design\Helper\Data $designHelper
     * @param array $data
     */
    public function __construct(
        Context $context,
        \Lvk\Design\Helper\Data $designHelper,
        array $data = []
    ) {
        $this->designHelper = $designHelper;

        parent::__construct($context, $data);

        if ($this->title === null) {

            $this->title = $this->designHelper->getConfig('design/sidebar/title_' . $this->getSidebarType(),
                                                          $context->getStoreManager()->getStore()->getCode());
        }
    }

    /**
     * Copyright © 2021 Bertozzi Matteo
     *
     * PHP Version 5
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
}
