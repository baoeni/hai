<?php

class myMail
{
	/**
	   * Sends a message.
	   *
	   * @param string|array $from    The from address
	   * @param string|array $to      The recipient(s)
	   * @param string       $subject The subject
	   * @param string       $body    The body
	   *
	   * @return int The number of sent emails
	   */
	  public static function send($to, $subject, $body)
	  {
		$from = sfConfig::get('app_sf_guard_plugin_default_from_email', 'info@haimee.com');
		$subject = '海米活动-'.$subject;
	    $mailer =  sfContext::getInstance()->getMailer();
		$message = Swift_Message::newInstance()
          ->setFrom($from)
          ->setTo($to)
          ->setSubject($subject)
          ->setBody($body)
          ->setContentType('text/html')
        ;


        $mailer->send($message);
	  }

}