<div class="wufoo <?php echo $activity->getStatus(); ?>">
  
  <?php
  $has_fees = (count($activity_fees['mandatory_fees']) + count($activity_fees['optional_fees']) + count($activity_fees['group_fees'])) > 0 ? true: false;
  if($has_fees): 
  ?>

  <?php if(count($activity_fees['mandatory_fees']) > 0) : ?>
  <?php echo include_partial('fees_list', array('fees' => $activity_fees['mandatory_fees'], 'fee_type' => 'mandatory_fee', 'fee_id' => 0, 'title' => 'mandatory fees')) ?>
  <?php endif ?>

  <?php if(count($activity_fees['optional_fees']) > 0) : ?>
  <?php echo include_partial('fees_list', array('fees' => $activity_fees['optional_fees'], 'fee_type' => 'optional_fee', 'fee_id' => 0, 'title' => 'optinal fees')) ?>
  <?php endif ?>

  <?php if(count($activity_fees['group_fees']) > 0) : ?>
  <?php $group_fee_id = 0 ?>
  <div class="multiplePrice_wrapper fee_group_wrapper" style="display:block">
    <h3>multiple choose fees:</h3>
	<?php foreach ($activity_fees['group_fees'] as $group_fee) : ?>
	<?php echo include_partial('fees_list', array('fees' => $group_fee['fees'], 'fee_type' => 'group_fee', 'fee_id' => ($group_fee_id++), 'title' => $group_fee['fee_group']->getName())) ?>
	<?php endforeach ?>
  </div>
  <?php endif ?>

  <?php else: ?>

  <h3>There is no joining fees!</h3>

  <?php endif ?>
  
  <ul>
    <li>
	<a class="Button Button18 RedButton join" href="<?php echo url_for('activity_attend', $activity) ?>"><strong>Join Us!</strong><span></span></a>
	</li>
  </ul>

</div>