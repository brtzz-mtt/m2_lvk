<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com and you will be sent a copy immediately.
 *
 * PHP version 7.3.17
 *
 * @category Modules
 * @package  Magento
 * @author   Bertozzi Matteo <brtzz.mtt@gmail.com>
 * @license  http://opensource.org/licenses/osl-3.0.php Open Software License 3.0
 * @link     https://github.com/brtzz-mtt
 */
namespace Lvk\Base\Plugin\Magento\Config\Model;

use Lvk\Base\Helper\Data as Helper;
use Lvk\Base\Rewrite\Monolog\LoggerOverride as Logger;
use Magento\Backend\Model\Auth\Session;
use Magento\Config\Model\Config;

class ConfigInterceptor
{
    protected $helper; // phpcs:ignore PSR2.Classes.PropertyDeclaration
    protected $logger; // phpcs:ignore PSR2.Classes.PropertyDeclaration
    protected $session; // phpcs:ignore PSR2.Classes.PropertyDeclaration

    /**
     * Magento 2 base Module | class constructor
     *
     * @param $helper  Lvk\Base\Helper\Data
     * @param $logger  Lvk\Base\Rewrite\Monolog\LoggerOverride as Logger
     * @param $session Magento\Backend\Model\Auth\Session
     *
     * @return void
     */
    public function __construct(
        Helper $helper,
        Logger $logger,
        Session $session
    ) {
        $this->helper = $helper;
        $this->logger = $logger;
        $this->session = $session;
    }

    /**
     * Magento 2 base module | around interceptor
     *
     * @param $subject Magento\Config\Model\Config
     * @param $proceed Closure
     *
     * @return void
     */
    public function aroundSave(
        Config $subject,
        callable $proceed
    ) {
        if ($this->helper->getConfigLogConfigChanges()) {
            if ($backendUser = $this->getBackendUser()) {
                $info = "User '" . $backendUser->getUsername() . "' "
                      . "(" . $backendUser->getEmail() . ") "
                      . "saved '" . $subject->getSection() . "' configuration!";
                $this->logger->info($info);
            }
        }

        return $proceed();
    }

    /**
     * Magento 2 base module | getBackendUser method
     *
     * @return Magento\User\Model\User
     */
    protected function getBackendUser()
    {
        return $this->session->getUser();
    }
}
