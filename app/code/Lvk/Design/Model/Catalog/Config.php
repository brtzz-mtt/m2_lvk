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

namespace Lvk\Design\Model\Catalog;

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
class Config extends \Magento\Catalog\Model\Config
{
    /**
     * Get Attribute Used For Sort By Array
     * @return array
     */
    public function getAttributeUsedForSortByArray()
    {
        $useCompactSorter = $this->_scopeConfig->getValue(
            'design/toolbar/use_compact_sorter',
            ScopeInterface::SCOPE_STORE
        );

        $showPositionInSortingOptions = $this->_scopeConfig->getValue(
            'design/toolbar/show_position_in_sorting_options',
            ScopeInterface::SCOPE_STORE
        );

        if ($useCompactSorter) {
            $options = [0 => __("Sort By") . ".."];
        } else {
            $options = [];
        }

        if ($showPositionInSortingOptions) {
            $options = ['position' => __('Position')];
        }

        foreach ($this->getAttributesUsedForSortBy() as $attribute) {
            $attributeCode = $attribute->getAttributeCode();
            $storeLabel = $attribute->getStoreLabel();
            if ($useCompactSorter) {
                $options[$attributeCode . '-asc']//'&product_list_dir=asc']
                    = __($storeLabel) . " (" . __("ascending") . ")";
                $options[$attributeCode . '-desc']//'&product_list_dir=desc']
                    = __($storeLabel) . " (" . __("descending") . ")";
            } else {
                $options[$attributeCode] = $storeLabel;
            }
        }

        return $options;
    }
}
