<?php

/**
 * Copyright © 2021 Bertozzi Matteo
 *
 * PHP Version 5
 *
 * @category File
 * @package  Lvk_DeveloperToolBox
 * @author   Bertozzi Matteo <brtzz.mtt@gmail.com>
 * @license  The PHP License, Version 3.0 - PHP.net (http://php.net/license/3_0.txt)
 * @link     https://github.com/brtzz-mtt
 */

namespace Lvk\DeveloperToolBox\Controller\Adminhtml\Component;

use Magento\Backend\App\Action as extended;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

/**
 * Copyright © 2021 Bertozzi Matteo
 *
 * PHP Version 5
 *
 * @category Class
 * @package  Lvk_DeveloperToolBox
 * @author   Bertozzi Matteo <brtzz.mtt@gmail.com>
 * @license  The PHP License, Version 3.0 - PHP.net (http://php.net/license/3_0.txt)
 * @link     https://github.com/brtzz-mtt
 */
class Index extends extended
{
    const RESOURCE = 'Lvk_DeveloperToolBox::menu_developertoolbox_component_index';

    /**
     * Copyright © 2021 Bertozzi Matteo
     *
     * PHP Version 5
     *
     * @return boolean
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Lvk_DeveloperToolBox::component');
    }

    /**
     * Copyright © 2021 Bertozzi Matteo
     *
     * PHP Version 5
     *
     * @param object $context     Magento\Backend\App\Action\Context
     * @param object $pageFactory Magento\Framework\View\Result\PageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $pageFactory
    ) {
        parent::__construct($context);

        $this->pageFactory = $pageFactory;
    }

    /**
     * Copyright © 2021 Bertozzi Matteo
     *
     * PHP Version 5
     *
     * @return object
     */
    public function execute()
    {
        $resultPage = $this->pageFactory->create();

        $resultPage->setActiveMenu(self::RESOURCE);

        $pageTitle = __("Developer's Tool-Box") . ' | ' . __("Components index");
        $resultPage->getConfig()->getTitle()->set($pageTitle);

        return $resultPage;
    }
}
