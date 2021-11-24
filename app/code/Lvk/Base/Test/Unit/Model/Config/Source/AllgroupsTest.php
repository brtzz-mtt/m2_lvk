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
namespace Lvk\Base\Test\Unit\Model\Config\Source;

use Lvk\Base\Helper\Unit;
use Lvk\Base\Model\Config\Source\Allgroups;
use Magento\Customer\Api\Data\GroupSearchResultsInterface;
use Magento\Customer\Api\Data\GroupInterface;
use Magento\Customer\Api\GroupRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchCriteriaInterface;

class AllgroupsTest extends Unit
{
    protected $groupInterfaceMock;
    protected $groupRepositoryInterfaceMock;
    protected $groupSearchResultsInterfaceMock;
    protected $object;
    protected $searchCriteriaBuilderMock;
    protected $searchCriteriaInterfaceMock;
    protected $stdClassMock;

    /**
     * Magento 2 base Module | test setup
     *
     * @return void
     */
    protected function setUp():void
    {
        $this->searchCriteriaInterfaceMock = $this->getMockBuilder(SearchCriteriaInterface::class)
            ->getMock();

        $arguments['searchCriteriaInterface'] = $this->searchCriteriaInterfaceMock;

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
                $this->returnValue($this->searchCriteriaInterfaceMock)
            );

        $arguments['searchCriteriaBuilder'] = $this->searchCriteriaBuilderMock;

        $this->groupInterfaceMock = $this->getMockBuilder(GroupInterface::class)
            ->getMock();

        $arguments['groupInterface'] = $this->groupInterfaceMock;

        $this->groupSearchResultsInterfaceMock = $this->getMockBuilder(GroupSearchResultsInterface::class)
            ->setMethods(
                [
                    'getItems',
                    'getSearchCriteria',
                    'getTotalCount',
                    'setItems',
                    'setSearchCriteria',
                    'setTotalCount'
                ]
            )
            ->getMock();

        $this->stdClassMock = $this->getMockBuilder(stdClass::class)
            ->disableOriginalConstructor()
            ->setMethods(
                [
                    'getCode',
                    'getId'
                ]
            )
            ->getMock();

        $this->stdClassMock->method('getCode')
            ->will(
                $this->returnValue("dummyCode")
            );

        $this->stdClassMock->method('getId')
            ->will(
                $this->returnValue("dummyId")
            );

        $this->groupSearchResultsInterfaceMock->method('getItems')
            ->will(
                $this->returnValue(
                    [
                        $this->stdClassMock
                    ]
                )
            );

        $arguments['groupSearchResultsInterface'] = $this->groupSearchResultsInterfaceMock;

        $this->groupRepositoryInterfaceMock = $this->getMockBuilder(GroupRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->setMethods(
                [
                    'delete',
                    'deleteById',
                    'getById',
                    'getList',
                    'save'
                ]
            )
            ->getMock();

        $this->groupRepositoryInterfaceMock->method('getList')
            ->with($this->searchCriteriaInterfaceMock)
            ->will(
                $this->returnValue($this->groupSearchResultsInterfaceMock)
            );

        $arguments['groupRepository'] = $this->groupRepositoryInterfaceMock; // mind the name of parameter..

        $this->object = parent::setSetUp(Allgroups::class, $arguments);
    }

    /**
     * Magento 2 base Module | test method
     *
     * @return void
     */
    public function testToArray():void
    {
        $expectedData = ['dummyId' => "dummyCode"];

        $data = $this->object->toArray();

        $this->assertEquals($expectedData, $data);
    }

    /**
     * Magento 2 base Module | test method
     *
     * @return void
     */
    public function testToOptionArray():void
    {
        $expectedData = null;

        $data = $this->object->toOptionArray();

        $this->assertEquals($expectedData, $data);
    }
}
