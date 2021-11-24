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

namespace Lvk\Design\Model\Design\Backend\Body;

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
class Background extends \Magento\Theme\Model\Design\Backend\Image
{
    const UPLOAD_DIR = 'body';

    /**
     * Copyright © 2021 Bertozzi Matteo
     *
     * PHP Version 5
     *
     * @return boolean
     */
    protected function _addWhetherScopeInfo()
    {
        return true;
    }

    /**
     * Copyright © 2021 Bertozzi Matteo
     *
     * PHP Version 5
     *
     * @return string
     */
    protected function _getUploadDir()
    {
        $uploadDir = $this->_appendScopeInfo(self::UPLOAD_DIR);

        return $this->_mediaDirectory->getRelativePath($uploadDir);
    }

    /**
     * Copyright © 2021 Bertozzi Matteo
     *
     * PHP Version 5
     *
     * @return array
     */
    public function getAllowedExtensions()
    {
        return ['jpg', 'jpeg', 'gif', 'png', 'svg'];
    }
}
