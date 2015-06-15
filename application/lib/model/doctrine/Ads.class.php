<?php

/**
 * Ads
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
 * Ads
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

class Ads extends BaseAds
{
    /**
     * get Page Value
     *
     * @return array
     */
    public function getPageValue()
    {
        $arr = sfConfig::get('app_pages');
        return $arr[$this->getPage()];
    }
    
    /**
     * get Position Value
     *
     * @return array
     */
    public function getPositionValue()
    {
        $arr = sfConfig::get('app_ad_position');
        return $arr[$this->getPosition()];
    }

    /**
     * get Ad Type Value
     *
     * @return array
     */
    public function getAdTypeValue()
    {
        $arr = sfConfig::get('app_ad_type');
        return $arr[$this->getAdType()];
    }

}