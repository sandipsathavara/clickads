<?php

/**
 * LanguagesTable
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
 * LanguagesTable
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
class LanguagesTable extends Doctrine_Table
{

    /**
     * Returns an instance of this class.
     *
     * @return object
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Languages');
    }

    /**
     * get All Active Language. 
     *
     * @return array
     */
    public static function getAllActiveLanguage()
    {
        $q = self::getInstance()
                ->createQuery('l')
                ->select('l.culture')
                ->where('l.status= ?', 1);
        $lang = $q->execute(array(), Doctrine_Core::HYDRATE_SINGLE_SCALAR);

        return is_array($lang) ? $lang : array($lang);
    }

    /**
     * get All Active Language FullName 
     *
     * @return object
     */
    public static function getAllActiveLanguageFullName()
    {
        $q = self::getInstance()
                ->createQuery('l')
                ->select('l.name,l.culture')
                ->where('l.status= ?', 1);

        return $q->execute(array(), Doctrine_Core::HYDRATE_ARRAY);
    }

    /**
     * get AllActive Language FullName Post 
     *
     * @return string
     */
    public static function getAllActiveLanguageFullNamePost()
    {
        $q = self::getInstance()
                ->createQuery('l')
                ->select('l.name,l.culture')
                ->where('l.status= ?', 1);

        return $q;
    }

    /**
     * set Default Language 
     * 
     * @param interger $id language id
     * 
     * @return object
     */
    public static function setDefaultLanguage($id = '')
    {
        $q = self::getInstance()
                ->createQuery('l')
                ->update()
                ->set("is_default", "IF( id=$id , 1 ,0 )");

        return $q->execute();
    }

}