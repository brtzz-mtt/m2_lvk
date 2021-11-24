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
class Styleguide extends \Magento\Framework\View\Element\Template
{
    /**
     * Styleguide constructor.
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

        $this->setData('helper', $this->designHelper);
    }
}
