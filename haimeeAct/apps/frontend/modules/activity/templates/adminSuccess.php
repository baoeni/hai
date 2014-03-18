<?php slot('title') ?>
  <?php echo sprintf('activity - %s', $activity->getName()) ?>
<?php end_slot() ?>

<script type="text/javascript" charset="utf-8">
	function updateNote(useractid, contentSource) {
		var content = $(contentSource).val();
		if(content.length > 0 ){
			//add loading
			contentSource.after('<span>updating...</span>');
			$.ajax({
			    type: 'GET',
			    url: '<?php echo url_for('update_note',$activity)?>'+'?useractid='+useractid+'&content='+content
			    
			  }).done(function(data) {
				 
			  })
			  .fail(function() { alert("error when adding note"); })
			  .always(function() { 
					//remove loading 
					contentSource.siblings('span').remove();
			  });
		}else{
			alert('Please enter a note');
		}
	  
	}
	function quitAttender(userid,removeElm){
		$.ajax({
		    type: 'GET',
		    url: '<?php echo url_for('quit_attender',$activity)?>'+'?userid='+userid
		    
		  }).done(function(data) { 
			if(data.indexOf('error') > 0){
				alert(data);
			}else{
				$(removeElm).remove();	
				window.location.reload();					
			}
		}).fail(function() { alert("error when quitting attender"); });
	}
	function updatePaid(useractid,elm){
		var isTrue = elm.html() == 'no'? 1 : 0;
		
		elm.after('<span class="updating">updating</span>');
		$.ajax({
		    type: 'GET',
		    url: '<?php echo url_for('update_paid',$activity)?>'+'?useractid='+useractid+'&isTrue='+isTrue
		    
		  }).done(function(data) { 
			if(data.indexOf('error') > 0){
				alert(data);
			}else{
				elm.toggleClass('red green');
				if(elm.html() == 'no'){
					elm.html('yes');
				}else{
					elm.html('no');
				}
			}
		}).fail(function() { alert("error when update paid"); })
		.always(function() { 
			//remove loading 
			elm.siblings('.updating').remove();
		});
		
	}
	$(document).ready(function(){
		$('.quitAttender').click(function(){
			
			if(confirm('Are you sure to quit this user?')) 		
			{
				quitAttender($(this).data('userid'),$(this).closest('tr'));
			}
			return false;
		});

		$('.addNote, .updateNote').click(function(){
			updateNote($(this).data('useractid'),$(this).siblings('textarea'));			
			return false;
		});
		
		$('.paid').click(function(){
				updatePaid($(this).data('useractid'),$(this));
		});
	});
</script>
<form class="wufoo" action="" method="post">

			<div class="info">
			<h2>activity admin</h2>
			<div>control your activity!</div>
			</div>

			<?php include_partial('activity/activity_info', array('activity' => $activity, 'activity_organizer' => $activity_organizer, 'mode' => 'admin')) ?>

            <div class="info">
			<h2><?php echo $activity->getAttendersTotalNum(); ?> users joined:</h2>
            </div>
			<?php if (count($activity_attenders) > 0): ?>
				<?php 
					$is_mandatory = count($activity_fees['mandatory_fees']) > 0;
					$is_optional = count($activity_fees['optional_fees']) > 0;
					$is_group = count($activity_fees['group_fees']) > 0;
				 ?>
				
				<div class="info" style="border:none">Note: Click <span class="paid noteBadge green" >yes</span> or <span class="paid noteBadge red" >no</span> to change paid status.
				</div>
				
				<table border="1" cellspacing="1" cellpadding="1" style="border-spacing:0px;margin:0 auto;" class="act_admin_pay_table">
					<tr>
						<th>name</th>
						<th>email</th>
						<th>phone</th>
						<th>location</th>
						<th>quantity</th>
						
						<?php if ($activity->getMinFee() > 0): ?>	
							<?php if ($is_mandatory): ?>
							
	                        	<th>mandatory fees
									<?php $mandatoryFeeTotal = 0 ?>
									<ul>
									<?php foreach ($activity_fees['mandatory_fees'] as $mandatory_fee) : ?>
							    		<li style="width:auto"><?php echo $mandatory_fee->getName() ?>( &euro;<?php echo $mandatory_fee->getPrice() ?>)</li>
										<?php $mandatoryFeeTotal += $mandatory_fee->getPrice() ?>
									<?php endforeach ?>
									</ul>
									subtotal:  &euro;<?php echo $mandatoryFeeTotal; ?>
								</th>
							<?php endif ?>
							
							<?php if ($is_optional): ?>
								<th>optional fees</th>
							<?php endif ?>
							
							<?php if ($is_group): ?>
								<th>group fees</th>
							<?php endif ?>
							
							<th>pay method</th>
							<th>pay amount</th>
							<th>Paid</th>
						<?php endif ?>
						<!-- <th>rating</th> -->
						
						
						<th>Note</th>
						<th>Action</th>
					</tr>
					
					<?php $count = 0; ?>
					<?php foreach($activity_attenders as $attender) : ?>
						<?php $userAct = $attender->getUserActivity($activity->getId()); ?>
					<tr <?php if ($count%2 == 0): ?>
						class="even"
					<?php endif ?>>
						<?php $count++; ?>
						<td><?php echo include_partial('activity/avatar', array('user' => $attender)) ?><?php echo $attender->getUserName() ?></td>
						<td><?php echo $userAct->getUserEmailAddress() ?></td>
						<td><?php echo $userAct->getUserPhone() ?></td>
						<td><?php echo $userAct->getLocation() ?></td>
						<td class="bignumber"><?php echo $userAct->getAmount() ?></td>
						
						
						<?php if ($activity->getMinFee() > 0): ?>
							
						<?php if ($is_mandatory): ?>
					    	<?php
							$fees_amount = array();
							foreach ($userAct->getPayments() as $payment) :
							  $fees_amount[$payment->getFeeId()] = $payment->getAmount();
							endforeach;
							?>
							<td class="bignumber">
							&euro;<?php 
								$UserMandatoryFeeTotal = $userAct->getAmount() * $mandatoryFeeTotal;
								echo $UserMandatoryFeeTotal; 
								?>
							</td>
						<?php endif ?>
						
						<?php $UserOptionalFeeTotal = 0; ?>
						<?php if ($is_optional): ?>
							<td class="">
								
							<?php foreach ($activity_fees['optional_fees'] as $optional_fee) : ?>
						    <p><?php 

								if(isset($fees_amount[$optional_fee->getId()])){
									$subtotal = $optional_fee->getPrice() * $fees_amount[$optional_fee->getId()];
									echo $optional_fee->getName() .' x '. $fees_amount[$optional_fee->getId()].' = '.$subtotal;
									$UserOptionalFeeTotal += $subtotal;
								} ?>
							</p>
							<?php endforeach; ?>
							</td>
						<?php endif ?>
						
						<?php $UserGroupFeeTotal = 0; ?>
						<?php if ($is_group): ?>
							<td class="">
								
							<?php foreach ($activity_fees['group_fees'] as $group_fee) : ?>
							  <?php foreach ($group_fee['fees'] as $fee) : ?>
						      <p><?php 

								if(isset($fees_amount[$fee->getId()])){
									$subtotal = $fee->getPrice() * $fees_amount[$fee->getId()];
									echo  $fee->getName() .' x '. $fees_amount[$fee->getId()].' = '.$subtotal;
									$UserGroupFeeTotal += $subtotal;
								} ?>	
								</p>
							  <?php endforeach; ?>
							<?php endforeach; ?>
							</td>
						<?php endif ?>
						
						<td><?php echo $userAct->getPaymentType() ?></td>
						
						<td class="bignumber">
						 &euro;<?php echo $UserMandatoryFeeTotal + $UserOptionalFeeTotal + $UserGroupFeeTotal; ?>
						</td>
						
						<td>
							<?php if ($userAct->getPaid()): ?>
								<span class="paid noteBadge green" data-useractid="<?php echo $userAct->getId(); ?>">yes</span>
							<?php else: ?>
								<span class="paid noteBadge red" data-useractid="<?php echo $userAct->getId(); ?>">no</span>
							<?php endif ?>
							
						</td>
						
						<?php endif ?>
						
						<!-- <td>
							<?php $rating = $userAct->getRating(); ?>
							<?php if($rating): ?>
								<?php echo include_partial('user_rating', array('rating' => $rating)) ?>
							<?php endif ?>						
						</td> -->
						
						
						</td>
						<td class="useract-note">
							<?php $note =  $userAct->getNote(); ?>
							<textarea><?php echo $note; ?></textarea>
							<?php if (strlen($note) > 0 ): ?>
								<a class="Button Button11 WhiteButton updateNote " data-useractid="<?php echo $userAct->getId(); ?>"><strong><em></em>Update</strong><span></span></a>
							<?php else: ?>
								<a class="Button Button11 WhiteButton addNote " data-useractid="<?php echo $userAct->getId(); ?>"><strong><em></em>Add note</strong><span></span></a>
							<?php endif ?>
						</td>
						<td>
							<a class="Button Button11 WhiteButton quitAttender " data-userid="<?php echo $attender->getId(); ?>"><strong><em></em>Delete</strong><span></span></a>
					</tr>
					<?php endforeach; ?>

					<tr class="blacktr">
					  <td colspan="4">Total</td>

					  <td class="bignumber"><?php echo $activity_sum_amount ?></td>
					
					<?php if ($activity->getMinFee() > 0): ?>
					  
					<?php
					  $fees_sum_amount = array();
					  foreach($activity_attenders as $attender) {
						$userAct = $attender->getUserActivity($activity->getId());
						//echo $attender->getId().'-';
						foreach ($userAct->getPayments() as $payment) {
						  if(isset($fees_sum_amount[$payment->getFeeId()])){
							$fees_sum_amount[$payment->getFeeId()] += $payment->getAmount();
							}
					      else{
							$fees_sum_amount[$payment->getFeeId()] = $payment->getAmount();
							}
							$count++;
						 	//echo $payment->getAmount().'<br>'; 
                        }
					  }
					
					  ?>
					
					<?php $ActMandatoryFeeTotal = 0; ?>
					<?php if ($is_mandatory): ?>
						<td class="bignumber">
						  <?php foreach ($activity_fees['mandatory_fees'] as $mandatory_fee) : ?>
						  <p><?php

							if(isset($fees_sum_amount[$mandatory_fee->getId()])){
								$subtotal = $mandatory_fee->getPrice() * $fees_sum_amount[$mandatory_fee->getId()];
								//echo $mandatory_fee->getName() .' x '. $fees_sum_amount[$mandatory_fee->getId()].' = '.$subtotal;
								$ActMandatoryFeeTotal += $subtotal;
							} ?></p>

						  <?php endforeach; ?>
						<p >&euro;<?php echo $ActMandatoryFeeTotal; ?></p>
						</td>
					<?php endif ?>
					
					<?php $ActOptionalFeeTotal = 0; ?>
					<?php if ($is_optional): ?>
						<td >
						
						  <?php foreach ($activity_fees['optional_fees'] as $optional_fee) : ?>
						<p><?php

							if(isset($fees_sum_amount[$optional_fee->getId()])){
								$subtotal = $optional_fee->getPrice() * $fees_sum_amount[$optional_fee->getId()];
								echo  $optional_fee->getName() .' x '. $fees_sum_amount[$optional_fee->getId()].' = '.$subtotal;
								$ActOptionalFeeTotal += $subtotal;
							} ?></p>

						  <?php endforeach; ?>
						<p>subtotal:  &euro;<?php echo $ActOptionalFeeTotal; ?></p>
						</td>
					<?php endif ?>
					
					<?php $ActGroupFeeTotal = 0; ?>
					<?php if ($is_group): ?>
						
						<td >
						  <?php foreach ($activity_fees['group_fees'] as $group_fee) : ?>
						    <?php foreach ($group_fee['fees'] as $fee) : ?>
						    	<p><?php

									if(isset($fees_sum_amount[$fee->getId()])){
										$subtotal = $fee->getPrice() * $fees_sum_amount[$fee->getId()];
										echo  $fee->getName() .' x '. $fees_sum_amount[$fee->getId()].' = '.$subtotal;
										$ActGroupFeeTotal += $subtotal;
									} ?></p>


						    <?php endforeach; ?>
						  <?php endforeach; ?>
							<p>subtotal:  &euro;<?php echo $ActGroupFeeTotal; ?></p>
						</td>
					<?php endif ?>
					
					<td></td>
					
					<td class="bignumber"> &euro;<?php echo $ActMandatoryFeeTotal + $ActOptionalFeeTotal + $ActGroupFeeTotal; ?></td>
					
					<!-- paid -->
					<td></td>
					<?php endif ?>
					
					<!-- note -->
					<td></td>
					<!-- action -->
					<td></td>
					</tr>

				</table>
			<?php endif; ?>
			
</form>