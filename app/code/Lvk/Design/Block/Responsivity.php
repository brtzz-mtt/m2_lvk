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

use Magento\Framework\App\Response\RedirectInterface;
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
class Responsivity extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Lvk\Design\Helper\Data
     */
    protected $designHelper;

    /**
     * @var RedirectInterface
     */
    protected $redirectInterface;

    /**
     * Responsivity constructor.
     * @param Context $context
     * @param \Lvk\Design\Helper\Data $designHelper
     * @param RedirectInterface $redirectInterface
     * @param array $data
     */
    public function __construct(
        Context $context,
        \Lvk\Design\Helper\Data $designHelper,
        RedirectInterface $redirectInterface,
        array $data = []
    ) {
        $this->designHelper = $designHelper;

        $this->redirectInterface = $redirectInterface;

        parent::__construct($context, $data);

        $this->setData('helper', $this->designHelper);
    }

    /**
     * Copyright © 2021 Bertozzi Matteo
     *
     * PHP Version 5
     *
     * @return string
     */
    public function getUrlToResponsivize()
    {
        return $this->redirectInterface->getRedirectUrl();
    }
}
