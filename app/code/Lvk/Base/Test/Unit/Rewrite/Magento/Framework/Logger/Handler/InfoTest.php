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
namespace Lvk\Base\Test\Unit\Rewrite\Magento\Framework\Logger\Handler;

use Lvk\Base\Helper\Unit;
use Lvk\Base\Rewrite\Magento\Framework\Logger\Handler\Info;
use Monolog\Logger;

class InfoTest extends Unit
{
    protected $object;

    /**
     * Magento 2 base Module | test setup
     *
     * @return void
     */
    protected function setUp():void
    {
        $this->object = parent::setSetUp(Info::class);
    }

    /**
     * Magento 2 base Module | test method
     *
     * @return void
     */
    public function test():void
    {
        $expectedData = '/var/log/lvk/info.log';

        $fileName = parent::getProperty(Info::class, 'fileName');
        $data = $fileName->getValue($this->object);

        $this->assertEquals($expectedData, $data);

        $expectedData = Logger::INFO;

        $loggerType = parent::getProperty(Info::class, 'loggerType');
        $data = $loggerType->getValue($this->object);

        $this->assertEquals($expectedData, $data);
    }
}
