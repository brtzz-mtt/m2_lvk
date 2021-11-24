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

use PHPUnit\Framework\TestCase;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;

class Unit extends TestCase
{
    protected $className;
    protected $object;

    protected static $dataArray = [
        1 => "first value",
        2 => "second value",
        'key' => "value",
        "value"
    ];

    protected static $expectedDataArray = [
        [
            'value' => 1,
            'label' => "first value"
        ],
        [
            'value' => 2,
            'label' => "second value"
        ],
        [
            'value' => "key",
            'label' => "value"
        ],
        [
            'value' => 3, // numeric key was assigned automatically as value also, starting from null..
            'label' => "value"
        ]
    ];

    /**
     * Magento 2 base Module | helper method
     *
     * @param $className  string
     * @param $methodName string
     *
     * @return void
     */
    protected static function getMethod($className, $methodName) // phpcs:ignore Magento2.Functions.StaticFunction.StaticFunction,Generic.Files.LineLength.TooLong
    {
        $class = new \ReflectionClass($className);
        $method = $class->getMethod($methodName);
        $method->setAccessible(true);

        return $method;
    }

    /**
     * Magento 2 base Module | helper method
     *
     * @param $className    string
     * @param $propertyName string
     *
     * @return void
     */
    protected static function getProperty($className, $propertyName) // phpcs:ignore Magento2.Functions.StaticFunction.StaticFunction,Generic.Files.LineLength.TooLong
    {
        $class = new \ReflectionClass($className);
        $property = $class->getProperty($propertyName);
        $property->setAccessible(true);

        return $property;
    }

    /**
     * Magento 2 base Module | helper method
     *
     * @param $className string
     * @param $arguments array
     *
     * @return obj
     */
    protected function setSetUp($className, $arguments = [])
    {
        $objectManager = new ObjectManager($this);
        $constructArguments = $objectManager->getConstructArguments($className);

        return $objectManager->getObject($className, array_merge($constructArguments, $arguments));
    }
}
