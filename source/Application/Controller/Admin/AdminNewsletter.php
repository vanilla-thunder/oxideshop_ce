<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\EshopCommunity\Application\Controller\Admin;

use OxidEsales\EshopCommunity\Application\Model\NewsletterRecipients;
use OxidEsales\EshopCommunity\Internal\Container\ContainerFactory;
use OxidEsales\EshopCommunity\Internal\Framework\FileSystem\FileGenerator\Bridge\CsvFileGeneratorBridge;
use OxidEsales\EshopCommunity\Internal\Framework\FileSystem\FileGenerator\Bridge\FileGeneratorBridgeInterface;
use Psr\Container\ContainerInterface;

/**
 * Admin newsletter manager.
 * Returns template, that arranges template ("newsletter.tpl") to frame.
 * Admin Menu: Customer Info -> Newsletter.
 */
class AdminNewsletter extends \OxidEsales\Eshop\Application\Controller\Admin\AdminController
{
    /**
     * Current class template name.
     *
     * @var string
     */
    protected $_sThisTemplate = 'newsletter.tpl';

    public function export(): void
    {
        $container = ContainerFactory::getInstance()->getContainer();
        $this->setCSVHeader();
        $this->generateCSV($container, (new NewsletterRecipients())->getNewsletterRecipients());
        exit();
    }

    private function setCSVHeader(): void
    {
        $filename = "Export_recipients_" . date("Y-m-d") . ".csv";
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Expires: 0");
        header("Content-Disposition: attachment; filename=vouchers.csv");
        header("Content-Type: application/csv");
        header("Content-Disposition: attachment;filename={$filename}");
    }

    /**
     * @param ContainerInterface $container
     * @param array              $data
     *
     * @return void
     */
    public function generateCSV(ContainerInterface $container, array $data): void
    {
        $csvGenerator = $container->get(FileGeneratorBridgeInterface::class);
        $csvGenerator->generate("php://output", $data);
    }
}
