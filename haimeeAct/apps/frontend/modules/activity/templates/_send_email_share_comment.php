<?php slot('header1') ?>
  Checkout the latest notice
<?php end_slot() ?>

<?php slot('header2') ?>
from activity: <a href="<?php echo url_for('activity_show', $activity,true) ?>"><strong><?php echo $activity->getName() ?></strong>
  <img class="poster" src="<?php echo url_for('@homepage',true) ?>uploads/activities/<?php echo $activity->getSmallPoster() ?>"
       alt="<?php echo $activity->getName() ?> poster" width='100' height='100'/>
</a>
<?php end_slot() ?>

<?php slot('content') ?>
<p >
<table border="0" cellspacing="5" cellpadding="5" width="100%">
	<tr><td style="white-space:nowrap"><?php echo include_partial('avatar', array('user' => $activity->getOrganizer(),'absolute' => true)) ?> <?php echo $activity->getOrganizer()->getName() ?> said:</td>
		<td style="background-color:#F2F0F0;" width="100%">
			<?php echo $comment ?>
			<br/>
			<?php if (isset($image)): ?>
				<img src="<?php echo url_for('@homepage',true) ?>uploads/comments/<?php echo $image ?>" height="200"/>
			<?php endif ?>
		</td>
	</tr>
</table>
</p>

<p>
<a href="<?php echo url_for('activity_show', $activity,true) ?>">Leave your comments here</a>
</p>
<?php end_slot() ?>


<?php include_partial('global/send_email_template', array('user' => $user)) ?>