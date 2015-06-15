<?php

/**
 * Users form base class.
 *
 * @method Users getObject() Returns the current form's model object
 *
 * @package    classifieds
 * @subpackage form
 * @author     Sandip Sathavara <sandip.sathavara@gmail.com>
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseUsersForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'email'            => new sfWidgetFormInputText(),
      'password'         => new sfWidgetFormInputText(),
      'nickname'         => new sfWidgetFormInputText(),
      'skype'            => new sfWidgetFormInputText(),
      'salt'             => new sfWidgetFormInputText(),
      'verify_code'      => new sfWidgetFormInputText(),
      'alert_flag'       => new sfWidgetFormInputCheckbox(),
      'skype_flag'       => new sfWidgetFormInputCheckbox(),
      'unique_code'      => new sfWidgetFormInputText(),
      'watch_list_count' => new sfWidgetFormInputText(),
      'last_login'       => new sfWidgetFormDateTime(),
      'ip_address'       => new sfWidgetFormInputText(),
      'status'           => new sfWidgetFormInputCheckbox(),
      'user_type'        => new sfWidgetFormChoice(array('choices' => array('admin' => 'admin', 'user' => 'user'))),
      'ads_count'        => new sfWidgetFormInputText(),
      'post_ads_limit'   => new sfWidgetFormInputText(),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'email'            => new sfValidatorString(array('max_length' => 255)),
      'password'         => new sfValidatorString(array('max_length' => 255)),
      'nickname'         => new sfValidatorString(array('max_length' => 255)),
      'skype'            => new sfValidatorString(array('max_length' => 255)),
      'salt'             => new sfValidatorString(array('max_length' => 64)),
      'verify_code'      => new sfValidatorString(array('max_length' => 64)),
      'alert_flag'       => new sfValidatorBoolean(array('required' => false)),
      'skype_flag'       => new sfValidatorBoolean(array('required' => false)),
      'unique_code'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'watch_list_count' => new sfValidatorInteger(),
      'last_login'       => new sfValidatorDateTime(),
      'ip_address'       => new sfValidatorString(array('max_length' => 255)),
      'status'           => new sfValidatorBoolean(array('required' => false)),
      'user_type'        => new sfValidatorChoice(array('choices' => array(0 => 'admin', 1 => 'user'), 'required' => false)),
      'ads_count'        => new sfValidatorInteger(array('required' => false)),
      'post_ads_limit'   => new sfValidatorInteger(),
      'created_at'       => new sfValidatorDateTime(),
      'updated_at'       => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Users', 'column' => array('email')))
    );

    $this->widgetSchema->setNameFormat('users[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Users';
  }

}
