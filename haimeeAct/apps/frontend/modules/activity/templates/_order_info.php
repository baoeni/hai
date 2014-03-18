<div class="wufoo">
  	<table>
	    <tbody>
	      <tr >
	  		<th>First name</th>
	  		<td><?php echo $user['first_name'] ?></td>
		  </tr>
		<tr >
	  		<th>Last name</th>
	  		<td><?php echo $user['last_name'] ?></td>
		  </tr>
	    <tr >
	  		<th>Email</th>
	  		<td><?php echo $user['email_address'] ?></td>
		  </tr>
		<tr >
	  		<th>Phone</th>
	  		<td><?php echo $user['phone'] ?></td>
		  </tr>
  <?php
  $has_fees = (count($activity_fees['mandatory_fees']) + count($activity_fees['optional_fees']) + count($activity_fees['group_fees'])) > 0 ? true: false;
  if($has_fees):
  ?>

	<tr >
    <td>Payment</td>

	<td>
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
	</td>
	</tr>
	      <tr>
	  		<th>Amount</th>
	  		<td><?php echo $amount ?></td>
		  </tr>
		<tr>
	  		<th>Pay type</th>
	  		<td><?php echo $pay_type ?></td>
		  </tr>
  
  <?php else: ?>
    
	      <tr>
	  		<th>Amount</th>
	  		<td><?php echo $amount ?></td>
		  </tr>
  <?php endif ?>

	<tfoot>
      <tr>
        <td colspan="2">
			<?php if ($activity->getStatus() != 'expired'): ?>
				<a class="Button Button11 WhiteButton" href="<?php echo url_for('activity_order_edit', $activity) ?>"><strong>Edit my Order</strong><span></span></a>
			<?php endif ?>
			<a  class="Button Button11 WhiteButton" href="<?php echo url_for('activity_show_bank_account', $activity) ?>"><strong><em></em>Check payment detail</strong><span></span></a>
			<a class="Button Button11 WhiteButton" href="<?php echo url_for('activity_show', $activity) ?>"><strong>Back to Activity</strong><span></span></a>
        </td>
      </tr>
    </tfoot>

	</tbody>
</table>
</div>