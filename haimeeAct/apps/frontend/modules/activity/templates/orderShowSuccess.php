<?php slot('title') ?>
  Activity - Order
<?php end_slot() ?> 

<div class="wufoo">
  <?php include_partial('activity/activity_info', array('activity' => $activity, 'activity_organizer' => $activity_organizer, 'mode' => 'view')) ?>

  <div class="info">
    <h2>Order</h2>
    <div>your order details</div>
  </div>

  <?php include_partial('activity/order_info', array('activity' => $activity, 'activity_fees' => $activity_fees, 'user' => $user, 'amount' => $amount, 'pay_type' => $pay_type)) ?>

</div>