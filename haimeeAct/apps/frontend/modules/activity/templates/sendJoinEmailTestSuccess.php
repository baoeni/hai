<?php slot('title') ?>
 send join email test
<?php end_slot() ?> 

<div class="wufoo">
  <?php include_partial('activity/send_email_join', array('activity' => $activity,'user' => $user,'activity_fees' => $activity_fees,'amount' => $amount,'pay_type' => $pay_type, 'totalPayAmount' => $totalPayAmount )) ?>

</div>