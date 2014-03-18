<?php

/**
 * UserActivity form base class.
 *
 * @method UserActivity getObject() Returns the current form's model object
 *
 * @package    haimeeAct
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseUserActivityForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'user_id'            => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'add_empty' => true)),
      'activity_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Activity'), 'add_empty' => true)),
      'type'               => new sfWidgetFormInputText(),
      'user_first_name'    => new sfWidgetFormInputText(),
      'user_last_name'     => new sfWidgetFormInputText(),
      'user_email_address' => new sfWidgetFormInputText(),
      'user_phone'         => new sfWidgetFormInputText(),
      'location'         => new sfWidgetFormInputText(),
      'amount'             => new sfWidgetFormInputText(),
      'pay_type'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PaymentType'), 'add_empty' => true)),
      'enter_time'         => new sfWidgetFormDateTime(),
      'quit_time'          => new sfWidgetFormDateTime(),
      'note'               => new sfWidgetFormTextarea(),
      'created_at'         => new sfWidgetFormDateTime(),
      'updated_at'         => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'user_id'            => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('User'), 'required' => false)),
      'activity_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Activity'), 'required' => false)),
      'type'               => new sfValidatorInteger(array('required' => false)),
      'user_first_name'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'user_last_name'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'user_email_address' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'user_phone'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'location'         => new sfValidatorString(array('max_length' => 2550, 'required' => false)),
      'amount'             => new sfValidatorInteger(array('required' => false)),
      'pay_type'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('PaymentType'), 'required' => false)),
      'enter_time'         => new sfValidatorDateTime(array('required' => false)),
      'quit_time'          => new sfValidatorDateTime(array('required' => false)),
      'note'               => new sfValidatorString(array('max_length' => 2550, 'required' => false)),
      'created_at'         => new sfValidatorDateTime(),
      'updated_at'         => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('user_activity[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'UserActivity';
  }

}
