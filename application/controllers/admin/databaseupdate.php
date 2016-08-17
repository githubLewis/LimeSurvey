<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* LimeSurvey
* Copyright (C) 2007-2011 The LimeSurvey Project Team / Carsten Schmitz
* All rights reserved.
* License: GNU/GPL License v2 or later, see LICENSE.php
* LimeSurvey is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*
*
*
*/

/**
* Update Database Controller
*
* @package        LimeSurvey
* @subpackage    Backend
*
* This controller must be accessible by unlogged user (in case of modifications of {{permissions}} blocking the login )
*
*/
class databaseupdate extends Survey_Common_Action
{
    /**
    * Update database
    */
    public function db($continue = null)
    {
        Yii::app()->loadHelper("update/update");
        if(isset($continue) && $continue=="yes")
        {
            $aViewUrls['output'] = CheckForDBUpgrades($continue);
            $aData['display']['header'] = false;
        }
        else
        {
            $aData['display']['header'] = true;
            $aViewUrls['output'] = CheckForDBUpgrades();
        }

        $aData['updatedbaction'] = true;

        // TODO: Add admin theme, WITHOUT call _renderWrappedTemplate. We don't want to
        // do any database queries when updating the database.
        $aData = array_merge($aData, $aViewUrls);
        Yii::app()->getController()->renderPartial('databaseupdate/db', $aData);
    }
}
