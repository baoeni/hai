<div class="<?php echo $fee_type.'_wrapper' ?> fee_wrapper">
<fieldset>
	<legend style="font-weight:bold;"><?php echo $title ?>:</legend>

  <table border="0" cellspacing="5" cellpadding="5">
  <tr>
    <th>status</th>
	<th></th>
	<th>name</th>
	<th>price</th>
	<th>explanation</th>
  </tr>

  <?php foreach ($fees as $fee): ?>
	  <?php if($fee_type === 'group_fee'): ?>
	  <div><?php echo $fee['fee_id']->renderLabel() ?>: </div>
	  <?php echo $fee['fee_id'] ?>
	  <tr><td><?php echo $fee['fee_id']->renderError() ?></td></tr>
	  <?php else: ?>
	  <tr>
	    <td><?php echo $fee['fee_id'] ?></td>
	    <td><?php echo $fee['fee_id']->renderLabel() ?></td>
		<td><?php echo $fee['fee_id']->renderError() ?></td>
	  </tr>
	  <?php endif ?>
  <?php endforeach; ?>

  </table>
</fieldset>
</div>