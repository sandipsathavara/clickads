<?php

/**
 * Users filter form base class.
 *
 * @package    classifieds
 * @subpackage filter
 * @author     Sandip Sathavara <sandip.sathavara@gmail.com>
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseUsersFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'email'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'password'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nickname'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'skype'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'salt'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'verify_code'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'alert_flag'       => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'skype_flag'       => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'unique_code'      => new sfWidgetFormFilterInput(),
      'watch_list_count' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'last_login'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'ip_address'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'status'           => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'user_type'        => new sfWidgetFormChoice(array('choices' => array('' => '', 'admin' => 'admin', 'user' => 'user'))),
      'ads_count'        => new sfWidgetFormFilterInput(),
      'post_ads_limit'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'email'            => new sfValidatorPass(array('required' => false)),
      'password'         => new sfValidatorPass(array('required' => false)),
      'nickname'         => new sfValidatorPass(array('required' => false)),
      'skype'            => new sfValidatorPass(array('required' => false)),
      'salt'             => new sfValidatorPass(array('required' => false)),
      'verify_code'      => new sfValidatorPass(array('required' => false)),
      'alert_flag'       => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'skype_flag'       => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'unique_code'      => new sfValidatorPass(array('required' => false)),
      'watch_list_count' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'last_login'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'ip_address'       => new sfValidatorPass(array('required' => false)),
      'status'           => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'user_type'        => new sfValidatorChoice(array('required' => false, 'choices' => array('admin' => 'admin', 'user' => 'user'))),
      'ads_count'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'post_ads_limit'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('users_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Users';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'email'            => 'Text',
      'password'         => 'Text',
      'nickname'         => 'Text',
      'skype'            => 'Text',
      'salt'             => 'Text',
      'verify_code'      => 'Text',
      'alert_flag'       => 'Boolean',
      'skype_flag'       => 'Boolean',
      'unique_code'      => 'Text',
      'watch_list_count' => 'Number',
      'last_login'       => 'Date',
      'ip_address'       => 'Text',
      'status'           => 'Boolean',
      'user_type'        => 'Enum',
      'ads_count'        => 'Number',
      'post_ads_limit'   => 'Number',
      'created_at'       => 'Date',
      'updated_at'       => 'Date',
    );
  }
}
