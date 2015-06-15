<?php

/**
 * CountriesTable
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
 * CountriesTable
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
class CountriesTable extends Doctrine_Table
{

    /**
     * Returns an instance of this class.
     *
     * @return object
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Countries');
    }

    /**
     * Select Join Translation1     
     *
     * @param string $q Query
     * 
     * @return string 
     */
    public function doSelectJoinTranslation1(Doctrine_Query $q)
    {
        //--- Get Alias ---//
        $rootAlias = $q->getRootAlias();

        //--- Get Default Culture ---//
        $culture = sfContext::getInstance()->getUser()->getCulture();

        $q->leftJoin($rootAlias . '.Translation ct');
        $q->addwhere('ct.lang = ?', $culture);

        return $q;
    }

    /**
     * get CountryName     
     *
     * @return array 
     */
    public static function getCountryName()
    {
        //-- Get Default culture ---//
        $culture = sfContext::getInstance()->getUser()->getCulture();

        //-- Get Countreis ---//
        $sql = Doctrine_Query::create()
                ->select('c.id , t.name')
                ->from('Countries c')
                ->leftJoin('c.Translation t')
                ->andWhere('c.status = 1')
                ->andWhere("t.lang = '$culture'");

        $rq = $sql->execute();

        $arr[''] = ' Please Select ';
        foreach ($rq as $k => $v) {
            $arr[$v->id] = $v->name;
        }

        return isset($arr) ? $arr : array();
    }

    /**
     * get Country Name With State    
     *
     * @return array of CountriesTable 
     */
    public static function getCountryNameWithState()
    {
        //--- Get Default Culture ---//
        $culture = sfContext::getInstance()->getUser()->getCulture();

        //-- Get Countreis ---//
        $sql = self::getInstance()
                ->createQuery('c')
                ->leftJoin('c.Translation t')
                ->leftJoin('c.States s')
                ->leftJoin('s.Posts ps')
                ->leftJoin('s.Translation st')
                ->andWhere('c.status = 1')
                ->andWhere("st.lang = '$culture'")
                ->andWhere("t.lang = '$culture'")
                ->OrderBy("st.name ASC")
                ->limit(10);

        return $sql->execute();
    }

    /**
     * get Popular State of Country    
     *
     * @return array of CountriesTable 
     */
    public static function getPopularStateOfCountry()
    {
        //--- Get Default Culture ---//
        $culture = sfContext::getInstance()->getUser()->getCulture();

        //--- Get Countreis ---//
        $sql = self::getInstance()
                ->createQuery('c')
                ->leftJoin('c.Translation t')
                ->leftJoin('c.States s')
                ->leftJoin('s.Posts ps')
                ->leftJoin('s.Translation st')
                ->andWhere('c.status = 1')
                ->andWhere('s.is_popular = 1')
                ->andWhere("st.lang = '$culture'")
                ->andWhere("t.lang = '$culture'")
                ->OrderBy("st.name ASC");

        return $sql->execute();
    }

    /**
     * get CountryName If State Avail    
     *
     * @return array 
     */
    public function getCountryNameIfStateAvail()
    {
        //--- Get Default Culture ---//
        $culture = sfContext::getInstance()->getUser()->getCulture();

        //-- Get Countreis ---//
        $sql = self::getInstance()
                ->createQuery('c')
                ->leftJoin('c.Translation t')
                ->innerJoin('c.States s')
                ->andWhere('c.status = 1')
                ->andWhere("t.lang = '$culture'");

        return $sql;
    }

    /**
     * get Single CountryName    
     *
     * @return array 
     */
    public static function getSingleCountryName()
    {
        //-- Get Default culture ---//
        $culture = sfContext::getInstance()->getUser()->getCulture();

        //-- Get Countreis ---//
        $sql = Doctrine_Query::create()
                ->select('c.id , t.name')
                ->from('Countries c')
                ->leftJoin('c.Translation t')
                ->andWhere('c.status = 1')
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