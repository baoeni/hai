<?php slot('header1') ?>
  You just joined an activity!
<?php end_slot() ?>

<?php slot('header2') ?>
<?php end_slot() ?>

<?php slot('content') ?>
<table border="0" cellspacing="0" cellpadding="0" width="100%">
	<tr>
		<td>
			<a href="<?php echo url_for('activity_show', $activity,true) ?>"><h3><?php echo $activity->getName() ?></h3></a>
		</td>	
	</tr>
	  <tr>
	    <td>
		  <a href="<?php echo url_for('activity_show', $activity,true) ?>"><img class="poster" src="<?php echo url_for('@homepage',true) ?>uploads/activities/<?php echo $activity->getSmallPoster() ?>"
                      width="200" height="200" alt="<?php echo $activity->getName() ?> poster" /></a>			
           </td>
		<td class="act-detail" valign="top">
			<table border="0" cellspacing="5" cellpadding="5" width="100%">
				<tr>
					<td width="26px;"><img  src="<?php echo url_for('@homepage',true) ?>images/activity/clock.png" alt="Time" title="Time"/></td>
					<td><?php echo html_entity_decode($activity->showFormTillTime(true)); ?></td>
				</tr>
				<tr>
					<td><img  src="<?php echo url_for('@homepage',true) ?>images/activity/location_pin.png" alt="Location" title="Location"/></td>
					<td><?php echo html_entity_decode($activity->getLocation()); ?></td>
				</tr>
				<tr>
					<td><img  src="<?php echo url_for('@homepage',true) ?>images/activity/person.png" alt="Organizer" title="Organizer"/></td>
					<td><?php echo include_partial('activity/avatar', array('user' => $activity->getOrganizer(),'absolute' => true)) ?></td>
				</tr>
			</table>
		
		</td>
	  </tr>
	<tr>
	
    </table>

<?php
  $has_fees = (count($activity_fees['mandatory_fees']) + count($activity_fees['optional_fees']) + count($activity_fees['group_fees'])) > 0 ? true: false;
  if($has_fees): 
  ?>

<p>Below is your payment details:</p>

  <?php if(count($activity_fees['mandatory_fees']) > 0) : ?>
  <?php echo include_partial('fees_list', array('fees' => $activity_fees['mandatory_fees'], 'fee_type' => 'mandatory_fee', 'fee_id' => 0, 'title' => 'mandatory fees')) ?>
  <?php endif ?>

  <?php if(count($activity_fees['optional_fees']) > 0) : ?>
  <?php echo include_partial('fees_list', array('fees' => $activity_fees['optional_fees'], 'fee_type' => 'optional_fee', 'fee_id' => 0, 'title' => 'optinal fees', 'editable' => false)) ?>
  <?php endif ?>

  <?php if(count($activity_fees['group_fees']) > 0) : ?>
  <?php $group_fee_id = 0 ?>
  <div class="multiplePrice_wrapper fee_group_wrapper" style="display:block">
    <h3>multiple choose fees:</h3>
	<?php foreach ($activity_fees['group_fees'] as $group_fee) : ?>
	<?php echo include_partial('fees_list', array('fees' => $group_fee['fees'], 'fee_type' => 'group_fee', 'fee_id' => ($group_fee_id++), 'title' => $group_fee['fee_group']->getName(), 'editable' => false)) ?>
	<?php endforeach ?>
  </div>
  <?php endif ?>

  
  <p>Amount: 
  <?php echo $amount ?>
  </p>
  
  <p>Pay type:
  <?php echo $pay_type ?>
  </p>

  <p>Total cost:
	&euro; <?php echo $totalPayAmount ?>
  </p>

  <p>
 	Your payment detail can be seen <a href="<?php echo url_for('activity_show_bank_account', $activity,true) ?>">here</a>
  </p>

  <?php else: ?>


  <p>Amount: 
  <?php echo $amount ?>
  </p>

  <p>Total cost: Free</p>

  <?php endif ?>

  <p>
 	Your order can be seen <a href="<?php echo url_for('activity_order_show', $activity,true) ?>">here</a>
  </p>
  

<?php end_slot() ?>


<?php include_partial('global/send_email_template', array('user' => $user)) ?>