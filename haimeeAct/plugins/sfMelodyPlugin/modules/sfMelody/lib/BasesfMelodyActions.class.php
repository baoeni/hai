<?php
/**
 * Actions class for Melody
 *
 * @author Gordon Franke <info@nevalon.de>
 * @since 29 août 2010
 */
class BasesfMelodyActions extends sfMelodyBaseActions
{
  /**
   *
   * @param sfWebRequest $request
   *
   * Store access token and manage user
   *
   * @author Maxime Picaud
   * @since 29 août 2010
   */
  public function executeAccess(sfWebRequest $request)
  {
    $melody = $this->getMelody();

    $melody->setCallback('@melody_access?service='.$melody->getName());
    $access_token = $melody->getAccessToken($this->getCode());

    $melody->setToken($access_token);

    $user = null;
	
    if($this->getUser()->isAuthenticated())
    {
      $user = $this->getUser()->getGuardUser();

      $conflict = !$melody->getUserFactory()->isCompatible($user);
      $event = new sfEvent($this, 'melody.filter_user', array('melody' => $melody, 'conflict' => $conflict));
      $dispatcher = $this->getContext()->getEventDispatcher();
      $user = $dispatcher->filter($event, $user)->getReturnValue();
		if (sfConfig::get('sf_logging_enabled'))
		{
		  sfContext::getInstance()->getLogger()->info('show this in second time user connect to fb or linkedin');
		}
    }
    else
    {
      $old_token = $this->getOrmAdapter('Token')->findOneByNameAndIdentifier($melody->getName(), $melody->getIdentifier());

      //try to get user from the token
      if($old_token)
      {
        $user = $old_token->getUser();
      }

      //try to get user by melody
      if(!$user)
      {
        $user = $this->getGuardAdapter()->findByMelody($melody);
      }

      $create_user = sfConfig::get('app_melody_create_user', false);
      $redirect_register = sfConfig::get('app_melody_redirect_register', false);

      $create_user = $melody->getConfigParameter('create_user', $create_user);
      $redirect_register = $melody->getConfigParameter('redirect_register', $redirect_register);

      //create a new user if needed
      if(!$user && ( $create_user || $redirect_register))
      {
        $user = $melody->getUser();
        if($redirect_register)
        {
          $this->getUser()->setAttribute('melody_user', serialize($user));
          $this->getUser()->setAttribute('melody', serialize($melody));

          $this->redirect($redirect_register);
        }
        else
        {
          $user->save();

			if($melody->getName() == 'facebook'){
				//location,gender,birthday
				$this->me = $melody->getMe();

				$fb_user_id = $this->me->id;
				$location = '';
				if(isset($this->me->location) && isset($this->me->location->name)){
					$location = $this->me->location->name ;				
				}

				$gender = $this->me->gender != "male";
				$birthday = '';
				if(isset($this->me->birthday)){
					$birthday = $this->me->birthday;						
				}


				$this->logMessage('-----FACEBOOK------', 'info');			
				$this->logMessage($location, 'info');
				$this->logMessage($gender, 'info');
				$this->logMessage($birthday, 'info');
				$this->logMessage('-----FACEBOOK------', 'info');			

				//save avatar
				$url = 'https://graph.facebook.com/'.$fb_user_id.'/picture';
				$avatar = 'fb-'.$fb_user_id.'.jpg';
				$img = sfConfig::get('sf_upload_dir').'/avatar/'.$avatar;
				$fileResult = file_put_contents($img, file_get_contents($url));

				if(!($user_profile = $user->getSfGuardUserProfile()))
				{
			      $user_profile = new sfGuardUserProfile();
			      $user_profile->setSfGuardUser($user);
				}
				$user_profile->setLocation($location);
				$user_profile->setSex($gender);
				if(strlen($birthday) > 0){
					$dateFormat = new sfDateFormat();
					$value = $dateFormat->format(strtotime($birthday), 'I');
					$user_profile->setBirthday($value);
				}
				if($fileResult){
					$user_profile->setAvatar($avatar);
				}
				$user_profile->save();

				
			}else if($melody->getName() == 'linkedin'){
				//location,gender,birthday
				$this->me = $melody->getMe();

				$li_user_id = $this->me->id;
				$location = '';
				if(isset($this->me->location) && isset($this->me->location->name)){
					$location = $this->me->location->name ;				
				}

				
				$birthday = '';
				if(isset($this->me->dateOfBirth) && isset($this->me->dateOfBirth->year) && isset($this->me->dateOfBirth->month) && isset($this->me->dateOfBirth->day)){
					$birthday = $this->me->dateOfBirth->year.'-'.$this->me->dateOfBirth->month.'-'.$this->me->dateOfBirth->day;
				}

				$phone = '';
				if(isset($this->me->phoneNumbers) && isset($this->me->phoneNumbers->_total) && isset($this->me->phoneNumbers->values[0]) && isset($this->me->phoneNumbers->values[0]->phoneNumber) ){
					$phone = $this->me->phoneNumbers->values[0]->phoneNumber;
				}
				
				$this->logMessage('-----linkedin------', 'info');			
				$this->logMessage($location, 'info');
				$this->logMessage($birthday, 'info');
				$this->logMessage('-----linkedin------', 'info');			

				//save avatar
				$url = $this->me->pictureUrl;
				$avatar = 'linkedin-'.$li_user_id.'.jpg';
				$img = sfConfig::get('sf_upload_dir').'/avatar/'.$avatar;
				$fileResult = file_put_contents($img, file_get_contents($url));

				if(!($user_profile = $user->getSfGuardUserProfile()))
				{
			      $user_profile = new sfGuardUserProfile();
			      $user_profile->setSfGuardUser($user);
				}
				$user_profile->setLocation($location);
				
				if(strlen($birthday) > 0){
					$dateFormat = new sfDateFormat();
					$value = $dateFormat->format(strtotime($birthday), 'I');
					$user_profile->setBirthday($value);
				}
				
				if(strlen($phone) > 0){
					$user_profile->setPhone($phone);
				}
				
				if($fileResult){
					$user_profile->setAvatar($avatar);					
				}

				$user_profile->save();

				
			}else if($melody->getName() == 'weibo'){
					//location,gender,birthday
					$this->me = $melody->getMe();

					$li_user_id = $this->me->id;
					$location = '';
					if(isset($this->me->location)){
						$location = $this->me->location ;
					}


					$gender = '';
					if(isset($this->me->gender) ){
						$gender = $this->me->gender;
					}
					
					
					//save avatar
					$url = $this->me->profile_image_url;
					$avatar = 'weibo-'.$li_user_id.'.jpg';
					$img = sfConfig::get('sf_upload_dir').'/avatar/'.$avatar;
					$fileResult = file_put_contents($img, file_get_contents($url));

					$this->logMessage('-----weibo------', 'info');			
					$this->logMessage($location, 'info');
					$this->logMessage($gender, 'info');
					$this->logMessage($url, 'info');
					$this->logMessage('-----weibo------', 'info');			


					if(!($user_profile = $user->getSfGuardUserProfile()))
					{
				      $user_profile = new sfGuardUserProfile();
				      $user_profile->setSfGuardUser($user);
					}
					
					$user_profile->setLocation($location);
					
					if(strlen($gender) > 0){
						$user_profile->setSex($gender == "m" ? 0 : 1);
					}

					if($fileResult){
						$user_profile->setAvatar($avatar);					
					}

					$user_profile->save();


				}
			if(strlen($user->getEmailAddress()) > 0){
				$message = Swift_Message::newInstance()
		          ->setFrom(sfConfig::get('app_sf_guard_plugin_default_from_email', 'info@haimee.com'))
		          ->setTo($user->getEmailAddress())
		//          ->setTo('baoeni@gmail.com')
		          ->setSubject('Welcome to 海米活动')
		          ->setBody($this->getPartial('sfGuardRegister/send_email_register', array('user' => $user)))
		          ->setContentType('text/html');
		        $this->getMailer()->send($message);
			}
			
        }
      }
    }

    if($user)
    {
      $access_token->setUserId($user->getId());

      if(!$this->getUser()->isAuthenticated())
      {
        $this->getUser()->signin($user, sfConfig::get('app_melody_remember_user', true));
      }
    }

    $this->getUser()->addToken($access_token);

    $this->redirect($this->getCallback());
  }
}