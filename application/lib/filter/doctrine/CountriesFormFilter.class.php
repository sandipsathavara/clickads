<?php


/**
 * CategoriesFormFilter
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
 * CategoriesFormFilter
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
class CountriesFormFilter extends BaseCountriesFormFilter
{
    
    /**
     * Configure
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
            'status' => new sfWidgetFormChoice(array('choices' => array('' => '', 1 => 'Enable', 0 => 'Disable')), array('class' => 'styled')),
        ));

        $this->setValidators(array(
            'name' => new sfValidatorPass(array('required' => false)),
            'status' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
        ));

        $this->widgetSchema->setNameFormat('countries_filters[%s]');

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
