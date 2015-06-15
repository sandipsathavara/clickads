<?php

/**
 * StatesTable
 *
 * PHP version 5.2
 * 
 * @category PHP
 * @package  SfClassi
 * @author   Sandip Sathavara <sandip.sathavara@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.expertswebsolution.com/
 */

/**
 * StatesTable
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
class StatesTable extends Doctrine_Table
{

    /**
     * Returns an instance of this class.
     *
     * @return object StatesTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('States');
    }

    /**
     * Returnt States      
     * 
     * @param string $country_id country_id 
     * 
     * @return array    
     */
    public static function getStatesNameByCountryId($country_id = '')
    {
        //--- Get Default culture ---//
        $culture = sfContext::getInstance()->getUser()->getCulture();

        //--- Get Countreis ---//
        $sql = Doctrine_Query::create()
            ->select('s.id , t.name')
            ->from('States s')
            ->leftJoin('s.Translation t')
            ->andWhere('s.status = 1')
            ->andWhere("t.lang = '$culture'")
            ->orderBy("t.name ASC");

        return $rq = $sql->execute();
    }

    /**
     * Retuern States      
     *
     * @return array of StatesTable   
     */
    public static function getAllStates()
    {
        //--- Get Default culture ---//
        $culture = sfContext::getInstance()->getUser()->getCulture();

        //--- Get Countreis ---//
        $sql = self::getInstance()
                ->createQuery('s')
                ->leftJoin('s.Translation t')
                ->leftJoin('s.Citys c')
                ->leftJoin('c.Posts p WITH p.status="publish"')
                ->leftJoin('s.Posts ps WITH ps.status="publish"')
                ->leftJoin('c.Translation ct')
                ->andWhere('s.status = 1')
                ->andWhere('c.status = 1')
                ->andWhere("ct.lang = '$culture'")
                ->orderBy("t.name ASC");

        return $rq = $sql->execute();
    }

    /**
     * Return States      
     * 
     * @param Doctrine_Query $q query from yml  
     * 
     * @return array    
     */
    public function doSelectJoinTranslation(Doctrine_Query $q)
    {
        //--- Get Alias ---//
        $rootAlias = $q->getRootAlias();

        //--- Get Default Culture ---//
        $culture = sfContext::getInstance()->getUser()->getCulture();

        $q->leftJoin($rootAlias . '.Countries c')
            ->leftJoin('c.Translation ct')
            ->addwhere($rootAlias . '.status = 1')
            ->addwhere('c.status = 1')
            ->addwhere('ct.lang = ?', $culture);
    }

    /**
     * Return States      
     * 
     * @param Doctrine_Query $state_id state id  
     * 
     * @return array    
     */
    public static function getCitiesByStateId($state_id)
    {
        //--- Get Default Culture ---//
        $culture = sfContext::getInstance()->getUser()->getCulture();

        //--- Get Countreis ---//
        $sql = self::getInstance()
                ->createQuery('s')
                ->leftJoin('s.Translation t')
                ->leftJoin('s.Citys c')
                ->leftJoin('c.Posts p  WITH p.status="publish" ')
                ->leftJoin('c.Translation ct')
                ->andWhere('s.status = 1')
                ->andWhere('c.status = 1')
                ->andWhere("ct.lang = '$culture'")
                ->andWhere("c.state_id= '$state_id'");

        return $sql->execute();
    }

    /**
     * Retuern Countries Name with State    
     *
     * @return array 
     */
    public static function getPopularStateOfCountry()
    {
        //--- Get Default Culture ---//
        $culture = sfContext::getInstance()->getUser()->getCulture();

        //--- Get Countreis ---//
        $sql = self::getInstance()
                ->createQuery('s')
                ->leftJoin('s.Translation t')
                ->leftJoin('s.Countries cnt')
                ->leftJoin('s.Posts ps WITH ps.status="publish" ')
                ->andWhere('s.status = 1')
                ->andWhere('cnt.status = 1')
                ->andWhere('s.is_popular = 1')
                ->andWhere("t.lang = '$culture'")
                ->OrderBy("t.name ASC");

        return $sql->execute();
    }

    /**
     * Retuern State Name with State    
     *
     * @return array of StatesTable 
     */
    public static function getSingleStateName()
    {
        //--- Get Default Culture ---//
        $culture = sfContext::getInstance()->getUser()->getCulture();
        $id = sfContext::getInstance()->getRequest()->getParameter('id');

        $sql = Doctrine_Query::create()
                ->select('s.id , t.name')
                ->from('States s')
                ->leftJoin('s.Translation t')
                ->andWhere('s.status = 1')
                ->andWhere('s.id = ?', $id)
                ->andWhere("t.lang = '$culture'")
                ->limit(1);

        $rq = $sql->fetchOne();
        $arr = array();

        if (isset($rq->id)) {
            $arr['id'] = $rq->id;
            $arr['name'] = $rq->name;
        }

        return isset($arr) ? $arr : array();
    }

}