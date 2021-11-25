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

use Magento\Catalog\Helper\Category;

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
class CategoryOptions extends \Lvk\Base\Model\Config\Source
{
    /**
     * @var \Lvk\CategoryTree\Helper\Data
     */
    protected $categoryTreeHelper;

    /**
     * @var \Magento\Framework\Data\Tree\Node\Collection
     */
    protected $storeCategories;

    /**
     * CategoryOptions constructor.
     *
     * @param \Lvk\CategoryTree\Helper\Data $categoryTreeHelper
     * @param Category $category
     */
    public function __construct(
        \Lvk\Base\Helper\Data $baseHelper,
        \Magento\Store\Model\StoreManagerInterface $storeManagerInterface,
        \Magento\Store\Model\StoreResolver $storeResolver,
        \Lvk\CategoryTree\Helper\Data $categoryTreeHelper,
        Category $category
    ) {
        $this->categoryTreeHelper = $categoryTreeHelper;

        $this->storeCategories = $category->getStoreCategories();

        parent::__construct($baseHelper, $storeManagerInterface, $storeResolver);
    }

    /**
     * Copyright © 2021 Bertozzi Matteo
     *
     * PHP Version 5
     *
     * @return array
     */
    public function toArray()
    {
        $data = [];

        foreach ($this->storeCategories as $category) {
            $data[$category->getId()] = $category->getName();
        }

        return $data;
    }
}
