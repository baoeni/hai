<?php

/**
 * sfGuardUser form.
 *
 * @package    haimeeAct
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrinePluginFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sfGuardUserForm extends PluginsfGuardUserForm
{
  public function configure()
  {
	$this->unsetAllFieldsExcept(array('first_name', 'last_name'));

    if( !($user_profile = $this->getObject()->getSfGuardUserProfile()) )
	{
      $user_profile = new sfGuardUserProfile();
      $user_profile->setSfGuardUser($this->getObject());
	}

    $this->embedForm('profile', new sfGuardUserProfileForm($user_profile));
  }
}
