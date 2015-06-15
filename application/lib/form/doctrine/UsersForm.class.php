<?php

/**
 * UsersForm
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

/**
 * UsersForm
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
class UsersForm extends BaseUsersForm
{
    /**
     * configure
     *
     * @return void
     */
    public function configure()
    {
        
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
            'email' => new sfWidgetFormInputText(array(), array('class' => 'text small')),
            'password' => new sfWidgetFormInputPassword(array(), array('class' => 'text small')),
            'nickname' => new sfWidgetFormInputText(array(), array('class' => 'text small')),
            'status' => new sfWidgetFormInputCheckbox(array(), array('class' => 'checkbox')),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'email' => new sfValidatorString(array('max_length' => 255, 'required' => ( $this->getObject()->isNew() === true) ? true : false), array('required' => 'Email is required', 'invalid' => 'Invalid Email Id')),
            'password' => new sfValidatorString(
                array('required' => ( $this->getObject()->isNew() === true) ? true : false, 'min_length' => 6, 'max_length' => 16), array('min_length' => 'Your new password must have at least %min_length% characters', 'max_length' => 'Your new password cannot be longer than %max_length% characters', 'required' => 'Password is required')),
            'nickname' => new sfValidatorString(array('max_length' => 255), array('required' => 'Nickname is required')),
            'status' => new sfValidatorBoolean(array('required' => false)),
        ));

        $this->validatorSchema->setPostValidator(
            new sfValidatorDoctrineUnique(array('model' => 'Users', 'column' => array('email')))
        );

        $this->widgetSchema->setNameFormat('users[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();
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

        return ( $this->getObject()->isNew() === true || $this->getValue('password') != '' ) ? generatePassword($salt, $this->getValue('password')) : $this->getObject()->getPassword();
    }

}
