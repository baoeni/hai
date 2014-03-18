<tr id='<?php echo $key ?>' data-fnum="<?php echo $fnum ?>">  
  <td <?php if ($field['name']->hasError()): ?>class="field_error"<?php endif ?>>    
	<?php echo $field['name'] ?>
	<?php echo $field['name']->renderError() ?>
  </td>
  <td <?php if ($field['price']->hasError()): ?>class="field_error"<?php endif ?>>
    
	<?php echo $field['price'] ?>
	<?php echo $field['price']->renderError() ?>
  </td>
  <td <?php if ($field['amount']->hasError()): ?>class="field_error"<?php endif ?>>

	<?php echo $field['amount'] ?>
    <?php echo $field['amount']->renderError() ?>
  </td>
  <td <?php if ($field['explanation']->hasError()): ?>class="field_error"<?php endif ?>>

	<?php echo $field['explanation'] ?>
    <?php echo $field['explanation']->renderError() ?>
  </td>
<td>
  <?php if ($sf_request->isXmlHttpRequest()): ?>
		<a  class="delete Button Button13 WhiteButton"><strong>Delete</strong><span></span></a>
  <?php else: ?>
		<a  class="delete_hard Button Button13 WhiteButton"><strong>delete exsit fee</strong><span></span></a>
  <?php endif ?>
</td>
</tr>