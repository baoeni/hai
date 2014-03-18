<?php slot('title') ?>
send user summary test
<?php end_slot() ?> 

<div class="wufoo">
  <?php include_partial('user/send_email_user_summary', array('user' => $user, 'organized_activities' => $organized_activities, 'attended_activities' => $attended_activities, 'hot_activities' => $hot_activities)) ?>

</div>
