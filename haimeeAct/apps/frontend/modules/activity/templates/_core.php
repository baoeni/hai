<table border="0" cellspacing="5" cellpadding="5" width="100%">
	<tr>
		<td width="26px;"><img  src="/images/activity/clock.png" alt="Time" title="Time"/></td>
		<td><?php echo html_entity_decode($activity->showFormTillTime()); ?></td>
	</tr>
	<tr>
		<td><img  src="/images/activity/location_pin.png" alt="Location" title="Location"/></td>
		<td><?php echo html_entity_decode($activity->getLocation()); ?></td>
	</tr>
	<tr>
		<td><img  src="/images/activity/price_tag_euro.png" alt="Cost" title="Cost"/></td>
		<td><?php echo html_entity_decode($activity->showCost()); ?></td>
	</tr>
	<tr>
		<td><img  src="/images/activity/person.png" alt="Organizer" title="Organizer"/></td>
		<td><?php echo include_partial('activity/avatar', array('user' => $activity->getOrganizer())) ?></td>
	</tr>
	<?php if ($activity->getMaxAttenders()): ?>
		<tr>
			<td><img  src="/images/activity/group.png" alt="Max attenders number" title="Max attenders number"/><br/>Max</td>
			<td><span style="font-size:24px"><?php echo $activity->getAttendersTotalNum() ?>/<?php echo $activity->getMaxAttenders() ?></span><?php $remain = $activity->getRemainAttendersNum();?><?php if ($remain*2 <= $activity->getMaxAttenders()): ?>
				<?php if ($remain == 0): ?>
					&nbsp;&nbsp;<span class="RepinsCount noteBadge red noteBadge-user"> Fully Booked! 
				<?php else: ?>
					<?php if ($activity->getStatus() != "expired"): ?>
						&nbsp;&nbsp;<span class="RepinsCount noteBadge noteBadge-user"> Get the last <?php echo $remain ?> chance! 
					<?php endif ?>
					
				<?php endif ?>
				</span>
			<?php else: ?>
				<?php if ($activity->getStatus() != "expired"): ?>
					&nbsp;&nbsp;<span class="RepinsCount noteBadge green noteBadge-user">
					<?php if ($activity->getAttendersTotalNum() < 3): ?>
						Be the top three ! 
					<?php else: ?>
						Join it now ! 
					<?php endif ?>
				<?php endif ?>
				</span>
			<?php endif ?></td>
		</tr>
	<?php endif ?>
</table>