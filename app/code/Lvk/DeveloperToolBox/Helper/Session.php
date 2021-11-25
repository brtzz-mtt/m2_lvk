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

namespace Lvk\DeveloperToolBox\Helper;

use Magento\Backend\Model\Auth\Session as model;
use Magento\Framework\App\Helper\AbstractHelper as extended;
use Magento\Framework\App\Helper\Context;

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
class Session extends extended
{
    public function __construct(
        Context $context,
        model $session
    ) {
        $this->session = $session;

        parent::__construct($context);
    }

    /**
     * Copyright © 2021 Bertozzi Matteo
     *
     * PHP Version 5
     *
     * @return boolean
     */
    public function isAdminLogged()
    {
        return $this->session->getAdminSessionLifetime() > time();
    }
}
