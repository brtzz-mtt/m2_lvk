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

use Lvk\Base\Helper\Unit;

class UnitTest extends Unit
{
    /**
     * Magento 2 base Module | test setup
     *
     * @return void
     */
    protected function setUp():void
    {
        $this->object = parent::setSetUp(Unit::class);
    }

    /**
     * Magento 2 base Module | test method
     *
     * @return void
     */
    public function testGetMethod():void
    {
        $className = Unit::class;
        $methodName = 'getMethod';

        $expectedData = parent::getMethod($className, $methodName);

        $data = $this->object->getMethod($className, $methodName);

        $this->assertEquals($expectedData, $data);
        $this->assertTrue($data->isProtected());
    }

    /**
     * Magento 2 base Module | test method
     *
     * @return void
     */
    public function testGetProperty():void
    {
        $className = Unit::class;
        $propertyName = 'className';

        $expectedData = parent::getProperty($className, $propertyName);

        $data = $this->object->getProperty($className, $propertyName);

        $this->assertEquals($expectedData, $data);
        $this->assertTrue($data->isProtected());
    }
}
