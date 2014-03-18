<?php

/**
 * sfGuardUserProfile form.
 *
 * @package    haimeeAct
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sfGuardUserProfileForm extends BasesfGuardUserProfileForm
{
  public function configure()
  {

    $this->widgetSchema['sex'] = new sfWidgetFormChoice(array(
          'choices'  => array(0=>'male', 1=>'female'),
          'expanded' => true,
       ));
	
	$this->validatorSchema['sex'] = new sfValidatorChoice(array(
          'choices' => array_keys(array(0, 1)),
       ));

    //birth
	$years = range(1970, 2005);
    $this->widgetSchema['birthday'] = new sfWidgetFormDate(array(
		  'format' => '%year% - %month% - %day%',
		  'years' => array_combine($years, $years),
		'empty_values' => array('year' => 'year', 'month' => 'month','day' => 'day'),
	   ));

	$this->setDefault('birthday', date('c', mktime(0, 0, 0, 1  , 1, 1982)));

	//avatar
    $this->widgetSchema['avatar'] = new sfWidgetFormInputFileEditable(array(
		  'label'     => 'Avatar',
		  'file_src'  => '/uploads/avatar/'.($this->getObject()->getAvatar() ? $this->getObject()->getAvatar() : 'avatar.png'),
		  'is_image'  => true,
		  'edit_mode' => !$this->isNew(),
		  'template'  => '<div>%file%<br />%input%<br />%delete% %delete_label%</div>',
      )	,array(
		  'class'  => 'avatar-field',
		  ));

	$this->validatorSchema['avatar_delete'] = new sfValidatorPass();

    $this->validatorSchema['avatar'] = new sfValidatorFile(array(
		    'required'   => false,
			'path'       => sfConfig::get('sf_upload_dir').'/avatar',
			'mime_types' => 'web_images',

	  ));


  }

/*
  public function processValues($values)
  {
    if ($values['avatar'] instanceof sfValidatedFile) { // file was uploaded
       
	   $basename = md5($values['avatar']->getOriginalName().rand(1111, 9999));
       $values['avatar'] = $this->savePicture($basename.'.jpg', 75, 75, true);
    }
    
    return parent::processValues($values);
  }

  protected function savePicture($filename, $width, $height, $crop = false)
  {
    // process $this->values['avatar'] here
    // Content type
    header('Content-Type: image/jpeg');

    // Get new sizes
    list($origin_width, $origin_height) = getimagesize($filename);

    // Load
    $thumb = imagecreatetruecolor($width, $height);
    $source = imagecreatefromjpeg($filename);

    // Resize
    imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

    // Output
    imagejpeg($thumb);
    return $thumb;
  }
*/
}
