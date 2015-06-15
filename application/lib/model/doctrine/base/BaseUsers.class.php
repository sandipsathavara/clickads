<?php

/**
 * BaseUsers
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $email
 * @property string $password
 * @property string $nickname
 * @property string $skype
 * @property string $salt
 * @property string $verify_code
 * @property boolean $alert_flag
 * @property boolean $skype_flag
 * @property string $unique_code
 * @property integer $watch_list_count
 * @property timestamp $last_login
 * @property string $ip_address
 * @property boolean $status
 * @property enum $user_type
 * @property integer $ads_count
 * @property integer $post_ads_limit
 * 
 * @method string    getEmail()            Returns the current record's "email" value
 * @method string    getPassword()         Returns the current record's "password" value
 * @method string    getNickname()         Returns the current record's "nickname" value
 * @method string    getSkype()            Returns the current record's "skype" value
 * @method string    getSalt()             Returns the current record's "salt" value
 * @method string    getVerifyCode()       Returns the current record's "verify_code" value
 * @method boolean   getAlertFlag()        Returns the current record's "alert_flag" value
 * @method boolean   getSkypeFlag()        Returns the current record's "skype_flag" value
 * @method string    getUniqueCode()       Returns the current record's "unique_code" value
 * @method integer   getWatchListCount()   Returns the current record's "watch_list_count" value
 * @method timestamp getLastLogin()        Returns the current record's "last_login" value
 * @method string    getIpAddress()        Returns the current record's "ip_address" value
 * @method boolean   getStatus()           Returns the current record's "status" value
 * @method enum      getUserType()         Returns the current record's "user_type" value
 * @method integer   getAdsCount()         Returns the current record's "ads_count" value
 * @method integer   getPostAdsLimit()     Returns the current record's "post_ads_limit" value
 * @method Users     setEmail()            Sets the current record's "email" value
 * @method Users     setPassword()         Sets the current record's "password" value
 * @method Users     setNickname()         Sets the current record's "nickname" value
 * @method Users     setSkype()            Sets the current record's "skype" value
 * @method Users     setSalt()             Sets the current record's "salt" value
 * @method Users     setVerifyCode()       Sets the current record's "verify_code" value
 * @method Users     setAlertFlag()        Sets the current record's "alert_flag" value
 * @method Users     setSkypeFlag()        Sets the current record's "skype_flag" value
 * @method Users     setUniqueCode()       Sets the current record's "unique_code" value
 * @method Users     setWatchListCount()   Sets the current record's "watch_list_count" value
 * @method Users     setLastLogin()        Sets the current record's "last_login" value
 * @method Users     setIpAddress()        Sets the current record's "ip_address" value
 * @method Users     setStatus()           Sets the current record's "status" value
 * @method Users     setUserType()         Sets the current record's "user_type" value
 * @method Users     setAdsCount()         Sets the current record's "ads_count" value
 * @method Users     setPostAdsLimit()     Sets the current record's "post_ads_limit" value
 * 
 * @package    classifieds
 * @subpackage model
 * @author     Sandip Sathavara <sandip.sathavara@gmail.com>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseUsers extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('users');
        $this->hasColumn('email', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'unique' => true,
             'length' => 255,
             ));
        $this->hasColumn('password', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('nickname', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('skype', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('salt', 'string', 64, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 64,
             ));
        $this->hasColumn('verify_code', 'string', 64, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 64,
             ));
        $this->hasColumn('alert_flag', 'boolean', null, array(
             'type' => 'boolean',
             'default' => 0,
             ));
        $this->hasColumn('skype_flag', 'boolean', null, array(
             'type' => 'boolean',
             'default' => 0,
             ));
        $this->hasColumn('unique_code', 'string', 255, array(
             'type' => 'string',
             'default' => 1,
             'length' => 255,
             ));
        $this->hasColumn('watch_list_count', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('last_login', 'timestamp', null, array(
             'type' => 'timestamp',
             'notnull' => true,
             ));
        $this->hasColumn('ip_address', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('status', 'boolean', null, array(
             'type' => 'boolean',
             'default' => 1,
             ));
        $this->hasColumn('user_type', 'enum', null, array(
             'type' => 'enum',
             'default' => 'user',
             'values' => 
             array(
              0 => 'admin',
              1 => 'user',
             ),
             ));
        $this->hasColumn('ads_count', 'integer', null, array(
             'type' => 'integer',
             'default' => 0,
             ));
        $this->hasColumn('post_ads_limit', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));

        $this->option('type', 'InnoDB');
        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}