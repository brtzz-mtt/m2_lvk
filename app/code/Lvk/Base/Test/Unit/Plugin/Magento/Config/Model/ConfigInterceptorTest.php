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
namespace Lvk\Base\Unit\Test\Plugin\Magento\Config\Model;

use Lvk\Base\Plugin\Magento\Config\Model\ConfigInterceptor;
use Lvk\Base\Helper\Data;
use Lvk\Base\Helper\Unit;
use Magento\Backend\Model\Auth\Session;
use Magento\Config\Model\Config;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use Magento\User\Model\User;

class ConfigInterceptorTest extends Unit
{
    protected $callableFunction;
    protected $configMock;
    protected $helperMock;
    protected $sessionMock;

    /**
     * Magento 2 base Module | test setup
     *
     * @return void
     */
    protected function setUp():void
    {
        $this->callableFunction = function () {
            return "dummyFunction";
        };

        $this->configMock = $this->getMockBuilder(Config::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->helperMock = $this->getMockBuilder(Data::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->helperMock->method('getConfigLogConfigChanges')
            ->will($this->returnValue(true));

        $arguments['helper'] = $this->helperMock;

        $this->sessionMock = $this->getMockBuilder(Session::class)
            ->disableOriginalConstructor()
            ->setMethods(
                [
                'getUser'
                ]
            )
            ->getMock();

        $this->sessionMock->method('getUser')
            ->will(
                $this->returnCallback(
                    function () {
                        return $this->getMockBuilder(User::class)
                            ->disableOriginalConstructor()
                            ->getMock();
                    }
                )
            );

        $arguments['session'] = $this->sessionMock;

        $this->object = parent::setSetUp(ConfigInterceptor::class, $arguments);
    }

    /**
     * Magento 2 base Module | test method
     *
     * @return void
     */
    public function testAroundSave():void
    {
        $expectedData = "dummyFunction";

        $data = $this->object->aroundSave($this->configMock, $this->callableFunction);

        $this->assertEquals($expectedData, $data);
    }

    /**
     * Magento 2 base Module | test method
     *
     * @return void
     */
    public function testGetBackendUser():void
    {
        $session = parent::getProperty(ConfigInterceptor::class, 'session');
        $expectedData = $session->getValue($this->object)->getUser();

        $getBackendUser = parent::getMethod(ConfigInterceptor::class, 'getBackendUser');
        $data = $getBackendUser->invoke($this->object);

        $this->assertEquals($expectedData, $data);
    }
}
