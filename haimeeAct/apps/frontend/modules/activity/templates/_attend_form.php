<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form name="ActivityJoin" action="<?php echo url_for($form->getObject()->isNew() ?  'activity_join' : 'activity_order_update', $activity) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>

<?php echo $form->renderGlobalErrors() ?>

  <?php if (!$form->getObject()->isNew()): ?>
  <input type="hidden" name="sf_method" value="put" />
  <?php endif; ?>

	<?php echo $form->renderHiddenFields() ?>

  <div class="info">
    <h2>Please fill in the form below to complete the join process!</h2>
	<div>Fields with * are compulsory </div>
  </div>

<?php include_partial('activity/form_error', array('form' => $form)) ?>

	<table>
	    <tbody>
	      <tr <?php if ($form['user_first_name']->hasError()): ?>
	      	class="field_error"
	      <?php endif; ?>>
	  		<th><?php echo $form['user_first_name']->renderLabel() ?></th>
	  		<td><?php echo $form['user_first_name'] ?> <?php echo $form['user_first_name']->renderError() ?></td>
		  </tr>
		<tr <?php if ($form['user_last_name']->hasError()): ?>
	      	class="field_error"
	      <?php endif; ?>>
	  		<th><?php echo $form['user_last_name']->renderLabel() ?></th>
	  		<td><?php echo $form['user_last_name'] ?> <?php echo $form['user_last_name']->renderError() ?></td>
		  </tr>
		<tr <?php if ($form['user_email_address']->hasError()): ?>
	      	class="field_error"
	      <?php endif; ?>>
	  		<th><?php echo $form['user_email_address']->renderLabel() ?></th>
	  		<td><?php echo $form['user_email_address'] ?><?php echo $form['user_email_address']->renderError() ?></td>
		  </tr>
		<tr <?php if ($form['user_phone']->hasError()): ?>
	      	class="field_error"
	      <?php endif; ?>>
	  		<th><?php echo $form['user_phone']->renderLabel() ?></th>
	  		<td><?php echo $form['user_phone'] ?><?php echo $form['user_phone']->renderError() ?></td>
		  </tr>
	    <tr <?php if ($form['location']->hasError()): ?>
	      	class="field_error"
	      <?php endif; ?>>
	  		<th><?php echo $form['location']->renderLabel() ?></th>
	  		<td><?php echo $form['location'] ?><?php echo $form['location']->renderError() ?></td>
		  </tr>
  <?php
  $has_fees = (count($form['activity_fees']['mandatory_fees']) + count($form['activity_fees']['optional_fees']) + count($form['activity_fees']['group_fees'])) > 0 ? true: false;
  if($has_fees):
  ?>

	<tr >
    <td>Payment</td>

	<td>
	  <?php if(count($form['activity_fees']['mandatory_fees']) > 0) : ?>
	  <?php echo include_partial('attend_fees_form', array('fees' => $form['activity_fees']['mandatory_fees'], 'fee_type' => 'mandatory_fee', 'title' => 'mandatory fees')) ?>
	  <?php endif ?>
  
	  <?php if(count($form['activity_fees']['optional_fees']) > 0) : ?>
	  <?php echo include_partial('attend_fees_form', array('fees' => $form['activity_fees']['optional_fees'], 'fee_type' => 'optional_fee', 'title' => 'optional fees')) ?>
	  <?php endif ?>

	  <?php if(count($form['activity_fees']['group_fees']) > 0) : ?>
	  <?php echo include_partial('attend_fees_form', array('fees' => $form['activity_fees']['group_fees'], 'fee_type' => 'group_fee', 'title' => 'group fees')) ?>
	  <?php endif ?>
	</td>
	</tr>
	      <tr <?php if ($form['amount']->hasError()): ?>
	      	class="field_error"
	      <?php endif; ?>>
	  		<th><?php echo $form['amount']->renderLabel() ?></th>
	  		<td><?php echo $form['amount'] ?> <?php echo $form['amount']->renderError() ?></td>
		  </tr>
		<tr <?php if ($form['pay_type']->hasError()): ?>
	      	class="field_error"
	      <?php endif; ?>>
	  		<th><?php echo $form['pay_type']->renderLabel() ?></th>
	  		<td><?php echo $form['pay_type'] ?> <?php echo $form['pay_type']->renderError() ?></td>
		  </tr>
  
  <?php else: ?>
    
	      <tr <?php if ($form['amount']->hasError()): ?>
	      	class="field_error"
	      <?php endif; ?>>
	  		<th><?php echo $form['amount']->renderLabel() ?></th>
	  		<td><?php echo $form['amount'] ?> <?php echo $form['amount']->renderError() ?></td>
		  </tr>
  <?php endif ?>

	<tfoot>
      <tr>
        <td colspan="2">
          	<a class="Button Button13 RedButton"  onclick="document.ActivityJoin.submit();"><strong>	
			Submit
			</strong><span></span></a>
        </td>
      </tr>
    </tfoot>

	</tbody>
</table>
 </form>