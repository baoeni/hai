<?php

class ActivityFeesForm extends BaseActivityForm
{
  /**
   * Fees scheduled for deletion
   * @var array
   */
  protected $scheduledMandatoryFeeForDeletion = array();
  protected $scheduledOptionalFeeForDeletion = array();
  protected $scheduledGroupFeeForDeletion = array();
  protected $scheduledGroupFeeItemForDeletion = array();

  public function configure()
  {

	$this->unsetAllFieldsExcept();

	$this->getObject()->setPaymentTypeIds(explode(',', $this->getObject()->getPaymentTypeIds()));
	$this->widgetSchema['payment_type_ids'] = new sfWidgetFormDoctrineChoice(array('model' => 'PaymentType', 'multiple' => true, 'renderer_class' => 'sfWidgetFormSelectCheckbox'));
	//$this->validatorSchema['payment_type_ids'] = new sfValidatorDoctrineChoice(array('model' => 'PaymentType', 'multiple' => true, 'required' => false));
    $this->validatorSchema['payment_type_ids'] = new sfValidatorString(array('max_length' => 255, 'required' => true),array('required'   => 'Please select a payment type'));

	$this->embedActivityFees();

    $this->widgetSchema->setNameFormat('activity_fees[%s]');
	$this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
  
  }

  protected function embedActivityFees()
  {
    $activity_fees_form = new sfForm();
	$mandatory_fees_form = new sfForm();
    $optional_fees_form = new sfForm();
    $group_fees_form = new sfForm();

	//we only need the form container for embedding form via ajax,
    if (false === sfContext::getInstance()->getRequest()->isXmlHttpRequest())
    {
	  $activity_fees = array();
	  $activity_fees['mandatory_fees'] = $this->getObject()->getMandatoryFees();
      $activity_fees['optional_fees'] = $this->getObject()->getOptionalFees();
      $activity_fees['group_fees'] = $this->getObject()->getGroupFees();

  	  if (count($activity_fees) == 0) //if still empty, create some fees by default
	  {
		  //or do something
	  }

	  foreach ($activity_fees['mandatory_fees'] as $num => $fee)
  	  {
		$key = 'mandatory_fee_'.$num;
        $mandatory_fees_form->embedForm($key, new FeeForm($fee));
  	  }

	  foreach ($activity_fees['optional_fees'] as $num => $fee)
  	  {
		$key = 'optional_fee_'.$num;
        $optional_fees_form->embedForm($key, new FeeForm($fee));
  	  }

	  foreach ($activity_fees['group_fees'] as $gnum => $gfee)
  	  {
		$gkey = 'group_fee_'.$gnum;
		$fee_group_form = new FeeGroupForm($gfee['fee_group']);
		$fees_form = new sfForm();
		
		foreach ($gfee['fees'] as $num => $fee)
		{
		  $key = $gkey.'_item_'.$num;
	      $fees_form->embedForm($key, new FeeForm($fee));
		}

        $fee_group_form->embedForm('fees', $fees_form);
        $group_fees_form->embedForm($gkey, $fee_group_form);
  	  }
    }

    $activity_fees_form->embedForm('mandatory_fees', $mandatory_fees_form);
    $activity_fees_form->embedForm('optional_fees', $optional_fees_form);
	$activity_fees_form->embedForm('group_fees', $group_fees_form);
	$this->embedForm('activity_fees', $activity_fees_form);
  }

  public function addMandatoryFeeForm($key)
  {
    if (!$this->getObject())
    {
      throw new InvalidArgumentException('You must provide a activity object.');
    }

    $fee = new Fee();
    $fee->Activity = $this->getObject();
    $fee->setFeeTypeId(1);

    //Embedding the new picture in the container
    $this->embeddedForms['activity_fees']->embeddedForms['mandatory_fees']->embedForm($key, new FeeForm($fee));
    
	//Re-embedding the container
    $this->embeddedForms['activity_fees']->embedForm('mandatory_fees', $this->embeddedForms['activity_fees']->embeddedForms['mandatory_fees']);

	$this->embedForm('activity_fees', $this->embeddedForms['activity_fees']);
  }

  public function addOptionalFeeForm($key)
  {
    if (!$this->getObject())
    {
      throw new InvalidArgumentException('You must provide a activity object.');
    }

    $fee = new Fee();
    $fee->Activity = $this->getObject();
    $fee->setFeeTypeId(2);

    //Embedding the new picture in the container
    $this->embeddedForms['activity_fees']->embeddedForms['optional_fees']->embedForm($key, new FeeForm($fee));
    
	//Re-embedding the container
    $this->embeddedForms['activity_fees']->embedForm('optional_fees', 
		$this->embeddedForms['activity_fees']->embeddedForms['optional_fees']);

	$this->embedForm('activity_fees', $this->embeddedForms['activity_fees']);

  }

  public function addGroupFeeForm($key, $id = null)
  {
    if (!$this->getObject())
    {
      throw new InvalidArgumentException('You must provide a activity object.');
    }

	//add fee group form
	if( !is_null($id) && ($fee_group = Doctrine_Core::getTable('FeeGroup')->find(array('id' => $id))) ){
	  $fee_group_form = new FeeGroupForm($fee_group);
	}else{
	  $fee_group = new FeeGroup();
      $fee_group->Activity = $this->getObject();
	  $fee_group_form = new FeeGroupForm($fee_group);
	}

	//$fee_group_form->setActivity($this->getObject());

    //Embedding the new picture in the container
    $this->embeddedForms['activity_fees']->embeddedForms['group_fees']->embedForm($key, $fee_group_form);
    
	//Re-embedding the container
    $this->embeddedForms['activity_fees']->embedForm('group_fees', 
		$this->embeddedForms['activity_fees']->embeddedForms['group_fees']);

	$this->embedForm('activity_fees', $this->embeddedForms['activity_fees']);

	return $fee_group_form;
  }

  public function addGroupFeeItemForm($gkey, $key, $fee_group_form)
  {
    if (!$this->getObject())
    {
      throw new InvalidArgumentException('You must provide a activity object.');
    }

	if (!$fee_group_form)
    {
      throw new InvalidArgumentException('You must provide a FeeGroup object.');
    }
    
    //Embedding the new picture in the container
	// if embedding form via ajax
	if(!$this->embeddedForms['activity_fees']->embeddedForms['group_fees']->offsetExists($gkey))
	{
	  //if( !is_null($gid) && ($fee_group = Doctrine_Core::getTable('FeeGroup')->find(array('id' => $gid))) ){
	  //  $fee_group_form = new FeeGroupForm($fee_group);
	  //}else{
      //  $fee_group_form = new FeeGroupForm();
	  //}
	  //$fee_group_form->setActivity($this->getObject());

	  $fee_group_form->addFeeGroupItemForm($key);
	  $this->embeddedForms['activity_fees']->embeddedForms['group_fees']->embedForm($gkey, $fee_group_form);

	}else{
      
	  //if( is_null($gid) || !($fee_group = Doctrine_Core::getTable('FeeGroup')->find(array('id' => $gid))) ){
	  //  $fee_group = new FeeGroup();
	  //}

	  //!!!!!!!!!!!why can <not> get the form object from sfFormFieldSchema!!!!!!!!
	  $fee = new Fee();
      $fee->Activity = $this->getObject();
	  //$fee->FeeGroup = $fee_group;
	  $fee->FeeGroup = $fee_group_form->getObject();
      $fee->setFeeTypeId(3); // fixed type
	  $this->embeddedForms['activity_fees']->embeddedForms['group_fees']->embeddedForms[$gkey]->embeddedForms['fees']->embedForm($key, new FeeForm($fee));
	 
	  //Re-embedding the container
	  $this->embeddedForms['activity_fees']->embeddedForms['group_fees']->embeddedForms[$gkey]->embedForm('fees', 
		  $this->embeddedForms['activity_fees']->embeddedForms['group_fees']->embeddedForms[$gkey]->embeddedForms['fees']);

	}
    
	//Re-embedding the container
    $this->embeddedForms['activity_fees']->embeddedForms['group_fees']->embedForm($gkey, 
		$this->embeddedForms['activity_fees']->embeddedForms['group_fees']->embeddedForms[$gkey]);

    $this->embeddedForms['activity_fees']->embedForm('group_fees', 
		$this->embeddedForms['activity_fees']->embeddedForms['group_fees']);

	$this->embedForm('activity_fees', $this->embeddedForms['activity_fees']);

  }
  

  /**
   * Updates object with provided values, dealing with evantual relation deletion
   *
   * @see sfFormDoctrine::doUpdateObject()
   */
  /*
  protected function doUpdateObject($values)
  {
    if (count($this->scheduledMandatoryFeeForDeletion))
    {
      foreach ($this->scheduledMandatoryFeeForDeletion as $key => $id)
      {
        unset($values['activity_fees']['mandatory_fees'][$key]);
        unset($this->object['activity_fees']['mandatory_fees'][$key]);
        Doctrine::getTable('Fee')->findOneById($id)->delete();
      }
    }

    $this->getObject()->fromArray($values);
  }
  */

  /**
   * Saves embedded form objects.
   *
   * @param mixed $con An optional connection object
   * @param array $forms An array of forms
   */
  /*
  public function saveEmbeddedForms($con = null, $forms = null)
  {
    if (null === $con)
    {
      $con = $this->getConnection();
    }

    if (null === $forms)
    {
      $forms = $this->embeddedForms;
    }
    
    foreach ($forms as $form)
    {
      if ($form instanceof sfFormObject)
      {
        if (!in_array($form->getObject()->getId(), $this->scheduledMandatoryFeeForDeletion))
        {
          $form->saveEmbeddedForms($con);
          $form->getObject()->save($con);
        }
      }
      else
      {
        $this->saveEmbeddedForms($con, $form->getEmbeddedForms());
      }
    }

  }
  */

  public function deleteMandatoryFeeForm($key)
  {
    $id = $this->widgetSchema['activity_fees']['mandatory_fees'][$key]['delete']->getAttribute("id");
  }

  public function bind(array $taintedValues = null, array $taintedFiles = null)
  {
	if(isset($taintedValues['payment_type_ids'])){

      $payment_types = $taintedValues['payment_type_ids'];
	  $taintedValues['payment_type_ids'] = implode(',', $payment_types);
	}

	if(isset($taintedValues['activity_fees'])) {
			
		if(array_key_exists('mandatory_fees',$taintedValues['activity_fees'])){
	  
		  foreach($taintedValues['activity_fees']['mandatory_fees'] as $key => $newFee)
	      {

	        if (!isset($this['activity_fees']['mandatory_fees'][$key]))
	        {
	          $this->addMandatoryFeeForm($key);
	        }else{

		      if(($newFee['delete'] == "1") && $newFee['id'])
			  {
			    $this->scheduledMandatoryFeeForDeletion[$key] = $newFee['id'];
	          }
		    }
	      }
		}
	
		if(array_key_exists('optional_fees',$taintedValues['activity_fees'])){
		
			foreach($taintedValues['activity_fees']['optional_fees'] as $key => $newFee)
		    {
		      if (!isset($this['activity_fees']['optional_fees'][$key]))
		      {
		        $this->addOptionalFeeForm($key);
		      }else{

				if(($newFee['delete'] == "1") && $newFee['id'])
				{
				  $this->scheduledOptionalFeeForDeletion[$key] = $newFee['id'];
		        }
			  }
		    }
		}

		if(array_key_exists('group_fees',$taintedValues['activity_fees'])){
	
		  foreach($taintedValues['activity_fees']['group_fees'] as $gkey => $newFeeGroup)
	      {
	        if (!isset($this['activity_fees']['group_fees'][$gkey]))
	        { 
			  $fee_group_form = $this->addGroupFeeForm($gkey);
 
		      foreach($taintedValues['activity_fees']['group_fees'][$gkey]['fees'] as $key => $newFee)
			  {
	            $this->addGroupFeeItemForm($gkey, $key, $fee_group_form);
			  }
      
		    }else{
        
		      if(($newFeeGroup['delete'] == "1") && $newFeeGroup['id'])
			  {
			    $this->scheduledGroupFeeForDeletion[$gkey] = $newFeeGroup['id'];
	          }

			  $gid = intval($this['activity_fees']['group_fees'][$gkey]['id']->getValue());
			  if($fee_group = Doctrine_Core::getTable('FeeGroup')->find(array('id' => $gid)))
			  {
		        $fee_group_form = new FeeGroupForm($fee_group);
			  }else{
				$fee_group_form = new FeeGroupForm();
			  }

			  foreach($taintedValues['activity_fees']['group_fees'][$gkey]['fees'] as $key => $newFee)
			  {
			    if (!isset($this['activity_fees']['group_fees'][$gkey]['fees'][$key]))
		        {
		          //$this->addGroupFeeItemForm($gkey, $key, $gid);
				  $this->addGroupFeeItemForm($gkey, $key, $fee_group_form);
				}else{

				  if(($newFee['delete'] == "1") && $newFee['id'])
				  {
				    $this->scheduledGroupFeeItemForDeletion[$key] = $newFee['id'];
		          }

				}
			  }
		    }
		  }
		
		}
	}

    parent::bind($taintedValues, $taintedFiles);
  }	

  public function deleteHard()
  {
    if (count($this->scheduledMandatoryFeeForDeletion))
    {
      foreach ($this->scheduledMandatoryFeeForDeletion as $key => $id)
      {
        Doctrine::getTable('Fee')->findOneById($id)->delete();
      }
    }

    if (count($this->scheduledOptionalFeeForDeletion))
    {
	  foreach ($this->scheduledOptionalFeeForDeletion as $key => $id)
      {
        Doctrine::getTable('Fee')->findOneById($id)->delete();
      }
	}


    $fee_group_ids = array();
    if (count($this->scheduledGroupFeeItemForDeletion))
    {
	  foreach ($this->scheduledGroupFeeItemForDeletion as $key => $id)
      {
		$fee = Doctrine::getTable('Fee')->findOneById($id);
		$fee_group_ids[$fee->getFeeGroupId()] = 1;
        $fee->delete();
      }
	}

	if (count($this->scheduledGroupFeeForDeletion))
    {
	  foreach ($this->scheduledGroupFeeForDeletion as $gkey => $gid)
      {
        $fee_group = Doctrine::getTable('FeeGroup')->findOneById($gid);
		$fee_group_ids[$gid] = 0;
		//$fee_group->deleteFees(); //automatically delete via( onDelete: CASCADE in MySql)
		$fee_group->delete();
      }
	}
    
	foreach ($fee_group_ids as $gid => $v)
	{
	  if($v)
	  {
		$fee_group = Doctrine::getTable('FeeGroup')->findOneById($gid);
	    if($fee_group->getFees()->count() < 1)
        {
          $fee_group->delete();
        }
	  }
	}
  }

  public function save($conn = null)
  {
	//do something
    return parent::save($conn);
  }

}
