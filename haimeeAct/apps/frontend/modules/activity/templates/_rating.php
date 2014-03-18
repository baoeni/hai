
	<?php
		if($activity->getStatus() == "expired" && $sf_user->isAuthenticated() && 	$sf_user->getGuardUser()->isAttendedActivity($activity->getId())){
		$useractivity = $sf_user->getGuardUser()->getUserActivity($activity->getId());
		if(!$useractivity->getRating()){
?>


<div class="rating-wrapper">
<a class="rating-close" title="close">x</a>
<p>Click to rate this activity!</p>
<a class="rating-star rated" href="<?php echo url_for('send_rating', $activity) ?>?num=1"></a>
<a class="rating-star rated" href="<?php echo url_for('send_rating', $activity) ?>?num=2"></a>
<a class="rating-star rated" href="<?php echo url_for('send_rating', $activity) ?>?num=3"></a>
<a class="rating-star" href="<?php echo url_for('send_rating', $activity) ?>?num=4"></a>
<a class="rating-star" href="<?php echo url_for('send_rating', $activity) ?>?num=5"></a>
<p class="rating-word">Not good</p>
<p class="rating-word">Just so so</p>
<p class="rating-word" style="display:block">I like it</p>
<p class="rating-word">It was great</p>
<p class="rating-word">I will join again!</p>
</div>
<?php			
		}
	}
	?>