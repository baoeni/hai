<?php

/**
 * UserActivity filter form base class.
 *
 * @package    haimeeAct
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseUserActivityFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => true)),
      'activity_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Activity'), 'add_empty' => true)),
      'type'               => new sfWidgetFormFilterInput(),
      'user_first_name'    => new sfWidgetFormFilterInput(),
      'user_last_name'     => new sfWidgetFormFilterInput(),
      'user_email_address' => new sfWidgetFormFilterInput(),
      'user_phone'         => new sfWidgetFormFilterInput(),
      'amount'             => new sfWidgetFormFilterInput(),
      'pay_type'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PaymentType'), 'add_empty' => true)),
      'enter_time'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'quit_time'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'note'               => new sfWidgetFormFilterInput(),
      'created_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'user_id'            => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('User'), 'column' => 'id')),
      'activity_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Activity'), 'column' => 'id')),
      'type'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'user_first_name'    => new sfValidatorPass(array('required' => false)),
      'user_last_name'     => new sfValidatorPass(array('required' => false)),
      'user_email_address' => new sfValidatorPass(array('required' => false)),
      'user_phone'         => new sfValidatorPass(array('required' => false)),
      'amount'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'pay_type'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('PaymentType'), 'column' => 'id')),
      'enter_time'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'quit_time'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'note'               => new sfValidatorPass(array('required' => false)),
      'created_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('user_activity_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'UserActivity';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'user_id'            => 'ForeignKey',
      'activity_id'        => 'ForeignKey',
      'type'               => 'Number',
      'user_first_name'    => 'Text',
      'user_last_name'     => 'Text',
      'user_email_address' => 'Text',
      'user_phone'         => 'Text',
      'amount'             => 'Number',
      'pay_type'           => 'ForeignKey',
      'enter_time'         => 'Date',
      'quit_time'          => 'Date',
      'note'               => 'Text',
      'created_at'         => 'Date',
      'updated_at'         => 'Date',
    );
  }
}
