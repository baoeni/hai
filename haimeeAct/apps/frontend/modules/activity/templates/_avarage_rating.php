<?php $avarageRating =  $activity->getAvarageRating(); ?>	
<?php if($avarageRating > 0): ?>
	<div class="avarage-rating-star" title="user rating:<?php echo $avarageRating ?> out of 5"><?php echo $avarageRating ?></div>
<?php endif ?>