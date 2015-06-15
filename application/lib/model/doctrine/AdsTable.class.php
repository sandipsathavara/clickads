<?php

/**
 * AdsTable
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
 * AdsTable
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
class AdsTable extends Doctrine_Table
{

    /**
     * Returns an instance of this class.
     *
     * @return object AdsTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Ads');
    }

    /**
     * Returns an instance of this class.
     *
     * @param string $page     display ads on which pages
     * @param string $position position on pages
     * 
     * @return object
     */
    public static function getActiveAds($page = array('BOTH'), $position = 'SIDEBAR125')
    {
        //--- Get Countreis ---//
        $sql = Doctrine_Query::create()
                ->select('a.id,a.ad_type,a.target_url,a.ad_data,a.banner_image')->from('Ads a')
                ->andWhere('a.is_published = 1')
                ->andWhere('(a.start_dt <= ? AND a.end_dt >= ?) OR ( a.start_dt = ?)', array(date("Y-m-d 00:00:00"), date("Y-m-d 00:00:00"), date("0000-00-00 00:00:00")))
                //->orWhere('a.start_dt = ? ', date("0000-00-00 00:00:00"))
                ->andWhere("a.position = '$position'")
                ->andWhereIn("a.page", $page);

        if ($position == 'SIDEBAR125' || $position == 'SIDEBAR200') {
            $sql->limit(sfConfig::get('app_number_ads'))
                ->orderby('rand()');
        } else {
            $sql->limit(1)
                ->orderby('rand()');
        }

        return $sql->execute();
    }

}