<?php

/**
 * AdReplyForm
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

sfProjectConfiguration::getActive()->loadHelpers('I18N');

/**
 * AdReplyForm
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
class AdReplyForm extends sfForm
{
    /**
     * Configure
     *
     * @return void
     */
    public function configure()
    {
        $this->setWidgets(array(
            'name' => new sfWidgetFormInput(),
            'email' => new sfWidgetFormInput(),
            'phone' => new sfWidgetFormInput(),
            'message' => new sfWidgetFormTextarea(),
            'captcha' => new sfWidgetCaptchaGDNew(),
        ));

        $this->widgetSchema->setNameFormat('ad[%s]');

        $this->setValidators(array(
            'name' => new sfValidatorString(array(), array('required' => __('msg_enter_name', '', 'postad'))),
            'email' => new sfValidatorEmail(array(), array('required' => __('msg_enter_email', '', 'postad'), 'invalid' => __('msg_invalid_email', '', 'postad'))),
            'phone' => new sfValidatorString(array('required' => false)),
            'message' => new sfValidatorString(array('max_length' => 1000, 'min_length' => 20), array('min_length' => __('msg_min_message', '', 'postad'), 'max_length' => __('msg_max_message', '', 'postad'), 'required' => __('msg_enter_message', '', 'postad'))),
            'captcha' => new sfCaptchaGDValidator(array('length' => 4), array('required' => __('msg_captcha_required', '', 'register'), 'invalid' => __('msg_invalid_captcha', '', 'register'), 'length' => __('msg_invalid_length', '', 'register'))),
        ));
    }

}