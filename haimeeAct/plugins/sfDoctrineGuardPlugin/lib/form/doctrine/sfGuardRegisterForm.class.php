<?php

/**
 * sfGuardRegisterForm for registering new users
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage form
 * @author     Jonathan H. Wage <jonwage@gmail.com>
 * @version    SVN: $Id: BasesfGuardChangeUserPasswordForm.class.php 23536 2009-11-02 21:41:21Z Kris.Wallsmith $
 */
class sfGuardRegisterForm extends BasesfGuardRegisterForm
{
  /**
   * @see sfForm
   */
  public function configure()
  {
		$this->setWidget(
		  'captcha' , new sfWidgetCaptchaGD()
		);
		
	$this->widgetSchema->setLabels(array(
			'first_name' => 'First name',
			'last_name' => 'Last name',
			'email_address' => 'Email Address <em>*</em>',
			'username' => 'Username <em>*</em>',
			'password' => 'Password <em>*</em>',
			'password_again' => 'Password again <em>*</em>',
			'captcha' => 'Captcha <em>*</em>'
			));

		
		
		$this->setValidator(
		  'captcha', new sfCaptchaGDValidator(array('length' => 4))
		);
		
    $this->setValidator('email_address', new sfValidatorEmail());
    $this->setValidator('username', new sfValidatorString(array('min_length' => 4)));

	//rewrite error: An object with the same "email_address" already exist.
    $validators = $this->validatorSchema->getPostValidator()->getValidators();
	foreach ($validators as $a) {
		if ($a instanceof sfValidatorAnd) {
			foreach ($a->getValidators() as $b) {
				if ($b instanceof sfValidatorDoctrineUnique) {
					$c = $b->getOption('column');
					if ($c[0] == 'username') {
						$b->setMessage('invalid', 'This username is already in use.');
					}else if ($c[0] == 'email_address') {
						$b->setMessage('invalid', 'This email is already in use.');
					}
				}
			}
		}
	}

  }
}