<?php

/**
 * LanguagesForm
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
 * LanguagesForm
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
class LanguagesForm extends BaseLanguagesForm
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
            'name' => new sfWidgetFormInputText(array(), array('class' => 'text small')),
            'culture' => new sfWidgetFormInputText(array(), array('class' => 'text small')),
            'status' => new sfWidgetFormInputCheckbox(array(), array('class' => 'checkbox')),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'name' => new sfValidatorString(array('max_length' => 255), array('required' => 'Name is required')),
            'culture' => new sfValidatorString(array('max_length' => 255), array('required' => 'Culture is required')),
            'status' => new sfValidatorBoolean(array('required' => false)),
        ));

        $this->validatorSchema->setPostValidator(
                new sfValidatorDoctrineUnique(array('model' => 'Languages', 'column' => array('name')))
        );

        $this->widgetSchema->setNameFormat('languages[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();
    }

}
