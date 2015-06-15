<?php

/**
 * Categories
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
 * Categories
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
class Categories extends BaseCategories
{

    /**
     * Get get Indented Name 
     * 
     * @return string
     */
    public function getIndentedName()
    {
        return str_repeat('- ', $this['level']) . $this['name'];
    }
    
    /**
     * Get get Indented Name Post 
     * 
     * @return string
     */
    public function getIndentedNamePost()
    {
        return str_repeat(' &nbsp;', ($this['level'] * 4)) . $this;
    }

    /**
     * Get get Indented Name Post 
     * 
     * @param integer $city_id city id  
     * 
     * @return string
     */
    public function getPostCount($city_id = '')
    {
        $q = CategoriesTable::getInstance()->createQuery('p')
                ->select('p.id, COUNT(p.id) as totpost')
                ->from('Posts p')
                ->addWhere("p.city_id = ? ", $city_id)
                ->addWhere("p.cat_id = ? ", $this->id);

        return $q->fetchOne()->getTotpost();
    }

    /**
     * get Parent Id 
     * 
     * @param integer $city_id city id  
     * 
     * @return integer
     */
    public function getParentId()
    {
        if (!$this->getNode()->isValidNode() || $this->getNode()->isRoot()) {
            return null;
        }

        $parent = $this->getNode()->getParent();

        return $parent['id'];
    }

    /**
     * get Cat Id 
     * 
     * @param object $request get all post parameters  
     * 
     * @return integer
     */
    public static function getCatId($request)
    {
        //--- Get City ID ---//
        $q = CategoriesTable::getInstance()->createQuery('c')
                ->select('c.id')
                ->from('Categories c')
                ->leftJoin('c.Translation t WITH t.lang = ?', self::getDefaultCulture())
                ->addWhere("REPLACE(LOWER(t.name),' ','-') = ? ", $request->getParameter('slug_sub_cat'));

        return $q->fetchOne()->getId();
    }

    /**
     * Return post count.
     *
     * @param integer $cat_id categary id   
     * 
     * @return object
     */
    public function getPostsCount($cat_id = '')
    {
        //--- Get Default Culture ---//
        $culture = sfContext::getInstance()->getUser()->getCulture();
        $objRequest = sfContext::getInstance()->getRequest();


        switch ($objRequest->getCookie('flag')) {
        case 'city':
            return Doctrine_Core::getTable('Posts')->findByCatIdAndCityIdAndStatusAndLang($this->getId(), $objRequest->getCookie('id'), 'publish', $culture);
            break;
        case 'state':
            return Doctrine_Core::getTable('Posts')->findByCatIdAndStateIdAndStatusAndLang($this->getId(), $objRequest->getCookie('id'), 'publish', $culture);
            break;
        default:
            return Doctrine_Core::getTable('Posts')->findByCatIdAndStatusAndLang($this->getId(), 'publish', $culture);
        }
    }

}