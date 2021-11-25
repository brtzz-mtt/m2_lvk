<?php

namespace Lvk\OpeningHours\Block\Opening;

class Widget extends \Lvk\OpeningHours\Block\Opening implements \Magento\Widget\Block\BlockInterface {

    protected function _construct() {

        $this->_first_day = $this->getFirstDay();
        $this->_compress_table = $this->getCompressTable();
    }
}
