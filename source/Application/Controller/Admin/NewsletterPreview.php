<?php
/**
 * This file is part of OXID eShop Community Edition.
 *
 * OXID eShop Community Edition is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * OXID eShop Community Edition is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with OXID eShop Community Edition.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @link      http://www.oxid-esales.com
 * @copyright (C) OXID eSales AG 2003-2016
 * @version   OXID eShop CE
 */

namespace OxidEsales\EshopCommunity\Application\Controller\Admin;

use oxRegistry;

/**
 * Newsletter preview manager.
 * Creates plaintext and HTML format newsletter preview.
 * Admin Menu: Customer Info -> Newsletter -> Preview.
 */
class NewsletterPreview extends \OxidEsales\Eshop\Application\Controller\Admin\AdminDetailsController
{
    /**
     * Executes parent method parent::render(), creates oxnewsletter object
     * and passes it's data to Smarty engine, returns name of template file
     * "newsletter_preview.tpl".
     *
     * @return string
     */
    public function render()
    {
        parent::render();

        $soxId = $this->getEditObjectId();
        if ($soxId != "-1" && isset($soxId)) {
            // load object
            $oNewsletter = oxNew(\OxidEsales\Eshop\Application\Model\Newsletter::class);
            $oNewsletter->load($soxId);
            $this->_aViewData["edit"] = $oNewsletter;

            // user
            $sUserID = \OxidEsales\Eshop\Core\Registry::getSession()->getVariable("auth");

            // assign values to the newsletter and show it
            $oNewsletter->prepare($sUserID, $this->getConfig()->getConfigParam('bl_perfLoadAktion'));

            $this->_aViewData["previewhtml"] = $oNewsletter->getHtmlText();
            $this->_aViewData["previewtext"] = $oNewsletter->getPlainText();
        }

        return "newsletter_preview.tpl";
    }
}