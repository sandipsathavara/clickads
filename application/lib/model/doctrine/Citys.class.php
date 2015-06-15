<?php

/**
 * Citys
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
 * Citys
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
class Citys extends BaseCitys
{

    /**
     * Returns an instance of this class.
     * 
     * @param integer $state_id state id
     * 
     * @return object
     */
    public static function getCity($state_id = '')
    {
        $objRequest = sfContext::getInstance()->getRequest();

        $city = $objRequest->getParameter('city') ? $objRequest->getParameter('city') : $objRequest->getCookie('city');

        //--- Get City ID ---//
        $q = CitysTable::getInstance()->createQuery('c')
                ->select('c.id')
                ->from('Citys c')
                ->leftJoin('c.Translation t WITH t.lang = ?', self::getDefaultCulture())
                ->addWhere("REPLACE(LOWER(t.name),' ','') = ? ", $city)
                ->addWhere("c.state_id = ? ", $state_id);

         return $q->fetchOne();
    }

}