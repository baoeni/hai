<?php

require_once dirname(__FILE__).'/../lib/BasesfGuardRegisterActions.class.php';

/**
 * sfGuardRegister actions.
 *
 * @package    guard
 * @subpackage sfGuardRegister
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z jwage $
 */
class sfGuardRegisterActions extends BasesfGuardRegisterActions
{
  public function executeIndex(sfWebRequest $request)
  {
    if ($this->getUser()->isAuthenticated())
    {
      $this->getUser()->setFlash('notice', 'You are already registered and signed in!');
      $this->redirect('@homepage');
    }

    $this->form = new sfGuardRegisterForm();

    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter($this->form->getName()));

	// $this->form->bind(array(
	// 	  'captcha'   => $request->getParameter('captcha'),
	// 	));
	
      if ($this->form->isValid())
      {
        $user = $this->form->save();
        $this->getUser()->signIn($user);
		
		//set user to default group: attender
		if (! $this->getUser()->hasGroup('attender')){
		     $this->getUser()->addGroupByName('attender');
		}
		

		$mymail = new myMail();
		$mymail->send(
			$user->getEmailAddress(),
			'Welcome to 海米活动',
			$this->getPartial('sfGuardRegister/send_email_register', array('user' => $user))
			);

        $this->redirect('user_profile_edit');
      }
    }
  }
}