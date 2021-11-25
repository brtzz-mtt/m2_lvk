<?php

/**
 * Copyright © 2021 Bertozzi Matteo
 *
 * PHP Version 5
 *
 * @category File
 * @package  Lvk_GoogleFonts
 * @author   Bertozzi Matteo <brtzz.mtt@gmail.com>
 * @license  The PHP License, Version 3.0 - PHP.net (http://php.net/license/3_0.txt)
 * @link     https://github.com/brtzz-mtt
 */

namespace Lvk\GoogleFonts\Observer\Lvk\Design\Admin\System\Config\Changed\Section;

use Lvk\GoogleFonts\Model\Api;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Event\Observer;
use Magento\Framework\Filesystem\File\Write;
use Magento\Framework\Filesystem\File\WriteFactory;
use Magento\Framework\Filesystem\Io\File as IOFile; // only to get rid of strict sniffers
use Magento\Framework\View\Element\Context;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Copyright © 2021 Bertozzi Matteo
 *
 * PHP Version 5
 *
 * @category Class
 * @package  Lvk_GoogleFonts
 * @author   Bertozzi Matteo <brtzz.mtt@gmail.com>
 * @license  The PHP License, Version 3.0 - PHP.net (http://php.net/license/3_0.txt)
 * @link     https://github.com/brtzz-mtt
 */
class Design extends \Lvk\Design\Observer\Admin\System\Config\Changed\Section\Design
{
    /**
     * @var array
     */
    protected $loadedFonts = [];

    /**
     * Filled via di.xml
     * @var array
     */
    protected $fontSelectors = [];

    /**
     * @var Write
     */
    protected $stylesFile;

    /**
     * @var Api
     */
    protected $api;

    /**
     * Design constructor.
     * @param \Lvk\Design\Helper\Data $designHelper
     * @param StoreManagerInterface $storeManagerInterface
     * @param DirectoryList $directoryList
     * @param IOFile $file
     * @param WriteFactory $writeFactory
     * @param Context $context
     * @param Api $api
     * @param array $fontSelectors
     */
    public function __construct(
        \Lvk\Design\Helper\Data $designHelper,
        StoreManagerInterface $storeManagerInterface,
        DirectoryList $directoryList,
        IOFile $file,
        WriteFactory $writeFactory,
        Context $context,
        Api $api,
        array $fontSelectors = []
    ) {
        parent::__construct(
            $designHelper,
            $storeManagerInterface,
            $directoryList,
            $file,
            $writeFactory,
            $context
        );
        $this->fontSelectors = $fontSelectors;
        $this->api = $api;
    }

    /**
     * Copyright © 2021 Bertozzi Matteo
     *
     * PHP Version 5
     *
     * @param string $configPath  font variant design configuration path
     * @param string $cssSelector valid css selector for resulting generation
     *
     * @return string
     */
    public function getFamilyCss($configPath, $cssSelector, $code = null)
    {
        $data = '';

        if ($family = $this->designHelper->getConfig($configPath, $code)) {

            $familyVariant = $this->designHelper->getConfig($configPath . '_variant', $code);

            $familyVariantArray = explode(
                ';',
                $familyVariant
            );

            $familyVariant = $familyVariantArray[0] ?? 'initial';
            $familySize = $familyVariantArray[5] ?? 'initial';
            $familyStyle = $familyVariantArray[4] ?? 'initial';
            $familyWeight = $familyVariantArray[3] ?? 'initial';

            if (//($family != FamilyOptions::FAMILY_DEFAULT) &&
                !in_array($family, $this->loadedFonts)) {

                $css = $this->api->getFontCss($family, [$familyVariant]);

                $data .= str_replace("  ", "    ", $css);
            }
            $this->loadedFonts[] = $family . $familyVariant;

            $familyReal = str_replace("+", " ", $family);

            $data .= $cssSelector . ' {' . self::EOL
                   . '    font-family: ' . $familyReal . ';' . self::EOL
                   . '    font-size: ' . $familySize . ';' . self::EOL
                   . '    font-style: ' . $familyStyle . ';' . self::EOL
                   . '    font-weight: ' . $familyWeight . ';' . self::EOL
                   . '}' . self::EOL;
        }

        return $data;
    }

    /**
     * Copyright © 2021 Bertozzi Matteo
     *
     * PHP Version 5
     *
     * @param object $observer Magento\Framework\Event\Observer
     *
     * @return void
     */
    public function execute(Observer $observer)
    {
        $data = '';

        foreach ($this->fontSelectors as $configPath => $cssSelector) {

            $data .= $this->getFamilyCss($configPath . '_family', $cssSelector, $observer->getStoreCode());

            if ($color = $this->designHelper->getConfig($configPath . '_color',
                                                        $observer->getStoreCode())) {

                $data .= $cssSelector . ' {' . self::EOL
                    . '    color: ' . $this->designHelper->checkColorCode($color) . ';' . self::EOL
                    . '}' . self::EOL;
            }
        }

        $this->stylesFile = $observer->getStylesFile();

        $this->write($data, $observer->getStoreCode());
    }
}
