<?php

/**
 * EmailsTranslation filter form base class.
 *
 * @package    classifieds
 * @subpackage filter
 * @author     Sandip Sathavara <sandip.sathavara@gmail.com>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseEmailsTranslationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'title'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'from_name' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'subject'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'body'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'title'     => new sfValidatorPass(array('required' => false)),
      'from_name' => new sfValidatorPass(array('required' => false)),
      'subject'   => new sfValidatorPass(array('required' => false)),
      'body'      => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('emails_translation_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'EmailsTranslation';
  }

  public function getFields()
  {
    return array(
      'id'        => 'Number',
      'title'     => 'Text',
      'from_name' => 'Text',
      'subject'   => 'Text',
      'body'      => 'Text',
      'lang'      => 'Text',
    );
  }
}
