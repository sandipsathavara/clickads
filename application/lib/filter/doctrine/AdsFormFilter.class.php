<?php

/**
 * AdsFormFilter
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
 * AdsFormFilter
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
class AdsFormFilter extends BaseAdsFormFilter
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
     * Setup form
     *
     * @return void
     */
    public function setup()
    {
        $this->setWidgets(array(
            'name' => new sfWidgetFormFilterInput(array('with_empty' => false), array('class' => 'text small')),
            'page' => new sfWidgetFormChoice(array('choices' => sfConfig::get('app_pages')), array('class' => 'styled')),
            'position' => new sfWidgetFormChoice(array('choices' => sfConfig::get('app_ad_position')), array('class' => 'styled')),
            'ad_type' => new sfWidgetFormChoice(array('choices' => sfConfig::get('app_ad_type')), array('class' => 'styled')),
            'is_published' => new sfWidgetFormChoice(array('choices' => array('' => '', 1 => 'Yes', 0 => 'No')), array('class' => 'styled')) 
           ));

        $this->setValidators(array(
            'name' => new sfValidatorPass(array('required' => false)),
            'page' => new sfValidatorPass(array('required' => false)),
            'position' => new sfValidatorPass(array('required' => false)),
            'ad_type' => new sfValidatorPass(array('required' => false)),
            'is_published' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
        ));

        $this->widgetSchema->setNameFormat('ads_filters[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();
    }

}
