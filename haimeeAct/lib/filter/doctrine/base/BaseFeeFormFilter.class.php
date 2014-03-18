<?php

/**
 * Fee filter form base class.
 *
 * @package    haimeeAct
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseFeeFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'activity_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Activity'), 'add_empty' => true)),
      'name'         => new sfWidgetFormFilterInput(),
      'explanation'  => new sfWidgetFormFilterInput(),
      'fee_type_id'  => new sfWidgetFormFilterInput(),
      'fee_group_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('FeeGroup'), 'add_empty' => true)),
      'price'        => new sfWidgetFormFilterInput(),
      'amount'       => new sfWidgetFormFilterInput(),
      'amount_order' => new sfWidgetFormFilterInput(),
      'created_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'activity_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Activity'), 'column' => 'id')),
      'name'         => new sfValidatorPass(array('required' => false)),
      'explanation'  => new sfValidatorPass(array('required' => false)),
      'fee_type_id'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'fee_group_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('FeeGroup'), 'column' => 'id')),
      'price'        => new sfValidatorPass(array('required' => false)),
      'amount'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'amount_order' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('fee_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Fee';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'activity_id'  => 'ForeignKey',
      'name'         => 'Text',
      'explanation'  => 'Text',
      'fee_type_id'  => 'Number',
      'fee_group_id' => 'ForeignKey',
      'price'        => 'Text',
      'amount'       => 'Number',
      'amount_order' => 'Number',
      'created_at'   => 'Date',
      'updated_at'   => 'Date',
    );
  }
}
