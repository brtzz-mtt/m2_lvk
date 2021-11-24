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
namespace Lvk\Base\Test\Unit\Rewrite\Magento\Framework\Module\Plugin;

use Lvk\Base\Helper\Data;
use Lvk\Base\Helper\Unit;
use Lvk\Base\Rewrite\Magento\Framework\Module\Plugin\DbStatusValidatorOverride;
use Magento\Framework\App\FrontController;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Module\DbVersionInfo;

class DbStatusValidatorOverrideTest extends Unit
{
    protected $dbVersionInfoMock;
    protected $frontControllerMock;
    protected $helperMock;
    protected $object;
    protected $requestInerfaceMock;

    /**
     * Magento 2 base Module | test setup
     *
     * @return void
     */
    protected function setUp():void
    {
        $this->frontControllerMock = $this->getMockBuilder(FrontController::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->requestInterfaceMock = $this->getMockBuilder(RequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->helperMock = $this->getMockBuilder(Data::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->helperMock->method('getConfigSuppressVersionTooHighErrors')
            ->will(
                $this->onConsecutiveCalls(
                    [true, true, false]
                )
            );

        $this->helperMock->method('getConfigSuppressVersionTooLowErrors')
            ->will(
                $this->onConsecutiveCalls(
                    [false, false, false]
                )
            );

        $arguments['helper'] = $this->helperMock;

        $this->dbVersionInfoMock = $this->getMockBuilder(DbVersionInfo::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->dbVersionInfoMock->method('getDbVersionErrors')
            ->will(
                $this->onConsecutiveCalls(
                    [
                        [
                            DbVersionInfo::KEY_MODULE => "dummyModule", // module name
                            DbVersionInfo::KEY_TYPE => "dummyType", // schema or data
                            DbVersionInfo::KEY_CURRENT => "none", // default current version
                            DbVersionInfo::KEY_REQUIRED => null
                        ],
                        [
                            DbVersionInfo::KEY_MODULE => "dummyModule",
                            DbVersionInfo::KEY_TYPE => "dummyType",
                            DbVersionInfo::KEY_CURRENT => '1.0.1',
                            DbVersionInfo::KEY_REQUIRED => "1.0"
                        ]
                    ],
                    [
                        [
                            DbVersionInfo::KEY_MODULE => "dummyModule", // module name
                            DbVersionInfo::KEY_TYPE => "dummyType", // schema or data
                            DbVersionInfo::KEY_CURRENT => "none", // default current version
                            DbVersionInfo::KEY_REQUIRED => null
                        ]
                    ],
                    []
                )
            ); // for versions see https://www.php.net/manual/en/function.version-compare.php

        $arguments['dbVersionInfo'] = $this->dbVersionInfoMock;

        $this->object = parent::setSetUp(DbStatusValidatorOverride::class, $arguments);
    }

    /**
     * Magento 2 base Module | test method
     *
     * @return void
     */
    public function testBeforeDispatch():void
    {
        $this->expectException(LocalizedException::class);
        $data = $this->object->beforeDispatch($this->frontControllerMock, $this->requestInterfaceMock);

        $this->expectException(LocalizedException::class);
        $data = $this->object->beforeDispatch($this->frontControllerMock, $this->requestInterfaceMock);

        $this->expectException(LocalizedException::class);
        $data = $this->object->beforeDispatch($this->frontControllerMock, $this->requestInterfaceMock);
    }

    /**
     * Magento 2 base Module | test method
     *
     * @return void
     */
    public function testFormatVersionTooLowErrors():void
    {
        $expectedData = ["dummyModule dummyType: current version - none, required version - "];

        $getGroupedDbVersionErrors = parent::getMethod(DbStatusValidatorOverride::class, 'getGroupedDbVersionErrors');
        $dummyData = $getGroupedDbVersionErrors->invoke($this->object);

        $formatVersionTooLowErrors = parent::getMethod(DbStatusValidatorOverride::class, 'formatVersionTooLowErrors');
        $data = $formatVersionTooLowErrors->invoke($this->object, $dummyData['version_too_low']);

        $this->assertEquals($expectedData, $data);
    }

    /**
     * Magento 2 base Module | test method
     *
     * @return void
     */
    public function testFormatVersionTooHighErrors():void
    {
        $expectedData = ["dummyModule dummyType: code version - 1.0, database version - 1.0.1"];

        $getGroupedDbVersionErrors = parent::getMethod(DbStatusValidatorOverride::class, 'getGroupedDbVersionErrors');
        $dummyData = $getGroupedDbVersionErrors->invoke($this->object);

        $formatVersionTooHighErrors = parent::getMethod(DbStatusValidatorOverride::class, 'formatVersionTooHighErrors');
        $data = $formatVersionTooHighErrors->invoke($this->object, $dummyData['version_too_high']);

        $this->assertEquals($expectedData, $data);
    }

    /**
     * Magento 2 base Module | test method
     *
     * @return void
     */
    public function testGetGroupedDbVersionErrors():void
    {
        $getGroupedDbVersionErrors = parent::getMethod(DbStatusValidatorOverride::class, 'getGroupedDbVersionErrors');

        $expectedData = [
            'version_too_low' => [
                [
                    'module' => "dummyModule",
                    'type' => "dummyType",
                    'current' => "none",
                    'required' => null
                ]
            ],
            'version_too_high' => [
                [
                    'module' => "dummyModule",
                    'type' => "dummyType",
                    'current' => "1.0.1",
                    'required' => "1.0"
                ]
            ]
        ];

        $data = $getGroupedDbVersionErrors->invoke($this->object, []);

        $this->assertEquals($expectedData, $data);

        $expectedData = [
            'version_too_low' => [
                [
                    'module' => "dummyModule",
                    'type' => "dummyType",
                    'current' => "none",
                    'required' => null
                ]
            ],
            'version_too_high' => []
        ];

        $data = $getGroupedDbVersionErrors->invoke($this->object, []);

        $this->assertEquals($expectedData, $data);

        $expectedData = [
            'version_too_low' => [],
            'version_too_high' => []
        ];

        $data = $getGroupedDbVersionErrors->invoke($this->object, []);

        $this->assertEquals($expectedData, $data);
    }
}
