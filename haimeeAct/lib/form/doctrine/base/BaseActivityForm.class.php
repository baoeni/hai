<?php

/**
 * Activity form base class.
 *
 * @method Activity getObject() Returns the current form's model object
 *
 * @package    haimeeAct
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseActivityForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'name'            => new sfWidgetFormInputText(),
      'subject_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ActSubject'), 'add_empty' => false)),
      'description'     => new sfWidgetFormTextarea(),
      'time_from'       => new sfWidgetFormDateTime(),
      'time_till'       => new sfWidgetFormDateTime(),
      'location'        => new sfWidgetFormTextarea(),
      'organizer_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => true)),
      'poster'          => new sfWidgetFormTextarea(),
      'invitation'      => new sfWidgetFormTextarea(),
      'reminder'        => new sfWidgetFormTextarea(),
      'reminder_time'   => new sfWidgetFormDateTime(),
      'confirmation'    => new sfWidgetFormTextarea(),
      'payment_type_ids'=> new sfWidgetFormInputText(),
      'expires_at'      => new sfWidgetFormDateTime(),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
      'max_attenders'   => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'            => new sfValidatorString(array('max_length' => 255)),
      'subject_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ActSubject'))),
      'description'     => new sfValidatorString(array('max_length' => 4055, 'required' => false)),
      'time_from'       => new sfValidatorDateTime(),
      'time_till'       => new sfValidatorDateTime(),
      'location'        => new sfValidatorString(array('max_length' => 2550, 'required' => false)),
      'organizer_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'required' => false)),
      'poster'          => new sfValidatorString(array('max_length' => 2550, 'required' => false)),
      'invitation'      => new sfValidatorString(array('max_length' => 2550, 'required' => false)),
      'reminder'        => new sfValidatorString(array('max_length' => 2550, 'required' => false)),
      'reminder_time'   => new sfValidatorDateTime(array('required' => false)),
      'confirmation'    => new sfValidatorString(array('max_length' => 2550, 'required' => false)),
      'payment_type_ids'=> new sfValidatorString(array('max_length' => 255,  'required' => false)),
      'expires_at'      => new sfValidatorDateTime(array('required' => false)),
      'created_at'      => new sfValidatorDateTime(),
      'updated_at'      => new sfValidatorDateTime(),
	  'max_attenders'   => new sfValidatorString(array('max_length' => 5, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('activity[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Activity';
  }

}
