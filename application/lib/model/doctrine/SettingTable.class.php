<?php

/**
 * SettingTable
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
 * SettingTable
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
class SettingTable extends Doctrine_Table
{

    /**
     * Returns an instance of this class.
     *
     * @return object
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Setting');
    }

     /**
     * Returns an instance of this class.
     *
     * @return object
     */
    public static function getAllSetting()
    {
        return self::getInstance()->findAll();
    }

    /**
     * Returns an instance of this class.
     *
     * @return object
     */
    public static function getAllSettingByName()
    {
        switch (sfContext::getInstance()->getActionName()) {
            case 'featurelist':
                return self::getInstance()->findByNameOrNameOrNameOrName('is_paypal_testmode','paypal_seller_account','currency_code','feature_monthly_price');
            break;
            case 'index':
            case 'setting':
                return self::getInstance()->findByNameOrNameOrNameOrNameOrNameOrNameOrName('website_title', 'admin_email', 'is_verify_user', 
                                        'is_user_login', 'site_logo', 'is_verify_post', 'favicon');
            break;
            default:
                return self::getInstance()->findAll();
            break;
        }
    }
    
    /**
     * Returns an instance of this class.
     *
     * @param string $name name of config variable 
     * @return object
     */
    public static function getSettingByName($name = '')
    {
        return self::getInstance()->findOneByName($name);
    }

}