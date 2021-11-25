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

namespace Lvk\CategoryTree\Helper;

use Magento\Catalog\Model\CategoryRepository;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Registry;
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
class Category extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * Copyright © 2021 Bertozzi Matteo
     *
     * PHP Version 5
     *
     * @param object $context               Magento\Framework\App\Helper\Context
     * @param object $registry              Magento\Framework\Registry
     * @param object $storeManagerInterface Magento\Store\Model\StoreManagerInterface
     * @param object $categoryRepository    Magento\Catalog\Model\CategoryRepository
     */
    public function __construct(
        Context $context,
        Registry $registry,
        StoreManagerInterface $storeManagerInterface,
        CategoryRepository $categoryRepository
    ) {
        $this->registry = $registry;
        $this->storeManagerInterface = $storeManagerInterface;
        $this->categoryRepository = $categoryRepository;

        parent::__construct($context);
    }

    /**
     * Copyright © 2021 Bertozzi Matteo
     *
     * PHP Version 5
     *
     * @return Magento\Catalog\Model\Category\Interceptor
     */
    public function getCurrent()
    {
        if ($category = $this->registry->registry('current_category')) {
            return $category;
        }

        return $this->getRoot();
    }

    /**
     * Copyright © 2021 Bertozzi Matteo
     *
     * PHP Version 5
     *
     * @return Magento\Catalog\Model\Category\Interceptor
     */
    public function getRoot()
    {
        $store = $this->storeManagerInterface->getStore();

        return $this->categoryRepository->get(
            $store->getRootCategoryId(),
            $store->getId()
        );
    }
}
