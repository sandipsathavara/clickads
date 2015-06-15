<?php

/**
 * PagesForm
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
 * PagesForm
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
class PagesForm extends BasePagesForm
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
            'slug' => new sfWidgetFormInputText(array(), array('class' => 'text small', 'value' => $this->getObject()->get('slug'))),
            'status' => new sfWidgetFormInputCheckbox(),
            'is_default' => new sfWidgetFormInputCheckbox(),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'slug' => new sfValidatorAnd(array(
                new sfValidatorString(array('max_length' => 255), array('required' => 'Slug is required')),
                new sfValidatorRegex(array('pattern' => '/^[a-za-z0-9-]+$/'), array('invalid' => 'Invalid slug format, Slug can only be letters, numbers and dash')),
                    )
            ),
            'status' => new sfValidatorBoolean(array('required' => false)),
            'is_default' => new sfValidatorBoolean(array('required' => false)),
        ));

        $this->validatorSchema->setPostValidator(
                new sfValidatorDoctrineUnique(array('model' => 'Pages', 'column' => array('slug')), array('invalid' => 'Slug is already exist'))
        );

        $this->widgetSchema->setNameFormat('pages[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();
    }

    /**
     * This function Override password value for DB
     * 
     * @return void
     */
    public function updateSlugColumn()
    {
        //--- Create Slug ---//
        return slugify($this->getValue('slug'));
    }

}
