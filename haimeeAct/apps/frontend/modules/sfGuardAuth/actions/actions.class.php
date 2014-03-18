<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once(dirname(__FILE__).'/../lib/BasesfGuardAuthActions.class.php');

/**
 *
 * @package    symfony
 * @subpackage plugin
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: actions.class.php 23319 2009-10-25 12:22:23Z Kris.Wallsmith $
 */
class sfGuardAuthActions extends BasesfGuardAuthActions
{
	/**
	   * Error page for page not found (404) error
	   *
	   */
	  public function executeError404()
	  {
	  }
	
	public function executeConnectFacebook(sfWebRequest $request)
	{
		
	  $this->getUser()->connect('facebook');
		return sfView::NONE;
	}

	public function executeConnectLinkedin(sfWebRequest $request)
	{
		
	  $this->getUser()->connect('linkedin');
		return sfView::NONE;
	}

	public function executeConnectWeibo(sfWebRequest $request)
	{
		
	  $this->getUser()->connect('weibo');
		return sfView::NONE;
	}
	
	public function executeFacebook(sfWebRequest $request)
	{
		
		
	  $this->me = $this->getUser()->getMelody('facebook')->getMe();
	
	$this->logMessage(serialize($this->me), 'info');
		$this->logMessage($this->me->location->name, 'info');
//	gender
//	birthday
	return sfView::NONE;
	}
}
