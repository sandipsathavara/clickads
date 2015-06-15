<?php

/**
 * PagesTranslationForm
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
 * PagesTranslationForm
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
class PagesTranslationForm extends BasePagesTranslationForm
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
            'title' => new sfWidgetFormInputText(array(), array('class' => 'text small')),
            'decription' => new sfWidgetFormTextareaTinyMCE(array(
                'width' => 650,
                'height' => 250,
                    )),
            'lang' => new sfWidgetFormInputHidden(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'title' => new sfValidatorString(array('max_length' => 255), array('required' => 'Title is required')),
            'decription' => new sfValidatorString(array(), array('required' => 'Decription is required')),
            'lang' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('lang')), 'empty_value' => $this->getObject()->get('lang'), 'required' => false)),
        ));


        $this->validatorSchema->setPostValidator(
                new sfValidatorDoctrineUnique(array('model' => 'PagesTranslation', 'column' => array('title')), array('invalid' => 'Title is already exist'))
        );


        $this->widgetSchema->setNameFormat('pages_translation[%s]');
        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
        $this->setupInheritance();
    }

}
