<?php

/**
 * PagesFormFilter
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
 * PagesFormFilter
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
class PagesFormFilter extends BasePagesFormFilter
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
            'title' => new sfWidgetFormFilterInput(array('with_empty' => false), array('class' => 'text small')),
            'status' => new sfWidgetFormChoice(array('choices' => array('' => '', 1 => 'Enable', 0 => 'Disable')), array('class' => 'styled')),
        ));

        $this->setValidators(array(
            'title' => new sfValidatorPass(array('required' => false)),
            'status' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
        ));

        $this->widgetSchema->setNameFormat('pages_filters[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();
    }

    /**
     * addTitleColumnQuery
     *
     * @param string $q     Queries 
     * @param string $field form field
     * @param string $value value of field
     * 
     * @return string
     */
    public function addTitleColumnQuery(Doctrine_Query $q, $field, $value)
    {
        #--- Get Alise from $q ---# 
        $alias = $q->getRootAlias();

        #--- prepar query for title---# 
        return $q->leftJoin($alias . '.Translation t')->addWhere('t.title LIKE ?', '%' . $value['text'] . '%');
    }

}
