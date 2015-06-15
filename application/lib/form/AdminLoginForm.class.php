<?php

/**
 * AdminLoginForm
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
 * AdminLoginForm
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
class AdminLoginForm extends sfForm
{

    /**
     * Configure
     *
     * @return void
     */
    public function configure()
    {
        $this->setWidgets(array(
            'email' => new sfWidgetFormInput(),
            'password' => new sfWidgetFormInputPassword(),
        ));

        $this->widgetSchema->setNameFormat('login[%s]');

        $this->setValidators(array(
            'email' => new sfValidatorString(array(), array('required' => 'Username is required')),
            'password' => new sfValidatorString(array(), array('required' => 'Password is required')),
        ));
    }

}