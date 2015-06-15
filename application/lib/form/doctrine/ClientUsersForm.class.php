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
class ClientUsersForm extends BaseUsersForm
{
    /**
     * configure
     *
     * @return void
     */
    public function configure()
    {
        unset($this['created_at'], $this['updated_at'], $this['skype_flag'], $this['unique_code'], $this['watch_list_count'], $this['last_login'], $this['ip_address'], $this['post_ads_limit'], $this['ads_count']
        );
    }
    
    /**
     * setup
     *
     * @return void
     */
    public function setup()
    {
        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'email' => new sfWidgetFormInputText(),
            'password' => new sfWidgetFormInputPassword(),
            'retype_password' => new sfWidgetFormInputPassword(),
            'nickname' => new sfWidgetFormInputText(),
            'verify_code' => new sfWidgetFormInputHidden(),
            'status' => new sfWidgetFormInputHidden(),
            'captcha' => new sfWidgetCaptchaGDNew(),
            'is_accept' => new sfWidgetFormInputCheckbox(array(), array('value' => 'Yes')),
        ));


        //--- For Add Time  ---//	
        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'email' => new sfValidatorEmail(array(), array('required' => __('msg_email_required', '', 'register'), 'invalid' => __('msg_invalid_email', '', 'register'))),
            'password' => new sfValidatorString(
                    array('required' => true, 'min_length' => 6, 'max_length' => 16), array('min_length' => __('msg_min_password', '', 'register'), 'max_length' => __('msg_max_password', '', 'register'), 'required' => __('msg_password_required', '', 'register'))
            ),
            'retype_password' => new sfValidatorString(array(), array('required' => __('msg_retype_password_required', '', 'register'))),
            'nickname' => new sfValidatorString(array('max_length' => 255), array('required' => __('msg_nickname_required', '', 'register'))),
            'captcha' => new sfCaptchaGDValidator(array('length' => 4), array('required' => __('msg_captcha_required', '', 'register'), 'invalid' => __('msg_invalid_captcha', '', 'register'), 'length' => __('msg_invalid_length', '', 'register'))),
            'verify_code' => new sfValidatorString(array('required' => false)),
            'status' => new sfValidatorString(array('required' => false)),
            'is_accept' => new sfValidatorString(array(), array('required' => __('msg_term_condition', '', 'register'))),
        ));


        $this->validatorSchema->setPostValidator(
            new sfValidatorDoctrineUnique(array('model' => 'Users', 'column' => 'email', 'primary_key' => 'id', 'required' => true, 'throw_global_error' => false), array('invalid' => __('msg_email_exist', '', 'register'))), 
                                            new sfValidatorSchemaCompare('password', sfValidatorSchemaCompare::EQUAL, 'retype_password', 
                                          array(), array('invalid' => __('msg_password_not_match', '', 'register')))
        );

        $this->widgetSchema->setNameFormat('users[%s]');
    }

    /**
     * This function Override password value for DB
     *
     * @return string
     */
    public function updatePasswordColumn()
    {
        //--- Create Salt Value  ---//
        $salt = generateSalt($this->getValue('email'));
        $this->getObject()->setSalt($salt);

        return generatePassword($salt, $this->getValue('password'));
    }

    /**
     * This function Override password value for DB
     * 
     * @return string
     */
    public function updateVerifyCodeColumn()
    {
        return uniqid();
    }

    /**
     * This function Override password value for DB
     * 
     * @return string
     */
    public function updateStatusColumn()
    {
        return sfConfig::get('is_verify_user') == 'on' ? '0' : '1';
    }

}