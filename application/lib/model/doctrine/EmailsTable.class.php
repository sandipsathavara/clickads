<?php

/**
 * EmailsTable
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
 * EmailsTable
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
class EmailsTable extends Doctrine_Table
{

    /**
     * Returns an instance of this class.
     *
     * @return object
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Emails');
    }

    /**
     * do Select Join Translation    
     *   
     * @param string $q Query
     * 
     * @return array  
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
     * get Email Formate
     *  
     * @param integer $id id 
     * 
     * @return object 
     */
    public function getEmailFormate($id = '')
    {
        //--- Get Default Culture ---//
        $culture = sfContext::getInstance()->getUser()->getCulture();

        //--- Get Email ---//
        $q = Doctrine_Core::getTable('Emails')->createQuery('e')
                ->leftJoin('e.Translation t')
                ->andWhere('e.status = 1')
                ->andWhere("t.lang = '$culture'")
                ->andWhere("t.id = '$id'")
                ->limit(1);

        return $q->execute();
    }

}