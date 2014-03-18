<?php slot('title') ?>
 send comment email test
<?php end_slot() ?> 

<div class="wufoo">
  <?php include_partial('activity/send_email_rating', array('activity' => $activity,'user' => $user, 'comment' => $content)) ?>

</div>