<?php

/**
 * PostsForm
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
 * PostsForm
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
class ResetPasswordForm extends BaseForm
{
    /**
     * configure
     *
     * @return void
     */
    public function configure()
    {
        $this->setWidgets(array(
            'old_password' => new sfWidgetFormInputPassword(),
            'password' => new sfWidgetFormInputPassword(),
            'retype_password' => new sfWidgetFormInputPassword(),
        ));

        $this->widgetSchema->setNameFormat('changepass[%s]');

        $this->setValidators(array(
            'old_password' => new sfValidatorString(array(), array('required' => __('msg_old_password_required', '', 'changepass'))),
            'password' => new sfValidatorString(
                array('required' => true, 'min_length' => 6, 'max_length' => 16), array('min_length' => __('msg_min_new_password', '', 'changepass'), 'max_length' => __('msg_max_new_password', '', 'changepass'), 'required' => __('msg_new_password_required', '', 'changepass'))
            ),
            'retype_password' => new sfValidatorString(
                array(), array('required' => __('msg_retype_new_password_required', '', 'changepass'))),
        ));

        //--- Compare Password ---//
        $this->validatorSchema->setPostValidator(new sfValidatorAnd(array(
            new sfValidatorSchemaCompare('password', sfValidatorSchemaCompare::EQUAL, 'retype_password', array(), array('invalid' => __('msg_password_not_match', '', 'changepass'))),
        )));
    }

}