<?php

/**
 * Activity filter form base class.
 *
 * @package    haimeeAct
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseActivityFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'subject_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ActSubject'), 'add_empty' => true)),
      'description'     => new sfWidgetFormFilterInput(),
      'time_from'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'time_till'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'location'        => new sfWidgetFormFilterInput(),
      'organizer_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => true)),
      'poster'          => new sfWidgetFormFilterInput(),
      'invitation'      => new sfWidgetFormFilterInput(),
      'reminder'        => new sfWidgetFormFilterInput(),
      'reminder_time'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'confirmation'    => new sfWidgetFormFilterInput(),
      'payment_type_ids'=> new sfWidgetFormFilterInput(),
      'expires_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'created_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'name'            => new sfValidatorPass(array('required' => false)),
      'subject_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ActSubject'), 'column' => 'id')),
      'description'     => new sfValidatorPass(array('required' => false)),
      'time_from'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'time_till'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'location'        => new sfValidatorPass(array('required' => false)),
      'organizer_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('User'), 'column' => 'id')),
      'poster'          => new sfValidatorPass(array('required' => false)),
      'invitation'      => new sfValidatorPass(array('required' => false)),
      'reminder'        => new sfValidatorPass(array('required' => false)),
      'reminder_time'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'confirmation'    => new sfValidatorPass(array('required' => false)),
      'payment_type_ids'=> new sfValidatorPass(array('required' => false)),
      'expires_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'created_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('activity_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Activity';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'name'            => 'Text',
      'subject_id'      => 'ForeignKey',
      'description'     => 'Text',
      'time_from'       => 'Date',
      'time_till'       => 'Date',
      'location'        => 'Text',
      'organizer_id'    => 'ForeignKey',
      'poster'          => 'Text',
      'invitation'      => 'Text',
      'reminder'        => 'Text',
      'reminder_time'   => 'Date',
      'confirmation'    => 'Text',
      'payment_type_ids'=> 'Text',
      'expires_at'      => 'Date',
      'created_at'      => 'Date',
      'updated_at'      => 'Date',
    );
  }
}
