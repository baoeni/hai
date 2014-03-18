<?php
class sendRatingEmails extends sfBaseTask
{
  public function configure()
  {
    $this->namespace = 'send';
    $this->name      = 'ratingEmails';

//	$this->addOption('connection', sfCommandOption::PARAMETER_REQUIRED, 'all', 'doctrine');
  }
 
  public function execute($arguments = array(), $options = array())
  {
    $this->logSection('send', 'rating emails!');

	$databaseManager = new sfDatabaseManager($this->configuration);
	//  $connection = $databaseManager->getDatabase()->getConnection();
	$connection = $databaseManager->getDatabase('doctrine')->getConnection();
	
	$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'sendemail', true);
	sfContext::createInstance($configuration);
	sfProjectConfiguration::getActive()->loadHelpers("Partial", "Url", 'Tag');
	
    $activities = Doctrine_Core::getTable('Activity')->getSendRatingActivityList();

	foreach($activities as $activity)
	{
		$this->logSection('send activity id:', $activity->getId());
		$this->sendEmail($activity);
	}
		
  }
	public function sendEmail(Activity $activity){
		
		$mymail = new myMail();
		
		$attenders = $activity->getAttenders();
		foreach($attenders as $attender) {
			if(strlen($attender->getEmailAddress()) > 0){
				$email = $attender->getEmailAddress();
				$mymail->send(
					$email,
					'Rate for activity:'.$activity->getName(),
					get_partial('activity/send_email_rating', array('activity' => $activity,'user' => $attender, 'comment' => ''))
					);
			}
		
		}
		
		
		//send an extra one to backup
		$mymail->send(
			$from = sfConfig::get('app_sendtome_email', 'sendtome@haimee.com'),
			'Rate for activity:'.$activity->getName(),
			get_partial('activity/send_email_rating', array('activity' => $activity,'user' => $activity->getOrganizer(), 'comment' => ''))
		);

		
	}
	
	
}
