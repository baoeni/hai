<?php

/**
 * Fee form.
 *
 * @package    haimeeAct
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class FeeForm extends BaseFeeForm
{
  public function configure()
  {
    $this->useFields(array('name', 'price', 'amount', 'explanation'));

    $this->widgetSchema['name'] = new sfWidgetFormInputText(array(), array('size' => '20'));
	$this->widgetSchema['price'] = new sfWidgetFormInputText(array(), array('size' => '5'));
	$this->widgetSchema['amount'] = new sfWidgetFormInputText(array(), array('size' => '5'));
	$this->widgetSchema['explanation'] = new sfWidgetFormInputText(array(), array('size' => '25'));


    if ($this->object->exists())
    {
      $this->widgetSchema['delete'] = new sfWidgetFormInputHidden(array(), array('value' => '0'));
      $this->validatorSchema['delete'] = new sfValidatorPass();
    }
  }
}
