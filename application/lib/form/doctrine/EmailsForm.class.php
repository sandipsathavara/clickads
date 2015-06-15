<?php

/**
 * EmailsForm
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
 * EmailsForm
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
class EmailsForm extends BaseEmailsForm
{
    /**
     * configure
     *
     * @return void
     */
    public function configure()
    {
        $objLang = LanguagesTable::getAllActiveLanguage();
        $objLangLable = LanguagesTable::getAllActiveLanguageFullName();

        //--- Embed I18N form ---//  
        $this->embedI18n($objLang);

        //--- Display Language Lable ---//
        foreach ($objLangLable as $lang) {
            $this->widgetSchema->setLabel($lang['culture'], $lang['name']);
        }
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
            'from_email' => new sfWidgetFormInputText(array(), array('class' => 'text small')),
            'status' => new sfWidgetFormInputCheckbox(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'from_email' => new sfValidatorString(array('max_length' => 255)),
            'status' => new sfValidatorBoolean(array('required' => false)),
        ));

        $this->widgetSchema->setNameFormat('emails[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    }

}
