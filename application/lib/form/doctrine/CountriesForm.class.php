<?php

/**
 * CountriesForm
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
 * CountriesForm
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

class CountriesForm extends BaseCountriesForm
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


        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'currency' => new sfWidgetFormI18nChoiceCurrency(array('culture' => 'en'), array('class' => 'styled')),
            'status' => new sfWidgetFormInputCheckbox(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'currency' => new sfValidatorString(array('max_length' => 10, 'required' => false)),
            'status' => new sfValidatorBoolean(array('required' => false)),
        ));


        //--- Embed I18N form ---//  
        $this->embedI18n($objLang);

        //--- Display Language Lable ---//
        foreach ($objLangLable as $lang) {
            $this->widgetSchema->setLabel($lang['culture'], $lang['name']);
        }

        $this->widgetSchema->setNameFormat('countries[%s]');
    }

}
