<?php

/**
 * CitysFormFilter
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
 * CitysFormFilter
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
class CitysFormFilter extends BaseCitysFormFilter
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
            'name' => new sfWidgetFormFilterInput(array('with_empty' => false), array('class' => 'text small')),
            'country_id' => new sfWidgetFormChoice(array('choices' => CountriesTable::getCountryName()), array('class' => 'styled', 'onChange' => jq_remote_function(array('update' => 'city_filters_state_id', 'with' => "'cid='+$(this).val()", 'url' => url_for('citys/getStateByCountryId'))))),
            'state_id' => new sfWidgetFormChoice(array('choices' => array(' Please Select ')), array('class' => 'styled')),
            'status' => new sfWidgetFormChoice(array('choices' => array('' => '', 1 => 'Enable', 0 => 'Disable')), array('class' => 'styled')),
        ));

        $this->setValidators(array(
            'name' => new sfValidatorPass(array('required' => false)),
            'country_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Countries'), 'column' => 'id')),
            'state_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('States'), 'column' => 'id')),
            'status' => new sfValidatorChoice(array('required' => false, 'choices' => array(1, 0))),
        ));

        $this->widgetSchema->setNameFormat('city_filters[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();
    }

    /**
     * Setup form
     *
     * @param string $q     Queries 
     * @param string $field form field
     * @param string $value value of field
     * 
     * @return string
     */
    public function addNameColumnQuery(Doctrine_Query $q, $field, $value)
    {
        //--- Get Alise from $q ---// 
        $alias = $q->getRootAlias();

        //--- prepar query for title---// 
        return $q->leftJoin($alias . '.Translation t')->addwhere('t.name LIKE ?', '%' . $value['text'] . '%');
    }

}
