<?php

/**
 * PagesTable
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
 * PagesTable
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
class PagesTable extends Doctrine_Table
{

    /**
     * Returns an instance of this class.
     *
     * @return object
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Pages');
    }

    /**
     * Return Pages Name      
     * 
     * @param interger $q query
     * 
     * @return string
     */
    public function doSelectJoinTranslation(Doctrine_Query $q)
    {
        //--- Get Alias ---//
        $rootAlias = $q->getRootAlias();

        //--- Get Default Culture ---//
        $culture = sfContext::getInstance()->getUser()->getCulture();

        $q->leftJoin($rootAlias . '.Translation ct')->addwhere('ct.lang = ?', $culture);

        return $q;
    }
    
    /**
     * Return Pages Name      
     * 
     * @param string $slug url slug
     * 
     * @return string
     */
    public static function getPageBySlug($slug = '')
    {
        //--- Get Default Culture ---//
        $culture = sfContext::getInstance()->getUser()->getCulture();

        $q = self::getInstance()->createQuery('p')
                ->leftJoin('p.Translation pt')
                ->andWhere("pt.lang = '$culture'")
                ->andWhere("p.slug = '$slug'")
                ->fetchOne();

        return $q;
    }

}