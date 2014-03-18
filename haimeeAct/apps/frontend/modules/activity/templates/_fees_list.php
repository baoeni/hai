<?php $counter = 0; ?>

<div class="<?php echo $fee_type.'_wrapper' ?> fee_wrapper">
<h3><?php echo $title ?>:</h3>

  <?php if ($fee_type == 'group_fee') : ?>
    <?php $fee_group_type = $fee_type. '_'.$fee_id.'_item'; ?>
  <?php endif ?>

  <table border="0" cellspacing="5" cellpadding="5">
  <tr>
    <th></th>
	<th>name</th>
	<th>price</th>
	<th>explanation</th>
  </tr>

  <?php foreach ($fees as $fee): ?>
  <?php $key = $fee_type.'_'.($counter++) ?>
	<tr>
	  <td>
	  <?php if ($fee_type == 'mandatory_fee') : ?>
		<input type="checkbox" checked="checked" disabled="disabled" name="<?php echo $key ?>" id="<?php echo $key ?>"/>
	  <?php endif ?>
	  <?php if (isset($editable)) : ?>
	    <?php if ($fee_type == 'optional_fee') : ?>
		  <input type="checkbox" checked="checked" disabled="disabled" name="<?php echo $key ?>" id="<?php echo $key ?>"/>
	    <?php endif ?>
	    <?php if ($fee_type == 'group_fee') : ?>
		<input type="radio" checked="checked" disabled="disabled" name="<?php echo $fee_group_type ?>" id="<?php echo $key ?>"/>
	    <?php endif ?>
	  <?php else: ?>
	    <?php if ($fee_type == 'optional_fee') : ?>
		  <input type="checkbox" name="<?php echo $key ?>" id="<?php echo $key ?>"/>
	    <?php endif ?>
	    <?php if ($fee_type == 'group_fee') : ?>
		<input type="radio" checked="checked" name="<?php echo $fee_group_type ?>" id="<?php echo $key ?>"/>
	    <?php endif ?>
	  <?php endif ?>
	  </td>
	  <td class="name"><?php echo $fee['name'] ?></td>
	  <td class="price"><?php echo $fee['price'] ?></td>
	  <td class="explanation"><?php echo $fee['explanation'] ?></td>
	</tr>

  <?php endforeach; ?>
  </table>
</div>