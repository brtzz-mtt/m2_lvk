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
namespace Lvk\Base\Rewrite\Magento\Framework\Module\Plugin;

use Lvk\Base\Helper\Data as Helper;
use Magento\Framework\App\FrontController;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Cache\FrontendInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Module\DbVersionInfo;
use Magento\Framework\Module\Plugin\DbStatusValidator;
use Magento\Framework\Phrase;

class DbStatusValidatorOverride extends DbStatusValidator
{
    private $cache;
    private $dbVersionInfo;

    protected $helper;

    /**
     * Magento 2 base Module | class constructor
     *
     * @param $cache         Magento\Framework\Cache\FrontendInterface
     * @param $dbVersionInfo Magento\Framework\Module\DbVersionInfo
     * @param $helper        Lvk\Base\Helper\Data
     *
     * @return void
     */
    public function __construct(
        FrontendInterface $cache,
        DbVersionInfo $dbVersionInfo,
        Helper $helper
    ) {
        $this->cache = $cache;
        $this->dbVersionInfo = $dbVersionInfo;
        $this->helper = $helper;
    }

    /**
     * Magento 2 base Module | beforeDispatch method
     *
     * @param $subject Magento\Framework\App\FrontController
     * @param $request Magento\Framework\App\RequestInterface
     *
     * @return void
     *
     * @throws Magento\Framework\Exception\LocalizedException
     */
    public function beforeDispatch(FrontController $subject, RequestInterface $request)
    {
        if (!$this->cache->load('db_is_up_to_date')) {
            list($versionTooLowErrors, $versionTooHighErrors) = array_values($this->getGroupedDbVersionErrors());
            if ($versionTooHighErrors) {
                $message = 'Please update your modules: '
                    . "Run \"composer install\" from the Magento root directory.\n"
                    . "The following modules are outdated:\n%1";
                if (!$this->helper->getConfigSuppressVersionTooHighErrors()) {
                    throw new LocalizedException(
                        new Phrase($message, [implode("\n", $this->formatVersionTooHighErrors($versionTooHighErrors))])
                    );
                }
            } elseif ($versionTooLowErrors) {
                $message = 'Please upgrade your database: '
                    . "Run \"bin/magento setup:upgrade\" from the Magento root directory.\n"
                    . "The following modules are outdated:\n%1";
                if (!$this->helper->getConfigSuppressVersionTooHighErrors()) {
                    throw new LocalizedException(
                        new Phrase($message, [implode("\n", $this->formatVersionTooLowErrors($versionTooLowErrors))])
                    );
                }
            } else {
                $this->cache->save('true', 'db_is_up_to_date');
            }
        }
    }

    /**
     * Magento 2 base Module | formatVersionTooLowErrors method
     *
     * @param $errorsData array
     *
     * @return array
     */
    private function formatVersionTooLowErrors($errorsData)
    {
        $formattedErrors = [];

        foreach ($errorsData as $error) {
            $formattedErrors[] = $error[DbVersionInfo::KEY_MODULE] . ' ' . $error[DbVersionInfo::KEY_TYPE]
                . ': current version - ' . $error[DbVersionInfo::KEY_CURRENT]
                . ', required version - ' . $error[DbVersionInfo::KEY_REQUIRED];
        }

        return $formattedErrors;
    }

    /**
     * Magento 2 base Module | formatVersionTooHighErrors method
     *
     * @param $errorsData array
     *
     * @return array
     */
    private function formatVersionTooHighErrors($errorsData)
    {
        $formattedErrors = [];
        foreach ($errorsData as $error) {
            $formattedErrors[] = $error[DbVersionInfo::KEY_MODULE] . ' ' . $error[DbVersionInfo::KEY_TYPE]
                . ': code version - ' . $error[DbVersionInfo::KEY_REQUIRED]
                . ', database version - ' . $error[DbVersionInfo::KEY_CURRENT];
        }

        return $formattedErrors;
    }

    /**
     * Magento 2 base Module | getGroupedDbVersionErrors method
     *
     * @return mixed
     */
    private function getGroupedDbVersionErrors()
    {
        $allDbVersionErrors = $this->dbVersionInfo->getDbVersionErrors();
        return array_reduce(
            (array)$allDbVersionErrors,
            function ($carry, $item) {
                if ($item[DbVersionInfo::KEY_CURRENT] === 'none'
                    || version_compare($item[DbVersionInfo::KEY_CURRENT], $item[DbVersionInfo::KEY_REQUIRED], '<')
                ) {
                    $carry['version_too_low'][] = $item;
                } else {
                    $carry['version_too_high'][] = $item;
                }
                return $carry;
            },
            [
                'version_too_low' => [],
                'version_too_high' => [],
            ]
        );
    }
}
