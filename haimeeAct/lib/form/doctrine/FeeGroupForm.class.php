<?php

/**
 * FeeGroup form.
 *
 * @package    haimeeAct
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class FeeGroupForm extends BaseFeeGroupForm
{
  //..
  //protected $activity;

  //public function setActivity(Activity $activity)
  //{
  //  $this->activity = $activity;
  //}

  //public function getActivity()
  //{
  //  return $this->activity;
  //}

  public function configure()
  {
    $this->unsetAllFieldsExcept(array('id', 'name', 'explanation'));

	$this->setWidgets(array(
      'name'        => new sfWidgetFormInputText(array(), array('size' => '10')),
      'explanation' => new sfWidgetFormInputText(array(), array('size' => '25')),
	  'id'          => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'name'        => new sfValidatorString(array('max_length' => 2550, 'required' => false)),
      'explanation' => new sfValidatorString(array('max_length' => 2550, 'required' => false)),
	  'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
    ));
    
	if ($this->object->exists())
    {
      $this->widgetSchema['delete'] = new sfWidgetFormInputHidden(array(), array('value' => '0'));
      $this->validatorSchema['delete'] = new sfValidatorPass();
    }

	$this->embedFees();

	$this->widgetSchema->setNameFormat('fee_group[%s]');
    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
  }

  protected function embedFees()
  {
    $fees_form = new sfForm();
    
	//we only need the form container for embedding form via ajax
    if (false === sfContext::getInstance()->getRequest()->isXmlHttpRequest())
    {
  	  //$fees = $this->getObject()->getFees();

  	  //if (count($fees) == 0) //if still empty, create some fees by default
	  //{
		  //or do something
	  //}

  	  //foreach ($fees as $key=>$fee)
  	  //{
      //  $fee_form = new FeeForm($fee);
      //  $fees_form->embedForm('fee_'.$key, $fee_form);
  	  //}
    }

    $this->embedForm('fees', $fees_form);
  }


  public function addFeeGroupItemForm($key)
  {
	if (!$this->getObject())
    {
      throw new InvalidArgumentException('You must provide a fee group object.');
    }
    
    if (!($activity = $this->getObject()->getActivity()))
    {
      throw new InvalidArgumentException('You must provide a activity object.');
    }

    $fee = new Fee();
    $fee->Activity = $activity;
	$fee->FeeGroup = $this->getObject();
    $fee->setFeeTypeId(3); // fixed type
    
	$this->embeddedForms['fees']->embedForm($key, new FeeForm($fee));
    $this->embedForm('fees', $this->embeddedForms['fees']);
  }

  public function bind(array $taintedValues = null, array $taintedFiles = null)
  {
	
    foreach($taintedValues['fees'] as $key=>$form)
    {
       if (false === $this->embeddedForms['fees']->offsetExists($key))
       {
    	   $this->addFeeGroupItemForm($key);
       }
    }
	
    parent::bind($taintedValues, $taintedFiles);
  }
}
