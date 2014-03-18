<?php

/**
 * Project form base class.
 *
 * @package    haimeeAct
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormBaseTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class BaseFormDoctrine extends sfFormDoctrine
{
  public function setup()
  {
  }

  //added for dynamic unset form fields
  protected function unsetAllFieldsExcept($fields = array())
  {  
    $unsetFields = array_diff(array_keys($this->getWidgetSchema()->getFields()), $fields);
	
	foreach($unsetFields as $value)
	{
	  unset($this[$value]);
	}  
  }
}
