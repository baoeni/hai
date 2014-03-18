<?php slot('header1') ?>
  Did you enjoy the last activity <strong><?php echo $activity->getName() ?></strong> ?
<br/>
<img class="poster" src="<?php echo url_for('@homepage',true) ?>uploads/activities/<?php echo $activity->getSmallPoster() ?>"
       alt="<?php echo $activity->getName() ?>" width='100' />
<?php end_slot() ?>

<?php slot('header2') ?>
<table border="0" cellspacing="5" cellpadding="5">
	<tr><th colspan="5">Please rate this activity:</th></tr>
	<tr>
		<td align="middle">
			<a href="<?php echo url_for('send_rating', $activity,true) ?>?num=1" style="text-decoration:none">
				<img src="<?php echo url_for('@homepage',true) ?>images/rating_single1.gif"
				       alt="" width='50' height="60"/>
				<br/>
				Not good
			</a>
		</td>
		<td align="middle">
			<a href="<?php echo url_for('send_rating', $activity,true) ?>?num=2" style="text-decoration:none">
				<img src="<?php echo url_for('@homepage',true) ?>images/rating_single2.gif"
				       alt="" width='50' height="60"/>
				<br/>
				Just so so
			</a>
		</td>
		<td align="middle">
			<a href="<?php echo url_for('send_rating', $activity,true) ?>?num=3" style="text-decoration:none">
				<img src="<?php echo url_for('@homepage',true) ?>images/rating_single3.gif"
				       alt="" width='50' height="60"/>
				<br/>
				I like it
			</a>
		</td>
		<td align="middle">
			<a href="<?php echo url_for('send_rating', $activity,true) ?>?num=4" style="text-decoration:none">
				<img src="<?php echo url_for('@homepage',true) ?>images/rating_single4.gif"
				       alt="" width='50' height="60"/>
				<br/>
				It was great
			</a>
		</td>
		<td align="middle">
			<a href="<?php echo url_for('send_rating', $activity,true) ?>?num=5" style="text-decoration:none">
				<img src="<?php echo url_for('@homepage',true) ?>images/rating_single5.gif"
				       alt="" width='50' height="60"/>
				<br/>
				I will join again!
			</a>
		</td>
	</tr>
</table>

<?php end_slot() ?>

<?php slot('content') ?>
<?php if (strlen($comment) > 0): ?>
	
<p >
<table border="0" cellspacing="5" cellpadding="5" width="100%">
	<tr><td style="white-space:nowrap"><?php echo include_partial('avatar', array('user' => $activity->getOrganizer(),'absolute' => true)) ?> <?php echo $activity->getOrganizer()->getName() ?> said:</td>
		<td style="background-color:#F2F0F0;" width="100%">
			<?php echo $comment ?>
			<br/>
		</td>
	</tr>
</table>
</p>
<?php endif ?>
<p>
Have more comments? You can <a href="<?php echo url_for('activity_show', $activity,true) ?>">leave them  here</a>
</p>
<?php end_slot() ?>


<?php include_partial('global/send_email_template', array('user' => $user)) ?>