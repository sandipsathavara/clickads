<?php
/**
 * Users
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
 * Users
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
class Users extends BaseUsers
{

     /**
     * Returns a name
     *
     * @return object UsersTable
     */
    public function __string()
    {
        return $this->getName();
    }
    
    /**
     * Returns a name
     *
     * @param string $user_id user id 
     * 
     * @return object UsersTable
     */
    static function getUserDetail($user_id = '')
    {
        $objUser = Doctrine::getTable('Users')->find($user_id); 
        return (is_object($objUser)) ? $objUser->getNickname() : 'Guest' ;
    }

}