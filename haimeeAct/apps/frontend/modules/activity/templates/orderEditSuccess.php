<?php slot('title') ?>
  Activity - Order
<?php end_slot() ?> 

<div class="wufoo">
  <?php include_partial('activity/activity_info', array('activity' => $activity, 'activity_organizer' => $activity_organizer, 'mode' => 'view')) ?>

  <div class="info">
    <h2>Order</h2>
    <div>list your order information!</div>
  </div>

  <?php include_partial('activity/attend_form', array('activity' => $activity, 'form' => $form)) ?>

</div>