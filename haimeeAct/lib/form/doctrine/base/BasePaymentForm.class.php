<?php

/**
 * Payment form base class.
 *
 * @method Payment getObject() Returns the current form's model object
 *
 * @package    haimeeAct
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePaymentForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'user_activity_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UserActivity'), 'add_empty' => true)),
      'fee_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fee'), 'add_empty' => true)),
      'amount'           => new sfWidgetFormInputText(),
      'pay_time'         => new sfWidgetFormDateTime(),
      'pay_type'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PaymentType'), 'add_empty' => true)),
      'pay_amount'       => new sfWidgetFormInputText(),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'user_activity_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('UserActivity'), 'required' => false)),
      'fee_id'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Fee'), 'required' => false)),
      'amount'           => new sfValidatorInteger(array('required' => false)),
      'pay_time'         => new sfValidatorDateTime(array('required' => false)),
      'pay_type'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('PaymentType'), 'required' => false)),
      'pay_amount'       => new sfValidatorPass(array('required' => false)),
      'created_at'       => new sfValidatorDateTime(),
      'updated_at'       => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('payment[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Payment';
  }

}
