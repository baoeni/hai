<?php

/**
 * sfGuardUser
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    haimeeAct
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class sfGuardUser extends PluginsfGuardUser
{ 
  public function getAttendedActivities()
  {
    $q = Doctrine_Query::create()
			->from('Activity a')
		    ->where('a.id IN (SELECT u.activity_id FROM UserActivity u WHERE u.user_id = ? AND u.quit_time IS NULL)', $this->getId())
		->orderBy('a.time_from DESC');

    return $q->execute();
  }

  public function getAttendedActivitiesNumber(){
	return $this->getAttendedActivities()->count();
  }

  public function getOrganizedActivities()
  {
    $q = Doctrine_Query::create()
			->from('Activity a')
		    ->where('a.organizer_id = ?', $this->getId())
			->orderBy('a.time_from DESC');

    return $q->execute();
  }

  public function getOrganizedActivitiesNumber(){
	return $this->getOrganizedActivities()->count();
  }

  public function isAttendedActivity($activity_id)
  {
    $q = Doctrine_Query::create()
			->from('UserActivity a')
			->where('a.user_id = ?', $this->getId())
			->andWhere('a.activity_id = ?', $activity_id)
	        ->andWhere('a.quit_time IS NULL');

    return $q->execute()->count();
  }

  public function isOrganizedActivity($activity_id)
  {
    $q = Doctrine_Query::create()
			->from('Activity a')
			->where('a.id = ?', $activity_id)
			->andWhere('a.organizer_id = ?', $this->getId());

    return $q->execute()->count();
  }

  public function getUserActivity($activity_id)
  {
    $q = Doctrine_Query::create()
			->from('UserActivity a')
			->where('a.user_id = ?', $this->getId())
			->andWhere('a.activity_id = ?', $activity_id)
	        ->andWhere('a.quit_time IS NULL');

    return $q->fetchOne();
  }

  public function quitActivity($activity_id)
  {
    $user_activity = Doctrine_Query::create()
			->from('UserActivity a')
		    ->where('a.user_id = ?', $this->getId())
			->andWhere('a.activity_id = ?', $activity_id)
		    ->andWhere('a.quit_time IS NULL')->fetchOne();
	
	if($user_activity)
	{
	  $user_activity->setQuitTime(date('Y-m-d H:i:s', time()));
      $user_activity->save();
	  
	  return true;
	}

	return false;
  }
	
  public function getSnsname()
  {
	$q = Doctrine_Query::create()
 		->select('u.name')
 		->from('Token u')
 		->where('u.user_id = ?', $this->getId());
	return $q->fetchOne();
  }

}