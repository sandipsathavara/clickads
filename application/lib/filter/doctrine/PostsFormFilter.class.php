<?php

/**
 * PostsFormFilter
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
 * PostsFormFilter
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
class PostsFormFilter extends BasePostsFormFilter
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
            'user_id'     => new sfWidgetFormFilterInput(array('with_empty' => false), array('class' => 'text small')),
            'cat_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Categories'), 'table_method' => 'getCategoryGroup', 'method' => 'getIndentedNamePost', 'add_empty' => true), array('class' => 'styled')),
            'title'       => new sfWidgetFormFilterInput(array('with_empty' => false), array('class' => 'text small')),
            'is_featured' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no')),array('class' => 'styled')),
            'created_at'  => new sfWidgetFormFilterDate(
                    array('from_date' => new sfWidgetFormInputText(array(), array('class' => 'text date_picker')),
                'to_date'  => new sfWidgetFormInputText(array(), array('class' => 'text date_picker')),
                'template' => 'Start Date: %from_date%&nbsp;&nbsp;&nbsp;&nbsp;End Date: %to_date%',
                'with_empty' => false)),
        ));

        $this->setValidators(array(
            'user_id'     => new sfValidatorPass(array('required' => false)),
            'cat_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Categories'), 'column' => 'id')),
            'is_featured' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
            'title'       => new sfValidatorPass(array('required' => false)),
            'created_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d')))),
        ));

        $this->widgetSchema->setNameFormat('posts_filters[%s]');

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
    public function addCityIidColumnQuery(Doctrine_Query $q, $field, $value)
    {
        //--- Get Alise from $q ---// 
        $alias = $q->getRootAlias();

        //--- prepar query for title---// 
        return $q->leftJoin($alias . '.Translation t')->addwhere('t.name LIKE ?', '%' . $value['text'] . '%');
    }

}
