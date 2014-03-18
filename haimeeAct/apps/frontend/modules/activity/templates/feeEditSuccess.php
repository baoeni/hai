<?php slot('title') ?>
  Create an Activity - Step 2 - Fee
<?php end_slot() ?>


<div class="fee-edit wufoo">
	<div class="info">
    <h2>
      Edit Fees
    </h2>
    <p>
      fill in the content below to set up fees for your activity!
    </p>
  </div>
	
  <?php include_partial('activity/activity_info', array('activity' => $form->getObject(), 'activity_organizer' => $activity_organizer, 'mode' => 'view')) ?>
  <?php include_partial('activity/activity_fees_form', array('form' => $form, 'mode' => 'edit')) ?>

</div>