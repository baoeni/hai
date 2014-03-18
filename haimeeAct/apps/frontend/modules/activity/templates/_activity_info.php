<div class="pin pin-fullwidth <?php echo $activity->getStatus(); ?>">

  <div class="title">
    <a href="<?php echo url_for('activity_show', $activity) ?>"><?php echo $activity->getName() ?></a>
  </div>
  
  <table border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td>
        <a class="PinImage ImgLink2" href="<?php echo url_for('activity_show', $activity) ?>">
		  <img class="poster" src="/uploads/activities/<?php echo $activity->getSmallPoster() ?>"
             alt="<?php echo $activity->getName()?> poster"/>
		</a>
      </td>

      <td class="act-detail">
        <?php echo include_partial('core', array('activity' => $activity)) ?>
      </td>
    </tr>
  </table>
	
	<?php if ( $activity->getStatus() == "expired"): ?>
		<div class="expired-label">Expired</div>
	<?php endif ?>
	
  <div class="button-area">
    <?php if( $mode === "admin" ): ?>
	<?php if ($activity->getStatus() == "expired"): ?>
	<a  class="Button Button11 WhiteButton" href="<?php echo url_for('send_activity_summary', $activity) ?>"><strong>Send summary</strong><span></span></a>	
	<?php endif ?>
	<a  class="Button Button11 WhiteButton" href="<?php echo url_for('activity_edit', $activity) ?>"><strong>Edit Info</strong><span></span></a>
	<a  class="Button Button11 WhiteButton" href="<?php echo url_for('activity_fee_edit', $activity) ?>"><strong>Edit Fees</strong><span></span></a>
	<a  class="Button Button11 RedButton" href="<?php echo url_for('activity_delete', $activity) ?>" onclick="if (confirm('Are you sure to delete this activity?')) {
		$.ajax( {
	   url: '<?php echo url_for('activity_delete', $activity) ?>',
	   type: 'delete'
	}).always(function() { window.location = '<?php echo url_for('@homepage') ?>'; }); } return false;"><strong>Delete Activity</strong><span></span></a>
	<?php endif ?>
  </div>

</div>