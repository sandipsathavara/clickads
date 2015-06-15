<?php

/**
 * PostsTable
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
 * PostsTable
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
class PostsTable extends Doctrine_Table
{

    /**
     * Returns an instance of this class.
     *
     * @return object
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Posts');
    }

    /**
     * get Posts By Category
     *
     * @params $cat_id categary id  
     * 
     * @return object
     */
    public static function getPostsByCategory($cat_id = '')
    {
        //--- Get Default Culture ---//
        $culture = sfContext::getInstance()->getUser()->getCulture();

        return self::getInstance()->findOneByCatIdAndLang($cat_id, $culture);
    }

    /**
     * get Post By PostId
     * 
     * @params $cat_id categary id
     * 
     * @return object 
     */
    public static function getPostByPostId($post_id = '')
    {
        //--- Get Default Culture ---//
        $culture = sfContext::getInstance()->getUser()->getCulture();

        $q = Doctrine_Query::create()->select('p.*,pi.image as image,pi.is_cover as is_cover,c.currency,ct.id')
                ->from('Posts p')
                ->leftJoin('p.PostImages pi')
                ->leftJoin('p.Citys ct')
                ->leftJoin('p.Countries c')
                ->andWhere("p.lang = '$culture'")
                ->andWhere("p.id = '$post_id'");

        return $q->fetchOne(array(), Doctrine_Core::HYDRATE_RECORD);
    }

    /**
     * do Select Join     
     *
     * @params Doctrine_Query $q Query
     * 
     * @return array 
     */
    public function doSelectJoin(Doctrine_Query $q)
    {
        //--- Get Default Culture ---//
        $culture = sfContext::getInstance()->getUser()->getCulture();

        //--- Get Alias ---//
        $rootAlias = $q->getRootAlias();
        $q->select($rootAlias . '.title,' . $rootAlias . '.price,' . $rootAlias . '.created_at,(SELECT u.nickname FROM USERS u WHERE u.id=' . $rootAlias . '.user_id) AS ' . $rootAlias . '.nickname');
        $q->leftJoin($rootAlias . '.Categories c');
        $q->leftJoin('c.Translation ct');
        $q->addWhere('ct.lang = ?', $culture);
        $q->orderby($rootAlias . '.created_at DESC');
    }

    /**
     * get Number Of Posts
     *
     * @return object
     */
    public static function getNumberOfPosts()
    {
        $q = self::getInstance()->createQuery('p')
                ->select('COUNT(p.created_at) AS currPost,DATE_FORMAT(p.created_at,"%e") AS day')
                ->where('DATE_FORMAT(p.created_at,"%Y") = ?', date('Y'))
                ->groupBy('day')
                ->orderBy('day');

        return $q->execute(array(), Doctrine_Core::HYDRATE_ARRAY);
    }

    /**
     * get Number OfPosts By Months
     *
     * @return array
     */
    public static function getNumberOfPostsByMonths()
    {
        $q = self::getInstance()->createQuery('p')
                ->select('COUNT(p.created_at) AS numberPosts,DATE_FORMAT(p.created_at,"%c") AS month')
                ->where('DATE_FORMAT(p.created_at,"%Y") = ?', date('Y'))
                ->groupBy('month')
                ->orderBy('month');

        return $q->execute(array(), Doctrine_Core::HYDRATE_ARRAY);
    }

    /**
     * get Newest 10 Posts
     *
     * @return object
     */
    public static function getNewest10Posts()
    {
        $q = self::getInstance()->createQuery('p')
                ->select('p.title,p.user_id')
                ->orderBy('p.id DESC')
                ->limit(10);

        return $q->execute();
    }

    /**
     * deleteFreePosts
     *
     * @return object
     */
    public static function deleteFreePosts()
    {
        $q = self::getInstance()->createQuery('p')
                ->andWhere('p.created_at > ?', date('Y-m-d', time() - 60 * 60 * 24 * 160));

        return $q->execute();
    }

    /**
     * deleteFreePosts
     *
     * @return object
     */
    public static function featureToFreePosts()
    {
        $q = self::getInstance()->createQuery('p')
                ->update()
                ->set('p.is_featured','?', 0)
                ->andWhere('p.created_at < ?', date('Y-m-d', time() - 60 * 60 * 24 * 30));
        
        return $q->execute();
    }
    
    
    
    /**
     * get Newest 10 Free Posts
     *
     * @return object
     */
    public static function getNewestFreePosts()
    {
        //--- Get Default Culture ---//
        $culture = sfContext::getInstance()->getUser()->getCulture();

        $q = self::getInstance()->createQuery('p')
                ->select('p.title,ct.name as catname,pi.image as image,pi.is_cover as is_cover,cnty.currency,c.id')
                ->leftJoin('p.Categories c')
                ->leftJoin('c.Translation ct')
                ->leftJoin('p.PostImages pi')
                ->leftJoin('p.Countries cnty')
                ->leftJoin('cnty.Translation cntyt')
                ->andWhere('p.lang = ?', $culture)
                ->addWhere('ct.lang = ?', $culture)
                ->addWhere('cntyt.lang = ?', $culture)
                ->addWhere('p.is_featured = 0')
                ->addWhere('p.status= ?', "publish")
                ->orderBy('p.created_at DESC')
                ->limit(5);

        return $q->execute();
    }

    /**
     * get Newest 10 Features Posts
     *
     * @return object
     */
    public static function getNewestFeaturedPosts()
    {
        //--- Get Default Culture ---//
        $culture = sfContext::getInstance()->getUser()->getCulture();

        $q = self::getInstance()->createQuery('p')
                ->select('p.title,ct.name as catname,pi.image as image,pi.is_cover as is_cover,cnty.currency,c.id')
                ->leftJoin('p.Categories c')
                ->leftJoin('c.Translation ct')
                ->leftJoin('p.PostImages pi')
                ->leftJoin('p.Countries cnty')
                ->leftJoin('cnty.Translation cntyt')
                ->andWhere('p.lang = ?', $culture)
                ->addWhere('ct.lang = ?', $culture)
                ->addWhere('cntyt.lang = ?', $culture)
                ->addWhere('p.is_featured = 1')
                ->addWhere('p.status= ?', "publish")
                ->andWhere('p.created_at > ?', date('Y-m-d', time() - 60 * 60 * 24 * 30))
                ->orderBy('p.created_at DESC')
                ->limit(10);

        return $q->execute();
    }

    /**
     * publish Post By Id
     *
     * @params Doctrine_Query $id id
     *  
     * @return array
     */
    public static function publishPostById($id = '')
    {
        $q = self::getInstance()
                ->createQuery('l')
                ->update()
                ->set("status", '?', "publish")
                ->set("is_featured", '?', "1")
                ->where("id = ?", $id);

        return $q->execute();
    }
    
    
    /**
     * Get Related Posts By Title
     *
     * @params string $title title
     * 
     * @return object
     */
    public static function getRelatedPostByTitle($title='')
    {
        
       // return self::getInstance()->search('test');
        
       // $newsItemTable->search('test');
       // print $title;
       // $title = str_replace($search, $replace, $subject)
        
    }
    

}