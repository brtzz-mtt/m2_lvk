<?php

/**
 * Copyright © 2021 Bertozzi Matteo
 *
 * PHP Version 5
 *
 * @category File
 * @package  Lvk_CategoryTree
 * @author   Bertozzi Matteo <brtzz.mtt@gmail.com>
 * @license  The PHP License, Version 3.0 - PHP.net (http://php.net/license/3_0.txt)
 * @link     https://github.com/brtzz-mtt
 */

namespace Lvk\CategoryTree\Model\Config\Source;

use Magento\Catalog\Model\CategoryRepository;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Copyright © 2021 Bertozzi Matteo
 *
 * PHP Version 5
 *
 * @category Class
 * @package  Lvk_CategoryTree
 * @author   Bertozzi Matteo <brtzz.mtt@gmail.com>
 * @license  The PHP License, Version 3.0 - PHP.net (http://php.net/license/3_0.txt)
 * @link     https://github.com/brtzz-mtt
 */
class DepthOptions extends \Lvk\Base\Model\Config\Source
{

    /**
     * @var \Lvk\CategoryTree\Helper\Data
     */
    protected $categoryTreeHelper;

    /**
     * @var \Lvk\CategoryTree\Helper\Category
     */
    protected $categoryTreeCategoryHelper;

    /**
     * @var int
     */
    protected $storeId;

    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * DepthOptions constructor.
     *
     * @param \Lvk\CategoryTree\Helper\Data $categoryTreeHelper
     * @param \Lvk\CategoryTree\Helper\Category $categoryTreeCategoryHelper
     * @param StoreManagerInterface $storeManagerInterface
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(
        \Lvk\Base\Helper\Data $baseHelper,
        \Magento\Store\Model\StoreManagerInterface $storeManagerInterface,
        \Magento\Store\Model\StoreResolver $storeResolver,
        \Lvk\CategoryTree\Helper\Data $categoryTreeHelper,
        \Lvk\CategoryTree\Helper\Category $categoryTreeCategoryHelper,
        CategoryRepository $categoryRepository
    ) {
        $this->categoryTreeHelper = $categoryTreeHelper;
        $this->categoryTreeCategoryHelper = $categoryTreeCategoryHelper;

        $this->storeId = $storeManagerInterface->getStore()->getId();
        $this->categoryRepository = $categoryRepository;

        parent::__construct($baseHelper, $storeManagerInterface, $storeResolver);
    }

    /**
     * Get Max Depth
     *
     * @param $category
     * @param int $depth
     * @return int
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getMaxDepth($category, $depth = 0)
    {
        if ($children = $category->getChildren()) {
            $data = $depth;
            foreach (explode(',', $children) as $id) {
                $category = $this->categoryRepository->get($id, $this->storeId);
                $result = $this->getMaxDepth($category, $depth + 1);
                if ($result > $data) {
                    $data = $result;
                }
            }
        } else {
            return $depth;
        }

        return $data;
    }

    /**
     * To Array
     *
     * @return array
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function toArray()
    {
        $data = [999 => 'All']; // todo a zero (0) could be better than this..

        $maxDepth = $this->getMaxDepth($this->categoryTreeCategoryHelper->getRoot());
        for ($i = 1; $i <= $maxDepth; $i++) {
            $data[$i - 1] = $i;
        }

        return $data;
    }
}
