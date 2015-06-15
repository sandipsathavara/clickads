<?php

/**
 * AdminPostsForm
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
sfProjectConfiguration::getActive()->loadHelpers(array('I18N', 'General'));

/**
 * AdminPostsForm
 * 
 * PHP version 5.2
 * 
 * @category PHP
 * @package  SfClassi
 * @author   Sandip Sathavara <sandip.sathavara@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.expertswebsolution.com
 * Copyright (c) Experts Web Solution  2012-2013
 * 
 */
class AdminPostsForm extends BasePostsForm
{

    /**
     * configure
     *
     * @return void
     */
    public function configure()
    {
        unset($this['created_at'], $this['updated_at']);
    }

    /**
     * setup
     *
     * @return void
     */
    public function setup()
    {

        $objRequest = sfContext::getInstance()->getRequest();

        $objLangLable = LanguagesTable::getAllActiveLanguageFullName();

        if (count($objLangLable) > 1) {

            $this->setWidgets(array(
                'id' => new sfWidgetFormInputHidden(),
                'user_id' => new sfWidgetFormInputHidden(),
                'country_id' => new sfWidgetFormInputHidden(array(), array('value' => $objRequest->getCookie('id'))),
                'state_id' => new sfWidgetFormDoctrineDependentSelect(array(
                    'model' => 'States',
                    'add_empty' => 'Select State',
                    'table_method' => 'getStatesNameByCountryId',
                        ), array('class' => 'styled')),
                'city_id' => new sfWidgetFormDoctrineDependentSelect(array(
                    'model' => 'Citys',
                    'depends' => 'States',
                    'add_empty' => 'Select City',
                    'ref_method' => 'getStateId',
                    'ajax' => true,
                        ), array('class' => 'styled')),
                'cat_id' => new sfWidgetFormDoctrineChoiceGrouped(array('group_by' => 'root_id',
                    'model' => 'Categories',
                    'table_method' => 'getCategoryGroup',
                    'method' => 'getName',
                    'multiple' => false,
                    'add_empty' => 'Select Category'
                        ), array('class' => 'styled')),
                'lang' => new sfWidgetFormDoctrineChoice(array(
                    'model' => 'Languages',
                    'key_method' => 'getCultureName',
                    'add_empty' => 'Select Language',
                    'table_method' => 'getAllActiveLanguageFullNamePost',
                        ), array('class' => 'styled')),
                'title' => new sfWidgetFormInputText(array(), array('class' => 'text small')),
                'image' => new sfWidgetFormInputFile(array(),array('id' => 'image', 'multiple ' => 'multiple', 'name' => 'posts[image][]')),
                'description' => new sfWidgetFormPostTextareaTinyMCE(array(
                    'width' => 550,
                    'height' => 250,
                    'config' => 'theme_advanced_disable: "anchor,image,cleanup,help"',
                        )),
                'price' => new sfWidgetFormInputText(array(), array('class' => 'text small')),
                'name' => new sfWidgetFormInputText(array(), array('class' => 'text small')),
                'phone' => new sfWidgetFormInputText(array(), array('class' => 'text small')),
                'reply_to' => new sfWidgetFormInputText(array(), array('class' => 'text small')),
                'status' => new sfWidgetFormInputCheckbox(),
                'is_featured' => new sfWidgetFormInputCheckbox(array(),array('value'=>1)),
                    #'zip'         => new sfWidgetFormInputText(),
            ));
        } else {

            $this->setWidgets(array(
                'id' => new sfWidgetFormInputHidden(),
                'user_id' => new sfWidgetFormInputHidden(),
                'country_id' => new sfWidgetFormInputHidden(array(), array('value' => $objRequest->getCookie('id'))),
                'state_id' => new sfWidgetFormDoctrineDependentSelect(array(
                    'model' => 'States',
                    'add_empty' => 'Select State',
                    'table_method' => 'getStatesNameByCountryId',
                        ), array('class' => 'styled')),
                'city_id' => new sfWidgetFormDoctrineDependentSelect(array(
                    'model' => 'Citys',
                    'depends' => 'States',
                    'add_empty' => 'Select City',
                    'ref_method' => 'getStateId',
                    'ajax' => true,
                        ), array('class' => 'styled')),
                'cat_id' => new sfWidgetFormDoctrineChoiceGrouped(array('group_by' => 'root_id',
                    'model' => 'Categories',
                    'table_method' => 'getCategoryGroup',
                    'method' => 'getName',
                    'multiple' => false,
                    'add_empty' => 'Select Category'
                        ), array('class' => 'styled')),
                'lang' => new sfWidgetFormInputHidden(),
                'title' => new sfWidgetFormInputText(array(), array('class' => 'text small')),
                'image' => new sfWidgetFormInputFile(array(),array('id' => 'image', 'multiple ' => 'multiple', 'name' => 'posts[image][]')),
                'description' => new sfWidgetFormPostTextareaTinyMCE(array(
                    'width' => 550,
                    'height' => 250,
                    'config' => 'theme_advanced_disable: "anchor,image,cleanup,help"',
                        ), array('class' => 'styled')),
                'price' => new sfWidgetFormInputText(array(), array('class' => 'text small')),
                'name' => new sfWidgetFormInputText(array(), array('class' => 'text small')),
                'phone' => new sfWidgetFormInputText(array(), array('class' => 'text small')),
                'reply_to' => new sfWidgetFormInputText(array(), array('class' => 'text small')),
                'status' => new sfWidgetFormInputCheckbox(),
                'is_featured' => new sfWidgetFormInputCheckbox(array(),array('value'=>1)),
                    #'zip'         => new sfWidgetFormInputText(),
            ));
        }

        
       

        $this->setValidators(array(
            'id' => new sfValidatorString(array('required' => false), array()),
            'user_id' => new sfValidatorString(array('required' => false), array()),
            'country_id' => new sfValidatorString(array('required' => false), array('required' => 'Select a country')),
            'state_id' => new sfValidatorString(array(), array('required' => 'Select a state')),
            'city_id' => new sfValidatorString(array(), array('required' => 'Select a city')),
            'cat_id' => new sfValidatorString(array(), array('required' => 'Select a Category')),
            'lang' => new sfValidatorString(array(), array('required' => 'Language is required')),
            'title' => new sfValidatorString(array('max_length' => 255), array('required' => 'Title is required')),
            'image' => new sfValidatorMultiFile(array(
                'required' => false,
                'path' => sfConfig::get('sf_upload_dir') . DIRECTORY_SEPARATOR . 'posts' . DIRECTORY_SEPARATOR . 'o',
                'mime_types' => 'web_images',
                    )),
            'description' => new sfValidatorString(array(), array('required' => 'Description is required')),
            'price' => new sfValidatorNumber(array('required' => false), array('invalid' => 'Please enter a valid price')),
            'name' => new sfValidatorString(array(), array('required' => 'Name is required')),
            'phone' => new sfValidatorNumber(array(), array('required' => 'Phone is required', 'invalid' => 'Enter a valid phone')),
            'reply_to' => new sfValidatorEmail(array(), array('required' => 'Email is required', 'invalid' => 'Enter a valid email')),
            'status' => new sfValidatorString(array('required' => false), array()),
            'is_featured' => new sfValidatorString(array('required' => false), array()),
                # 'zip'         => new sfValidatorString(array('max_length' => 20,'required' => false) , array('required' => __('msg_zip_required','','postad')) ),
        ));

        $this->widgetSchema->setNameFormat('posts[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();
    }

    /**
     * updateUserIdColumn 
     * 
     * @return string
     */
    public function updateUserIdColumn()
    {
        return sfContext::getInstance()->getUser()->getAttribute('id', '', 'oUserInfoClient');
    }

    

    /**
     * This function Override User Id value for DB
     * 
     * @return string
     */
    public function updateStatusColumn()
    {
        return ( $this->getValue('status') == 'publish' ) ? 'publish' : 'unpublish';
    }
    
    /**
     * This function Override User Id value for DB
     * 
     * @return string
     */
    public function updateIsFeaturedColumn()
    {
        return ($this->getValue('is_featured') == 1 ) ? 1 : 0;
    }
    

    /**
     * This function Override cat id value for DB
     * 
     * @return string
     * 
     */
    public function updateLangColumn()
    {
        return sfContext::getInstance()->getUser()->getCulture();
    }

}

