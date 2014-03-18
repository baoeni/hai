<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>


<script type="text/javascript" charset="utf-8">

var mandatory_fee_counter = <?php print_r($form['activity_fees']['mandatory_fees']->count())?>;
var optional_fee_counter = <?php print_r($form['activity_fees']['optional_fees']->count())?>;
var group_fee_counter = <?php print_r($form['activity_fees']['group_fees']->count())?>;
<?php if ($form->getObject()->getMaxAttenders()): ?>
	var max_attenders = <?php echo $form->getObject()->getMaxAttenders() ?>;
<?php endif ?>
var group_fee_item_counter_array = new Array();
<?php foreach ($form['activity_fees']['group_fees'] as $group_fee): ?>
    group_fee_item_counter_array.push(<?php print_r($group_fee['fees']->count()) ?>);
<?php endforeach; ?>


function addMandatoryFee(num) {
  var r = $.ajax({
    type: 'GET',
    url: '<?php echo url_for('activity/addMandatoryFeeForm')?>'+'<?php echo ('?id='.$form->getObject()->getId().'&num=')?>'+num,
    async: false
  }).responseText;

  return r;
}

function deleteMandatoryFee(num) {
  var r = $.ajax({
    type: 'GET',
    url: '<?php echo url_for('activity/deleteMandatoryFeeForm')?>'+'<?php echo ('?id='.$form->getObject()->getId().'&num=')?>'+num,
    async: false
  }).responseText;

  return r;
}

function addOptionalFee(num) {
  var r = $.ajax({
    type: 'GET',
    url: '<?php echo url_for('activity/addOptionalFeeForm')?>'+'<?php echo ('?id='.$form->getObject()->getId().'&num=')?>'+num,
    async: false
  }).responseText;

  return r;
}

function deleteOptionalFee(num) {
  var r = $.ajax({
    type: 'GET',
    url: '<?php echo url_for('activity/deleteOptionalFeeForm')?>'+'<?php echo ('?id='.$form->getObject()->getId().'&num=')?>'+num,
    async: false
  }).responseText;

  return r;
}

function addGroupFee(num) {
  var r = $.ajax({
    type: 'GET',
    url: '<?php echo url_for('activity/addGroupFeeForm')?>'+'<?php echo ('?id='.$form->getObject()->getId().'&num=')?>'+num,
    async: false
  }).responseText;

  return r;
}

function deleteGroupFee(num) {
  var r = $.ajax({
    type: 'GET',
    url: '<?php echo url_for('activity/deleteGroupFeeForm')?>'+'<?php echo ('?id='.$form->getObject()->getId().'&num=')?>'+num,
    async: false
  }).responseText;

  return r;
}

function addGroupFeeItem(gid, gnum, num) {
  var r = $.ajax({
    type: 'GET',
    url: '<?php echo url_for('activity/addGroupFeeItemForm')?>'+'<?php echo ('?id='.$form->getObject()->getId().'&gid=')?>'+gid+'&gnum='+gnum+'&num='+num,
    async: false
  }).responseText;

  return r;
}

function deleteGroupFeeItem(gid, gnum, num) {
  var r = $.ajax({
    type: 'GET',
    url: '<?php echo url_for('activity/deleteGroupFeeItemForm')?>'+'<?php echo ('?id='.$form->getObject()->getId().'&gid=')?>'+gid+'&gnum='+gnum+'&num='+num,
    async: false
  }).responseText;

  return r;
}


$(document).ready(function() {

  $('.delete').live('click',function(){
	if($(this).closest('table').find('tr').length == 2){
		$(this).closest('table').hide();
	}
    $(this).closest('tr').remove();
	
  });

  $('.delete_hard').live('click',function(){
    var table = $(this).closest('table');
	var row = $(this).closest('tr');
	var fee_type = table.attr('data-feetype');
    var fnum = parseInt($(this).closest('tr').attr('data-fnum'));
    if(fee_type == 'mandatory_fee')
	{
	  //var id = deleteMandatoryFee(fnum);
	  
      //var id = document.getElementById("activity_fees_activity_fees_mandatory_fees_mandatory_fee_"+fnum+"_delete").value;
	  //alert(id);
	if($("#activity_fees_activity_fees_mandatory_fees_mandatory_fee_"+fnum+"_delete").length){
		$("#activity_fees_activity_fees_mandatory_fees_mandatory_fee_"+fnum+"_delete").val('1');
	}

	  row.remove();
	  
	}else if(fee_type == 'optional_fee'){
      //deleteOptionalFee(fnum);

	  if($("#activity_fees_activity_fees_optional_fees_optional_fee_"+fnum+"_delete").length){
		$("#activity_fees_activity_fees_optional_fees_optional_fee_"+fnum+"_delete").val('1');
	}
	  row.remove();

	}else if(fee_type == 'group_fee'){   
	  //var gid = parseInt(table.attr('data-gid'));
	  var gnum = parseInt(table.attr('data-gnum'));
      //deleteGroupFee(gid, gnum, fnum);
      
	  //activity_fees_activity_fees_group_fees_group_fee_0_fees_group_fee_0_item_4_delete
	if($("#activity_fees_activity_fees_group_fees_group_fee_"+gnum+"_fees_group_fee_"+gnum+"_item_"+fnum+"_delete").length){
		$("#activity_fees_activity_fees_group_fees_group_fee_"+gnum+"_fees_group_fee_"+gnum+"_item_"+fnum+"_delete").val('1');
		} 	  
		row.remove();
	}
	//why hide? yini
	//table.hide();
  });

  $('.add_fee').live('click',function(){
    
    var table = $(this).closest('.fee_wrapper').find('table');

	var fee_type = table.attr('data-feetype');
	if(fee_type == 'mandatory_fee')
	{
      table.append(addMandatoryFee(mandatory_fee_counter));
		
	  
	
      mandatory_fee_counter = mandatory_fee_counter + 1;
	
	}else if(fee_type == 'optional_fee'){

	  table.append(addOptionalFee(optional_fee_counter));
      optional_fee_counter = optional_fee_counter + 1;

	}else if(fee_type == 'group_fee'){
      
	  var group_id = parseInt(table.attr('data-gid'));
	  var group_fee_num = parseInt(table.attr('data-gnum'));
	  var group_fee_item_num = group_fee_item_counter_array[group_fee_num];
      table.append(addGroupFeeItem(group_id, group_fee_num, group_fee_item_num));
	  group_fee_item_counter_array[group_fee_num] = group_fee_item_counter_array[group_fee_num] + 1;
	}
	
	var amountInput = $('tr:last input[name*=amount]',table);
	if(amountInput.length>0 && amountInput.val().length == 0 && typeof(max_attenders) != 'undefined'){
		amountInput.val(max_attenders);
	}
	table.show();
  });
  
  $('.remove_group').live('click',function(){
    $(this).closest('.fee_wrapper').remove();
  });

  $('.remove_group_hard').live('click',function(){
    var table = $(this).closest('.fee_wrapper').find('table');
    var gnum = parseInt(table.attr('data-gnum'));

    if($("#activity_fees_activity_fees_group_fees_group_fee_"+gnum+"_delete").length){
		$("#activity_fees_activity_fees_group_fees_group_fee_"+gnum+"_delete").val('1');
	}
    $(this).closest('.fee_wrapper').remove();
  });

  $('.add_group').click(function(){
	
	var wrapper = $(this).closest('.multiplePrice_wrapper');
	wrapper.append(addGroupFee(group_fee_counter));
	group_fee_item_counter_array[group_fee_counter] = 0;
	group_fee_counter = group_fee_counter + 1;
					
  });
   
 $('.submit').click(function(){
	$form = $('body #container form');
	valid = true;
	//validate
	$('input',$form).not('[type=hidden]').not('[name*=explanation]').each(function(){
		$td = $(this).closest('td');
		if(!this.value.length){
			valid = false;
			$td.addClass('field_error');
			if(!$td.find('ul').length){
				$td.append('<ul class="error_list"><li>this field is required.</li></ul>');
			}
		}else{
			$td.removeClass('field_error');
			$td.find('ul').remove();
		}
	});
	if(valid){
		$(this).attr('disabled',true);
		$('.formError').hide();
		$('body #container form').submit();		
	}else{
		$(this).attr('disabled',false);
		$('.formError').show();
	}

  });
});

</script>


<form action="<?php echo url_for(($mode === 'new' ? 'activity_fee_create' : 'activity_fee_update'), $form->getObject()) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>

  <?php if (!($mode === 'new')): ?>
  <input type="hidden" name="sf_method" value="put" />
  <?php endif; ?>

  <?php include_partial('activity/form_error', array('form' => $form)) ?>
	<div class="formError" style="display:none">
	<h3 id="errorMsgLbl">There was a problem with your submission.</h3>
	<p id="errorMsg">
	Errors have been <b>highlighted</b> below.
	</p>
	</div>
	
  <?php echo include_partial('fees_form', array('fees' => $form['activity_fees']['mandatory_fees'], 'fee_type' => 'mandatory_fee', 'gnum' => 0, 'title' => 'mandatory fees')) ?>

  <?php echo include_partial('fees_form', array('fees' => $form['activity_fees']['optional_fees'], 'fee_type' => 'optional_fee', 'gnum' => 0, 'title' => 'optional fees')) ?>


  <?php $group_fee_num = 0 ?>

  <div class=" fee_group_wrapper" style="display:block">
	<fieldset class="multiplePrice_wrapper">
    <legend>multiple choose fees:</legend>
	<a  class="add_group Button Button13 WhiteButton"><strong>add group</strong><span></span></a>	
	<?php foreach ($form['activity_fees']['group_fees'] as $group_fee) : ?>
	  <?php echo include_partial('fees_form', array('fees' => $group_fee, 'fee_type' => 'group_fee', 'gnum' => ($group_fee_num++), 'title' => 'group fee')) ?>
	<?php endforeach ?>
	</fieldset>	
  </div>

  <div class=" fee_group_wrapper" style="display:block">
    <fieldset class="multiplePrice_wrapper">
    <legend>allowed payment types (you must select one):</legend>
	<?php if ($form['payment_type_ids']->hasError()): ?>
		<?php echo $form['payment_type_ids']->renderError() ?>
	<?php endif; ?>
    <?php echo $form['payment_type_ids']->render() ?>
	</fieldset>
  </div>
  
  <ul>
    <li class="buttons">
	  <a onclick="" class="Button Button13 WhiteButton submit"><strong>Submit</strong><span></span></a>
    </li>
	<?php if ($mode === 'new'): ?>
	<li class="buttons">
	  <a  class="Button Button13 WhiteButton" href="<?php echo url_for('activity_show', $form->getObject()) ?>"><strong>Skip for Now</strong><span></span></a>
	</li>
	<?php endif; ?>
	<li>
	  <?php echo $form->renderHiddenFields() ?>
	</li>
	<li>
	  <?php echo $form->renderGlobalErrors() ?>
	</li>
  </ul>
</form>
