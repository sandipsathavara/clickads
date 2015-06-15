<?php

/**
 * ClientPostsForm
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
 * ClientPostsForm
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
class ClientPostsForm extends BasePostsForm
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
                    'add_empty' => __('cap_select_state', '', 'postad'),
                    'table_method' => 'getStatesNameByCountryId',
                        )),
                'city_id' => new sfWidgetFormDoctrineDependentSelect(array(
                    'model' => 'Citys',
                    'depends' => 'States',
                    'add_empty' => __('cap_select_city', '', 'postad'),
                    'ref_method' => 'getStateId',
                    'ajax' => true,
                        )),
                'cat_id' => new sfWidgetFormDoctrineChoiceGrouped(array('group_by' => 'root_id',
                    'model' => 'Categories',
                    'table_method' => 'getCategoryGroup',
                    'method' => 'getName',
                    'multiple' => false,
                    'add_empty' => __('cap_select_category', '', 'postad')
                        )),
                'lang' => new sfWidgetFormDoctrineChoice(array(
                    'model' => 'Languages',
                    'key_method' => 'getCultureName',
                    'add_empty' => __('cap_select_language', '', 'postad'),
                    'table_method' => 'getAllActiveLanguageFullNamePost',
                        )),
                'title' => new sfWidgetFormInputText(),
                'image' => new sfWidgetFormInputFile(),
                'description' => new sfWidgetFormPostTextareaTinyMCE(array(
                    'width' => 550,
                    'height' => 250,
                    'config' => 'theme_advanced_disable: "anchor,image,cleanup,help"',
                        )),
                'price' => new sfWidgetFormInputText(),
                'name' => new sfWidgetFormInputText(),
                'phone' => new sfWidgetFormInputText(),
                'reply_to' => new sfWidgetFormInputText(),
                'status' => new sfWidgetFormInputHidden(),
                'is_featured' => new sfWidgetFormInputCheckbox(array('value_attribute_value' => "")),
                    #'zip'         => new sfWidgetFormInputText(),
            ));
        } else {

            $this->setWidgets(array(
                'id' => new sfWidgetFormInputHidden(),
                'user_id' => new sfWidgetFormInputHidden(),
                'country_id' => new sfWidgetFormInputHidden(array(), array('value' => $objRequest->getCookie('id'))),
                'state_id' => new sfWidgetFormDoctrineDependentSelect(array(
                    'model' => 'States',
                    'add_empty' => __('cap_select_state', '', 'postad'),
                    'table_method' => 'getStatesNameByCountryId',
                        )),
                'city_id' => new sfWidgetFormDoctrineDependentSelect(array(
                    'model' => 'Citys',
                    'depends' => 'States',
                    'add_empty' => __('cap_select_city', '', 'postad'),
                    'ref_method' => 'getStateId',
                    'ajax' => true,
                        )),
                'cat_id' => new sfWidgetFormDoctrineChoiceGrouped(array('group_by' => 'root_id',
                    'model' => 'Categories',
                    'table_method' => 'getCategoryGroup',
                    'method' => 'getName',
                    'multiple' => false,
                    'add_empty' => __('cap_select_category', '', 'postad')
                        )),
                'lang' => new sfWidgetFormInputHidden(),
                'title' => new sfWidgetFormInputText(),
                'image' => new sfWidgetFormInputFile(),
                'description' => new sfWidgetFormPostTextareaTinyMCE(array(
                    'width' => 550,
                    'height' => 250,
                    'config' => 'theme_advanced_disable: "anchor,image,cleanup,help"',
                        )),
                'price' => new sfWidgetFormInputText(),
                'name' => new sfWidgetFormInputText(),
                'phone' => new sfWidgetFormInputText(),
                'reply_to' => new sfWidgetFormInputText(),
                'status' => new sfWidgetFormInputHidden(),
                'is_featured' => new sfWidgetFormInputCheckbox(array('value_attribute_value' => "")),
                    #'zip'         => new sfWidgetFormInputText(),
            ));
        }

        //$this->setDefault('is_featured', false);
        $this->setValidators(array(
            'id' => new sfValidatorString(array('required' => false), array()),
            'user_id' => new sfValidatorString(array('required' => false), array()),
            'country_id' => new sfValidatorString(array('required' => false), array('required' => __('msg_select_country', '', 'postad'))),
            'state_id' => new sfValidatorString(array(), array('required' => __('msg_select_state', '', 'postad'))),
            'city_id' => new sfValidatorString(array(), array('required' => __('msg_select_city', '', 'postad'))),
            'cat_id' => new sfValidatorString(array(), array('required' => __('msg_select_category', '', 'postad'))),
            'lang' => new sfValidatorString(array(), array('required' => __('msg_select_language', '', 'postad'))),
            'title' => new sfValidatorString(array('max_length' => 255), array('required' => __('msg_title_required', '', 'postad'))),
            'image' => new sfValidatorMultiFile(array(
                'required' => false,
                'path' => sfConfig::get('sf_upload_dir') . DIRECTORY_SEPARATOR . 'posts' . DIRECTORY_SEPARATOR . 'o',
                'mime_types' => 'web_images',
                    )),
            'description' => new sfValidatorString(array(), array('required' => __('msg_description_required', '', 'postad'))),
            'price' => new sfValidatorNumber(array('required' => false), array('invalid' => __('msg_invalid_price', '', 'postad'))),
            'name' => new sfValidatorString(array(), array('required' => __('msg_name_required', '', 'postad'))),
            'phone' => new sfValidatorNumber(array(), array('required' => __('msg_phone_required', '', 'postad'), 'invalid' => __('msg_invalid_phone', '', 'postad'))),
            'reply_to' => new sfValidatorEmail(array(), array('required' => __('msg_email_required', '', 'postad'), 'invalid' => __('msg_invalid_email', '', 'postad'))),
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
     * updateIsFeaturedColumn 
     * 
     * @return void
     */
    public function updateIsFeaturedColumn()
    {
        return  $this->getObject()->getIsFeatured() == 1 ? 1 : 0;
    }

    /**
     * This function Override User Id value for DB
     * 
     * @return string
     */
    public function updateStatusColumn()
    {
        return (sfConfig::get('is_verify_post') == 'on' ||  $this->getObject()->getStatus() == 'unpublish'  ) ? 'unpublish' : 'publish';
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

