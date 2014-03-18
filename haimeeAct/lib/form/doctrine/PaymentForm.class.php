<?php

/**
 * Payment form.
 *
 * @package    haimeeAct
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PaymentForm extends BasePaymentForm
{
  protected $fee_group;

  public function setFeeGroup(FeeGroup $fee_group)
  {
    $this->fee_group = $fee_group;
  }

  public function getFeeGroup()
  {
    return $this->fee_group;
  }

  public function __construct($fee_group = null, $object = null, $options = array(), $CSRFSecret = null)
  {
	 $this->fee_group = $fee_group;
	 parent::__construct($object, $options, $CSRFSecret);
  }

  public function configure()
  {
	//require at last one field, otherwise the field won't be seted
	$this->unsetAllFieldsExcept(array('fee_id', 'amount', 'pay_type'));
    
	$this->widgetSchema['amount'] = new sfWidgetFormInputHidden();
    $this->validatorSchema['amount'] = new sfValidatorPass(array('required' => false));

	$this->widgetSchema['pay_type'] = new sfWidgetFormInputHidden();
    $this->validatorSchema['pay_type'] = new sfValidatorPass(array('required' => false));

	$this->embedFee();
  }

  protected function embedFee()
  {
	if($fee = $this->getObject()->getFee())
	{
	  $fee_type_id = $fee->getFeeTypeId();
	  if($fee_type_id == 1)
	  {
		$this->widgetSchema['fee_id'] = new sfWidgetFormInputCheckBox(
			array('value_attribute_value' => $fee->getId(),
			),
			array('checked' => 'ckecked',
			      'disabled' => 'disabled'
		    )
		  );

        $label = '<td>'.$fee->getName().'</td><td>'.$fee->getPrice().'</td><td>'.$fee->getExplanation().'</td>';
	    $this->widgetSchema['fee_id']->setLabel($label);
        
      }elseif($fee_type_id == 2){
        $this->widgetSchema['fee_id'] = new sfWidgetFormInputCheckBox(
			array('value_attribute_value' => $fee->getId(),
			)
		  );
        
		$this->setDefault('fee_id', false);

        $label = '<td>'.$fee->getName().'</td><td>'.$fee->getPrice().'</td><td>'.$fee->getExplanation().'</td>';
	    $this->widgetSchema['fee_id']->setLabel($label);

	  }elseif($fee_type_id == 3 || $fee->isNew()){

		$gfee = $this->getFeeGroup();
        $fees = $gfee->getFees();
		$choices = array();
		$default = null;
		foreach($fees as $fee)
		{
		  $label = sprintf('<%s>%s</%s><%s>%s</%s><%s>%s</%s>', 'td', $fee->getName(), 'td', 'td', $fee->getPrice(), 'td', 'td',  $fee->getExplanation(), 'td');
          $choices[$fee->getId()] = $label;
		  if($default == null)
		  {
            $default = $fee->getId();
		  }
		}

		$this->widgetSchema['fee_id'] = new myWidgetFormSelectRadio(array(
			'choices' => $choices,
			'formatter' =>  array($this, "formatRadioList")
			));
        
		$this->setDefault('fee_id', $default); 
		$label = $gfee->getName();
	    $this->widgetSchema['fee_id']->setLabel($label);
	  }
	}

  }

  public function formatRadioList($widget, $inputs)
  {
    $rows = array();
	foreach ($inputs as $input)
	{
	  $rows[] = sprintf('<%s><%s>%s</%s>%s%s</%s>', 'tr', 'td', $input['input'], 'td', $this->getOption('label_separator'), $input['label'], 'tr');
    }
	
	return !$rows ? '' : implode($this->getOption('separator'), $rows);
  }

}

class myWidgetFormInputCheckbox extends sfWidgetFormInputCheckbox
{




}


class myWidgetFormSelectRadio extends sfWidgetFormSelectRadio
{
  protected function formatChoices($name, $value, $choices, $attributes)
  {
    $inputs = array();
    foreach ($choices as $key => $option)
    {
      $baseAttributes = array(
        'name'  => substr($name, 0, -2),
        'type'  => 'radio',
        'value' => self::escapeOnce($key),
        'id'    => $id = $this->generateId($name, self::escapeOnce($key)),
      );

      if (strval($key) == strval($value === false ? 0 : $value))
      {
        $baseAttributes['checked'] = 'checked';
      }

      $inputs[$id] = array(
        'input' => $this->renderTag('input', array_merge($baseAttributes, $attributes)),
        'label' => $this->renderContentTag('td', $this->renderContentTag('label', null, array('for' => $id))).$option
      );
    }

    return call_user_func($this->getOption('formatter'), $this, $inputs);
  }

}