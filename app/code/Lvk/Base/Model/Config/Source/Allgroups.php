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
namespace Lvk\Base\Model\Config\Source;

use Lvk\Base\Helper\Data;
use Lvk\Base\Model\Config\Source;
use Magento\Customer\Api\GroupRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Convert\DataObject;

class Allgroups extends Source
{
    protected $dataObject; // phpcs:ignore PSR2.Classes.PropertyDeclaration
    protected $groupRepository; // phpcs:ignore PSR2.Classes.PropertyDeclaration
    protected $searchCriteriaBuilder; // phpcs:ignore PSR2.Classes.PropertyDeclaration

    /**
     * Magento 2 base Module | class constructor
     *
     * @param $dataObject            Magento\Framework\Convert\DataObject
     * @param $groupRepository       Magento\Customer\Api\GroupRepositoryInterface
     * @param $searchCriteriaBuilder Magento\Framework\Api\SearchCriteriaBuilder
     * @param $helper                Lvk\Base\Helper\Data
     */
    public function __construct(
        DataObject $dataObject,
        GroupRepositoryInterface $groupRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        Data $helper
    ) {
        $this->dataObject = $dataObject;
        $this->groupRepository = $groupRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;

        parent::__construct($helper);
    }

    /**
     * Magento 2 base Module | source method
     *
     * @return array
     */
    public function toArray()
    {
        $array = $this->groupRepository->getList($this->searchCriteriaBuilder->create())->getItems();

        $data = [];

        if (!empty($array)) {
            foreach ($array as $key => $value) {
                $data[$value->getId()] = $value->getCode();
            }

            asort($data, SORT_NATURAL);
        }

        return $data;
    }
}
