<?php

/**
 * UsersTable
 *
 * PHP version 5.2
 * 
 * @category PHP
 * @package  SfClassi
 * @author   Sandip Sathavara <sandip.sathavara@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.expertswebsolution.com/
 */

sfProjectConfiguration::getActive()->loadHelpers('General');
/**
 * UsersTable
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
class UsersTable extends Doctrine_Table
{

    /**
     * Returns an instance of this class.
     *
     * @return object UsersTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Users');
    }

    /**
     * Classifled Search
     *
     * @param object $oform     form object
     * @param string $user_type User type for login
     *
     * @return string
     */ 
    public static function checkUserExist($oform, $user_type = 'admin')
    {
        //--- Get Form Field Value ---//
        $email = $oform->getValue('email');
        $password = $oform->getValue('password');

        //--- Get User Information ---//
        $oUser = self::getInstance()->findOneByEmailAndUserTypeAndStatus($email, $user_type, 1);

        //--- If password match then return data object ---//
        return ($oUser) ? (generatePassword($oUser->getSalt(), $password) == $oUser->getPassword()) ? $oUser : false  : false;
    }


    /**
     * Classifled Search
     *
     * @param string $email1 User type for login
     *
     * @return string
     */    
    public static function checkIsEmailExist($email = '')
    {
        $objUser = self::getInstance()->findOneByEmail($email);

        //--- Check Id Email exist them return true ---//
        
        return ($objUser) ? $objUser : false;
    }

    /**
     * Returns an instance of this class.
     *
     * @param object $oform     form object
     * @param string $user_type User type for login
     * 
     * @return object UsersTable
     */
    public static function isPasswordExist($oform, $user_type = 'user')
    {
        //--- Get Form Field Value ---//
        $password = $oform->getValue('old_password');

        //--- Get Default Culture ---//
        $oUserSession = sfContext::getInstance()->getUser();
        $email = $oUserSession->getAttribute('email', '', 'oUserInfoClient');

        //--- Get User Information ---//
        $oUser = self::getInstance()->findOneByEmailAndUserType($email, $user_type);

        //--- If password match then return data object ---//
        return ( $oUser ) ? (generatePassword($oUser->getSalt(), $password) == $oUser->getPassword() ) ? $oUser : false  : false;
    }

    /**
     * Returns an instance of this class.
     *
     * @return List of user by date
     */
    public static function getNumberOfUsers()
    {
        $q = self::getInstance()->createQuery('u')
                ->select('COUNT(u.created_at) AS currUser,DATE_FORMAT(u.created_at,"%e") AS day')
                ->where('DATE_FORMAT(u.created_at,"%Y") = ?', date('Y'))
                ->groupBy('day')
                ->orderBy('day');

        return $q->execute(array(), Doctrine_Core::HYDRATE_ARRAY);
    }

    /**
     * Returns an instance of this class.
     *
     * @return List of user by date
     */
    public static function getNumberOfUsersByMonths()
    {
        $q = self::getInstance()->createQuery('u')
            ->select('COUNT(u.created_at) AS numberUsers,DATE_FORMAT(u.created_at,"%c") AS month')
            ->where('DATE_FORMAT(u.created_at,"%Y") = ?', date('Y'))
            ->groupBy('month')
            ->orderBy('month');

        return $q->execute(array(), Doctrine_Core::HYDRATE_ARRAY);
    }

    /**
     * Returns an instance of this class.
     *
     * @return List of user by date
     */
    public static function doSelectUsers(Doctrine_Query $q)
    {   
        
        //--- Get Alias ---//
        $rootAlias = $q->getRootAlias();
        
        $oUserSession = sfContext::getInstance()->getUser();
        $id = $oUserSession->getAttribute('id', '', 'oUserInfoClient');
        
        $q->orderBy($rootAlias.'.created_at DESC');
        $q->where($rootAlias.'.id != ?', $id);

        return $q;
    }
    
    /**
     * Returns an instance of this class.
     *
     * @return List of user by date
     */
    public static function getNewest10Users()
    {
        $q = self::getInstance()->createQuery('u')
            ->select('nickname,email')
            ->orderBy('id DESC')
            ->limit(10);

        return $q->execute();
    }

}