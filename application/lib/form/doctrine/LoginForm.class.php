<?php

/**
 * LoginForm
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
 * LoginForm
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
class LoginForm extends sfForm
{
    /**
     * configure
     *
     * @return void
     */
    public function configure()
    {
        $this->setWidgets(array(
            'email' => new sfWidgetFormInput(),
            'password' => new sfWidgetFormInputPassword(),
            'isremember' => new sfWidgetFormInputCheckbox(),
        ));

        $this->widgetSchema->setNameFormat('login[%s]');

        $this->setValidators(array(
            'email' => new sfValidatorString(array(), array('required' => __('msg_email_required', '', 'login'))),
            'password' => new sfValidatorString(array(), array('required' => __('msg_password_required', '', 'login'))),
            'isremember' => new sfValidatorString(array('required' => false)),
        ));
    }

}
