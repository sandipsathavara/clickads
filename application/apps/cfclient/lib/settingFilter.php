<?php

/**
 * Prepar setting for site
 *
 * PHP version 5.2
 * 
 * @category PHP
 * @package  SfClassi
 * @author   Sandip Sathavara <sandip.sathavara@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.expertswebsolution.com/
 *
 */

/**
 * Prepar setting for site
 * 
 * PHP version 5.2
 * 
 * @category PHP
 * @package  SfClassi
 * @author   Sandip Sathavara <sandip.sathavara@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.expertswebsolution.com
 * Copyright (c) Experts Web Solution  2012-2013
 */
class settingFilter extends sfFilter
{

    /**
     * Prepar setting for site.
     *
     * @param sfFilter $filterChain .
     *
     * @return string
     */
    public function execute($filterChain)
    {
        $oSettings = SettingTable::getAllSetting();
        
        foreach ($oSettings as $oSetting) {
            sfConfig::set($oSetting->getName(), $oSetting->getValue());
        }
        // execute next filter
        $filterChain->execute();
    }

}

