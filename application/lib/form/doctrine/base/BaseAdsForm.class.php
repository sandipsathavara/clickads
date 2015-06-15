<?php

/**
 * Ads form base class.
 *
 * @method Ads getObject() Returns the current form's model object
 *
 * @package    classifieds
 * @subpackage form
 * @author     Sandip Sathavara <sandip.sathavara@gmail.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseAdsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'name'         => new sfWidgetFormInputText(),
      'page'         => new sfWidgetFormInputText(),
      'position'     => new sfWidgetFormInputText(),
      'ad_type'      => new sfWidgetFormInputText(),
      'target_url'   => new sfWidgetFormInputText(),
      'ad_data'      => new sfWidgetFormTextarea(),
      'banner_image' => new sfWidgetFormInputText(),
      'start_dt'     => new sfWidgetFormDateTime(),
      'end_dt'       => new sfWidgetFormDateTime(),
      'is_published' => new sfWidgetFormInputCheckbox(),
      'created_at'   => new sfWidgetFormDateTime(),
      'updated_at'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'         => new sfValidatorString(array('max_length' => 255)),
      'page'         => new sfValidatorString(array('max_length' => 255)),
      'position'     => new sfValidatorString(array('max_length' => 255)),
      'ad_type'      => new sfValidatorString(array('max_length' => 255)),
      'target_url'   => new sfValidatorString(array('max_length' => 255)),
      'ad_data'      => new sfValidatorString(array('required' => false)),
      'banner_image' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'start_dt'     => new sfValidatorDateTime(),
      'end_dt'       => new sfValidatorDateTime(array('required' => false)),
      'is_published' => new sfValidatorBoolean(array('required' => false)),
      'created_at'   => new sfValidatorDateTime(),
      'updated_at'   => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('ads[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Ads';
  }

}
