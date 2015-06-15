<?php

/**
 * CitysTable
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
 * CitysTable
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
class CitysTable extends Doctrine_Table {

    /**
     * Returns an instance of this class.
     *
     * @return object CitysTable
     */
    public static function getInstance() {
        return Doctrine_Core::getTable('Citys');
    }

    /**
     * Return Citys Name      
     *
     * @return array of CitysTable 
     */
    public function doSelectJoinTranslation(Doctrine_Query $q) {
        #--- Get Alias ---#
        $rootAlias = $q->getRootAlias();

        #--- Get Default Culture ---#
        $culture = sfContext::getInstance()->getUser()->getCulture();

        $q->leftJoin($rootAlias . '.States s')
                ->leftJoin($rootAlias . '.Countries c')
                ->leftJoin('c.Translation ctry')
                ->leftJoin('s.Translation st')
                ->addwhere('s.status = 1')
                ->addwhere('c.status = 1')
                ->addwhere("st.lang = ?", $culture)
                ->addwhere("ctry.lang = ?", $culture);
    }

    /**
     * Return CitysTable Name      
     *
     * @return array of CitysTable 
     */
    public function getCityName() {
        #--- Get Default Culture ---#
        $culture = sfContext::getInstance()->getUser()->getCulture();

        #--- Get CitysTable ---#
        $q = self::getInstance()
                ->createQuery('c')
                ->select('c.id , t.name')
                ->leftJoin('c.Translation t')
                ->andWhere('c.status = 1')
                ->andWhere("t.lang = '$culture'");

        return $q;
    }

    public static function getPopularCitiesOfCountry() {
        #--- Get Default Culture ---#
        $culture = sfContext::getInstance()->getUser()->getCulture();

        #-- Get cities ---#
        $sql = self::getInstance()
                ->createQuery('c')
                ->leftJoin('c.Translation t')
                ->leftJoin('c.Countries cnt')
                ->leftJoin('c.Posts ps WITH ps.status="publish"')
                ->andWhere('c.status = 1')
                ->andWhere('cnt.status = 1')
                ->andWhere('c.is_popular = 1')
                ->andWhere("t.lang = '$culture'")
                ->OrderBy("t.name ASC");

        return $sql->execute();
    }

    /**
     * Retuern State Name with State    
     *
     * @return array of StatesTable 
     */
    public static function getSingleCityName() {
        #--- Get Default Culture ---#
        $culture = sfContext::getInstance()->getUser()->getCulture();
        $id = sfContext::getInstance()->getRequest()->getParameter('id');

        $sql = Doctrine_Query::create()
                ->select('c.id , t.name')
                ->from('Citys c')
                ->leftJoin('c.Translation t')
                ->andWhere('c.status = 1')
                ->andWhere('c.id = ?', $id)
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