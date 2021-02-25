<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\EshopCommunity\Tests\Integration\Admin;

use OxidEsales\EshopCommunity\Application\Model\NewsletterRecipients;
use OxidEsales\TestingLibrary\UnitTestCase;

class NewsletterMainTest extends UnitTestCase
{
    public function testGetNewsletterRecipients(): void
    {
        $this->assertContains(
            [
                'Salutation'           => "MR",
                'Firstname'            => "John",
                'Lastname'             => "Doe",
                'Email'                => "admin",
                'Opt-In state'         => "subscribed",
                'Country'              => "Deutschland",
                'Assigned user groups' => "malladmin"
            ], (New NewsletterRecipients())->getNewsletterRecipients()
        );
    }

}
