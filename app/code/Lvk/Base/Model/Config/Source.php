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
namespace Lvk\Base\Model\Config;

use Lvk\Base\Helper\Data;
use Magento\Framework\Option\ArrayInterface;

abstract class Source implements ArrayInterface
{
    protected $helper; // phpcs:ignore PSR2.Classes.PropertyDeclaration

    /**
     * Magento 2 base Module | class constructor
     *
     * @param $helper Lvk\Base\Helper\Data
     */
    public function __construct(
        Data $helper
    ) {
        $this->helper = $helper;
    }

    /**
     * Magento 2 base Module | abstract method
     *
     * @return array
     */
    abstract public function toArray();

    /**
     * Magento 2 base Module | helper lookup
     *
     * @return array
     */
    public function toOptionArray()
    {
        return $this->helper->toOptionArray($this->toArray());
    }
}
