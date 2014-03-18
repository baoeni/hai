<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form class="wufoo" action="<?php echo url_for('user/profileUpdate') ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>

<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>

<div class="info">
  <h2>
	Edit your profile
  </h2>
  <p>
  </p>
</div>


  <table>
    <tfoot>
      <tr>
        <td colspan="2">
		  <a onclick="$('form.wufoo').submit();" class="Button Button13 WhiteButton"><strong>Save</strong><span></span></a>
        </td>
		<td>
		  <?php echo $form->renderHiddenFields() ?>
		</td>
		<td>
		  <?php echo $form->renderGlobalErrors() ?>
		</td>
      </tr>
    </tfoot>
    
	<tbody>
	   <tr>
	    <?php echo $form['profile']['avatar']->renderRow() ?>
	  </tr>
      <tr>
	    <?php echo $form['first_name']->renderRow() ?>
	  </tr>
	  <tr>
	    <?php echo $form['last_name']->renderRow() ?>
	  </tr>
	  <tr>
	    <?php echo $form['profile']['birthday']->renderRow() ?>
	  </tr>
	  <tr>
	    <?php echo $form['profile']['sex']->renderRow() ?>
	  </tr>
	  <tr>
	    <?php echo $form['profile']['location']->renderRow() ?>
	  </tr>
	  <tr>
	    <?php echo $form['profile']['phone']->renderRow() ?>
	  </tr>
	<?php if ($sf_user->hasCredential('activity_admin')): ?>
	  <tr>
	    <?php echo $form['profile']['bank_account_info']->renderRow() ?>
	  </tr>
	<?php endif ?>
    </tbody>
  </table>
</form>