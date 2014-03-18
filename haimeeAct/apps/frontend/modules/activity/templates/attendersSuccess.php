<?php slot('title') ?>
  <?php echo sprintf('activity - %s', $activity->getName()) ?>
<?php end_slot() ?>

<?php slot('bodyClass') ?>
  attenderpage
<?php end_slot() ?>



  <div class="wufoo">
      <?php include_partial('activity/activity_info', array('activity' => $activity, 'activity_organizer' => $activity_organizer, 'mode' => 'view')) ?>
	

	<div style="clear:both"></div>

	<div class="info">
	    <h2>Attenders(<?php echo $activity->getAttendersTotalNum() ?>)</h2>
	  </div>
	
	<div class="wufoo attenders">
      <div class="list all-list">
		<?php foreach($activity_attenders as $attender) : ?>
			<div class="list-item">
			<?php echo include_partial('avatar', array('user' => $attender)) ?>
			<?php $userAct = $attender->getUserActivity($activity->getId()); ?>
			<?php $rating = $userAct->getRating(); ?>
			<?php if($rating): ?>
			<?php echo include_partial('user_rating', array('rating' => $rating)) ?>
			<?php endif ?>
			</div>
		<?php endforeach; ?>
	  </div>
	  <p><a class="Button Button11 WhiteButton" href="<?php echo url_for('activity_show', $activity) ?>"><strong>Back to Activity</strong><span></span></a><p>
    </div>

  </div>