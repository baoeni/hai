<?php

/**
 * Activity form.
 *
 * @package    haimeeAct
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ActivityForm extends BaseActivityForm
{
  public function configure()
  {
	  $this->useFields(array('name', 'location', 'subject_id', 'time_from', 'time_till', 'description', 'poster','max_attenders'));
      
		    $this->validatorSchema['name'] = new sfValidatorString(
			  array('required' => true),
			  array('required' => 'Title is required.')
			);
	$this->widgetSchema['name'] = new sfWidgetFormInputText(array(), array('size' => '50'));
	  $this->widgetSchema['location'] = new sfWidgetFormInputText(array(), array('size' => '50'));
      
	  /*
      $this->widgetSchema['time_from'] = new sfWidgetFormJQueryDate(array(
		  'config' => '{}',
		  'image'=>'/images/calendar.png'
		  ));
      
	  $this->widgetSchema['time_till'] = new sfWidgetFormJQueryDate(array(
		  'config' => '{}',
		  'image'=>'/images/calendar.png'
		  ));
      */

	  $this->widgetSchema['time_from'] = new sfWidgetFormDatePickerTime(array(
	  	  			'date' => array(
	  	  			  'jq_picker_options' => array(
	  	  				'buttonImage' => '/images/calendar.png',
	  	  				'buttonImageOnly' => true,
	  	  				'showOn' => 'both',
	  	  			  )
	  	  			),
	  	  			'time' => array(
	  	  			  'format_without_seconds' => '%hour% hour %minute% minute',
	  	  			'empty_values' => array('hour' => 'hour', 'minute' => 'minute'),
	  	  			'can_be_empty' => true,
	  	   			'minutes' => array(0 => '00',15 => 15,30 => 30,45 => 45),
	  	  			)
	  	  		));
	  	  
	  		$this->validatorSchema['time_from'] = new sfValidatorDate( array('required' => false,'with_time' => true));
	   		//$this->setDefault('time_from', date('c', mktime(9, 0, 0, date("m")  , date("d")+1, date("Y"))));
	  		
	  	  	  $this->widgetSchema['time_till'] = new sfWidgetFormDatePickerTime(array(
	  	  			'date' => array(
	  	  			  'jq_picker_options' => array(
	  	  				'buttonImage' => '/images/calendar.png',
	  	  				'buttonImageOnly' => true,
	  	  				'showOn' => 'both',
	  	  			  )
	  	  			),
	  	  			'time' => array(
	  	  			  'format_without_seconds' => '%hour% hour %minute% minute',
	  	  			'empty_values' => array('hour' => 'hour', 'minute' => 'minute'),
	  	  			'can_be_empty' => true,
	  	   			'minutes' => array(0 => '00',15 => 15,30 => 30,45 => 45),
	  	  			)
	  	  		));
	  	  
	  	  		$this->validatorSchema['time_till'] = new sfValidatorDate( array('required' => false,'with_time' => true));
	  	  		//$this->setDefault('time_till', date('c', mktime(17, 0, 0, date("m")  , date("d")+1, date("Y"))));

	  $this->widgetSchema['description'] = new sfWidgetFormTextareaTinyMCE(array(
		  'width'  => 400,
		  'height' => 250,
		  'config' => 'theme_advanced_disable: "help"',
		  ),array(
		  'class'  => 'tinyMCE',
		  ));

	  //poster
	  $this->widgetSchema['poster'] = new sfWidgetFormInputFileEditable(array(
		  'label'     => 'Activity Poster',
		  'file_src'  => '/uploads/activities/'.$this->getObject()->getPoster(),
		  'is_image'  => true,
		  'edit_mode' => !$this->isNew(),
		  'template'  => '<div>%file%<br />%input%<br /></div>',
		),array(
		  'class'  => 'poster-field',
		  ));
	  $this->validatorSchema['poster_delete'] = new sfValidatorPass();

      $this->validatorSchema['poster'] = new sfValidatorFile(array(
		    'required'   => false,
			'path'       => sfConfig::get('sf_upload_dir').'/activities',
			'mime_types' => 'web_images',
		));

		$this->widgetSchema['max_attenders'] = new sfWidgetFormInputText(array(), array('size' => '5'));

	  $this->widgetSchema->setLabels(array(
			'name' => 'Title',
			'subject_id' => 'Category',
            'time_from' => 'Start Time',
		    'time_till' => 'End Time',
			'max_attenders' => 'Max attender Number'
			));
  }
}
