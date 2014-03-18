<?php

/**
 * Comment form.
 *
 * @package    haimeeAct
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class CommentForm extends BaseCommentForm
{
  public function configure()
  {
	unset(
	      $this['user_id'], $this['activity_id'],
	      $this['time']
	    );
	
	//poster
	  $this->widgetSchema['image'] = new sfWidgetFormInputFileEditable(array(
		  'label'     => '',
		  'file_src'  => '/uploads/comments/'.$this->getObject()->getImage(),
		  'is_image'  => true,
		'edit_mode' => false
		));

      $this->validatorSchema['image'] = new sfValidatorFile(array(
		    'required'   => false,
			'path'       => sfConfig::get('sf_upload_dir').'/comments',
			'mime_types' => 'web_images',
		));
		
		$this->validatorSchema['content'] = new sfValidatorString(array(
			    'required'   => true,
			));
  }
}
