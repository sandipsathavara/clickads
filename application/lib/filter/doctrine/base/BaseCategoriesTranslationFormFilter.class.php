<?php

/**
 * CategoriesTranslation filter form base class.
 *
 * @package    classifieds
 * @subpackage filter
 * @author     Sandip Sathavara <sandip.sathavara@gmail.com>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseCategoriesTranslationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'image' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'name'  => new sfValidatorPass(array('required' => false)),
      'image' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('categories_translation_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CategoriesTranslation';
  }

  public function getFields()
  {
    return array(
      'id'    => 'Number',
      'name'  => 'Text',
      'image' => 'Text',
      'lang'  => 'Text',
    );
  }
}
