<?php
class sendUserSummary extends sfBaseTask
{
  public function configure()
  {
    $this->namespace = 'send';
    $this->name      = 'userSummary';

//	$this->addOption('connection', sfCommandOption::PARAMETER_REQUIRED, 'all', 'doctrine');
  }
 
  public function execute($arguments = array(), $options = array())
  {
    $this->logSection('send', 'user summary!');

	$databaseManager = new sfDatabaseManager($this->configuration);
	//  $connection = $databaseManager->getDatabase()->getConnection();
	$connection = $databaseManager->getDatabase('doctrine')->getConnection();
	
	$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'sendemail', true);
	sfContext::createInstance($configuration);
	sfProjectConfiguration::getActive()->loadHelpers("Partial", "Url", 'Tag');
	
    $hot_activities = Doctrine_Core::getTable('Activity')->getHotActivityList();

	$q = Doctrine_Query::create()
		->select('s.*')
		->from('sfGuardUser s')
		->where('s.is_active=1 AND s.email_address IS NOT NULL')
		->orderBy('s.id');

    $users = $q->execute();

	foreach($users as $user)
	{
		
		
			$this->logSection('send user id:', $user->getId());
			$this->sendEmail($user,$hot_activities);
		
		
	}
		
  }
	public function sendEmail($user, $hot_activities){
		
		
		if(strlen($user->getEmailAddress()) > 0){
			$email = $user->getEmailAddress();
			
			$organized_activities = $user->getOrganizedActivities();
			$attended_activities = $user->getAttendedActivities();
			
			
			$mymail = new myMail();
			$subject = 'Haimee 2012';
			$content = get_partial('user/send_email_user_summary', array('user' => $user, 'organized_activities' => $organized_activities, 'attended_activities' => $attended_activities, 'hot_activities' => $hot_activities));
			
			$this->logSection('email:', $email);
			$this->logSection('subject:', $subject);
			$this->logSection('content', $content);
			/*
			$mymail->send(
				$email,
				$subject,
				$content
				);
			*/	
			//send an extra one to backup
			$mymail->send(
				$from = sfConfig::get('app_sendtome_email', 'sendtome@haimee.com'),
				$subject,
				$content
			);
		}
		
	}
	
	
}
