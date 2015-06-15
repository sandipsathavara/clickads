<?php

/**
 * CategoriesTranslationForm
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
 * CategoriesTranslationForm
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
class CitysForm extends BaseCitysForm
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
            'country_id' => new sfWidgetFormChoice(array('choices' => CountriesTable::getCountryName()), array('class' => 'styled', 'onChange' => jq_remote_function(array('update' => 'citys_state_id', 'with' => "'cid='+$(this).val()", 'url' => url_for('citys/getStateByCountryId'))))),
            'state_id' => new sfWidgetFormChoice(array('choices' => array('  Please Select  ')), array('class' => 'styled')),
            'is_popular' => new sfWidgetFormInputCheckbox(array(), array('class' => 'checkbox')),
            'status' => new sfWidgetFormInputCheckbox(array(), array('class' => 'checkbox')),
        ));

        $this->setDefault("is_popular", false);

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'country_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Countries')), array('required' => 'Countrie is required')),
            'state_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('States')), array('required' => 'State is required')),
            'is_popular' => new sfValidatorBoolean(array('required' => false)),
            'status' => new sfValidatorBoolean(array('required' => false)),
        ));

        $this->validatorSchema->setPostValidator(
            new sfValidatorDoctrineUnique(array('model' => 'Citys', 'column' => array('slug')))
        );

        $this->widgetSchema->setNameFormat('citys[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();
    }

    /**
     * Update $slug field 
     * 
     * @param string $slug slug field
     * 
     * @return void
     */
    public function updateSlugColumn($slug)
    {
        //--- Replace all non letters or digits by  ---//
        $slug = preg_replace('/\W+/', '', $slug);

        $this->slug = strtolower(trim($slug, ''));
    }

}