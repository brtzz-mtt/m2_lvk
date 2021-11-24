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

namespace Lvk\Design\Controller\Responsivity;

use Magento\Framework\App\Action\Context;
use Magento\Framework\Module\Manager;
use Magento\Framework\View\Result\PageFactory;

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
class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var Manager
     */
    protected $manager;

    /**
     * Index constructor.
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param Manager $manager
     */
    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        manager $manager
    ) {
        $this->resultPageFactory = $pageFactory;
        $this->manager = $manager;

        parent::__construct($context);
    }

    /**
     * Execute
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        if (!$this->manager->isEnabled('Lvk_DeveloperToolBox')) {
            $this->_redirect('admin');
        }

        return $this->resultPageFactory->create();
    }
}
