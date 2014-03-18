<?php $counter = 0;  $fee_type_ = $fee_type; $gid = null; ?>

<div class="<?php echo $fee_type.'_wrapper' ?> fee_wrapper">
<fieldset>	
<legend>
  <?php echo $title ?>:
  <?php if ($fee_type == 'group_fee') : ?>
    <?php echo $fees['name']->renderError() ?>
    <?php echo $fees['name'] ?>
    <?php echo $fees['explanation']->renderError() ?>
    <?php echo $fees['explanation'] ?>
	<?php $gid = $fees['id']->getValue() ?>
    <?php $fees = $fees['fees']; ?>
    <?php endif ?>
</legend>

<table class="fixPrice" data-feetype="<?php echo $fee_type ?>" data-gid="<?php echo $gid ?>" data-gnum="<?php echo $gnum ?>" <?php if (count($fees) == 0 ) : ?>
style="display:none;"
  <?php endif ?>>
  <tr>
    <th>Fee name</th>
    <th>Price</th>
    <th>Max attenders</th>
    <th>Description</th>
    <th>Action</th>
  </tr>
  <?php if ($fee_type == 'group_fee') : ?>
    <?php $fee_type_ .= '_'.$gnum.'_item'; ?>
  <?php endif ?>
  <?php foreach ($fees as $fee): ?>
	<?php echo include_partial('fee_form', array('field' => $fee, 'key' => $fee_type_.'_'.$counter, 'fnum' => $counter)) ?>
	<?php $counter++; ?>
  <?php endforeach; ?>
</table>

<a  class="add_fee Button Button13 WhiteButton"><strong>add <?php echo $title ?></strong><span></span></a>
<?php if ($fee_type == 'group_fee') : ?>
  <?php if ($sf_request->isXmlHttpRequest()): ?>
	<a  class="remove_group Button Button13 WhiteButton"><strong>remove group</strong><span></span></a>
  <?php else: ?>
	<a  class="remove_group_hard Button Button13 WhiteButton"><strong>remove exsit group</strong><span></span></a>	
  <?php endif ?>
<?php endif ?>
</fieldset>
</div>
