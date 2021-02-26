<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\EshopCommunity\Tests\Codeception\acceptanceAdmin;

use OxidEsales\EshopCommunity\Tests\Codeception\AcceptanceAdminTester;

final class AdminExportNewsletterRecipientsCest
{
    /** @param AcceptanceAdminTester $I */
    public function checkExportRecipients(AcceptanceAdminTester $I): void
    {
        $I->wantToTest('Check Export Newsletter Recipients');

        $adminPanel = $I->loginAdmin();
        $newsletter = $adminPanel->openNewsletter();
        $newsletter->exportReciepents();
        $I->waitForAjax();
    }
}
