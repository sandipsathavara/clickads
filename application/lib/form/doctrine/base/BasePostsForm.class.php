<?php

/**
 * Posts form base class.
 *
 * @method Posts getObject() Returns the current form's model object
 *
 * @package    classifieds
 * @subpackage form
 * @author     Sandip Sathavara <sandip.sathavara@gmail.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePostsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'user_id'     => new sfWidgetFormInputText(),
      'country_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Countries'), 'add_empty' => false)),
      'state_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('States'), 'add_empty' => false)),
      'city_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Citys'), 'add_empty' => false)),
      'cat_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Categories'), 'add_empty' => false)),
      'lang'        => new sfWidgetFormInputText(),
      'title'       => new sfWidgetFormInputText(),
      'description' => new sfWidgetFormTextarea(),
      'name'        => new sfWidgetFormInputText(),
      'price'       => new sfWidgetFormInputText(),
      'phone'       => new sfWidgetFormInputText(),
      'reply_to'    => new sfWidgetFormInputText(),
      'zip'         => new sfWidgetFormInputText(),
      'status'      => new sfWidgetFormChoice(array('choices' => array('publish' => 'publish', 'unpublish' => 'unpublish', 'banned' => 'banned'))),
      'is_featured' => new sfWidgetFormInputCheckbox(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'user_id'     => new sfValidatorInteger(),
      'country_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Countries'))),
      'state_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('States'))),
      'city_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Citys'))),
      'cat_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Categories'))),
      'lang'        => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'title'       => new sfValidatorString(array('max_length' => 255)),
      'description' => new sfValidatorString(),
      'name'        => new sfValidatorString(array('max_length' => 255)),
      'price'       => new sfValidatorNumber(),
      'phone'       => new sfValidatorString(array('max_length' => 20)),
      'reply_to'    => new sfValidatorString(array('max_length' => 255)),
      'zip'         => new sfValidatorInteger(),
      'status'      => new sfValidatorChoice(array('choices' => array(0 => 'publish', 1 => 'unpublish', 2 => 'banned'), 'required' => false)),
      'is_featured' => new sfValidatorBoolean(array('required' => false)),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('posts[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Posts';
  }

}
