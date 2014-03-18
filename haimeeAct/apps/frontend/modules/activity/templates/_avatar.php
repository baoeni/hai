<?php
  $small = isset($small) ? $small: false;
  $absolute = isset($absolute) ? $absolute: false;
  ?>
<a class="avatar <?php if ($small): ?>avatar_small<?php endif ?> <?php if ($user->getSfGuardUserProfile()->getSex()): ?>
	avatar_female
<?php endif ?>" title="<?php echo $user->getUsername()?>" href="<?php echo url_for('user_profile_show', $user, true) ?>" <?php if ($absolute): ?>
	style="text-decoration:none;"
<?php endif ?>>
  <img alt="Picture of <?php echo $user->getUsername()?>" src="<?php if ($absolute): ?><?php echo url_for('@homepage', true) ?><?php endif ?>/uploads/avatar/<?php $avatar = $user->getSfGuardUserProfile()->getSmallAvatar(); echo $avatar ? $avatar : 'avatar.png' ?>" <?php if ($absolute): ?>
	width="48" height="48"
<?php endif ?>>
</a>