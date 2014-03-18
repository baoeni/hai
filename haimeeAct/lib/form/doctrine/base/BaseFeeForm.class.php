<?php

/**
 * Fee form base class.
 *
 * @method Fee getObject() Returns the current form's model object
 *
 * @package    haimeeAct
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFeeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'activity_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Activity'), 'add_empty' => true)),
      'name'         => new sfWidgetFormTextarea(),
      'explanation'  => new sfWidgetFormTextarea(),
      'fee_type_id'  => new sfWidgetFormInputText(),
      'fee_group_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('FeeGroup'), 'add_empty' => true)),
      'price'        => new sfWidgetFormInputText(),
      'amount'       => new sfWidgetFormInputText(),
      'amount_order' => new sfWidgetFormInputText(),
      'created_at'   => new sfWidgetFormDateTime(),
      'updated_at'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'activity_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Activity'), 'required' => false)),
      'name'         => new sfValidatorString(array('max_length' => 2550, 'required' => false)),
      'explanation'  => new sfValidatorString(array('max_length' => 2550, 'required' => false)),
      'fee_type_id'  => new sfValidatorInteger(array('required' => false)),
      'fee_group_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('FeeGroup'), 'required' => false)),
      'price'        => new sfValidatorPass(array('required' => false)),
      'amount'       => new sfValidatorInteger(array('required' => false)),
      'amount_order' => new sfValidatorInteger(array('required' => false)),
      'created_at'   => new sfValidatorDateTime(),
      'updated_at'   => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('fee[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Fee';
  }

}
