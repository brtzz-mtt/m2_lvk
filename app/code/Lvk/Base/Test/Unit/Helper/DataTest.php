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
namespace Lvk\Base\Unit\Test\Helper;

use Lvk\Base\Helper\Data;
use Lvk\Base\Helper\Unit;
use Magento\Framework\App\Config\ScopeConfigInterface;

class DataTest extends Unit
{
    protected $scopeConfigMock;

    /**
     * Magento 2 base Module | test setup
     *
     * @return void
     */
    protected function setUp():void
    {
        $this->scopeConfigMock = $this->getMockBuilder(ScopeConfigInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->scopeConfigMock
            ->method('getValue')
            ->will(
                $this->returnCallback(
                    function ($arg) {
                        return str_replace('/', '_', $arg);
                    }
                )
            );

        $arguments['scopeConfig'] = $this->scopeConfigMock;

        $this->object = parent::setSetUp(Data::class, $arguments);
    }

    /**
     * Magento 2 base Module | test method
     *
     * @return void
     */
    public function testGetConfig():void
    {
        $path = 'dummy/db/path';

        $expectedData = $this->scopeConfigMock->getValue($path);

        $data = $this->object->getConfig($path);

        $this->assertEquals($expectedData, $data);
    }

    /**
     * Magento 2 base Module | test method
     *
     * @return void
     */
    public function testGetConfigLogConfigChanges():void
    {
        $expectedData = $this->object->getConfig('lvk_base/base_features/log_config_changes');

        $data = $this->object->getConfigLogConfigChanges();

        $this->assertEquals($expectedData, $data);
    }

    /**
     * Magento 2 base Module | test method
     *
     * @return void
     */
    public function testGetConfigSuppressVersionTooHighErrors()
    {
        $expectedData = $this->object->getConfig('lvk_base/base_features/suppress_version_too_high_errors');

        $data = $this->object->getConfigSuppressVersionTooHighErrors();

        $this->assertEquals($expectedData, $data);
    }

    /**
     * Magento 2 base Module | test method
     *
     * @return void
     */
    public function testGetConfigSuppressVersionTooLowErrors()
    {
        $expectedData = $this->object->getConfig('lvk_base/base_features/suppress_version_too_low_errors');

        $data = $this->object->getConfigSuppressVersionTooLowErrors();

        $this->assertEquals($expectedData, $data);
    }

    /**
     * Magento 2 base Module | test method
     *
     * @return void
     */
    public function testToOptionArray():void
    {
        $expectedData = Unit::$expectedDataArray;

        $data = $this->object->toOptionArray(Unit::$dataArray);

        $this->assertEquals($expectedData, $data);
    }
}
