<?php

class myThumbnail
{
	
	  public static function createThumb($image,$iWidth = NULL ,$iHeight = NULL)
	  {
			if(!file_exists($image)){
				return false;
			}
			
			 $file = $image;
			 sfContext::getInstance()->getLogger()->info('from file:'. $file );
			// Set a maximum height and width
			$width = 400;
			if($iWidth){
				$width = $iWidth;
			}
			$height = 400;
			if($iHeight){
				$width = $iHeight;
			}

			// Get new dimensions
			list($width_orig, $height_orig) = getimagesize($file);

			if(($width_orig <= $width) && ($height_orig <= $height)){
				return false;
			}
			$pathInfo = pathinfo($file);
			//sfContext::getInstance()->getLogger()->info('save file:'. print_r($pathInfo) );
			$newFileName = $pathInfo['filename'].'-s.'.$pathInfo['extension'];
			$save = $pathInfo['dirname'].'/'.$newFileName;
			sfContext::getInstance()->getLogger()->info('save file:'. $save );
			
			$ratio_orig = $width_orig/$height_orig;

			if ($width/$height > $ratio_orig) {
			   $width = $height*$ratio_orig;
			} else {
			   $height = $width/$ratio_orig;
			}

			// Resample
			$image_p = imagecreatetruecolor($width, $height);
			$image = imagecreatefromjpeg($file);
			imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

			// Output
			imagejpeg($image_p, $save, 100);
			return $newFileName;
	  }

}