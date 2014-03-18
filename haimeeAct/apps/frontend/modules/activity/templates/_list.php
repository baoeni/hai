<div id="activity">

  <?php foreach ($activities as $activity): ?>

  <div class="pin <?php echo $activity['activity']->getStatus(); ?>">
    
    
	<?php if ( $activity['activity']->getStatus() == "expired"): ?>
		<div class="expired-label">Expired</div>
	<?php endif ?>
	
	
	<div class="title">
	  <a href="<?php echo url_for('activity_show', $activity['activity']) ?>"><?php echo $activity['activity']->getName() ?></a><?php echo include_partial('activity/avarage_rating', array('activity' => $activity['activity'])) ?>
	</div>


		<table border="0" cellspacing="0" cellpadding="0" width="100%">
			<tr>
			    <td>
				  <a class="PinImage ImgLink2" href="<?php echo url_for('activity_show', $activity['activity']) ?>">
			      <img class="poster" src="/uploads/activities/<?php echo $activity['activity']->getSmallPoster() ?>"
                       alt="<?php echo $activity['activity']->getName() ?> poster" />
				  </a>
			    </td>
				
				<td class="act-detail" >
				<div style="position:relative;height:300px">
					<?php echo include_partial('activity/core', array('activity' => $activity['activity'])) ?>
				
				 
				<br style="clear:both"/>
					<div class="act-buttons">
						<a  class="Button Button13 GreenButton " href="<?php echo url_for('activity_show', $activity['activity']) ?>"><strong>See more</strong><span></span></a> 
						<?php if($sf_user->isAuthenticated() && $sf_user->getGuardUser()->isAttendedActivity($activity['activity']->getId())): ?>

				        <?php else: ?>
						
				        <a   class="Button Button13 RedButton join" href="<?php echo url_for('activity_attend', $activity['activity']) ?>"><strong>Join</strong><span></span></a> 

						<?php endif ?>
						<?php if($mode == 'attender'): ?>
						    <a  class="Button Button13 RedButton" href="<?php echo url_for('activity_order_show', $activity['activity']) ?>"><strong>Check order</strong><span></span></a>
						<?php endif ?>
						<?php if($mode == 'organizer'): ?>
						    <a  class="Button Button13 RedButton" href="<?php echo url_for('activity_admin', $activity['activity']) ?>"><strong>Admin</strong><span></span></a>
						<?php endif ?>
						<a   class="Button Button13 WhiteButton comment" href="<?php echo url_for('activity_show', $activity['activity']) ?>"><strong><em></em>Comment</strong><span></span></a>
					</div>
				</div>
			    </td>
			</tr>
			
		</table>
		<?php echo include_partial('activity/rating', array('activity' => $activity['activity'])) ?>
		
  <div class="convo attribution clearfix" style="position:relative">
	<p class="stats colorless" style="height:48px;float:left;margin:0 5px 0 0" title="attenders">
	    <span class="RepinsCount noteBadge noteBadge-user" style="background-image: url(/images/activity/group.png);
		background-repeat: no-repeat;
		padding-left: 37px;
		line-height: 30px;
		height: 30px;
		display: block;
		background-position: 6px center;margin-top: 6px;color:#000"><?php echo $activity['activity']->getAttendersTotalNum(); ?></span>&nbsp;&nbsp;
	    
	  </p>

	<?php $isSmall = count($activity['attenders']) > 27 ? TRUE : FALSE; ?>
  <?php foreach($activity['attenders'] as $attender) : ?>
	  <?php echo include_partial('activity/avatar', array('user' => $attender,'small' => $isSmall)) ?>
	  
   <?php endforeach; ?>
	
   </div>
  
<?php if($mode != 'attender' && $mode != 'organizer'): ?>
	<div class="comments colormuted">
		<?php foreach($activity['comments'] as $comment) : ?>
			<div class="comment convo clearfix">
			<?php echo include_partial('activity/avatar', array('user' => $comment->getUser(),'small' => true)) ?>
			<div class="comment_time"><?php echo $comment->getDateTimeObject('time')->format('M j')  ?></div>
               <div class="CommenterMeta">
				<div class="username"><a href="<?php echo url_for('user_profile_show', $comment->getUser(), true) ?>"><?php echo $comment->getUser()->getUsername() ?></a></div>

					<?php echo $comment->getContent(); ?>
				</div>
           </div>
		<?php endforeach; ?>
		
		<?php $commentsLength = $activity['commentsLength']; ?>
		<?php if ($commentsLength > 4 ): ?>
			<div class="comment convo clearfix">
	           <div class="CommenterMeta" style="text-align:center">

					<a href="<?php echo url_for('activity_show', $activity['activity']) ?>">view all <?php echo $activity['commentsLength'] ?> comments</a>
				</div>
	       </div>
		<?php endif ?>
		
	</div>
<?php endif ?>	
  </div>

  <?php endforeach; ?>

</div>