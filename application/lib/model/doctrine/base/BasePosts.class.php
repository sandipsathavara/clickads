<?php

/**
 * BasePosts
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $user_id
 * @property integer $country_id
 * @property integer $state_id
 * @property integer $city_id
 * @property integer $cat_id
 * @property string $lang
 * @property string $title
 * @property string $description
 * @property string $name
 * @property float $price
 * @property string $phone
 * @property string $reply_to
 * @property integer $zip
 * @property enum $status
 * @property boolean $is_featured
 * @property Countries $Countries
 * @property States $States
 * @property Citys $Citys
 * @property Categories $Categories
 * @property Doctrine_Collection $PostImages
 * @property PostImages $PostImage
 * 
 * @method integer             getUserId()      Returns the current record's "user_id" value
 * @method integer             getCountryId()   Returns the current record's "country_id" value
 * @method integer             getStateId()     Returns the current record's "state_id" value
 * @method integer             getCityId()      Returns the current record's "city_id" value
 * @method integer             getCatId()       Returns the current record's "cat_id" value
 * @method string              getLang()        Returns the current record's "lang" value
 * @method string              getTitle()       Returns the current record's "title" value
 * @method string              getDescription() Returns the current record's "description" value
 * @method string              getName()        Returns the current record's "name" value
 * @method float               getPrice()       Returns the current record's "price" value
 * @method string              getPhone()       Returns the current record's "phone" value
 * @method string              getReplyTo()     Returns the current record's "reply_to" value
 * @method integer             getZip()         Returns the current record's "zip" value
 * @method enum                getStatus()      Returns the current record's "status" value
 * @method boolean             getIsFeatured()  Returns the current record's "is_featured" value
 * @method Countries           getCountries()   Returns the current record's "Countries" value
 * @method States              getStates()      Returns the current record's "States" value
 * @method Citys               getCitys()       Returns the current record's "Citys" value
 * @method Categories          getCategories()  Returns the current record's "Categories" value
 * @method Doctrine_Collection getPostImages()  Returns the current record's "PostImages" collection
 * @method PostImages          getPostImage()   Returns the current record's "PostImage" value
 * @method Posts               setUserId()      Sets the current record's "user_id" value
 * @method Posts               setCountryId()   Sets the current record's "country_id" value
 * @method Posts               setStateId()     Sets the current record's "state_id" value
 * @method Posts               setCityId()      Sets the current record's "city_id" value
 * @method Posts               setCatId()       Sets the current record's "cat_id" value
 * @method Posts               setLang()        Sets the current record's "lang" value
 * @method Posts               setTitle()       Sets the current record's "title" value
 * @method Posts               setDescription() Sets the current record's "description" value
 * @method Posts               setName()        Sets the current record's "name" value
 * @method Posts               setPrice()       Sets the current record's "price" value
 * @method Posts               setPhone()       Sets the current record's "phone" value
 * @method Posts               setReplyTo()     Sets the current record's "reply_to" value
 * @method Posts               setZip()         Sets the current record's "zip" value
 * @method Posts               setStatus()      Sets the current record's "status" value
 * @method Posts               setIsFeatured()  Sets the current record's "is_featured" value
 * @method Posts               setCountries()   Sets the current record's "Countries" value
 * @method Posts               setStates()      Sets the current record's "States" value
 * @method Posts               setCitys()       Sets the current record's "Citys" value
 * @method Posts               setCategories()  Sets the current record's "Categories" value
 * @method Posts               setPostImages()  Sets the current record's "PostImages" collection
 * @method Posts               setPostImage()   Sets the current record's "PostImage" value
 * 
 * @package    classifieds
 * @subpackage model
 * @author     Sandip Sathavara <sandip.sathavara@gmail.com>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePosts extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('posts');
        $this->hasColumn('user_id', 'integer', 20, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 20,
             ));
        $this->hasColumn('country_id', 'integer', 20, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 20,
             ));
        $this->hasColumn('state_id', 'integer', 20, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 20,
             ));
        $this->hasColumn('city_id', 'integer', 20, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 20,
             ));
        $this->hasColumn('cat_id', 'integer', 20, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 20,
             ));
        $this->hasColumn('lang', 'string', 20, array(
             'type' => 'string',
             'notnull' => true,
             'default' => 'en',
             'length' => 20,
             ));
        $this->hasColumn('title', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('description', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             'length' => '',
             ));
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('price', 'float', null, array(
             'type' => 'float',
             'notnull' => true,
             ));
        $this->hasColumn('phone', 'string', 20, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 20,
             ));
        $this->hasColumn('reply_to', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('zip', 'integer', 20, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 20,
             ));
        $this->hasColumn('status', 'enum', null, array(
             'type' => 'enum',
             'default' => 'publish',
             'values' => 
             array(
              0 => 'publish',
              1 => 'unpublish',
              2 => 'banned',
             ),
             ));
        $this->hasColumn('is_featured', 'boolean', null, array(
             'type' => 'boolean',
             'default' => 0,
             ));

        $this->option('type', 'InnoDB');
        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Countries', array(
             'local' => 'country_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('States', array(
             'local' => 'state_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('Citys', array(
             'local' => 'city_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('Categories', array(
             'local' => 'cat_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasMany('PostImages', array(
             'local' => 'id',
             'foreign' => 'post_id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('PostImages as PostImage', array(
             'local' => 'id',
             'foreign' => 'post_id',
             'onDelete' => 'CASCADE'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}