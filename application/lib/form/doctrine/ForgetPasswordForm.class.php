<?php

/**
 * ForgetPasswordForm
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
 * ForgetPasswordForm
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
class ForgetPasswordForm extends BaseForm
{
    
    /**
     * configure
     *
     * @return void
     */
    public function configure()
    {
        $this->setWidgets(array(
            'email' => new sfWidgetFormInputText(),
        ));

        $this->widgetSchema->setNameFormat('forgetpass[%s]');

        $this->setValidators(array(
            'email' => new sfValidatorString(array(), array('required' => __('msg_enter_email', '', 'forgetpassword'))),
        ));
    }
}
