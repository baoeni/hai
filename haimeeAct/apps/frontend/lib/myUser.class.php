<?php

//class myUser extends sfBasicSecurityUser
class myUser extends sfMelodyUser
{
  public function addActivityInfo(Activity $activity)
  {
    $this->setAttribute('activity_info', $activity);
  }

  public function getActivityInfo()
  {
    return $this->getAttribute('activity_info');
  }

  public function resetActivityInfo()
  {
    $this->getAttributeHolder()->remove('activity_info');
  }
	
  public function isOrganizedActivity($activity_id)
  {
    if (empty($activity_id))
    {
      return false;
    }
	

    if (!$this->getGuardUser())
    {
      return false;
    }

	if(!$this->hasCredential('activity_admin')){
		return false;
	}
	
    if ($this->getGuardUser()->getIsSuperAdmin())
    {
      return true;
    }

    return $this->getGuardUser()->isOrganizedActivity($activity_id);
  }
}