<?php slot('title') ?>
  Activity - Fees
<?php end_slot() ?>


<div class="wufoo">
  <?php include_partial('activity/activity_info', array('activity' => $activity, 'activity_organizer' => $activity_organizer, 'mode' => 'view')) ?>

  <div class="info">
    <h2>Fees</h2>
    <p>list all fees for this activity!</p>
  </div>

  <?php include_partial('activity/activity_fees_list', array('activity' => $activity, 'activity_fees' => $activity_fees)) ?>


</div>