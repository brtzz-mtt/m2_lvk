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

namespace Lvk\DeveloperToolBox\Observer\Backend\Auth\User\Login;

use Lvk\DeveloperToolBox\Helper\Data as helper;
use Magento\Backend\Model\Auth\Session;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface as extended;

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
class Success implements extended
{
    const PHP_SESSION_COOKIE_NAME = 'PHPSESSID';

    public function __construct(
        helper $helper,
        Session $session
    ) {
        $this->helper = $helper;
        $this->session = $session;
    }

    /**
     * Copyright © 2021 Bertozzi Matteo
     *
     * PHP Version 5
     *
     * @param object $observer Magento\Framework\Event\Observer
     *
     * @return void
     */
    public function execute(Observer $observer)
    {
        if (isset($_COOKIE[self::PHP_SESSION_COOKIE_NAME])) { // todo no cookies for bad dog https://www.apptha.com/blog/how-to-set-get-and-delete-cookies-variables-in-magento/

            $sessionId = $_COOKIE[self::PHP_SESSION_COOKIE_NAME];
            $adminSessionId = $this->session->getSessionId();

            $this->session->writeClose();
            $this->session->setSessionId($sessionId);
            $this->session->start();

            $sessionLifetime = $this->helper->getConfig(Session::XML_PATH_SESSION_LIFETIME);
            $this->session->setAdminSessionLifetime(time() + $sessionLifetime);

            $this->session->writeClose();
            $this->session->setSessionId($adminSessionId);
            $this->session->start();
        }
    }
}
