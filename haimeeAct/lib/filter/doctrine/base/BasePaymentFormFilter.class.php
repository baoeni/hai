<?php

/**
 * Payment filter form base class.
 *
 * @package    haimeeAct
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePaymentFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_activity_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('UserActivity'), 'add_empty' => true)),
      'fee_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fee'), 'add_empty' => true)),
      'amount'           => new sfWidgetFormFilterInput(),
      'pay_time'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'pay_type'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('PaymentType'), 'add_empty' => true)),
      'pay_amount'       => new sfWidgetFormFilterInput(),
      'created_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'user_activity_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('UserActivity'), 'column' => 'id')),
      'fee_id'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Fee'), 'column' => 'id')),
      'amount'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'pay_time'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'pay_type'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('PaymentType'), 'column' => 'id')),
      'pay_amount'       => new sfValidatorPass(array('required' => false)),
      'created_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('payment_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Payment';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'user_activity_id' => 'ForeignKey',
      'fee_id'           => 'ForeignKey',
      'amount'           => 'Number',
      'pay_time'         => 'Date',
      'pay_type'         => 'ForeignKey',
      'pay_amount'       => 'Text',
      'created_at'       => 'Date',
      'updated_at'       => 'Date',
    );
  }
}
