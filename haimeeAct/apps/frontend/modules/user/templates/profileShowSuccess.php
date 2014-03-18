<div class="wufoo user_profile">
	
  <table border="0" cellspacing="5" cellpadding="5">
	<tr class="info">
	  <td width="75">
			<?php echo include_partial('activity/avatar', array('user' => $user)) ?>
      </td>
	  <td>
	    <h2><?php echo $user->getUsername()?></h2>
	  </td>
	</tr>

	<?php if (!$user_profile->isNew()): ?>

    <tr>
	  <td>Sex: </td>
	  <td>
	    <?php if($user_profile->getSex()): ?>
		Female
        <?php else: ?>
		Male
		<?php endif; ?>
	  </td>
	</tr>

	<?php if($user == $sf_user->getGuardUser()): ?>
	<tr>
	  <td>Birthday: </td>
	  <td>
        <?php echo $user_profile->getDateTimeObject('birthday')->format('m/d/Y') ?>
	  </td>
	</tr>
	<?php endif ?>
	
	<tr>
	  <td>Location: </td>
	  <td>
        <?php echo $user_profile->getLocation() ?>
	  </td>
	</tr>

	<?php endif ?>
	
	<?php if($user == $sf_user->getGuardUser()): ?>
	<tr>
	  <td>Email: </td>
	  <td>
        <?php echo $user->getEmailAddress() ?>
	  </td>
	</tr>

	<tr>	  
		<td><a class="Button Button11 WhiteButton" href="<?php echo url_for('user_profile_edit') ?>"><strong><em></em>Edit Profile</strong><span></span></a></td>
   
	</tr>
   <?php endif; ?>


  </table>
	
<br/>
<br/>
    <h3>Organized Activities:</h3>

	<div style="overflow:hidden">		
		<?php foreach($organized_activities as $organized_activity) : ?>
			<div class="user_act_item pin" >
				<a href="<?php echo url_for('activity_show', $organized_activity) ?>" style="display:block">
				<div style="font-size: 15px;font-weight: bold;"><?php echo $organized_activity->getName(); ?></div>
				<div><img height="150px" src="/uploads/activities/<?php echo $organized_activity->getSmallPoster() ?>"
		                      alt="<?php echo $organized_activity->getName() ?> poster" />
				</div>
				</a>
			</div>
       <?php endforeach; ?> 
	</div>
	
<br/>
<br/>	
	<h3>Attended Activities:</h3>

	<div style="overflow:hidden">	  
		<?php foreach($attended_activities as $attended_activity) : ?>
			<div class="user_act_item pin" >
				<a href="<?php echo url_for('activity_show', $attended_activity) ?>" style="display:block">
				<div style="font-size: 15px;font-weight: bold;"><?php echo $attended_activity->getName(); ?></div>
				<div><img height="150px" src="/uploads/activities/<?php echo $attended_activity->getSmallPoster() ?>"
		                      alt="<?php echo $attended_activity->getName() ?> poster" />
				</div>
				</a>
			</div>
	  <?php endforeach; ?>        
	</div>

</div>
