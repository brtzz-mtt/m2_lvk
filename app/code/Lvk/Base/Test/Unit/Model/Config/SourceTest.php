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
namespace Lvk\Base\Test\Unit\Model\Config;

use Lvk\Base\Helper\Data;
use Lvk\Base\Helper\Unit;
use Lvk\Base\Model\Config\Source;
use Lvk\Base\Model\Config\Source\Allgroups;
use Magento\Customer\Api\Data\GroupSearchResultsInterface;
use Magento\Customer\Api\GroupRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchCriteriaInterface;

class SourceTest extends Unit
{
    protected $groupRepositoryMock;
    protected $helperMock;
    protected $searchCriteriaBuilderMock;
    protected $sourceMock;

     /**
      * Magento 2 base Module | test setup
      *
      * @return void
      */
    protected function setUp():void
    {
        $this->helperMock = $this->getMockBuilder(Data::class)
            ->disableOriginalConstructor()
            ->getMock();

        $arguments['helper'] = $this->helperMock;

        $this->sourceMock = $this->getMockForAbstractClass(
            Source::class,
            $arguments,
            '',
            true,
            true,
            true,
            ['toArray', 'toOptionArray']
        );

        $this->sourceMock
            ->method('toOptionArray')
            ->will($this->returnValue(Unit::$expectedDataArray));

        $this->groupRepositoryMock = $this->getMockBuilder(GroupRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->setMethods(
                [
                    'delete',
                    'deleteById',
                    'getById',
                    'getItems',
                    'getList',
                    'save'
                ]
            )
            ->getMock();

        $this->groupRepositoryMock->method('getList')
            ->will(
                $this->returnCallback(
                    function () {
                        return $this->getMockBuilder(GroupSearchResultsInterface::class)
                            ->disableOriginalConstructor()
                            ->getMock();
                    }
                )
            );

        $arguments['groupRepository'] = $this->groupRepositoryMock;

        $this->searchCriteriaBuilderMock = $this->getMockBuilder(SearchCriteriaBuilder::class)
            ->disableOriginalConstructor()
            ->setMethods(
                [
                'create'
                ]
            )
            ->getMock();

        $this->searchCriteriaBuilderMock->method('create')
            ->will(
                $this->returnCallback(
                    function () {
                        return $this->getMockBuilder(SearchCriteriaInterface::class)
                            ->disableOriginalConstructor()
                            ->getMock();
                    }
                )
            );

        $arguments['searchCriteriaBuilder'] = $this->searchCriteriaBuilderMock;

        $this->object = parent::setSetUp(Allgroups::class, $arguments);
    }

    /**
     * Magento 2 base Module | test method
     *
     * @return void
     */
    public function testToOptionArray():void
    {
        $expectedData = Unit::$expectedDataArray;

        $data = $this->sourceMock->toOptionArray(Unit::$dataArray);

        $this->assertEquals($expectedData, $data);

        $expectedData = null;

        $data = $this->object->toOptionArray(Unit::$dataArray);

        $this->assertEquals($expectedData, $data);
    }
}
