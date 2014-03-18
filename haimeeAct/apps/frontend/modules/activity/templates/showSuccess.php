<?php slot('title') ?>
  <?php echo sprintf('activity - %s', $activity->getName()) ?>
<?php end_slot() ?>

  <div class="wufoo show_act">
	<div style="float:left;">
    <div class="pin pin-clean pin-right-border <?php echo $activity->getStatus(); ?>" >
	  <div class="title">
	    <?php echo $activity->getName() ?>
	    	
	    <?php echo include_partial('activity/avarage_rating', array('activity' => $activity)) ?>
	  </div>

       <table border="0" cellspacing="0" cellpadding="0">
		  <tr>
		    <td>
			  <img class="poster" src="/uploads/activities/<?php echo $activity->getSmallPoster() ?>"
	                      alt="<?php echo $activity->getName() ?> poster" />			
	           </td>
			<td class="act-detail">
			 	<?php echo include_partial('activity/core', array('activity' => $activity)) ?>
			</td>
		  </tr>
		<tr>
		
	    </table>

		<?php if ( $activity->getStatus() == "expired"): ?>
			<div class="expired-label" style="top:0px">Expired</div>
		<?php endif ?>
		
		<div class="button-area">
		    
			<?php if($sf_user->isAuthenticated() && $sf_user->getGuardUser()->isAttendedActivity($activity->getId())): ?>
	        <a  class="Button Button11 WhiteButton quit" href="<?php echo url_for('activity_quit', $activity) ?>"><strong><em></em>Quit</strong><span></span></a>
			<?php else: ?>
			<a  class="Button Button18 RedButton join" href="<?php echo url_for('activity_attend', $activity) ?>"><strong>Join</strong><span></span></a>
		    <?php endif ?>
		    <!-- <a  class="Button Button11 WhiteButton likebutton" href=""><strong>Like</strong><span></span></a> -->
			<?php if($sf_user->isAuthenticated() && $sf_user->getGuardUser()->isAttendedActivity($activity->getId())): ?>
	        <a  class="Button Button11 WhiteButton" href="<?php echo url_for('activity_order_show', $activity) ?>"><strong><em></em>Check my order</strong><span></span></a>
			<?php endif ?>
		    <?php if($sf_user->isAuthenticated() && $sf_user->isOrganizedActivity($activity->getId())): ?>
	        <a  class="Button Button11 WhiteButton" href="<?php echo url_for('activity_admin', $activity) ?>"><strong><em></em>Admin</strong><span></span></a>
		    <?php endif ?>
			
	  	</div>
		
		<div>
			
		</div>
		
		<?php echo include_partial('activity/rating', array('activity' => $activity)) ?>
		
	  <div class="act-detail-full" style="clear:both"><p class="description" style="	font-size: 20px;margin: 5px 0 10px 0;font-weight:bold">Description:  </p><?php echo html_entity_decode($activity->getDescription()) ?></div> 

    </div>
		
				<div class="" style="margin-top:15px;">
					<script type="text/javascript" charset="utf-8">
						function addComment() {
							var content = $.trim($('#commentbox').val());
							if(content.length > 0 ){
								//add loading
								$('.PinComments').prepend($('<div class="loading">loading...</div>'))

								$.ajax({
								    type: 'GET',
								    url: '<?php echo url_for('activity/addComment')?>'+'<?php echo ('?act_id='.$activity->getId())?>&content='+content

								  }).done(function(data) {
									 $('.PinComments').prepend($(data));
									$('#commentbox').val('');
								 	})
									.fail(function() { alert("error when adding comment"); })
									.always(function() { 
										//remove loading 
										$('.loading').remove();
										});
							}else{
								alert('please enter a comment');
							}

						}
						function removeComment(id){
							$.ajax({
							    type: 'GET',
							    url: '<?php echo url_for('activity/removeComment')?>'+'?id='+id

							  }).done(function(data) { 
								if(data.indexOf('error') > 0){
									alert(data);
								}else{
									$('#'+id).remove();						
								}
			 				})
								.fail(function() { alert("error when removing comment"); })
								;
						}

						$(document).ready(function(){
							$('.send_comment').click(function(){
								if($('#commentbox').val().length == 0){
									return false;
								};

								var sendEmail = $('#send_email');
								if(sendEmail.length && sendEmail.get(0).checked){
									sendEmail.css('display','none');
									$('.send_email_label').html('sending email, please wait...');
								}

								$(this).closest('form').submit();

								return false;
							});



							$('.image-zoom').fancybox({
				                padding : 0,
				                openEffect  : 'fade'
				            });
						});
					</script>



				    <?php if ($sf_user->isAuthenticated()): ?>
			      		<form action="<?php echo url_for('@add_comment') ?>" enctype="multipart/form-data" method="post" style="width: 700px;margin-bottom:20px">
				<div style="font-size:20px;font-weight:bold">Share comments:</div>
							<textarea id="commentbox" class="twitter-anywhere-tweet-box-editor" style="width: 100%; overflow-x: hidden; overflow-y: hidden; height: 3em; -moz-box-sizing:border-box;box-sizing: border-box;" dir="ltr" name="comment[content]"></textarea>
													<br/>
							<div style="margin-top:10px;overflow:hidden">
								<span>Upload a image:</span>
								<input name="comment[image]" id="comment_image" type="file">

								<a  class="Button Button13 RedButton send_comment"  onclick="" style="float:right"><strong><em></em>Send</strong><span></span></a>
									<?php if ($sf_user->isOrganizedActivity($activity->getId())): ?>
										<span style="float:right;padding: 0.45em 0.825em;">
										<input id="send_email" type="checkbox" name="send_email"><label class="send_email_label" for="send_email" > also send as email</label>
										</span>
									<?php endif ?>
							</div>
							<?php echo $commentForm->renderHiddenFields(); ?>
							<input type="hidden" name="act_id" value="<?php echo $activity->getId() ?>">
						</form>

					<?php endif ?>
					<div class="PinComments" style="width:700px">
						<?php foreach($activity_comments as $comment) : ?>
							<?php echo include_partial('comment_ajax', array('comment' => $comment,'activity' => $activity)) ?>
						<?php endforeach; ?>

					</div>
			    </div>
	
	</div>
	<div style="position: relative;float: right;z-index: 1;width:230px;">
    	<div class="attenders">
	  	<p>Attenders:</p>
	      <div class="list">
			<?php foreach($activity_attenders as $attender) : ?>
				<?php echo include_partial('avatar', array('user' => $attender)) ?>
			<?php endforeach; ?>
		  </div>
		  <p><a style="font-weight:normal" href="<?php echo url_for('activity_attenders', $activity) ?>">See all attenders</a><p>
	    </div>
	
		<div style="margin-top:40px; padding-left: 10px;">
			<p style="font-size: 20px;margin: 5px 0 10px 0;font-weight: bold;background-color: #F2F0F0;
			text-align: center;">More activities:</p>
			<?php foreach ($relatedActivityList as $r_activity): ?>
				<div class="r_act_item pin">
					<a href="<?php echo url_for('activity_show', $r_activity) ?>" style="display:block">
					<div style="font-size: 15px;font-weight: bold;"><?php echo $r_activity->getName(); ?></div>
					<div><img width="200px" src="/uploads/activities/<?php echo $r_activity->getSmallPoster() ?>"
			                      alt="<?php echo $r_activity->getName() ?> poster" />
					</div>
					</a>
				</div>
			<?php endforeach ?>
		</div>	
	</div>		
	<div style="clear:both"></div> 
			
    
  </div>