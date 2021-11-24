<?php

/**
 * Copyright © 2021 Bertozzi Matteo
 *
 * PHP Version 5
 *
 * @category File
 * @package  Lvk_Design
 * @author   Bertozzi Matteo <brtzz.mtt@gmail.com>
 * @license  The PHP License, Version 3.0 - PHP.net (http://php.net/license/3_0.txt)
 * @link     https://github.com/brtzz-mtt
 */

namespace Lvk\Design\Block\Catalog\Product\ProductList;

use Magento\Store\Model\ScopeInterface;

/**
 * Copyright © 2021 Bertozzi Matteo
 *
 * PHP Version 5
 *
 * @category Class
 * @package  Lvk_Design
 * @author   Bertozzi Matteo <brtzz.mtt@gmail.com>
 * @license  The PHP License, Version 3.0 - PHP.net (http://php.net/license/3_0.txt)
 * @link     https://github.com/brtzz-mtt
 */
class Toolbar extends \Magento\Catalog\Block\Product\ProductList\Toolbar
{
    /**
     * Copyright © 2021 Bertozzi Matteo
     *
     * PHP Version 5
     *
     * @return string
     */
    public function getSorterTemplate()
    {
        return $this->useCompactSorter()
               ? 'Lvk_Design::catalog/product/productlist/toolbar/sorter.phtml'
               : 'Magento_Catalog::product/list/toolbar/sorter.phtml';
    }

    /**
     * Copyright © 2021 Bertozzi Matteo
     *
     * PHP Version 5
     *
     * @param object $collection Magento\Framework\Data\Collection
     *
     * @return $this
     */
    public function setCollection($collection)
    {
        $this->_collection = $collection;

        $this->_collection->setCurPage($this->getCurrentPage());

        if ($limit = (int)$this->getLimit()) {

            $this->_collection->setPageSize($limit);
        }

        if ($this->getCurrentOrder()) {

            if ($this->useCompactSorter()) {

                $orderDir = explode('-', $this->getCurrentOrder());
                $direction = isset($orderDir[1]) ? $orderDir[1] : null;
                $this->_collection->setOrder($orderDir[0], $direction);

            } else {

                $this->_collection->setOrder(
                    $this->getCurrentOrder(),
                    $this->getCurrentDirection()
                );
            }
        }

        return $this;
    }

    /**
     * Copyright © 2021 Bertozzi Matteo
     *
     * PHP Version 5
     *
     * @return boolean
     */
    public function showCategoryTitle() {

        return $this->_scopeConfig->getValue(
            'design/toolbar/show_category_title',
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Copyright © 2021 Bertozzi Matteo
     *
     * PHP Version 5
     *
     * @return boolean
     */
    public function showFieldLimiter() {

        return $this->_scopeConfig->getValue(
            'design/toolbar/show_field_limiter',
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Copyright © 2021 Bertozzi Matteo
     *
     * PHP Version 5
     *
     * @return boolean
     */
    public function useCompactSorter() {

        return $this->_scopeConfig->getValue(
            'design/toolbar//use_compact_sorter',
            ScopeInterface::SCOPE_STORE
        );
    }
}
