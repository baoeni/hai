<?php

/**
 * activity actions.
 *
 * @package    haimeeAct
 * @subpackage activity
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class activityActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
	$this->activities = array();
    $activities = Doctrine_Core::getTable('Activity')->getFutureActivityList();
	//reorder
	foreach($activities as $activity)
	{
		$activity_info = array();
	      $activity_info['activity'] = $activity;
		  $activity_info['organizer'] = $activity->getUser();
		  $activity_info['attenders'] = $activity->getAttenders(sfConfig::get('app_max_attenders_on_activity'));
		  $activity_info['comments'] = $activity->getCommentsWithLimit(4);
		  $activity_info['commentsLength'] = $activity->getCommentsLength();
	      $this->activities[] = $activity_info;
	}	


	$activities = Doctrine_Core::getTable('Activity')->getComingSoonActivityList();
    foreach($activities as $activity)
	{
	  $activity_info = array();
      $activity_info['activity'] = $activity;
	  $activity_info['organizer'] = $activity->getUser();
	  $activity_info['attenders'] = $activity->getAttenders(sfConfig::get('app_max_attenders_on_activity'));
	  $activity_info['comments'] = $activity->getCommentsWithLimit(4);
	  $activity_info['commentsLength'] = $activity->getCommentsLength();
      $this->activities[] = $activity_info;
	}	

	$activities = Doctrine_Core::getTable('Activity')->getOldActivityList();
    foreach($activities as $activity)
	{
	  $activity_info = array();
      $activity_info['activity'] = $activity;
	  $activity_info['organizer'] = $activity->getUser();
	  $activity_info['attenders'] = $activity->getAttenders(sfConfig::get('app_max_attenders_on_activity'));
	  $activity_info['comments'] = $activity->getCommentsWithLimit(4);
	  $activity_info['commentsLength'] = $activity->getCommentsLength();
      $this->activities[] = $activity_info;
	}	

  }

  public function executeOlderAct(sfWebRequest $request)
  {
	$this->activities = array();
    $activities = Doctrine_Core::getTable('Activity')->getOlderActivityList();
	//reorder
	foreach($activities as $activity)
	{
		$activity_info = array();
	      $activity_info['activity'] = $activity;
		  $activity_info['organizer'] = $activity->getUser();
		  $activity_info['attenders'] = $activity->getAttenders(sfConfig::get('app_max_attenders_on_activity'));
		  $activity_info['comments'] = $activity->getCommentsWithLimit(4);
		  $activity_info['commentsLength'] = $activity->getCommentsLength();
	      $this->activities[] = $activity_info;
	}	

  }

  public function executeShow(sfWebRequest $request)
  {

    //$this->activity = Doctrine_Core::getTable('Activity')->find(array($request->getParameter('id')));
	$this->activity = $this->getRoute()->getObject();
	if(!$this->activity){
		$this->redirect('@homepage');
	}
	$this->activity_organizer = $this->activity->getUser();
	$this->activity_attenders = $this->activity->getAttenders(sfConfig::get('app_max_attenders_on_activity'));
	$this->activity_comments = $this->activity->getComments();
	
	$this->commentForm = new CommentForm();
	
	$this->relatedActivityList = Doctrine_Core::getTable('Activity')->getRelatedActivityList($this->activity->getId());
  }

  public function executeAttenders(sfWebRequest $request)
  {
	$this->activity = $this->getRoute()->getObject();
	if(!$this->activity){
		$this->redirect('@homepage');
	}
	$this->activity_organizer = $this->activity->getUser();
	$this->activity_attenders = $this->activity->getAttenders();
  }

  public function executeAdmin(sfWebRequest $request)
  {

    $this->activity = $this->getRoute()->getObject();

	if(!$this->getUser()->isOrganizedActivity($this->activity->getId())){
		$this->redirect('activity_show', $this->activity);
	}
	
	$this->activity_organizer = $this->activity->getUser();
	$this->activity_attenders = $this->activity->getAttenders();
    
	$this->activity_amount = 0;
	foreach($this->activity_attenders as $attender)
	{
      $this->activity_sum_amount +=  $attender->getUserActivity($this->activity->getId())->getAmount();
	}

    $this->activity_fees = array();
	$this->activity_fees['mandatory_fees'] = $this->activity->getMandatoryFees();
    $this->activity_fees['optional_fees'] = $this->activity->getOptionalFees();
    $this->activity_fees['group_fees'] = $this->activity->getGroupFees();
  }


  ///////////////////////////////////////////////////////
  //Order
  ///////////////////////////////////////////////////////
  public function executeOrderShow(sfWebRequest $request)
  {
	$this->activity = $this->getRoute()->getObject();
	$this->activity_organizer = $this->activity->getUser();

    $sf_guard_user = $this->getUser()->getGuardUser();
	
	$is_attender = $sf_guard_user->isAttendedActivity($this->activity->getId());
	if(!$is_attender)
	{
	  $this->redirect('activity_show', $this->activity);
	}else{
      $user_activity = $sf_guard_user->getUserActivity($this->activity->getId());
	  $this->activity_fees = array();
	  $this->activity_fees['mandatory_fees'] = $user_activity->getOrderMandatoryFees();
      $this->activity_fees['optional_fees'] = $user_activity->getOrderOptionalFees();
      $this->activity_fees['group_fees'] = $user_activity->getOrderGroupFees();
	  $this->user = array();
	  $this->user['first_name'] = $user_activity->getUserFirstName();
	  $this->user['last_name'] = $user_activity->getUserLastName();
      $this->user['email_address'] = $user_activity->getUserEmailAddress();
      $this->user['phone'] = $user_activity->getUserPhone();
	  $this->amount =  $user_activity->getAmount();
	  $this->pay_type =  $user_activity->getPaymentType();	
    }
  }

  public function executeOrderEdit(sfWebRequest $request)
  {
	$this->activity = $this->getRoute()->getObject();
	$this->activity_organizer = $this->activity->getUser();

	if($this->activity->getStatus() == 'expired'){
		$this->getUser()->setFlash('notice', sprintf('this activity has been expired!'));
		$this->redirect('activity_show', $this->activity);
	}
	
    $sf_guard_user = $this->getUser()->getGuardUser();
	
	$is_attender = $sf_guard_user->isAttendedActivity($this->activity->getId());
	if(!$is_attender)
	{
	  $this->redirect('activity_show', $this->activity);
	}else{
      $user_activity = $sf_guard_user->getUserActivity($this->activity->getId());
	  $this->form = new UserActivityForm($user_activity);
	}
  }

  public function executeOrderUpdate(sfWebRequest $request)
  {
	$this->activity = $this->getRoute()->getObject();
    $this->activity_organizer = $this->activity->getUser();

	$sf_guard_user = $this->getUser()->getGuardUser();
	
	$is_attender = $sf_guard_user->isAttendedActivity($this->activity->getId());
	if(!$is_attender)
	{
	  $this->redirect('activity_show', $this->activity);
	}else{

      $user_activity = new UserActivity();
      $user_activity->setUser($sf_guard_user);
      $user_activity->setActivity($this->activity);
	  $user_activity->setType(0); //#(1:organizer, 0:attender) 
	  $this->form = new UserActivityForm($user_activity);

      //..
	  $sf_guard_user->quitActivity($this->activity->getId());
	  $this->processJoinActivityForm($request, $this->form);
	}

	$this->setTemplate('attend');
  }


  ////////////////////////////////////////////////
  //Activity
  ////////////////////////////////////////////////

  public function executeNew(sfWebRequest $request)
  {
	$activity = new Activity();
    $activity->setUser($this->getUser()->getGuardUser());
    $this->form = new ActivityForm($activity);
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));
	$activity = new Activity();
    $activity->setUser($this->getUser()->getGuardUser());
    $this->form = new ActivityForm($activity);
    $this->processForm($request, $this->form);
    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($activity = $this->getRoute()->getObject(), sprintf('Object activity does not exist.'));

	if(!$this->getUser()->isOrganizedActivity($activity->getId())){
		$this->redirect('activity_show', $activity);
	}
	
    $this->form = new ActivityForm($activity);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($activity = $this->getRoute()->getObject(), sprintf('Object activity does not exist.'));

    $this->form = new ActivityForm($activity);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    //$request->checkCSRFProtection();

    $this->forward404Unless($activity = $this->getRoute()->getObject(), sprintf('Object activity does not exist.'));
    

	if(!$this->getUser()->isOrganizedActivity($activity->getId())){
		$this->redirect('activity_show', $activity);
	}else{
		$activity->delete();
	    $this->redirect('@homepage');
	}	

  }
  
  /////////////////////////////////////////////////////////////////
  //Join or Quit Activity
  /////////////////////////////////////////////////////////////////
  public function executeAttend(sfWebRequest $request)
  {
	$this->activity = $this->getRoute()->getObject();
	
	if($this->activity->getStatus() == 'expired'){
		$this->getUser()->setFlash('notice', sprintf('this activity has been expired!'));
		$this->redirect('activity_show', $this->activity);
	}
	if($this->activity->getMaxAttenders() && ($this->activity->getRemainAttendersNum() == 0)){
		$this->getUser()->setFlash('notice', sprintf('you are too late! this activity has been fully booked!'));
		$this->redirect('activity_show', $this->activity);
	}
	$this->activity_organizer = $this->activity->getUser();

    $sf_guard_user = $this->getUser()->getGuardUser();
	
	$is_attender = $sf_guard_user->isAttendedActivity($this->activity->getId());
	if($is_attender)
	{
	  $this->getUser()->setFlash('notice', sprintf('You have already joined this activity before!'));
	  $this->redirect('activity_show', $this->activity);
	}else{
      $user_activity = new UserActivity();
      $user_activity->setUser($this->getUser()->getGuardUser());
      $user_activity->setActivity($this->activity);
	  $user_activity->setType(0); //#(1:organizer, 0:attender)  !! ....change into..
	  $this->form = new UserActivityForm($user_activity);
	}
  }

  public function executeJoin(sfWebRequest $request)
  {
	$this->activity = $this->getRoute()->getObject();
	
	if($this->activity->getStatus() == 'expired'){
		$this->getUser()->setFlash('notice', sprintf('this activity has been expired!'));
		$this->redirect('activity_show', $this->activity);
	}
	
    $this->activity_organizer = $this->activity->getUser();

	$sf_guard_user = $this->getUser()->getGuardUser();
	
	$is_attender = $sf_guard_user->isAttendedActivity($this->activity->getId());
	if($is_attender)
	{
	  $this->getUser()->setFlash('notice', sprintf('You have already joined this activity before!'));
	  $this->redirect('activity_show', $this->activity);
	}else{
      $user_activity = new UserActivity();
      $user_activity->setUser($sf_guard_user);
      $user_activity->setActivity($this->activity);
	  $user_activity->setType(0); //#(1:organizer, 0:attender) 
	  $this->form = new UserActivityForm($user_activity);

	  $this->processJoinActivityForm($request, $this->form);
	}

	//return sfView::NONE;
	$this->setTemplate('attend');
  }

  public function executeQuit(sfWebRequest $request)
  {
    //$request->checkCSRFProtection();

    $this->forward404Unless($activity = $this->getRoute()->getObject(), sprintf('Activity does not exist.'));

	if($activity->getStatus() == 'expired'){
		$this->getUser()->setFlash('notice', sprintf('you can not quit a expired activity!'));
		$this->redirect('activity_show', $activity);
	}
	
	$sf_guard_user = $this->getUser()->getGuardUser();

    if($sf_guard_user->quitActivity($activity->getId()))
	{
      $this->getUser()->setFlash('notice', sprintf('You have quit this activity!'));
	}else{
      $this->getUser()->setFlash('error', sprintf('Error occurs when you quit this activity!'));
	}

    $this->redirect('activity_show', $activity);
  }


  /////////////////////////////////////////////////////////////////
  //Add Actions for Fee
  /////////////////////////////////////////////////////////////////
  public function executeAddMandatoryFeeForm(sfWebRequest $request)
  {
	$this->forward404unless($request->isXmlHttpRequest());

    if($activity = Doctrine_Core::getTable('Activity')->find(array($request->getParameter('id')))){
      
		if(!$this->getUser()->isOrganizedActivity($activity->getId())){
			return '';
		}

	  $form = new ActivityFeesForm($activity);
	  $number = intval($request->getParameter("num"));

	  $key = 'mandatory_fee_'.$number;
      $form->addMandatoryFeeForm($key);
      
	  return $this->renderPartial('fee_form', array('field' => $form['activity_fees']['mandatory_fees'][$key], 'key' => $key, 'fnum' => $number));
	}
  }
  
  public function executeAddOptionalFeeForm(sfWebRequest $request)
  {
	$this->forward404unless($request->isXmlHttpRequest());

    if($activity = Doctrine_Core::getTable('Activity')->find(array($request->getParameter('id')))){
     
		if(!$this->getUser()->isOrganizedActivity($activity->getId())){
			return '';
		}
		
	  $form = new ActivityFeesForm($activity);
	  $number = intval($request->getParameter("num"));
    
	  $key = 'optional_fee_'.$number;
      $form->addOptionalFeeForm($key);
      
	  return $this->renderPartial('fee_form', array('field' => $form['activity_fees']['optional_fees'][$key], 'key' => $key, 'fnum' => $number));
	}
  }

  public function executeAddGroupFeeForm(sfWebRequest $request)
  {
	$this->forward404unless($request->isXmlHttpRequest());

    if($activity = Doctrine_Core::getTable('Activity')->find(array($request->getParameter('id')))){
     
		if(!$this->getUser()->isOrganizedActivity($activity->getId())){
			return '';
		}
		
	  $form = new ActivityFeesForm($activity);
	  $number = intval($request->getParameter("num"));
      
	  $key = 'group_fee_'.$number;
      $form->addGroupFeeForm($key);
	  $fees = $form['activity_fees']['group_fees'][$key];
	  
	  return $this->renderPartial('fees_form', array('fees' => $fees, 'fee_type' => 'group_fee', 'gnum' => $number, 'title' => 'group fee'));
	}
  }

  public function executeAddGroupFeeItemForm(sfWebRequest $request)
  {
	$this->forward404unless($request->isXmlHttpRequest());

    if($activity = Doctrine_Core::getTable('Activity')->find(array($request->getParameter('id')))){
      
		if(!$this->getUser()->isOrganizedActivity($activity->getId())){
			return '';
		}
		
	  $form = new ActivityFeesForm($activity);
	  $gid = intval($request->getParameter("gid"));
	  $gnumber = intval($request->getParameter("gnum"));
      $number = intval($request->getParameter("num"));
	  
	  $gkey = 'group_fee_'.$gnumber;
      $key = $gkey.'_item_'.$number;

	  if($fee_group = Doctrine_Core::getTable('FeeGroup')->find(array('id' => $gid)))
	  {
        $fee_group_form = new FeeGroupForm($fee_group);
	  }else{
		$fee_group = new FeeGroup();
        $fee_group->Activity = $form->getObject();
		$fee_group_form = new FeeGroupForm($fee_group);
	  }

	  //$fee_group_form->setActivity($form->getObject());
	  $form->addGroupFeeItemForm($gkey, $key, $fee_group_form);
      
	  return $this->renderPartial('fee_form', array('field' => $form['activity_fees']['group_fees'][$gkey]['fees'][$key], 'key' => $key, 'fnum' => $number));
    }
  }
  
  /////////////////////////////////////////////////////////////////
  //Delete Actions for Fee
  /////////////////////////////////////////////////////////////////
  public function executeDeleteMandatoryFeeForm(sfWebRequest $request)
  {
	$this->forward404unless($request->isXmlHttpRequest());

    if($activity = Doctrine_Core::getTable('Activity')->find(array($request->getParameter('id')))){
      
		if(!$this->getUser()->isOrganizedActivity($activity->getId())){
			return '';
		}
		
	  $form = new ActivityFeesForm($activity);
	  $number = intval($request->getParameter("num"));

	  $key = 'mandatory_fee_'.$number;

	  return $this->renderText($form->deleteMandatoryFeeForm($key));
	}

  }

  public function executeDeleteOptionalFeeForm(sfWebRequest $request)
  {
	$this->forward404unless($request->isXmlHttpRequest());

    if($activity = Doctrine_Core::getTable('Activity')->find(array($request->getParameter('id')))){
      
		if(!$this->getUser()->isOrganizedActivity($activity->getId())){
			return '';
		}
		
	  $form = new ActivityFeesForm($activity);
	  $number = intval($request->getParameter("num"));

	  $key = 'optional_fee_'.$number;
      $msg = $form->deleteOptionalFeeForm($key);

	  return $this->renderText($msg);
	}
  }


  /////////////////////////////////////////////////////////////////
  //Actions for Activity Fees
  /////////////////////////////////////////////////////////////////
  public function executeFeeShow(sfWebRequest $request)
  {
    $this->activity = $this->getRoute()->getObject();
    $this->activity_organizer = $this->activity->getUser();

	$this->activity_fees = array();
	$this->activity_fees['mandatory_fees'] = $this->activity->getMandatoryFees();
    $this->activity_fees['optional_fees'] = $this->activity->getOptionalFees();
    $this->activity_fees['group_fees'] = $this->activity->getGroupFees();
  }
  
  //create
  public function executeFeeNew(sfWebRequest $request)
  {
    $activity = $this->getRoute()->getObject();
	if($activity->hasFeeCreated())
	{
      $this->redirect('activity_fee_edit', $activity);
	}

	$this->activity_organizer = $activity->getUser();
	$this->form = new ActivityFeesForm($activity);
  }

  public function executeFeeCreate(sfWebRequest $request)
  {
	if ($request->isMethod('post'))
	{
	  //$activity = Doctrine_Core::getTable('Activity')->find(array($request->getParameter('id')));
	  $activity = $this->getRoute()->getObject();
      $this->form = new ActivityFeesForm($activity);

      $this->processFeesForm($request, $this->form);
      
	  $this->activity_organizer = $activity->getUser();
	  $this->setTemplate('feeNew');
	}
  }

  //update
  public function executeFeeEdit(sfWebRequest $request)
  {
    $activity = $this->getRoute()->getObject();
	
	if(!$this->getUser()->isOrganizedActivity($activity->getId())){
		$this->redirect('activity_show', $activity);
	}

    if(!$activity->hasFeeCreated())
	{
      $this->redirect('activity_fee_new', $activity);
	}
	
	$this->activity_organizer = $activity->getUser();
	$this->form = new ActivityFeesForm($activity);
  }

  public function executeFeeUpdate(sfWebRequest $request)
  {
	if ($request->isMethod('put'))
	{
	  //$activity = Doctrine_Core::getTable('Activity')->find(array($request->getParameter('id')));
	  $activity = $this->getRoute()->getObject();
      $this->form = new ActivityFeesForm($activity);

      $this->processFeesForm($request, $this->form);
      
	  $this->activity_organizer = $activity->getUser();
	  $this->setTemplate('feeEdit');
	}
  }


	public function executeAddComment(sfWebRequest $request){
		if($request->isXmlHttpRequest()){
			if($activity = Doctrine_Core::getTable('Activity')->find(array($request->getParameter('act_id')))){


				$content = $request->getParameter('content');
				if(strlen($content) > 0){
					$newComment = new Comment();
					$newComment->setUserId($this->getUser()->getGuardUser()->getId());
					$newComment->setActivityId($activity->getId());
					$newComment->setContent($content);
					$newComment->setTime(date('c',time()));
					$newComment->save();

					return $this->renderPartial('comment_ajax', array('comment' => $newComment));
				}	
			}
		    
		}else{

			if($activity = Doctrine_Core::getTable('Activity')->find(array($request->getParameter('act_id')))){
			
				$content = $request->getPostParameter('comment[content]');

				if(strlen($content) > 0){
					$newComment = new Comment();
					$newComment->setUserId($this->getUser()->getGuardUser()->getId());
					$newComment->setActivityId($activity->getId());
					$newComment->setTime(date('c',time()));
					$form = new CommentForm($newComment);
					$form->bind($request->getParameter($form->getName()),
						$request->getFiles($form->getName()));

				    if ($form->isValid())
				    {
				        $form->save();
						
						//set thumbnail
						$image = $newComment->getImage();
						$thumbnailname = $image;
						if($image){
							$myThumbnail = new myThumbnail();
							$thumbnailname = $myThumbnail->createThumb(sfConfig::get('sf_upload_dir').'/comments/'.$image);

						}
						
						
						$send_email = $request->getPostParameter('send_email');

						if(strlen($send_email) > 0){

							$time = time();
							$mymail = new myMail();
							//for ($i=0; $i < 10; $i++) { 
							$attenders = $activity->getAttenders();
							foreach($attenders as $attender) {
								if(strlen($attender->getEmailAddress()) > 0){
									$email = $attender->getEmailAddress();
									$mymail->send(
										$email,
										'Notice from activity:'.$activity->getName(),
										$this->getPartial('activity/send_email_share_comment', array('activity' => $activity,'user' => $attender, 'comment' => $content,'image' => $newComment->getSmallImage()))
										);
								}
								
							}
							
							//send an extra one to backup
							$mymail->send(
								$from = sfConfig::get('app_sendtome_email', 'sendtome@haimee.com'),
								'Notice from activity:'.$activity->getName(),
								$this->getPartial('activity/send_email_share_comment', array('activity' => $activity,'user' => $this->getUser()->getGuardUser(), 'comment' => $content,'image' => $newComment->getSmallImage()))
								);
							//}
							
							$this->logMessage('AAAAA', 'debug');
							$this->logMessage(time() - $time, 'debug');
							$this->getUser()->setFlash('notice', sprintf('the comment has been sent to attenders email addresses!'));
						}
				    }
				
					
				}
			}
			 $this->redirect('activity_show', $activity);
			//return sfView::NONE;
		}

	}
	
	public function executeRemoveComment(sfWebRequest $request){
		$this->forward404unless($request->isXmlHttpRequest());
		
	    if($comment = Doctrine_Core::getTable('Comment')->find(array($request->getParameter('id')))){
		
			if(!$this->getUser()->isOrganizedActivity($comment->getActivityId())){
				return $this->renderText('error! you do not have permission to do this');
			}
			
			$comment->delete();
			
			return sfView::NONE;
		}
	}
	
	public function executeShowBankAccount(sfWebRequest $request){
		$this->activity = $this->getRoute()->getObject();

		$sf_guard_user = $this->getUser()->getGuardUser();

		$is_attender = $sf_guard_user->isAttendedActivity($this->activity->getId());
		if($is_attender){

		  $this->activity_organizer = $this->activity->getUser();
			
		  $this->user_activity = $user_activity = $sf_guard_user->getUserActivity($this->activity->getId());
		  $this->activity_fees = array();
		  $this->activity_fees['mandatory_fees'] = $user_activity->getOrderMandatoryFees();
	      $this->activity_fees['optional_fees'] = $user_activity->getOrderOptionalFees();
	      $this->activity_fees['group_fees'] = $user_activity->getOrderGroupFees();
		
		}else{
			$this->redirect('activity_show', $this->activity);
		}

	}
	
	public function executeSendCommentEmailTest(sfWebRequest $request)
  	{
		$this->activity = $this->getRoute()->getObject();
		$this->user = $this->getUser()->getGuardUser();
		$this->content = 'test';
		
	}
	
	public function executeSendJoinEmailTest(sfWebRequest $request)
  	{
		$this->activity = $this->getRoute()->getObject();
		$this->user = $this->getUser()->getGuardUser();
		$user_activity = $this->user->getUserActivity($this->activity->getId());
		
		$this->activity_fees = array();
	  $this->activity_fees['mandatory_fees'] = $user_activity->getOrderMandatoryFees();
      $this->activity_fees['optional_fees'] = $user_activity->getOrderOptionalFees();
      $this->activity_fees['group_fees'] = $user_activity->getOrderGroupFees();
	  $this->amount =  $user_activity->getAmount();
	  $this->pay_type =  $user_activity->getPaymentType();
	  $this->totalPayAmount = $user_activity->getOrderFeesTotal();	 
		
	}
	
	public function executeSendRating(sfWebRequest $request)
	  {
		$this->activity = $this->getRoute()->getObject();
		$this->user = $this->getUser()->getGuardUser();
		
		$flashNotice = '';
		if($this->activity->getStatus() == "expired" && $this->getUser()->isAuthenticated() && 	$this->getUser()->getGuardUser()->isAttendedActivity($this->activity->getId())){
			$number = intval($request->getParameter("num"));
			if($number && $number > 0 && $number <= 5){
				$user_activity = $this->getUser()->getGuardUser()->getUserActivity($this->activity->getId());
				if(!$user_activity->getRating()){

					$user_activity->setRating($number);
					$user_activity->save();

					$flashNotice = 'Thanks for your rating';
					
				}else{
					$flashNotice = 'You have already set the rating for this activity';
				}
			}else{
				$flashNotice = 'There is something wrong with rating, try again later';
			}
		}else{
			$flashNotice = 'set rating error';
		}
		
		if($request->isXmlHttpRequest()){
			return $this->renderText('success');
		}else{
			$this->getUser()->setFlash('notice', sprintf($flashNotice));
			
			$this->redirect('activity_show', $this->activity);
		}
		 
	  }
	
	public function executeSendRatingEmailTest(sfWebRequest $request)
  	{
		$this->activity = $this->getRoute()->getObject();
		$this->user = $this->getUser()->getGuardUser();
		$this->content = 'this activity just ended, are you happy?';

	}
	
	public function executeSendActivitySummary(sfWebRequest $request)
	{
		$this->activity = $this->getRoute()->getObject();
		$this->activity_organizer = $this->activity->getUser();
		
	}
	
	public function executeSendActivitySummaryDoSend(sfWebRequest $request)
	{
		$this->activity = $this->getRoute()->getObject();
		$this->activity_organizer = $this->activity->getUser();
		
		if($this->activity->getStatus() == "expired" ){
			
			if ($request->isMethod('post')){
			
				$content = $request->getParameter('content');

				if(strlen($content) > 0){
					
					$time = time();
					$mymail = new myMail();
					//for ($i=0; $i < 10; $i++) { 
					$attenders = $this->activity->getAttenders();
					foreach($attenders as $attender) {
						if(strlen($attender->getEmailAddress()) > 0){
							$email = $attender->getEmailAddress();
							$mymail->send(
								$email,
								'Summary of activity:'.$this->activity->getName(),
								$this->getPartial('activity/send_email_rating', array('activity' => $this->activity,'user' => $attender, 'comment' => $content))
								);
						}
					
					}
				
					//send an extra one to backup
					$mymail->send(
						$from = sfConfig::get('app_sendtome_email', 'sendtome@haimee.com'),
						'Notice from activity:'.$this->activity->getName(),
						$this->getPartial('activity/send_email_rating', array('activity' => $this->activity,'user' => $this->getUser()->getGuardUser(), 'comment' => $content))
						);
					//}
				
					$this->logMessage('---summary---', 'debug');
					$this->logMessage(time() - $time, 'debug');
					$this->getUser()->setFlash('notice', sprintf('Summary emails has been send to attenders'));
				}
			}
		}
		$this->redirect('send_activity_summary', $this->activity);
	}
  
	public function executeQuitAttender(sfWebRequest $request){
		//$this->forward404unless($request->isXmlHttpRequest());
		
		$activity = $this->getRoute()->getObject();
		if(!$this->getUser()->isOrganizedActivity($activity->getId())){
			return sfView::NONE;
		}
		$sf_guard_user = Doctrine_Core::getTable('sfGuardUser')->find(array($request->getParameter('userid')));
	    
		if($sf_guard_user){
		
			if($sf_guard_user->quitActivity($activity->getId())){
				
			}else{
				
			}
		}
		return sfView::NONE;
	}
	
	public function executeUpdateNote(sfWebRequest $request){
		//$this->forward404unless($request->isXmlHttpRequest());
		
		$activity = $this->getRoute()->getObject();
		if(!$this->getUser()->isOrganizedActivity($activity->getId())){
			return sfView::NONE;
		}
		$user_activity = Doctrine_Core::getTable('userActivity')->find(array($request->getParameter('useractid')));
	    
		if($user_activity){
		
			if($user_activity->setNote($request->getParameter('content'))){
				$user_activity->save();
			}else{
				
			}
		}
		return sfView::NONE;
	}
	
	public function executeUpdatePaid(sfWebRequest $request){
		//$this->forward404unless($request->isXmlHttpRequest());
		
		$activity = $this->getRoute()->getObject();
		if(!$this->getUser()->isOrganizedActivity($activity->getId())){
			return sfView::NONE;
		}
		$user_activity = Doctrine_Core::getTable('userActivity')->find(array($request->getParameter('useractid')));
	    
		if($user_activity){
			$isTrue = $request->getParameter('isTrue') == '1' ;
			if($user_activity->setPaid($isTrue)){
				$user_activity->save();
			}else{
				
			}
		}
		return sfView::NONE;
	}
	
  ///////////////////////////////////////////////////////////////////
  // form processes
  ///////////////////////////////////////////////////////////////////
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()),
		$request->getFiles($form->getName()));

    if ($form->isValid())
    {
	  /* if using user session
	  if(!$form->getObject()->isNew())
	  {
		$activity = $form->getObject();
      }   	
	  else
	  {
		$activity = new Activity();
		$activity->setName($form->getValue('name'));
		$activity->setLocation($form->getValue('location'));
		$activity->setSubjectId($form->getValue('subject_id'));
		$activity->setTimeFrom($form->getValue('time_from'));
		$activity->setTimeTill($form->getValue('time_till'));
		$activity->setDescription($form->getValue('description'));
		$activity->setPoster($form->getValue('poster'));
	  }

	  $this->getUser()->addActivityInfo($activity);
      $this->redirect('fee_new');
	  */

      $activity = $form->save();

	  //set thumbnail
	  $image = $activity->getPoster();
	  $thumbnailname = $image;
		if($image){
			$myThumbnail = new myThumbnail();
			$thumbnailname = $myThumbnail->createThumb(sfConfig::get('sf_upload_dir').'/activities/'.$image);

		}

	  if ($request->isMethod('post'))
	  {
	    $this->redirect('activity_fee_new', $activity);

	  }else{

		$this->redirect('activity_fee_edit', $activity);
	  }
    }
  }

  protected function processFeesForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()),
		$request->getFiles($form->getName()));

    if ($form->isValid())
    {
      $form->save();
	  $form->deleteHard();
	  $this->redirect('activity_fee_show', $form->getObject());
    }
  }

  protected function processJoinActivityForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()),
		$request->getFiles($form->getName()));

    if ($form->isValid())
    {
      $form->save();

		$user_activity = $this->getUser()->getGuardUser()->getUserActivity($form->getObject()->getActivity()->getId());

		//update profile
		$this->getUser()->getGuardUser()->setEmailAddress($user_activity->getUserEmailAddress());
		$this->getUser()->getGuardUser()->setFirstName($user_activity->getUserFirstName());
		$this->getUser()->getGuardUser()->setLastName($user_activity->getUserLastName());
		$this->getUser()->getGuardUser()->save();
	    $this->getUser()->getGuardUser()->getSfGuardUserProfile()->setPhone($user_activity->getUserPhone());
	    $this->getUser()->getGuardUser()->getSfGuardUserProfile()->setLocation($user_activity->getLocation());	
		$this->getUser()->getGuardUser()->getSfGuardUserProfile()->save();
	
	if(strlen($this->getUser()->getGuardUser()->getEmailAddress()) > 0){
		  $activity_fees = array();
		  $activity_fees['mandatory_fees'] = $user_activity->getOrderMandatoryFees();
	      $activity_fees['optional_fees'] = $user_activity->getOrderOptionalFees();
	      $activity_fees['group_fees'] = $user_activity->getOrderGroupFees();
		  $amount =  $user_activity->getAmount();
		  $pay_type =  $user_activity->getPaymentType();
		  $totalPayAmount = $user_activity->getOrderFeesTotal();

		$mymail = new myMail();
		$mymail->send(
			$this->getUser()->getGuardUser()->getEmailAddress(),
			'you just joined activity:'.$form->getObject()->getActivity()->getName(),
			$this->getPartial('activity/send_email_join', array('activity' => $form->getObject()->getActivity(),'user' => $this->getUser()->getGuardUser(), 'activity_fees' => $activity_fees, 'amount' => $amount, 'pay_type' => $pay_type,'totalPayAmount' => $totalPayAmount))
			);
	      
	}
	
	  $this->getUser()->setFlash('notice', sprintf('You have successfully joined this activity, an email has been send to your email address!'));
	if($form->getObject()->getActivity()->getMinFee() > 0){
	  $this->redirect('activity_show_bank_account', $form->getObject()->getActivity());			  
	}else{
		$this->redirect('activity_show', $form->getObject()->getActivity());		
	}
		
    }
  }


}