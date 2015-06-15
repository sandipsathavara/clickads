<?php

/**
 * PostsForm
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
 * PostsForm
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
class PostsForm extends BasePostsForm
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
            'id' => new sfWidgetFormInputHidden(),
            'user_id' => new sfWidgetFormInputText(array(), array('class' => 'styled')),
            'state_id' => new sfWidgetFormDoctrineDependentSelect(array(
                'model' => 'States',
                'add_empty' => 'Select State',
                'table_method' => 'getStatesNameByCountryId',
                    ), array('class' => 'styled')),
            'city_id' => new sfWidgetFormDoctrineDependentSelect(array(
                'model' => 'Citys',
                'depends' => 'States',
                'add_empty' => 'Select City',
                'ref_method' => 'getStateId',
                'ajax' => true,
                    ), array('class' => 'styled')),
            'cat_id' => new sfWidgetFormDoctrineChoiceGrouped(array('group_by' => 'root_id',
                'model' => 'Categories',
                'table_method' => 'getCategoryGroup',
                'method' => 'getName',
                'multiple' => false,
                'add_empty' => 'Select Category'
                    )),
            'lang' => new sfWidgetFormInputText(),
            'title' => new sfWidgetFormInputText(array(), array('class' => 'text small')),
            'description' => new sfWidgetFormTextarea(),
            'price' => new sfWidgetFormInputText(array(), array('class' => 'text small')),
            'phone' => new sfWidgetFormInputText(array(), array('class' => 'text small')),
            'reply_to' => new sfWidgetFormInputText(array(), array('class' => 'text small')),
            'zip' => new sfWidgetFormInputText(array(), array('class' => 'text small')),
        ));

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'user_id' => new sfValidatorString(array()),
            'city_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Citys'))),
            'cat_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Categories'))),
            'lang' => new sfValidatorString(array('max_length' => 20, 'required' => false)),
            'title' => new sfValidatorString(array('max_length' => 255)),
            'description' => new sfValidatorString(),
            'price' => new sfValidatorNumber(),
            'phone' => new sfValidatorString(array('max_length' => 20)),
            'reply_to' => new sfValidatorString(array('max_length' => 255)),
            'zip' => new sfValidatorInteger(),
        ));

        $this->widgetSchema->setNameFormat('posts[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();
    }

}
