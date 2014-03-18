<?php

/**
 * Comment
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    haimeeAct
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Comment extends BaseComment
{
	public function getSmallImage(){
		$image = $this->getImage();
		if($image){
			$pathInfo = pathinfo(sfConfig::get('sf_upload_dir').'/comments/'.$image);
			$newFileName = $pathInfo['filename'].'-s.'.$pathInfo['extension'];
			$save = $pathInfo['dirname'].'/'.$newFileName;
			//sfContext::getInstance()->getLogger()->info('detect file:'. $save );
			if(file_exists($save)){
				$image = $newFileName;
			}
			
		}
		
		return  $image;
	}
}