<?php

/**
 * UserActivity form.
 *
 * @package    haimeeAct
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class UserActivityForm extends BaseUserActivityForm
{
  public function configure()
  {
    $this->unsetAllFieldsExcept();

    //user first name
	$this->widgetSchema['user_first_name'] = new sfWidgetFormInputText(array('default' => $this->getObject()->getUser()->getFirstName()), array('size' => '40'));
	$this->validatorSchema['user_first_name'] = new sfValidatorString(array('max_length' => 255, 'required' => true));

    //user last name
	$this->widgetSchema['user_last_name'] = new sfWidgetFormInputText(array('default' => $this->getObject()->getUser()->getLastName()), array('size' => '40'));
	$this->validatorSchema['user_last_name'] = new sfValidatorString(array('max_length' => 255, 'required' => true));

	//user email
	$this->widgetSchema['user_email_address'] = new sfWidgetFormInputText(array('default' => $this->getObject()->getUser()->getEmailAddress()), array('size' => '40'));
	$this->validatorSchema['user_email_address'] = new sfValidatorEmail(array('max_length' => 255, 'required' => true));

	//user phone
	$this->widgetSchema['user_phone'] = new sfWidgetFormInputText(array('default' => $this->getObject()->getUser()->getSfGuardUserProfile()->getPhone()), array('size' => '20'));
	$this->validatorSchema['user_phone'] = new sfValidatorString(array('max_length' => 255, 'required' => true));

	//user phone
	$this->widgetSchema['location'] = new sfWidgetFormTextarea(array('default' => $this->getObject()->getUser()->getSfGuardUserProfile()->getLocation()), array('size' => '100'));
	$this->validatorSchema['location'] = new sfValidatorString(array('max_length' => 2550, 'required' => true));

	//quantity
	$this->widgetSchema['amount'] = new sfWidgetFormInputText(array('default' => 1), array('size' => '5'));
	$this->validatorSchema['amount'] = new sfValidatorInteger(array('required' => true));

    //pay type
	if($this->getObject()->getActivity()->hasFeeCreated()){	
	
		$choices = array();
		$payment_types = $this->getObject()->getActivity()->getPaymentTypes();
		if($payment_types){
			foreach($payment_types as $payment_type)
			{
			  $choices[$payment_type->getId()] = $payment_type->getName();
			}
		}
			//$this->widgetSchema['pay_type'] = new sfWidgetFormDoctrineChoice(array('model' => 'PaymentType', 'add_empty' => false));
			$this->widgetSchema['pay_type'] = new sfWidgetFormChoice(array('choices' => $choices));
			$this->validatorSchema['pay_type'] = new sfValidatorDoctrineChoice(array('model' => 'PaymentType'));
		
		
	}
	$this->embedActivityFees();

    $this->widgetSchema->setLabels(array(
			'user_first_name' => 'First name <em>*</em>',
			'user_last_name' => 'Last name <em>*</em>',
            'user_email_address' => 'Email <em>*</em>',
		    'user_phone' => 'Phone <em>*</em>',
			'location' => 'Location <em>*</em>',
			'amount' => 'Attend amount <em>*</em>',
		    'pay_type' => 'Pay type'
			));
  }

  protected function embedActivityFees()
  {
    $activity_fees_form = new sfForm();
	$mandatory_fees_form = new sfForm();
    $optional_fees_form = new sfForm();
    $group_fees_form = new sfForm();

	$user_activity = $this->getObject();
	$activity = $user_activity->getActivity();

	$activity_fees = array();
	$activity_fees['mandatory_fees'] = $activity->getMandatoryFees();
    $activity_fees['optional_fees'] = $activity->getOptionalFees();
    $activity_fees['group_fees'] = $activity->getGroupFees();

	foreach ($activity_fees['mandatory_fees'] as $num => $fee)
  	{
	  $key = 'mandatory_fee_'.$num;
	  if(!($payment = $user_activity->getOrderPayment($fee)))
	  {
		$payment = new Payment();
		$payment->setUserActivity($this->getObject());
		$payment->setFee($fee);
	  }

      $mandatory_fees_form->embedForm($key, new PaymentForm(null, $payment));
  	}

	foreach ($activity_fees['optional_fees'] as $num => $fee)
  	{ 
	  $key = 'optional_fee_'.$num;
	  if(!($payment = $user_activity->getOrderPayment($fee)))
	  {
		$payment = new Payment();
		$payment->setUserActivity($this->getObject());
		$payment->setFee($fee);
	  }

      $optional_fees_form->embedForm($key, new PaymentForm(null, $payment));
  	}

	foreach ($activity_fees['group_fees'] as $gnum => $gfee)
  	{
	  $gkey = 'group_fee_'.$gnum;
	  if(!($payment = $user_activity->getOrderPaymentOfGroup($gfee['fee_group'])))
	  {
		$payment = new Payment();
		$payment->setUserActivity($this->getObject());
	  }

	  $payment_form = new PaymentForm($gfee['fee_group'], $payment);
      $group_fees_form->embedForm($gkey, $payment_form);
  	}

	$activity_fees_form->embedForm('mandatory_fees', $mandatory_fees_form);
    $activity_fees_form->embedForm('optional_fees', $optional_fees_form);
	$activity_fees_form->embedForm('group_fees', $group_fees_form);
	$this->embedForm('activity_fees', $activity_fees_form);
  }

  public function bind(array $taintedValues = null, array $taintedFiles = null)
  {
	if(isset($taintedValues['activity_fees']))
	{
    
	if (array_key_exists('mandatory_fees', $taintedValues['activity_fees'])){
	  
	  foreach ($taintedValues['activity_fees']['mandatory_fees'] as $key => $fee)
      {
		$taintedValues['activity_fees']['mandatory_fees'][$key]['fee_id'] = $this['activity_fees']['mandatory_fees'][$key]['fee_id']->getValue();

		$taintedValues['activity_fees']['mandatory_fees'][$key]['amount'] = $taintedValues['amount'];
		$taintedValues['activity_fees']['mandatory_fees'][$key]['pay_type'] = $taintedValues['pay_type'];
      }
	}
	

	if (array_key_exists('optional_fees', $taintedValues['activity_fees'])){
	
	  foreach ($taintedValues['activity_fees']['optional_fees'] as $key => $fee)
      {
	    if (!isset($fee['fee_id']))
		{
		  unset($this->widgetSchema['activity_fees']['optional_fees'][$key]);
          unset($this->validatorSchema['activity_fees']['optional_fees'][$key]);
          unset($this->embeddedForms['activity_fees']->embeddedForms['optional_fees'][$key]);
		  unset($taintedValues['activity_fees']['optional_fees'][$key]);
		  unset($taintedFiles['activity_fees']['optional_fees'][$key]);

		} else {
	      $taintedValues['activity_fees']['optional_fees'][$key]['amount'] = $taintedValues['amount'];
		  $taintedValues['activity_fees']['optional_fees'][$key]['pay_type'] = $taintedValues['pay_type'];
		}
      }
	}
    
	if (array_key_exists('group_fees', $taintedValues['activity_fees'])){
	
	  foreach ($taintedValues['activity_fees']['group_fees'] as $key => $fee)
      {
		$taintedValues['activity_fees']['group_fees'][$key]['amount'] = $taintedValues['amount'];
		$taintedValues['activity_fees']['group_fees'][$key]['pay_type'] = $taintedValues['pay_type'];
      }
	}

	}else {

	  unset($this->widgetSchema['pay_type']);
      unset($this->validatorSchema['pay_type']);
	  unset($taintedValues['pay_type']);
	  unset($taintedFiles['pay_type']);
	}

	parent::bind($taintedValues, $taintedFiles);
  }


}


