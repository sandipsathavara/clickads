<?php

/**
 * BaseCountries
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $name
 * @property string $currency
 * @property boolean $status
 * @property Doctrine_Collection $States
 * @property Doctrine_Collection $Citys
 * @property Doctrine_Collection $Posts
 * 
 * @method string              getName()     Returns the current record's "name" value
 * @method string              getCurrency() Returns the current record's "currency" value
 * @method boolean             getStatus()   Returns the current record's "status" value
 * @method Doctrine_Collection getStates()   Returns the current record's "States" collection
 * @method Doctrine_Collection getCitys()    Returns the current record's "Citys" collection
 * @method Doctrine_Collection getPosts()    Returns the current record's "Posts" collection
 * @method Countries           setName()     Sets the current record's "name" value
 * @method Countries           setCurrency() Sets the current record's "currency" value
 * @method Countries           setStatus()   Sets the current record's "status" value
 * @method Countries           setStates()   Sets the current record's "States" collection
 * @method Countries           setCitys()    Sets the current record's "Citys" collection
 * @method Countries           setPosts()    Sets the current record's "Posts" collection
 * 
 * @package    classifieds
 * @subpackage model
 * @author     Sandip Sathavara <sandip.sathavara@gmail.com>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCountries extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('countries');
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('currency', 'string', 10, array(
             'type' => 'string',
             'notnull' => true,
             'default' => 'INR',
             'length' => 10,
             ));
        $this->hasColumn('status', 'boolean', null, array(
             'type' => 'boolean',
             'default' => 1,
             ));

        $this->option('type', 'InnoDB');
        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('States', array(
             'local' => 'id',
             'foreign' => 'country_id'));

        $this->hasMany('Citys', array(
             'local' => 'id',
             'foreign' => 'country_id'));

        $this->hasMany('Posts', array(
             'local' => 'id',
             'foreign' => 'country_id'));

        $i18n0 = new Doctrine_Template_I18n(array(
             'fields' => 
             array(
              0 => 'name',
             ),
             ));
        $this->actAs($i18n0);
    }
}