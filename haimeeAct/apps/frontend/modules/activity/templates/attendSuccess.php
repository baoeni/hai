<?php slot('title') ?>
  Activity - Attend
<?php end_slot() ?> 

<div class="wufoo">
  <?php include_partial('activity/activity_info', array('activity' => $activity, 'activity_organizer' => $activity_organizer, 'mode' => 'view')) ?>

  <?php include_partial('activity/attend_form', array('activity' => $activity, 'form' => $form)) ?>

</div>