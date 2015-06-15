<?php
/**
 * CategoriesTable
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
 * CategoriesTable
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
class CategoriesTable extends Doctrine_Table
{

    /**
     * Returns an instance of this class.
     *
     * @return object CategoriesTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Categories');
    }

    /**
     * Return Categories      
     *
     * @return array of CategoriesTable 
     */
    public static function doSelect()
    {
        $q = self::getInstance()
                ->createQuery('c')
                ->leftJoin('c.Translation ct')
                ->addwhere('c.level = ?', 0);

        return $q;
    }

    /**
     * Return Categories Name      
     * 
     * @param string $q Table query
     * 
     * @return string
     */
    public function doSelectJoinTranslation(Doctrine_Query $q)
    {
        //--- Get Alias ---//
        $rootAlias = $q->getRootAlias();
        return $q;
    }

    /**
     * Return Categories Name      
     *
     * @return object 
     */
    public static function getCategory()
    {
        //--- Get Default Culture ---//
        $culture = sfContext::getInstance()->getUser()->getCulture();
        $objRequest = sfContext::getInstance()->getRequest();

        //--- Create Base Query or Fetch Subcategory ---//
        $q = self::getInstance()
                ->createQuery('c')
                ->select('c.id, ct.name,c.root_id ')
                ->leftJoin('c.Translation ct');


        switch ($objRequest->getCookie('flag')) {
        case 'city':
            $q->leftJoin('c.Posts pc WITH pc.status="publish" AND pc.city_id = ? ', $objRequest->getCookie('id'));
            break;

        case 'state':
            $q->leftJoin('c.Posts pc WITH pc.status="publish" AND pc.state_id = ? ', $objRequest->getCookie('id'));
            break;
        default:
            $q->leftJoin('c.Posts pc WITH pc.status="publish" ');
        }
        $q->addWhere('ct.lang = ?', $culture);
        $q->orderBy('c.root_id  ASC,c.lft ASC');
        
        //--- Create Tree Object for get Category  ---//	
        $treeObject = self::getCategoryTreeObject();
        $treeObject->setBaseQuery($q);

        return $treeObject;
    }

    /**
     * Return Categories Name  
     *     
     * @return array of CategoriesTable 
     */
    public static function getCategoryGroup()
    {
        //--- Get Default Culture ---//
        $culture = sfContext::getInstance()->getUser()->getCulture();

        //--- Create Base Query or Fetch Subcategory ---//
        $q = self::getInstance()
                ->createQuery('c')
                ->select('c.id, ct.*,c.root_id,c.level')
                ->leftJoin('c.Translation ct')
                ->addWhere('ct.lang = ?', $culture)
                ->orderBy('c.root_id  ASC,c.lft ASC');

        return $q;
    }

    /**
     * Return Categories Name      
     *
     * @return array of CategoriesTable 
     */
    public static function getCategoryGroupForSearch()
    {
        //--- Get Default Culture ---//
        $culture = sfContext::getInstance()->getUser()->getCulture();

        //--- Create Base Query or Fetch Subcategory ---//
        $q = self::getInstance()
                ->createQuery('c')
                ->select('c.id, ct.*,c.root_id,c.level')
                ->leftJoin('c.Translation ct')
                ->addWhere('ct.lang = ?', $culture)
                ->orderBy('c.root_id  ASC,c.lft ASC');

        return $q->execute();
    }

    /**
     * Return Countries Name with State     
     *
     * @return array of CategoriesTable 
     */
    public static function getCategoryTreeObject()
    {
        return self::getInstance()->getTree();
    }

    /**
     * Return Countries Name with State     
     *
     * @param string $order sort order
     *  
     * @return array
     */
    public static function setCategoryOrder($order = array())
    {
        $root_id = 1;
        foreach ($order as $k => $arrOrderLine):

            $parent = CategoriesTable::getInstance()->findOneById($arrOrderLine['id']);

            $lft = $parent->getLft();

            foreach ($arrOrderLine['children'] as $kq => $id):

                $lft = ($lft + 1);
                $rgt = ($lft + 1);

                $q = Doctrine_Query::create()
                        ->update('Categories')
                        ->set('root_id', $root_id)
                        ->set('lft', $lft)
                        ->set('rgt', $rgt)
                        ->set('level', 1)
                        ->where('id = ?', $id['id'])
                        ->limit(1);

                $q->execute();

                $lft++;

            endforeach;

            $q = Doctrine_Query::create()
                    ->update('Categories')
                    ->set('root_id', $root_id)
                    ->set('lft', 1)
                    ->set('rgt', $rgt + 1)
                    ->set('level', 0)
                    ->where('id = ? ', $arrOrderLine['id'])
                    ->limit(1);
            $q->execute();

            $lft = $rgt = 0;

            $root_id++;
        endforeach;
    }

}

