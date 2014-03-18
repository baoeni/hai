<?php use_helper('I18N') ?>

<form class="wufoo" action="<?php echo url_for('@sf_guard_register') ?>" method="post">
	
	<div class="info">
	  <h2>
		Register
	  </h2>
	  <p>
	  </p>
	</div>
	
  <table>
    <?php echo $form ?>
    <tfoot>
      <tr>
        <td colspan="2">
			<a onclick="$('form.wufoo').submit();" class="Button Button13 WhiteButton"><strong>Register</strong><span></span></a>		
        </td>
      </tr>
    </tfoot>
  </table>
</form>