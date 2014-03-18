<?php

/**
 * user actions.
 *
 * @package    haimeeAct
 * @subpackage user
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class userActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->sf_guard_users = Doctrine_Core::getTable('sfGuardUser')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->sf_guard_user = Doctrine_Core::getTable('sfGuardUser')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->sf_guard_user);

  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new sfGuardUserForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new sfGuardUserForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($sf_guard_user = Doctrine_Core::getTable('sfGuardUser')->find(array($request->getParameter('id'))), sprintf('Object sf_guard_user does not exist (%s).', $request->getParameter('id')));
    $this->form = new sfGuardUserForm($sf_guard_user);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($sf_guard_user = Doctrine_Core::getTable('sfGuardUser')->find(array($request->getParameter('id'))), sprintf('Object sf_guard_user does not exist (%s).', $request->getParameter('id')));
    $this->form = new sfGuardUserForm($sf_guard_user);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($sf_guard_user = Doctrine_Core::getTable('sfGuardUser')->find(array($request->getParameter('id'))), sprintf('Object sf_guard_user does not exist (%s).', $request->getParameter('id')));
    $sf_guard_user->delete();

    $this->redirect('user/index');
  }
  
  ###  actions for user profile  ###
  public function executeProfileShow(sfWebRequest $request)
  {
    $this->user = $this->getRoute()->getObject();

	if(!($this->user_profile = $this->user->getSfGuardUserProfile()))
	{
      $this->user_profile = new sfGuardUserProfile();
      $this->user_profile->setSfGuardUser($this->user);
	}

	$this->organized_activities = $this->user->getOrganizedActivities();
	$this->attended_activities = $this->user->getAttendedActivities();
	
	
  }

  public function executeProfileEdit(sfWebRequest $request)
  {
    $sf_guard_user = $this->getUser()->getGuardUser();

	/*
	if(!($sf_guard_user_profile = $sf_guard_user->getSfGuardUserProfile()))
	{
      $sf_guard_user_profile = new sfGuardUserProfile();
      $sf_guard_user_profile->setSfGuardUser($sf_guard_user);
	}
	$this->form = new sfGuardUserProfileForm($sf_guard_user_profile);
	*/
    
	$this->form = new sfGuardUserForm($sf_guard_user);
  }
  
  public function executeProfileUpdate(sfWebRequest $request)
  {
	$this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));	
	$sf_guard_user = $this->getUser()->getGuardUser();

    /*
	if(!($sf_guard_user_profile = $sf_guard_user->getSfGuardUserProfile()))
	{
      $sf_guard_user_profile = new sfGuardUserProfile();
      $sf_guard_user_profile->setSfGuardUser($sf_guard_user);
	}

	$this->form = new sfGuardUserProfileForm($sf_guard_user_profile);
    $this->processProfileForm($request, $this->form);
    $this->setTemplate('profileEdit');
    */

    $this->form = new sfGuardUserForm($sf_guard_user);
	$this->processProfileForm($request, $this->form);
	$this->setTemplate('profileEdit');
  }
  

  ##
  public function executeActivityAttended(sfWebRequest $request)
  {
	$sf_guard_user = $this->getUser()->getGuardUser();;
	
	$this->activities = array();
    $activities = $sf_guard_user->getAttendedActivities();
    foreach($activities as $activity)
	{
	  $activity_info = array();
      $activity_info['activity'] = $activity;
	  $activity_info['organizer'] = $activity->getUser();
	  $activity_info['attenders'] = $activity->getAttenders();
	  $activity_info['comments'] = $activity->getCommentsWithLimit(4);

      $this->activities[] = $activity_info;
	}

  }

  public function executeActivityOrganized(sfWebRequest $request)
  {
	$sf_guard_user = $this->getUser()->getGuardUser();;
	
	$this->activities = array();
    $activities = $sf_guard_user->getOrganizedActivities();
    foreach($activities as $activity)
	{
	  $activity_info = array();
      $activity_info['activity'] = $activity;
	  $activity_info['organizer'] = $activity->getUser();
	  $activity_info['attenders'] = $activity->getAttenders();
	  $activity_info['comments'] = $activity->getCommentsWithLimit(4);

      $this->activities[] = $activity_info;
	}
  }

  public function executeSendUserSummaryTest(sfWebRequest $request){
	$this->user = $this->getRoute()->getObject();
	$this->organized_activities = $this->user->getOrganizedActivities();
	$this->attended_activities = $this->user->getAttendedActivities();
	$this->hot_activities = Doctrine_Core::getTable('Activity')->getHotActivityList();
  }

  ##
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $sf_guard_user = $form->save();

      $this->redirect('user/edit?id='.$sf_guard_user->getId());
    }
  }

  protected function processProfileForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $sf_guard_user = $form->save();
      
		//set thumbnail
		$image = $sf_guard_user->getSfGuardUserProfile()->getAvatar();
		$thumbnailname = $image;
		if($image){
			$myThumbnail = new myThumbnail();
			$thumbnailname = $myThumbnail->createThumb(sfConfig::get('sf_upload_dir').'/avatar/'.$image, 100,100);

		}

	  $this->getUser()->setFlash('notice', sprintf('Your profile has been saved!'));
      $this->redirect('user_profile_show',$sf_guard_user);
    }
  }
}
