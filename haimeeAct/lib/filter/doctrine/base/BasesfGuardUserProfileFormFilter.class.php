<?php

/**
 * sfGuardUserProfile filter form base class.
 *
 * @package    haimeeAct
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasesfGuardUserProfileFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'avatar'   => new sfWidgetFormFilterInput(),
      'sex'      => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'birthday' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'location' => new sfWidgetFormFilterInput(),
      'phone'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'avatar'   => new sfValidatorPass(array('required' => false)),
      'sex'      => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'birthday' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'location' => new sfValidatorPass(array('required' => false)),
      'phone'    => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sf_guard_user_profile_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfGuardUserProfile';
  }

  public function getFields()
  {
    return array(
      'user_id'  => 'Number',
      'avatar'   => 'Text',
      'sex'      => 'Boolean',
      'birthday' => 'Date',
      'location' => 'Text',
      'phone'    => 'Text',
    );
  }
}
