<?php

/**
 * EmailsTranslationForm
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
 * EmailsTranslationForm
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
class EmailsTranslationForm extends BaseEmailsTranslationForm
{
    /**
     * configure
     *
     * @return void
     */
    public function configure()
    {

        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'title' => new sfWidgetFormInputText(array(), array('class' => 'text small')),
            'from_name' => new sfWidgetFormInputText(array(), array('class' => 'text small')),
            'subject' => new sfWidgetFormInputText(array(), array('class' => 'text small')),
            'body' => new sfWidgetFormTextareaTinyMCE(array(
                'width' => 650,
                'height' => 250,
                    )),
            'lang' => new sfWidgetFormInputHidden(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'title' => new sfValidatorString(array('max_length' => 255)),
            'from_name' => new sfValidatorString(array('max_length' => 255)),
            'subject' => new sfValidatorString(array('max_length' => 255)),
            'body' => new sfValidatorString(),
            'lang' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('lang')), 'empty_value' => $this->getObject()->get('lang'), 'required' => false)),
        ));

        $this->validatorSchema->setPostValidator(
                new sfValidatorDoctrineUnique(array('model' => 'EmailsTranslation', 'column' => array('title')))
        );

        $this->widgetSchema->setNameFormat('emails_translation[%s]');
    }

}
