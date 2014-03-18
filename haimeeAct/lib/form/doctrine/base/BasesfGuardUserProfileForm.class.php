<?php

/**
 * sfGuardUserProfile form base class.
 *
 * @method sfGuardUserProfile getObject() Returns the current form's model object
 *
 * @package    haimeeAct
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasesfGuardUserProfileForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'  => new sfWidgetFormInputHidden(),
      'avatar'   => new sfWidgetFormTextarea(),
      'sex'      => new sfWidgetFormInputCheckbox(),
      'birthday' => new sfWidgetFormDateTime(),
      'location' => new sfWidgetFormTextarea(),
      'phone'    => new sfWidgetFormInputText(),
	  'bank_account_info'    => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'user_id'  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('user_id')), 'empty_value' => $this->getObject()->get('user_id'), 'required' => false)),
      'avatar'   => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'sex'      => new sfValidatorBoolean(array('required' => false)),
      'birthday' => new sfValidatorDateTime(array('required' => false)),
      'location' => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'phone'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
	  'bank_account_info'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sf_guard_user_profile[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfGuardUserProfile';
  }

}
