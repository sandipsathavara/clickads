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
class CategoriesTranslationForm extends BaseCategoriesTranslationForm
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
     * setup
     *
     * @return void
     */
    public function setup()
    {

        $this->setWidgets(array(
            'id' => new sfWidgetFormInputHidden(),
            'name' => new sfWidgetFormInputText(array(), array('class' => 'text small')),
            /* 'image' =>  new sfWidgetFormInputFileEditable(array(
              'label' => 'Image',
              'file_src' => '/uploads/categories/'.$this->getObject()->get('image').'?'.rand(),
              'is_image' => true,
              'edit_mode' => !$this->isNew(),
              'with_delete' => false,
              )), */
            'lang' => new sfWidgetFormInputHidden(),
        ));

        //'required' => !$this->isNew() ? false : true  ,

        $this->setValidators(array(
            'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
            'name' => new sfValidatorString(array('max_length' => 255), array('required' => 'Name is required')),
            /* 'image' => new sfValidatorFile(array( 'required' => false , 
              'path' => sfConfig::get('sf_upload_dir').'/categories/'  ,
              'mime_types' => 'web_images' ,
              'max_size' => 2500000  ),
              array( 'invalid' => 'Invalid file.',
              'required' => 'Select a file to upload.',
              'mime_types' => 'The file must be a supported type.( valid images are jpg,png,gif )')
              ), */
            'lang' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('lang')), 'empty_value' => $this->getObject()->get('lang'), 'required' => false)),
        ));

        $this->validatorSchema->setPostValidator(
                new sfValidatorAnd(array(
            new sfValidatorDoctrineUnique(array('model' => 'CategoriesTranslation', 'column' => array('lang', 'name'))),
                ))
        );

        $this->widgetSchema->setNameFormat('categories_translation[%s]');

        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

        $this->setupInheritance();
    }

}
