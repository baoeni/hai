<?php slot('title') ?>
  Create an Activity - Step 2 - Fee
<?php end_slot() ?>


<div class="fee-new wufoo">
	<div class="info">
    <h2>
      Create Activity - Step2 - Set up Fees 
    </h2>
    <p>
      Set up fees for your activity, or press this button to skip it: <a  class="Button Button13 WhiteButton" href="<?php echo url_for('activity_show', $form->getObject()) ?>"><strong>skip for now</strong><span></span></a>
    </p>
  </div>

  <?php include_partial('activity/activity_info', array('activity' => $form->getObject(), 'activity_organizer' => $activity_organizer, 'mode' => 'view')) ?>
  <?php include_partial('activity/activity_fees_form', array('form' => $form, 'mode' => 'new')) ?>

</div>