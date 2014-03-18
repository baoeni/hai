<?php slot('header1') ?>
	海米活动和您一起成长
	<br/>
<?php end_slot() ?>

<?php slot('header2') ?>
	<br/>
	<div style="text-align:left;">
		亲爱的<?php echo $user->getFirstName(); ?>，
	<br/>
	<br/>
	<?php if (count($attended_activities) > 0): ?>
		2012年是海米活动(haimee.com)平台诞生的第一年，在短短的半年之内，我们已经发布了24个活动，让我们来回顾一下您都参与了那些活动吧：
	<?php else: ?>
		2012年是海米活动(haimee.com)平台诞生的第一年，在短短的半年之内，我们已经发布了24个活动，其中热点有：
	<?php endif ?>
	
	</div>
<?php end_slot() ?>

<?php slot('content') ?>
	<br/>

	<!-- 可惜你没有参加活动 -->
	
	<?php if (count($organized_activities) > 0): ?>
		<p>您组织的活动:</p>

		<div style="overflow:hidden">		
			<?php foreach($organized_activities as $organized_activity) : ?>
				<div class="user_act_item pin" style="margin: 10px;
				overflow: hidden;
				padding: 0 10px 10px 10px;
				width: 200px;height:167px;float: left;background-color: white;
				box-shadow: 0 1px 3px black;
				font-size: 11px;">
					<a href="<?php echo url_for('activity_show', $organized_activity,true) ?>" style="display:block">
					<div style="font-size: 15px;font-weight: bold;"><?php echo $organized_activity->getName(); ?></div>
					<div><img height="150px" src="/uploads/activities/<?php echo $organized_activity->getSmallPoster() ?>"
			                      alt="<?php echo $organized_activity->getName() ?> poster" />
					</div>
					</a>
				</div>
		   <?php endforeach; ?> 
		</div>
	<?php endif ?>

	<?php if (count($attended_activities) > 0): ?>
		<p>您参与的活动:</p>

		<div style="overflow:hidden">	  
			<?php foreach($attended_activities as $attended_activity) : ?>
				<div class="user_act_item pin" style="margin: 10px;
				overflow: hidden;
				padding: 0 10px 10px 10px;
				width: 200px;height:167px;float: left;background-color: white;
				box-shadow: 0 1px 3px black;
				font-size: 11px;">
					<a href="<?php echo url_for('activity_show', $attended_activity,true) ?>" style="display:block">
					<div style="font-size: 15px;font-weight: bold;"><?php echo $attended_activity->getName(); ?></div>
					<div><img height="150px" src="<?php echo url_for('@homepage',true) ?>/uploads/activities/<?php echo $attended_activity->getSmallPoster() ?>"
			                      alt="<?php echo $attended_activity->getName() ?> poster" />
					</div>
					</a>
				</div>
		  <?php endforeach; ?>        
		</div>
		
		<p>再次谢谢您的参与，祝您圣诞和新年快乐。期待您明年更多的参与海米活动！</p>
	<?php endif ?>
	
	<?php if (count($attended_activities) == 0): ?>
		<div style="overflow:hidden">	  
			<?php foreach($hot_activities as $attended_activity) : ?>
				<div class="user_act_item pin" style="margin: 10px;
				overflow: hidden;
				padding: 0 10px 10px 10px;
				width: 200px;height:167px;float: left;background-color: white;
				box-shadow: 0 1px 3px black;
				font-size: 11px;">
					<a href="<?php echo url_for('activity_show', $attended_activity,true) ?>" style="display:block">
					<div style="font-size: 15px;font-weight: bold;"><?php echo $attended_activity->getName(); ?></div>
					<div><img height="150px" src="<?php echo url_for('@homepage',true) ?>/uploads/activities/<?php echo $attended_activity->getSmallPoster() ?>"
			                      alt="<?php echo $attended_activity->getName() ?> poster" />
					</div>
					</a>
				</div>
		  <?php endforeach; ?>        
		</div>
		<p>很可惜在这些活动中没出现您的身影，但是没关系， 在即将到来的2013初，我们已经为大家精心准备了6个活动 我们将奉献更多的活动等待您的参与。</p>
		<p>在此海米活动  祝您圣诞和新年快乐!</p>
	<?php endif ?>
	
	<p style="text-align:right">海米活动 敬上</p>
	
<?php end_slot() ?>


<?php include_partial('global/send_email_template', array('user' => $user)) ?>