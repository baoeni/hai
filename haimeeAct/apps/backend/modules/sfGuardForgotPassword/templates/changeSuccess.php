<?php use_helper('I18N') ?>
<div class="wufoo">
	<div class="info">
		  <h2>
			<?php echo __('Hello %name%', array('%name%' => $user->getName()), 'sf_guard') ?>
		  </h2>
		  <p>
			<?php echo __('Enter your new password in the form below.', null, 'sf_guard') ?>
		  </p>
		</div>

<form action="<?php echo url_for('@sf_guard_forgot_password_change?unique_key='.$sf_request->getParameter('unique_key')) ?>" method="POST">
  <table>
    <tbody>
      <?php echo $form ?>
    </tbody>
    <tfoot><tr><td>
	<a onclick="$('form.wufoo').submit();" class="Button Button13 WhiteButton"><strong><?php echo __('Change', null, 'sf_guard') ?></strong><span></span></a>		
	</td></tr></tfoot>
  </table>
</form>
</div>