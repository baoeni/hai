<?php use_helper('I18N') ?>

<form action="<?php echo url_for('@sf_guard_signin') ?>" method="post" class="wufoo">
	
	<div class="info">
	  <h2>
		Login
	  </h2>
	  <p>
	  </p>
	</div>
	
  <table>
    <tbody>
      <?php echo $form ?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="2">
			<a onclick="$('form.wufoo').submit();" class="Button Button13 WhiteButton"><strong>Submit</strong><span></span></a>	
			<input type="submit" style="padding: 0pt; border: medium none;" value=""/>		
          <?php $routes = $sf_context->getRouting()->getRoutes() ?>
        </td>
      </tr>
    </tfoot>
  </table>
</form>