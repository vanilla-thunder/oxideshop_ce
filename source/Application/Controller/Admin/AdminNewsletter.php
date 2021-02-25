<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\EshopCommunity\Application\Controller\Admin;

use OxidEsales\Eshop\Core\Registry;
use OxidEsales\EshopCommunity\Application\Model\NewsletterRecipients;

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
        $this->download((new NewsletterRecipients())->getNewsletterRecipients());
    }

    /**
     * @param array $data
     */
    private function download(array $data): void
    {
        $filename = "Export_recipients_" . date("Y-m-d") . ".csv";
        $oUtils = Registry::getUtils();
        $oUtils->setHeader("Pragma: public");
        $oUtils->setHeader("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        $oUtils->setHeader("Expires: 0");
        $oUtils->setHeader("Content-Disposition: attachment; filename=vouchers.csv");
        $oUtils->setHeader("Content-Type: application/csv");
        $oUtils->setHeader("Content-Disposition: attachment;filename={$filename}");
        $this->generateCSV($data);
        $oUtils->showMessageAndExit("");
    }

    /**
     * @param array $data
     *
     * @return string|false
     */
    private function generateCSV(array $data)
    {
        $fp = fopen("php://output", 'wb');

        foreach ($data as $value) {
            fputcsv($fp, $value);
        }
        fclose($fp);
    }
}
