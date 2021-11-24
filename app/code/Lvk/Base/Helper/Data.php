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
namespace Lvk\Base\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
    /**
     * Magento 2 base Module | helper method
     *
     * @param $path  string
     * @param $codid mixed
     *
     * @return mixed
     */
    public function getConfig($path, $codid = null)
    {
        return $this->scopeConfig->getValue($path, ScopeInterface::SCOPE_STORE, $codid);
    }

    /**
     * Magento 2 base Module | helper method
     *
     * @return bool
     */
    public function getConfigLogConfigChanges()
    {
        return $this->getConfig('lvk_base/base_features/log_config_changes');
    }

    /**
     * Magento 2 base Module | helper method
     *
     * @return bool
     */
    public function getConfigSuppressVersionTooHighErrors()
    {
        return $this->getConfig('lvk_base/base_features/suppress_version_too_high_errors');
    }

    /**
     * Magento 2 base Module | helper method
     *
     * @return bool
     */
    public function getConfigSuppressVersionTooLowErrors()
    {
        return $this->getConfig('lvk_base/base_features/suppress_version_too_low_errors');
    }

    /**
     * Magento 2 base Module | helper method
     *
     * @param $array array
     *
     * @return array
     */
    public function toOptionArray($array)
    {
        $data = [];

        foreach ($array as $key => $value) {
            $data[] = [
                'value' => $key,
                'label' => $value,
            ];
        }

        return $data;
    }
}
