<?php

require_once dirname(__FILE__).'/../lib/sfGuardUserGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/sfGuardUserGeneratorHelper.class.php';

/**
 * sfGuardUser actions.
 *
 * @package    sfGuardPlugin
 * @subpackage sfGuardUser
 * @author     Fabien Potencier
 * @version    SVN: $Id: actions.class.php 23319 2009-10-25 12:22:23Z Kris.Wallsmith $
 */
class sfGuardUserActions extends autoSfGuardUserActions
{
	public function executeDelete(sfWebRequest $request)
	  {
	    $request->checkCSRFProtection();

	    $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));
		
		$bShowFlash = false;
		if ($user = $this->getRoute()->getObject()){
			
			$this->logMessage('DDDDDDDD', 'debug');
			
			$q = Doctrine_Query::create()
					->from('Token t')
				    ->where('t.user_id = ?', $user->getId());
			$q = $q->fetchOne();	
			
			if($q){
				$bShowFlash = $q->delete();
			}
			
			$bShowFlash = $user->delete();
			
			$this->logMessage('DDDDDDDD', 'debug');
		}
		
	    
		if($bShowFlash)
	    {
	      $this->getUser()->setFlash('notice', 'The item was deleted successfully.');
	    }

	    $this->redirect('@sf_guard_user');
	  }
	
}
